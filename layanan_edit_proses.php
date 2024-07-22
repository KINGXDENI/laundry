<?php
include "include/koneksi.php";

$id_layanan = $_POST["id_layanan"];
$nama_layanan = $_POST['nama_layanan'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$estimasi_waktu = $_POST['estimasi_waktu'];

if (empty($_POST['id_layanan']) || empty($_POST['nama_layanan']) || empty($_POST['deskripsi']) || empty($_POST['harga']) || empty($_POST['estimasi_waktu'])) {
    echo "<script language='javascript'>alert('Gagal di Edit');</script>";
    echo '<meta http-equiv="refresh" content="0; url=layanan_edit.php">';
} else {
    $sql = "UPDATE layanan SET nama_layanan='$nama_layanan', deskripsi='$deskripsi', harga='$harga', estimasi_waktu='$estimasi_waktu' WHERE id_layanan='$id_layanan'";
    $kueri = mysqli_query($conn, $sql);

    if ($kueri) {
        echo "<script language='javascript'>alert('Berhasil di Edit');</script>";
    } else {
        echo "<script language='javascript'>alert('Gagal di Edit: " . mysqli_error($conn) . "');</script>";
    }
    echo '<meta http-equiv="refresh" content="0; url=layanan.php">';
}
