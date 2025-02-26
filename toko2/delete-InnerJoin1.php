<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_transaksi = $_POST['id_transaksi'];

    $sql = "DELETE FROM penjualan WHERE id_transaksi='$id_transaksi'";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }
    header('location:InnerJoin1.php');
}

$conn->close();
?>
