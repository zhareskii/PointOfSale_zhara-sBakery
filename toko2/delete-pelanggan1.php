<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pelanggan = $_POST['id_pelanggan'];

    $sql = "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }
    header('location:pelanggan1.php');
}

$conn->close();
?>
