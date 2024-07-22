<?php

include "include/koneksi.php";

$id_layanan = $_GET['hapus'];

// Query untuk menghapus data berdasarkan id_layanan
$query = "DELETE FROM layanan WHERE id_layanan='$id_layanan'";

// Eksekusi query
$sql = mysqli_query($conn, $query);

if ($sql) {
    echo "<script language='javascript'>alert('Berhasil di Hapus');</script>";
    echo '<meta http-equiv="refresh" content="0; url=layanan.php">';
} else {
    echo "<script language='javascript'>alert('Gagal di Hapus: " . mysqli_error($conn) . "');</script>";
    echo '<meta http-equiv="refresh" content="0; url=layanan.php">';
}
