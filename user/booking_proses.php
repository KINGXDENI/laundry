<?php
session_start();
include '../include/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $no_booking = $_POST['no_booking'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $email_pelanggan = $_POST['email_pelanggan'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat_penjemputan = $_POST['alamat_penjemputan'];
    $jenis_layanan = $_POST['jenis_layanan'];

    // Memeriksa koneksi ke database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Memeriksa apakah data yang diambil dari form tidak kosong
    if (empty($no_booking) || empty($nama_pelanggan) || empty($email_pelanggan) || empty($nomor_telepon) || empty($alamat_penjemputan) || empty($jenis_layanan)) {
        die("All fields are required.");
    }

    // Menggunakan prepared statements untuk menghindari SQL Injection
    $stmt = $conn->prepare("INSERT INTO bookings (no_booking, nama_pelanggan, email_pelanggan, nomor_telepon, alamat_penjemputan, jenis_layanan) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssssss", $no_booking, $nama_pelanggan, $email_pelanggan, $nomor_telepon, $alamat_penjemputan, $jenis_layanan);

    // Menjalankan query dan mengecek hasilnya
    if ($stmt->execute() === TRUE) {
        $id_booking = $stmt->insert_id; // Mendapatkan ID booking terakhir yang dimasukkan
        $stmt->close();
        $conn->close();
        // Redirect ke halaman sukses dengan ID booking
        header("Location: booking_tampil.php?id=$id_booking");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
