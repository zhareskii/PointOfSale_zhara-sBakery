<?php
    include "koneksi.php";

    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];
    
    mysqli_query($conn,"INSERT INTO barang values ('$id_barang','$nama_barang','$harga','$stock')");

    header('location: barang1.php');
?>