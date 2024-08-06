<?php
session_start();
include 'include/koneksi.php';

// Mengecek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: Login/index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama_pelanggan = $_POST['nama'];
    $email_pelanggan = $_POST['email'];
    $nomor_telepon = $_POST['telepon'];
    $alamat_penjemputan = $_POST['alamat'];
    $jenis_layanan = $_POST['layanan'];

    // Memeriksa koneksi ke database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Menggunakan prepared statements untuk menghindari SQL Injection
    $stmt = $conn->prepare("INSERT INTO bookings (nama_pelanggan, email_pelanggan, nomor_telepon, alamat_penjemputan, jenis_layanan, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("sssss", $nama_pelanggan, $email_pelanggan, $nomor_telepon, $alamat_penjemputan, $jenis_layanan);

    // Menjalankan query dan mengecek hasilnya
    if ($stmt->execute() === TRUE) {
        $id_booking = $stmt->insert_id; // Mendapatkan ID booking terakhir yang dimasukkan
        $stmt->close();
        $conn->close();
        // Redirect ke halaman sukses dengan ID   booking
        header("Location: booking_sukses.php?id=$id_booking");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
