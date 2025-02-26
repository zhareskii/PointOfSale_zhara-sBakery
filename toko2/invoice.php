<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    die("ID transaksi tidak ditemukan. <a href='kasir.php'>Kembali</a>");
}

$id_transaksi = $_GET['id'];

// Ambil data transaksi
$sql = "SELECT p.id_transaksi, p.tgl_transaksi, p.total_transaksi, 
               d.id_barang, d.jml_barang, d.harga_satuan, b.nama_barang
        FROM penjualan p 
        INNER JOIN detail_penjualan d ON p.id_transaksi = d.id_transaksi
        INNER JOIN barang b ON d.id_barang = b.id_barang
        WHERE p.id_transaksi = '$id_transaksi'";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Transaksi tidak ditemukan. <a href='kasir.php'>Kembali</a>");
}

$data = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-box { border: 1px solid #ddd; padding: 20px; width: 50%; margin: auto; }
        .text-center { text-align: center; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; word-wrap: break-word; }
        .no-print { margin-top: 20px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <h2 class="text-center">Struk Transaksi</h2>
    <p>ID Transaksi: <strong><?php echo htmlspecialchars($data[0]['id_transaksi']); ?></strong></p>
    <p>Tanggal: <?php echo htmlspecialchars($data[0]['tgl_transaksi']); ?></p>

    <table>
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $total = 0;
        foreach ($data as $row):
            $subtotal = $row['jml_barang'] * $row['harga_satuan'];
            $total += $subtotal;
        ?>
        <tr>
            <td><?= htmlspecialchars($row['id_barang']); ?></td>
            <td><?= htmlspecialchars($row['nama_barang']); ?></td>
            <td><?= htmlspecialchars($row['jml_barang']); ?></td>
            <td><?= number_format($row['harga_satuan'], 0, ',', '.'); ?></td>
            <td><?= number_format($subtotal, 0, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h4>Total: Rp <?= number_format($total, 0, ',', '.'); ?></h4>

    <div class="no-print">
        <button onclick="window.print()" class="btn btn-primary">Cetak Nota</button>
        <a href="kasir.php" class="btn btn-secondary">Kembali</a>
    </div>
</div>

</body>
</html>
