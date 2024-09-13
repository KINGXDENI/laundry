<?php
include "include/koneksi.php";

// Ambil data dari POST
$No_Identitas = $_POST["No_Identitas"];
$Nama = $_POST["Nama"];
$Alamat = $_POST["Alamat"];
$No_Hp = $_POST["No_Hp"];
$email = $_POST["email"];

// Periksa apakah file foto diupload
$foto = isset($_FILES['Foto']) ? $_FILES['Foto'] : null;
$foto_name = $foto ? basename($foto['name']) : null;
$foto_tmp = $foto ? $foto['tmp_name'] : null;
$foto_path = "./uploads/" . $foto_name;

if (empty($No_Identitas) || empty($Nama) || empty($Alamat) || empty($No_Hp) || empty($email)) {
  echo "<script>
            alert('Data tidak lengkap!');
            window.location.href = 'pelanggan_tambah.php';
          </script>";
} else {
  // Pindahkan file foto ke direktori tujuan
  if ($foto_tmp && $foto_name) {
    if (move_uploaded_file($foto_tmp, $foto_path)) {
      // File berhasil dipindahkan
    } else {
      echo "<script>
              alert('Gagal mengupload foto!');
              window.location.href = 'pelanggan_tambah.php';
            </script>";
      exit();
    }
  }

  // Query untuk menambahkan data ke database
  $sql = "INSERT INTO pelanggan (No_Identitas, Nama, Alamat, No_Hp, email, Foto) VALUES ('$No_Identitas', '$Nama', '$Alamat', '$No_Hp', '$email', '$foto_name')";

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
