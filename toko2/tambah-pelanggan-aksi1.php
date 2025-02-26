
<?php
    include "koneksi.php";

    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    
    mysqli_query($conn,"INSERT INTO pelanggan values ('$id_pelanggan','$nama','$gender')");

    header('location: pelanggan1.php');
?>