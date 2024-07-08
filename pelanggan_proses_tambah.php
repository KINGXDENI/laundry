<?php
include "include/koneksi.php";

$No_Identitas = $_POST["No_Identitas"];
$Nama = $_POST["Nama"];
$Alamat = $_POST["Alamat"];
$No_Hp = $_POST["No_Hp"];

if (empty($No_Identitas) || empty($Nama) || empty($Alamat) || empty($No_Hp)) {
	echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Data tidak lengkap!',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.location.href = 'tambahdatapelanggan.php';
        });
    </script>";
} else {
	$sql = "INSERT INTO pelanggan (No_Identitas, Nama, Alamat, No_Hp) VALUES ('$No_Identitas', '$Nama', '$Alamat', '$No_Hp')";
	if (mysqli_query($conn, $sql)) {
		echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil ditambahkan!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = 'pelanggan.php';
            });
        </script>";
	} else {
		echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menambahkan data!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = 'tambahdatapelanggan.php';
            });
        </script>";
	}
}
