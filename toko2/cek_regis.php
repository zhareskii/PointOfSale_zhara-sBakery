<?php
session_start(); // Mulai session
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Ambil role dari form
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['message'] = [
            'type' => 'danger',
            'text' => "Username sudah terdaftar!"
        ];
        header("Location: regis.php");
        exit();
    } else {
        // Simpan username, hashed password, dan role ke database
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $role);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => "Pendaftaran berhasil!"
            ];
            header("Location: regis.php");
            exit();
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => "Error: " . $stmt->error
            ];
            header("Location: regis.php");
            exit();
        }
    }

    $stmt->close();
    $conn->close();
}
?>