<?php
session_start();
include 'koneksi.php';

// Ambil daftar barang dari database
$barang_result = $conn->query("SELECT * FROM barang");
$barang_list = [];
while ($row = $barang_result->fetch_assoc()) {
    $barang_list[$row['id_barang']] = $row;
}

// Jika belum ada keranjang, inisialisasi
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Tambah barang ke keranjang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_barang'])) {
    $id_barang = intval($_POST['id_barang']);
    $jumlah = intval($_POST['jumlah']);

    if (isset($barang_list[$id_barang])) {
        if (isset($_SESSION['keranjang'][$id_barang])) {
            $_SESSION['keranjang'][$id_barang]['jumlah'] += $jumlah;
        } else {
            $_SESSION['keranjang'][$id_barang] = $barang_list[$id_barang];
            $_SESSION['keranjang'][$id_barang]['jumlah'] = $jumlah;
        }
    }
}

// Hapus barang dari keranjang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_barang'])) {
    $id_barang = intval($_POST['hapus_barang']);
    unset($_SESSION['keranjang'][$id_barang]);
}

// Proses transaksi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proses_transaksi'])) {
    $id_transaksi = date("YmdHis") . rand(100, 999);
    $tgl_transaksi = date("Y-m-d");
    $total_transaksi = 0;

    foreach ($_SESSION['keranjang'] as $barang) {
        $id_barang = $barang['id_barang'];
        $jumlah = $barang['jumlah'];
        $harga_satuan = $barang['harga_barang'];
        $subtotal = $harga_satuan * $jumlah;
        $total_transaksi += $subtotal;

        $conn->query("INSERT INTO detail_penjualan (id_transaksi, id_barang, jml_barang, harga_satuan) 
                      VALUES ('$id_transaksi', '$id_barang', '$jumlah', '$harga_satuan')");
    }

    if ($total_transaksi > 0) {
        $conn->query("INSERT INTO penjualan (id_transaksi, tgl_transaksi, total_transaksi) 
                      VALUES ('$id_transaksi', '$tgl_transaksi', '$total_transaksi')");

        $_SESSION['keranjang'] = [];
        header("Location: invoice.php?id=$id_transaksi");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Kasir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
    <script>
        function updateNamaBarang() {
            var id_barang = document.getElementById("id_barang").value;
            var barangList = <?= json_encode($barang_list); ?>;
            if (barangList[id_barang]) {
                document.getElementById("nama_barang").value = barangList[id_barang]['nama_barang'];
            } else {
                document.getElementById("nama_barang").value = "";
            }
        }
    </script>
</head>
<body>
<div class="sidebar">
    <br>
    <div class="user-info text-center">
        <h2>Karyawan</h2>
    </div>
    <br>
    <nav class="nav flex-column">
        <a class="nav-link" href="pelanggan.php">
            <i class="bi bi-calendar2-heart"></i> Table Pelanggan
        </a>
        <a class="nav-link" href="barang.php">
            <i class="bi bi-box2-heart"></i> Table Barang
        </a>
        <a class="nav-link" href="InnerJoin.php">
        <i class="bi bi-clipboard2-heart"></i> Table Laporan
        </a>
        <a class="nav-link" href="kasir.php">
            <i class="bi bi-basket-fill"></i> Kasir
        </a><br><br>
        
        <a class="nav-link" href="index.php">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </nav>
</div>
<div class="content">
    <h2>Kasir</h2>
    <form method="POST" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <label>ID Barang</label>
                <input type="number" name="id_barang" id="id_barang" class="form-control" required oninput="updateNamaBarang()">
            </div>
            <div class="col-md-3">
                <label>Nama Barang</label>
                <input type="text" id="nama_barang" class="form-control" disabled>
            </div>
            <div class="col-md-3">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" min="1" required>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" name="tambah_barang" class="btn btn-success">Tambah</button>
            </div>
        </div>
    </form>
    
    <table class="table table-bordered">
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['keranjang'] as $barang): ?>
            <?php $subtotal = $barang['harga_barang'] * $barang['jumlah']; ?>
            <tr>
                <td><?= htmlspecialchars($barang['id_barang']); ?></td>
                <td><?= htmlspecialchars($barang['nama_barang']); ?></td>
                <td><?= number_format($barang['harga_barang'], 0, ',', '.'); ?></td>
                <td><?= htmlspecialchars($barang['jumlah']); ?></td>
                <td><?= number_format($subtotal, 0, ',', '.'); ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <button type="submit" name="hapus_barang" value="<?= $barang['id_barang']; ?>" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php $total += $subtotal; ?>
        <?php endforeach; ?>
    </table>

    <h4>Total: Rp <?= number_format($total, 0, ',', '.'); ?></h4>

    <form method="POST">
        <button type="submit" name="proses_transaksi" class="btn btn-primary">Proses Transaksi</button>
    </form>
</div>
</body>
</html>
