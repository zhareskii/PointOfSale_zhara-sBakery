<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Ambil password lama dari database
    $stmt = $conn->prepare("SELECT password FROM users WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $stmt->bind_result($oldPassword);
    $stmt->fetch();
    $stmt->close();

    // Periksa apakah password diubah
    if ($password === $oldPassword) {
        $hashedPassword = $oldPassword; // Tetap gunakan password lama jika tidak diubah
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash password baru
    }

    // Update data user
    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id_user = ?");
    $stmt->bind_param("sssi", $username, $hashedPassword, $role, $id_user);

    if ($stmt->execute()) {
        $_SESSION['message'] = ['type' => 'success', 'text' => "User berhasil diperbarui!"];
    } else {
        $_SESSION['message'] = ['type' => 'error', 'text' => "Terjadi kesalahan: " . $stmt->error];
    }

    $stmt->close();
    $conn->close();

    header("Location: users.php");
    exit();
}
?>
