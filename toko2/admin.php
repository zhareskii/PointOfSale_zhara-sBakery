<?php
session_start(); // Mulai session
// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}
?>
<link rel='stylesheet' type='text/css' href='style.css'>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
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
                    <i class="bi bi-clipboard2-heart"></i>
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

    <main class="main-content">
        <h2>Hallo Admin</h2>
        <p>Selamat datang di dashboard admin</p>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>