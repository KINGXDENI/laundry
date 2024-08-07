<?php
session_start();
include "../include/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_booking = $_POST['no_booking'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $email_pelanggan = $_POST['email_pelanggan'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat_penjemputan = $_POST['alamat_penjemputan'];
    $jenis_layanan = $_POST['jenis_layanan'];

    $sql = "INSERT INTO bookings (no_booking, nama_pelanggan, email_pelanggan, nomor_telepon, alamat_penjemputan, jenis_layanan, status, created_at) VALUES (?, ?, ?, ?, ?, ?, 'Pending', NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $no_booking, $nama_pelanggan, $email_pelanggan, $nomor_telepon, $alamat_penjemputan, $jenis_layanan);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Booking berhasil dilakukan!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Gagal melakukan booking. Silakan coba lagi.";
        $_SESSION['message_type'] = "error";
    }

    $stmt->close();
    header('Location: booking_tampil.php');
    exit();
}
