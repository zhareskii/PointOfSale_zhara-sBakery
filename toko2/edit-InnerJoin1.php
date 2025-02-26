<?php
include "koneksi.php";

// Ambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];
    $sql = "SELECT * FROM penjualan WHERE id_transaksi='$id_transaksi'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    header("Location: InnerJoin1.php");
    exit();
}
?>

<body>
    <h2>Edit Laporan</h2>
    <form action="edit-InnerJoin-aksi1.php" method="POST">
        <input type="hidden" name="id_transaksi" value="<?php echo $row['id_transaksi']; ?>">

        <label>ID Barang:</label>
        <input type="number" name="id_barang" value="<?php echo $row['id_barang']; ?>" required>

        <label>Jumlah Barang:</label>
        <input type="number" name="jml_barang" value="<?php echo $row['jml_barang']; ?>" required>

        <label>Harga Satuan:</label>
        <input type="number" name="harga_satuan" value="<?php echo $row['harga_satuan']; ?>" required>

        <label>Tanggal Transaksi:</label>
        <input type="date" name="tgl_transaksi" value="<?php echo $row['tgl_transaksi']; ?>" required>

        <label>Total Transaksi:</label>
        <input type="number" name="total_transaksi" value="<?php echo $row['total_transaksi']; ?>" required>

        <button type="submit" id="btnSave">Simpan Perubahan</button>
    </form>
</body>
