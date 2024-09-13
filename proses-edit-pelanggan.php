<?php
include "include/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Ambil data dari POST
	$No_Identitas = $_POST["No_Identitas"] ?? '';
	$Nama = $_POST["Nama"] ?? '';
	$Alamat = $_POST["Alamat"] ?? '';
	$No_Hp = $_POST["No_Hp"] ?? '';
	$email = $_POST["email"] ?? '';

	// Proses upload foto
	$foto_sql = '';
	if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
		$foto = $_FILES['foto']['name'];
		$foto_tmp = $_FILES['foto']['tmp_name'];
		$foto_path = './uploads/' . basename($foto);

		// Validasi ekstensi file
		$allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
		$foto_ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

		if (in_array($foto_ext, $allowed_ext)) {
			if (move_uploaded_file($foto_tmp, $foto_path)) {
				$foto_sql = ", Foto = '$foto'";
			} else {
				echo "<script>alert('Gagal mengupload foto!');</script>";
				exit;
			}
		} else {
			echo "<script>alert('Jenis file tidak diperbolehkan!');</script>";
			exit;
		}
	}

	// Update data pelanggan
	$sql = "UPDATE pelanggan SET Nama = '$Nama', Alamat = '$Alamat', No_Hp = '$No_Hp' $foto_sql WHERE email = '$email'";

	// Tampilkan SQL query untuk debugging
	echo $sql;

	// Eksekusi query
	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('Data berhasil diperbarui!'); window.location.href = 'pelanggan.php';</script>";
	} else {
		echo "<script>alert('Terjadi kesalahan saat memperbarui data!'); window.location.href = 'pelanggan.php';</script>";
	}
}
