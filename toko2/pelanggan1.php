<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
    <title>Document</title>
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
                <span>
                    <i class="bi bi-calendar2-heart"></i>
                </span>
                <span class="description">Table User</span>
            </a>
            <a class="nav-link" href="pelanggan1.php">
                <span class="icon">
                    <i class="bi bi-calendar2-heart"></i>
                </span>
                <span class="description">Table Pelanggan</span>
            </a>
            <a class="nav-link" href="barang1.php">
                <span class="icon">
                    <i class="bi bi-box2-heart"></i>
                </span>
                <span class="description">Table Barang</span>
            </a>
            <a class="nav-link" href="InnerJoin1.php">
                <span class="icon">
                    <i class="bi bi-basket-fill"></i>
                </span>
                <span class="description">Table Laporan</span>
            </a>
            <a class="nav-link" href="index.php">
                <span class="icon">
                    <i class="bi bi-box-arrow-left"></i>
                </span>
                <span class="description">Logout</span>
            </a>
        </nav>
    </div>
</body>
</html>
<?php
include 'koneksi.php';
echo "<link rel='stylesheet' type='text/css' href='style.css'>";

// Ambil data pelanggan
$sql = "SELECT * FROM pelanggan";
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
    <h1>Daftar Pelanggan</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Gender</th>
            <th>Aksi</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_pelanggan']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td class="actionButton">
                    <button class="btn-edit" onclick="openEditModal(
                    '<?php echo htmlspecialchars($row['id_pelanggan'], ENT_QUOTES); ?>', 
                    '<?php echo htmlspecialchars($row['nama'], ENT_QUOTES); ?>', 
                    '<?php echo htmlspecialchars($row['gender'], ENT_QUOTES); ?>'
                )">Edit</button>


                        <button class="btn-delete" onclick="openDeleteModal('<?php echo $row['id_pelanggan']; ?>')">Hapus</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
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
        <h2>Edit Pelanggan</h2>
        <form id="editForm" method="POST">
            <input type="hidden" name="id_pelanggan" id="edit_id_pelanggan">
            <label>Nama Pelanggan:</label>
            <input type="text" name="nama" id="edit_nama" required>
            <label>Gender:</label>
            <input type="text" name="gender" id="edit_gender" required>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</div>


<!-- MODAL HAPUS -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2>Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus barang ini?</p>
        <form id="deleteForm" method="POST">
            <input type="hidden" name="id_pelanggan" id="delete_id_pelanggan">
            <button type="submit">Hapus</button>
            <button type="button" onclick="closeDeleteModal()">Batal</button>
        </form>
    </div>
</div>

<script src="tambah-pelanggan.js"></script>
</body>

    </table>
        <button id="openModal" class="btn-add">
        <span>+</span>
        </button>
    </main>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambah Pelanggan</h2>
            <form action="tambah-pelanggan-aksi.php" method="POST">
                <label for="id_pelanggan">ID Pelanggan:</label>
                <input type="text" name="id_pelanggan" required>

                <label for="nama">Nama Pelanggan:</label>
                <input type="text" name="nama" required>

                <label for="gender">Gender:</label>
                <input type="text" name="gender" required>

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
    <script src="tambah-pelanggan.js"></script>
</body>
</html>

</body>
</html>

<?php
$conn->close();
?>