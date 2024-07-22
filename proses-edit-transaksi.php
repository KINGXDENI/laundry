<?php
include "include/koneksi.php";

$No_Order = $_POST["No_Order"] ?? null;
$No_Identitas = $_POST["No_Identitas"] ?? null;
$id_layanan = $_POST["id_layanan"] ?? null;
$total_berat = $_POST["total_berat"] ?? null;
$diskon = $_POST["diskon"] ?? null;
$total_bayar = $_POST["total_bayar"] ?? null;
$Tgl_Terima = $_POST["tanggal"] ?? null;
$harga_per_kg = $_POST["harga_per_kg"] ?? null;

if (empty($No_Order) || empty($No_Identitas) || empty($id_layanan) || empty($total_berat) || empty($total_bayar) || empty($Tgl_Terima)) {
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
} else {
	$sql = "UPDATE `transaksi` SET `No_Identitas`='$No_Identitas', `total_berat`='$total_berat', `diskon`='$diskon',
`Total_Bayar`='$total_bayar' WHERE `No_Order` = '$No_Order'";
	$kueri = mysqli_query($conn, $sql);
	if ($kueri) {
		echo "<script language='javascript'>alert('Berhasil di Edit');</script>";
	} else {
		echo "<script language='javascript'>alert('Gagal di Edit');</script>";
	}
	echo '<meta http-equiv="refresh" content="0; url=transaksi.php">';
}