<?php
include 'koneksi.php';
echo "<link rel='stylesheet' type='text/css' href='style.css'>";

// Ambil data barang
$sql = "SELECT * FROM detail_penjualan";
$result = $conn->query($sql);
?>
<body class='content'>
    <h1>Detail Penjualan</h1>
    <table border="1">
        <tr>
            <th>ID Transaksi Detail</th>
            <th>ID Transaksi</th>
            <th>ID Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga Satuan</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_transaksi_detail']; ?></td>
                    <td><?php echo $row['id_transaksi']; ?></td>
                    <td><?php echo $row['id_barang']; ?></td>
                    <td><?php echo $row['jml_barang']; ?></td>
                    <td><?php echo $row['harga_satuan']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Tidak ada data</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

<?php
$conn->close();
?>