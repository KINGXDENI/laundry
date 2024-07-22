<?php
include "include/koneksi.php";

// Ambil data dari POST
$id_layanan = $_POST["id_layanan"];
$nama_layanan = $_POST["nama_layanan"];
$deskripsi = $_POST["deskripsi"];
$harga = $_POST["harga"];
$estimasi_waktu = $_POST["estimasi_waktu"];

// Validasi input
if (empty($id_layanan) || empty($nama_layanan) || empty($deskripsi) || empty($harga) || empty($estimasi_waktu)) {
    echo "<script language='javascript'>alert('Gagal di tambahkan. Semua field harus diisi.');</script>";
    echo '<meta http-equiv="refresh" content="0; url=layanan_tambah.php">';
    exit();
}

// Gunakan prepared statement untuk menghindari SQL Injection
$stmt = $conn->prepare("INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `deskripsi`, `harga`, `estimasi_waktu`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $id_layanan, $nama_layanan, $deskripsi, $harga, $estimasi_waktu);

if ($stmt->execute()) {
    echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=layanan.php">';
} else {
    echo "<script language='javascript'>alert('Gagal di tambahkan. Terjadi kesalahan.');</script>";
    echo '<meta http-equiv="refresh" content="0; url=layanan_tambah.php">';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();