<?php
include 'database.php';

$tanggal = $_POST['tanggal'];
$pj = $_POST['pj'];
$hadir = $_POST['hadir'];
$keluar = $_POST['keluar'];
$masuk = $_POST['masuk'];

$sql = "INSERT INTO uang (tanggal, pj, hadir, keluar, masuk)
        VALUES ('$tanggal', '$pj', $hadir, $keluar, $masuk)";

if (mysqli_query($conn, $sql)) {
    header("Location: lihat.php");
} else {
    echo "Gagal menambahkan data: " . mysqli_error($conn);
}
?>