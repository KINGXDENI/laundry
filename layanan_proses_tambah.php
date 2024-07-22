<?php
include "include/koneksi.php";

$id_layanan = $_POST["id_layanan"];
$nama_layanan = $_POST["nama_layanan"];
$deskripsi = $_POST["deskripsi"];
$harga = $_POST["harga"];
$estimasi_waktu = $_POST["estimasi_waktu"];

if (empty($_POST["id_layanan"]) || empty($_POST["nama_layanan"]) || empty($_POST["deskripsi"]) || empty($_POST["harga"]) || empty($_POST["estimasi_waktu"])) {
    echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
    // echo '<meta http-equiv="refresh" content="0; url=layanan_tambah.php">';
} else {
    $sql = "INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `deskripsi`, `harga`, `estimasi_waktu`)
			VALUES ('$id_layanan', '$nama_layanan', '$deskripsi', '$harga', '$estimasi_waktu')";
    $kueri = mysqli_query($conn, $sql);
    echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=layanan.php">';
}
