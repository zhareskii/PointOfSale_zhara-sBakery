
<?php
    include "koneksi.php";

    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_barang = $_POST['harga_barang'];
    $stock = $_POST['stock'];
    
    mysqli_query($conn,"INSERT INTO barang values ('$id_barang','$nama_barang','$harga_barang','$stock')");

    header('location: barang.php');
?>