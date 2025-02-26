<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];

    $sql = "DELETE FROM users WHERE id_user='$id_user'";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }
    header('location:users.php');
}

$conn->close();
?>
