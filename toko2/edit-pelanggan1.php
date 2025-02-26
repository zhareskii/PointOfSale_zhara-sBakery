<?php
include "koneksi.php";

// Ambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id_pelanggan = $_GET['id'];
    $sql = "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    header("Location: pelanggan1.php");
    exit();
}
?>

<body>
    <h2>Edit Pelanggan</h2>
    <form action="edit-pelanggan-aksi1.php" method="POST">
        <input type="hidden" name="id_pelanggan" value="<?php echo $row['id_pelanggan']; ?>">

        <label>Nama Pelanggan:</label>
        <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required>

        <label>Gender:</label>
        <input type="text" name="gender" value="<?php echo $row['gender']; ?>" required>

        <button type="submit" id="btnSave">Simpan Perubahan</button>
    </form>
</body>
