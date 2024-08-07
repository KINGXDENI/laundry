<?php
include "include/koneksi.php";

// Ambil waktu terakhir kali admin memeriksa booking baru
$last_check_time = isset($_SESSION['last_check_time']) ? $_SESSION['last_check_time'] : '1970-01-01 00:00:00';

// Query untuk mendapatkan booking baru
$query = "SELECT * FROM bookings WHERE created_at > '$last_check_time'";
$result = mysqli_query($conn, $query);

$new_bookings = mysqli_num_rows($result);

// Update waktu terakhir kali admin memeriksa booking baru
$_SESSION['last_check_time'] = date('Y-m-d H:i:s');

// Mengembalikan hasil sebagai JSON
echo json_encode(['new_bookings' => $new_bookings]);
