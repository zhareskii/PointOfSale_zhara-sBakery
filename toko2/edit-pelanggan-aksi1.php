<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];

    $sql = "UPDATE pelanggan SET 
            nama='$nama', 
            gender='$gender' 
            WHERE id_pelanggan='$id_pelanggan'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
        header('location:pelanggan1.php');
    } else {
        echo "Error: " . $conn->error;
    }

}
$conn->close();
?>
