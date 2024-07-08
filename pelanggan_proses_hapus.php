<?php
include "include/koneksi.php";
$No_Identitas = $_GET['hapus'];
$query = "DELETE FROM pelanggan WHERE No_Identitas='".$No_Identitas."'";
$sql = mysqli_query($conn, $query);

header("Location: pelanggan.php");
exit;
?>