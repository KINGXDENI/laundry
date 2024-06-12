<?php
// Load file koneksi.php
include "include/koneksi.php";

// Ambil data No_Order yang dikirim melalui URL
$No_Order = $_GET['hapus'];

// Query untuk menghapus data transaksi berdasarkan No_Order yang dikirim
$query = "DELETE FROM transaksi WHERE No_Order='" . $No_Order . "'";
$query2 = "DELETE FROM detail_transaksi WHERE No_Order='" . $No_Order . "'";

// Eksekusi query
$sql = mysqli_query($conn, $query);
$sql2 = mysqli_query($conn, $query2);

if ($sql && $sql2) { // Cek jika proses hapus dari database sukses atau tidak
  echo '<meta http-equiv="refresh" content="0; url=transaksi.php">';
} else {
  // Jika gagal, lakukan :
  echo '<meta http-equiv="refresh" content="0; url=transaksi.php">';
}
