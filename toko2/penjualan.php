<?php
include 'koneksi.php';
echo "<link rel='stylesheet' type='text/css' href='style.css'>";

// Ambil data barang
$sql = "SELECT * FROM penjualan";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main class='content'>
    <h1>Daftar Barang</h1>
    <table border="1">
        <tr>
            <th>ID Transaksi</th>
            <th>ID Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <tr>Aksi</tr>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_transaksi']; ?></td>
                    <td><?php echo $row['id_pelanggan']; ?></td>
                    <td><?php echo $row['tgl_transaksi']; ?></td>
                    <td><?php echo $row['total_transaksi']; ?></td>
                    <td>
                        <button class="btn-edit" onclick="openEditModal('<?php echo $row['id_barang']; ?>', '<?php echo $row['nama_barang']; ?>', '<?php echo $row['harga_barang']; ?>', '<?php echo $row['stock']; ?>')">Edit</button>
                        <button class="btn-delete" onclick="openDeleteModal('<?php echo $row['id_barang']; ?>')">Hapus</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Tidak ada data</td>
            </tr>
        <?php endif; ?>
    </table>
</main>
</body>
</html>


<?php
$conn->close();
?>