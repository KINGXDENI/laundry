<?php
include "include/koneksi.php";

$id_layanan = $_POST["id_layanan"];
$nama_layanan = $_POST["nama_layanan"];
$deskripsi = $_POST["deskripsi"];
$harga = $_POST["harga"];
$estimasi_waktu = $_POST["estimasi_waktu"];

// Validasi jika ada field yang kosong
if (empty($id_layanan) || empty($nama_layanan) || empty($deskripsi) || empty($harga) || empty($estimasi_waktu)) {
    echo "<script language='javascript'>alert('Semua field harus diisi');</script>";
    echo '<meta http-equiv="refresh" content="0; url=layanan_tambah.php">';
    exit(); // Pastikan form tidak diproses lebih lanjut
}

// Gunakan prepared statement untuk mencegah SQL Injection
$stmt = $conn->prepare("INSERT INTO layanan (id_layanan, nama_layanan, deskripsi, harga, estimasi_waktu) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $id_layanan, $nama_layanan, $deskripsi, $harga, $estimasi_waktu);

// Eksekusi query
if ($stmt->execute()) {
    echo "<script language='javascript'>alert('Berhasil ditambahkan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=layanan.php">';
} else {
    echo "<script language='javascript'>alert('Gagal ditambahkan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=layanan_tambah.php">';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
