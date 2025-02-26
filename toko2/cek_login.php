<?php
session_start();

include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Persiapkan statement dengan parameter untuk mencegah SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // Verifikasi password menggunakan password_verify
        if (password_verify($password, $data['password'])) {
                // Jika login berhasil, simpan data ke session
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $data['role'];
    
                // Redirect berdasarkan role
                if ($data['role'] == "admin") {
                    header("Location: admin.php");
                    exit();
                } elseif ($data['role'] == "kariawan") {
                    header("Location: kariawan.php");
                    exit();
                } 
        } else {
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => 'Password salah!'
            ];
        }
    } else {
        $_SESSION['message'] = [
            'type' => 'danger',
            'text' => 'Username tidak ditemukan!'
        ];
    }

    // Redirect ke halaman index
    header("Location: index.php");
    exit();

    $stmt->close();
    $conn->close();
}