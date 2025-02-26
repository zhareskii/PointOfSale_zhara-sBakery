<?php
include 'koneksi.php'; // Pastikan ini ada di bagian atas file
echo "<link rel='stylesheet' type='text/css' href='style.css'>";

// Ambil nilai filter tanggal jika ada
$tgl_awal = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : '';
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : '';

// Query untuk mengambil data sesuai filter tanggal
$query = "SELECT penjualan.id_transaksi, detail_penjualan.id_barang, detail_penjualan.jml_barang, detail_penjualan.harga_satuan, penjualan.tgl_transaksi, penjualan.total_transaksi 
          FROM detail_penjualan 
          INNER JOIN penjualan ON detail_penjualan.id_transaksi = penjualan.id_transaksi";

if (!empty($tgl_awal) && !empty($tgl_akhir)) {
    $query .= " WHERE penjualan.tgl_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'";
}

$data = mysqli_query($conn, $query);
if (!$data) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
    <title>Daftar Barang</title>
    <style>
        @media print {
            .sidebar, .no-print {
                display: none;
            }
        }
    </style>
</head>
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
        <a class="nav-link" href="innerJoin.php">
            <i class="bi bi-clipboard2-heart"></i> Table Laporan
        </a>
        <a class="nav-link" href="kasir.php">
            <span class="icon">
                <i class="bi bi-basket-fill"></i>
            </span>
            <span class="description">Kasir</span>
        </a><br><br>
        <a class="nav-link" href="index.php">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </nav>
</div>
<body class="content">
    <h1>Laporan Penjualan</h1>
    
    <form method="GET" class="no-print d-flex gap-2 mb-3">
        <label for="tgl_awal" class="form-label">Dari:</label>
        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" value="<?php echo htmlspecialchars($tgl_awal); ?>">
        <label for="tgl_akhir" class="form-label">Sampai:</label>
        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" value="<?php echo htmlspecialchars($tgl_akhir); ?>">
        <button type="submit" class="btn btn-primary">Filter</button>
        <button type="button" class="btn btn-success" onclick="window.print()">Cetak</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='innerJoin.php'">Reset</button>
    </form>
    
    <table border='1'>
        <tr>
            <th>ID Transaksi</th>
            <th>ID Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga Satuan</th>
            <th>Tanggal Transaksi</th>
            <th>Total Transaksi</th>
        </tr>
        <?php
        if (mysqli_num_rows($data) > 0) {
            while($tampil = mysqli_fetch_array($data)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($tampil['id_transaksi']) . "</td>";
                echo "<td>" . htmlspecialchars($tampil['id_barang']) . "</td>";
                echo "<td>" . htmlspecialchars($tampil['jml_barang']) . "</td>";
                echo "<td>" . htmlspecialchars($tampil['harga_satuan']) . "</td>";
                echo "<td>" . htmlspecialchars($tampil['tgl_transaksi']) . "</td>";
                echo "<td>" . htmlspecialchars($tampil['total_transaksi']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data ditemukan</td></tr>";
        }
        ?>
    </table>

    <?php
    mysqli_close($conn);
    ?>
</body>
</html>