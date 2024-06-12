<?php
include "include/koneksi.php";

$No_Identitas = $_GET['hapus'];

$query = "DELETE FROM pelanggan WHERE No_Identitas='".$No_Identitas."'";
$sql = mysqli_query($conn, $query);

// Redirect ke halaman pelanggan setelah penghapusan
header("Location: pelanggan.php");
exit; // Pastikan untuk keluar dari skrip setelah pengalihan halaman
?>
