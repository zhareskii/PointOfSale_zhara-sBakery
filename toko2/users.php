<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
    <title>Daftar Pengguna</title>
</head>
<body>

<div class="sidebar">
    <br>
    <div class="user-info text-center">
        <h2>Admin</h2>
    </div>
    <br>
    <nav class="nav flex-column">
        <a class="nav-link" href="users.php">
            <i class="bi bi-calendar2-heart"></i> Table User
        </a>
        <a class="nav-link" href="pelanggan1.php">
            <i class="bi bi-calendar2-heart"></i> Table Pelanggan
        </a>
        <a class="nav-link" href="barang1.php">
            <i class="bi bi-box2-heart"></i> Table Barang
        </a>
        <a class="nav-link" href="InnerJoin1.php">
            <i class="bi bi-basket-fill"></i> Table Laporan
        </a>
        
        <a class="nav-link" href="index.php">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </nav>
</div>

<main class='content'>
    <h1>Daftar Pengguna</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0): 
            while ($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?php echo $row['id_user']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td>
                <button onclick="openEditModal('<?php echo $row['id_user']; ?>', `<?php echo addslashes($row['username']); ?>`, `<?php echo addslashes($row['password']); ?>`, '<?php echo $row['role']; ?>')">
                        Edit
                    </button>
                    <button onclick="openDeleteModal('<?php echo $row['id_user']; ?>')">Hapus</button>
                </td>
            </tr>
        <?php 
            endwhile;
        else:
        ?>
            <tr>
                <td colspan="5">Tidak ada data</td>
            </tr>
        <?php endif; ?>
    </table>
</main>

<!-- MODAL EDIT -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit User</h2>
        <form id="editForm" method="POST" action="edit-user-aksi.php">        
            <input type="hidden" name="id_user" id="edit_id_user">
            <label>Username:</label>
            <input type="text" name="username" id="edit_username" required>
            <label>Password:</label>
            <input type="text" name="password" id="edit_password" required>
            <label>Role:</label>
            <div class="radio-group mb-3">
                <input type="radio" name="role" value="kariawan" id="edit_kariawan" required>
                <label for="edit_kariawan">Kariawan</label>
                <input type="radio" name="role" value="admin" id="edit_admin" required>
                <label for="edit_admin">Admin</label>
            </div>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</div>


<!-- MODAL HAPUS -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2>Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus user ini?</p>
        <form id="deleteForm" method="POST">
            <input type="hidden" name="id_user" id="delete_id_user">
            <button type="submit">Hapus</button>
            <button type="button" onclick="closeDeleteModal()">Batal</button>
        </form>
    </div>
</div>

<!-- MODAL TAMBAH -->
<button id="openModal" class="btn-add">+</button>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Tambah User</h2>
        <form action="tambah-user-aksi.php" method="POST">
            <!--<label>ID User:</label>-->
            <input type="hidden" name="id_user" required>
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="text" name="password" required>
            <label>Role:</label>
                        <div class="radio-group mb-3">
                            <input type="radio" name="role" value="kariawan" id="kariawan" required>
                            <label for="kariawan">Kariawan</label>
                            <input type="radio" name="role" value="admin" id="admin" required>
                            <label for="admin">Admin</label>
                        </div>
            <button type="submit">Tambah</button>
        </form>
    </div>
</div>
<script src="tambah-user.js"></script>
</body>
</html>

<?php
$conn->close();
?>
