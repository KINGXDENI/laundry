<?php
include "./include/koneksi.php";

// Mengambil data dari form
$no_order = isset($_POST['No_Order']) ? $_POST['No_Order'] : '';
$id_pakaian = isset($_POST['Id_Pakaian']) ? $_POST['Id_Pakaian'] : '';
$jumlah_pakaian = isset($_POST['Jumlah_Pakaian']) ? $_POST['Jumlah_Pakaian'] : '';

// Validasi input
$errors = [];

if (empty($id_pakaian)) {
	$errors[] = "Jenis Pakaian harus di isi";
}

if (empty($jumlah_pakaian)) {
	$errors[] = "Jumlah Pakaian harus di isi";
}

if (count($errors) > 0) {
	foreach ($errors as $error) {
		echo $error . "<br>";
	}
	exit();
}

// Menyimpan data ke database jika tidak ada error
$sql = "INSERT INTO detail_transaksi (No_Order, Id_Pakaian, Jumlah_pakaian) VALUES ('$no_order', '$id_pakaian', '$jumlah_pakaian')";
if (mysqli_query($conn, $sql)) {
	echo "Detail pakaian berhasil ditambahkan!";
	header("Location: transaksi.php");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
