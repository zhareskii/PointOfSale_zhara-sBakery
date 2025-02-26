<?php
include "koneksi.php";

// Ambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id_user = $_GET['id']; // Pakai id_user, bukan id_pelanggan
    $sql = "SELECT * FROM users WHERE id_user='$id_user'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    header("Location: users.php");
    exit();
}
?>

<body>
    <h2>Edit User</h2>
    <form action="edit-user-aksi.php" method="POST">
        <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
        <label>Password:</label>
        <input type="text" name="password" value="<?php echo $row['password']; ?>" required>
        <label>Role:</label>
                        <div class="radio-group mb-3">
                            <input type="radio" name="role" value="kariawan" id="kariawan" required>
                            <label for="kariawan">Kariawan</label>
                            <input type="radio" name="role" value="admin" id="admin" required>
                            <label for="admin">Admin</label>
                        </div>
        <button type="submit" id="btnSave">Simpan Perubahan</button>
    </form>
</body>
