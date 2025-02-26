<?php
include "koneksi.php";

// Ambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];
    $sql = "SELECT * FROM barang WHERE id_barang='$id_barang'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    header("Location: barang.php");
    exit();
}
?>

<body>
    <h2>Edit Barang</h2>
    <form action="edit-barang-aksi.php" method="POST">
        <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">

        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required>

        <label>Harga:</label>
        <input type="number" name="harga" value="<?php echo $row['harga_barang']; ?>" required>

        <label>Stok:</label>
        <input type="number" name="stock" value="<?php echo $row['stock']; ?>" required>

        <button type="submit" id="btnSave">Simpan Perubahan</button>
    </form>
</body>
