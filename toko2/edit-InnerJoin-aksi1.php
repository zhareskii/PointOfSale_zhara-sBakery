<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_transaksi = $_POST['id_transaksi'];
    $id_barang = $_POST['id_barang'];
    $jml_barang = $_POST['jml_barang'];
    $harga_satuan = $_POST['harga_satuan'];
    $tgl_transaksi = $_POST['tgl_transaksi'];
    $total_transaksi = $_POST['total_transaksi'];

    $sql = "SELECT penjualan.id_transaksi, detil_penjualan.id_barang, detil_penjualan.jml_barang, detil_penjualan.harga_satuan, penjualan.tgl_transaksi, penjualan.total_transaksi 
            FROM detil_penjualan 
            INNER JOIN penjualan ON detil_penjualan.id_transaksi = penjualan.id_transaksi;";
;

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $conn->error;
    }

    header('location:InnerJoin1.php');
}
$conn->close();
?>
