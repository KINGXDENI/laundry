<?php
include "include/koneksi.php";

// Ambil data dari POST
$No_Identitas = $_POST["No_Identitas"];
$Nama = $_POST["Nama"];
$Alamat = $_POST["Alamat"];
$No_Hp = $_POST["No_Hp"];

if (empty($No_Identitas) || empty($Nama) || empty($Alamat) || empty($No_Hp)) {
    echo "<script>
            alert('Data tidak lengkap!');
            window.location.href = 'tambahdatapelanggan.php';
          </script>";
} else {
    $sql = "INSERT INTO pelanggan (No_Identitas, Nama, Alamat, No_Hp) VALUES ('$No_Identitas', '$Nama', '$Alamat', '$No_Hp')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = 'pelanggan.php';
              </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat menambahkan data!');
                window.location.href = 'tambahdatapelanggan.php';
              </script>";
    }
}