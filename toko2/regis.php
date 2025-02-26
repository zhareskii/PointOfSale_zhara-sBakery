<?php
session_start(); // Mulai session
include 'koneksi.php'; // Menghubungkan ke database
echo "<link rel='stylesheet' type='text/css' href='style.css'>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='style.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Daftar</title>
    
</head>
<body class='form'>
    <form method="POST" action="cek_regis.php">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="row border rounded-5 p-3 bg-white shadow box-area">
                <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column right-box" style="background: #f8d8c3;">
                    <div class="featured-image mb-3">
                        <img src="assets/birthday_cake.jpg" class="img-fluid" style="width: 250px;">
                    </div>
                    <p class="text-black fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">ZHARA'S BAKERY</p>
                    <small class="text-black text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced bakery on this platform.</small>
                </div> 

                <div class="col-md-6 left-box">
                    <div class="row align-items-center">
                        <div class="header-text mb-4">
                            <h2>Hello, Again</h2>
                            <p>We are happy to have you back.</p>
                        </div>
                        <?php if (isset($_SESSION['message'])): ?>
                            <div class="alert alert-<?php echo $_SESSION['message']['type'] === 'success' ? 'success' : 'danger'; ?>" role="alert">
                                <?php 
                                    echo $_SESSION['message']['text']; 
                                    unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control form-control-lg bg-light fs-6" placeholder="Username" required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" required>
                        </div>
                        <label>Role:</label>
                        <div class="radio-group mb-3">
                            <input type="radio" name="role" value="kariawan" id="kariawan" required>
                            <label for="kariawan">Kariawan</label>
                            <input type="radio" name="role" value="admin" id="admin" required>
                            <label for="admin">Admin</label>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg" style="background-color: #f09688; color: white; border: none; width: 100%; font-size: 1rem;">Register</button>
                        </div>
                        <div class="row">
                            <small>Have an account? <a href="index.php">Login</a></small>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </form>
</body>
</html>