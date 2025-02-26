<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];

    $sql = "UPDATE barang SET 
            nama_barang='$nama_barang', 
            harga_barang='$harga', 
            stock='$stock' 
            WHERE id_barang='$id_barang'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }

    header('location:barang1.php');
}
$conn->close();
?>
