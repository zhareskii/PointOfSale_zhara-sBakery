<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_barang = $_POST['id_barang'];

    $sql = "DELETE FROM barang WHERE id_barang='$id_barang'";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }
    header('location:barang1.php');
}

$conn->close();
?>
