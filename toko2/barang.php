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
    <title>Daftar Barang</title>
</head>
<body>

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
        <a class="nav-link" href="InnerJoin.php">
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

<main class='content'>
    <h1>Daftar Barang</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM barang";
        $result = $conn->query($sql);
        if ($result->num_rows > 0): 
            while ($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?php echo $row['id_barang']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['harga_barang']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td>
                    <button onclick="openEditModal(
                        '<?php echo $row['id_barang']; ?>',
                        '<?php echo $row['nama_barang']; ?>',
                        '<?php echo $row['harga_barang']; ?>',
                        '<?php echo $row['stock']; ?>'
                    )">Edit</button>
                    <button onclick="openDeleteModal('<?php echo $row['id_barang']; ?>')">Hapus</button>
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
        <h2>Edit Barang</h2>
        <form id="editForm" method="POST">
            <input type="hidden" name="id_barang" id="edit_id_barang">
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" id="edit_nama_barang" required>
            <label>Harga:</label>
            <input type="number" name="harga_barang" id="edit_harga" required>
            <label>Stok:</label>
            <input type="number" name="stock" id="edit_stock" required>
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
            <input type="hidden" name="id_barang" id="delete_id_barang">
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
        <h2>Tambah Barang</h2>
        <form action="tambah-barang-aksi.php" method="POST">
            <label>ID Barang:</label>
            <input type="text" name="id_barang" required>
            <label>Nama Barang:</label>
            <input type="text" name="nama_barang" required>
            <label>Harga:</label>
            <input type="number" name="harga_barang" required>
            <label>Stok:</label>
            <input type="number" name="stock" required>
            <button type="submit">Tambah</button>
        </form>
    </div>
</div>

<script src="tambah-barang.js"></script>
</body>
</html>

<?php
$conn->close();
?>
