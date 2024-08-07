<?php
session_start();
// Pastikan user sudah login
if (!isset($_SESSION['email'])) {
    // Redirect ke halaman login jika belum login
    header('Location: login.php');
    exit();
}

include "../include/koneksi.php";

$email_user = $_SESSION['email'];

// Ambil data pelanggan dari database
$query = "SELECT * FROM pelanggan WHERE email = '$email_user'";
$result = mysqli_query($conn, $query);
$pelanggan = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari POST
    $No_Identitas = $_POST["No_Identitas"] ?? '';
    $Nama = $_POST["Nama"] ?? '';
    $Alamat = $_POST["Alamat"] ?? '';
    $No_Hp = $_POST["No_Hp"] ?? '';
    $email = $_POST["email"] ?? '';

    // Proses upload foto
    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_path = '../uploads/' . basename($foto);

    // Validasi dan upload foto
    if (!empty($foto) && move_uploaded_file($foto_tmp, $foto_path)) {
        $foto_sql = ", Foto = '$foto'";
    } else {
        $foto_sql = "";
    }

    // Update data pelanggan
    $sql = "UPDATE pelanggan SET Nama = '$Nama', Alamat = '$Alamat', No_Hp = '$No_Hp' WHERE email = '$email'";
    if (!empty($foto_sql)) {
        $sql = "UPDATE pelanggan SET Nama = '$Nama', Alamat = '$Alamat', No_Hp = '$No_Hp', Foto = '$foto' WHERE email = '$email'";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            Swal.fire({
                title: 'Sukses!',
                text: 'Data berhasil diperbarui!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'pelanggan_tampil.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Terjadi kesalahan saat memperbarui data!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'pelanggan_tampil.php';
                }
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Edit Profil - Amanah Laundry</title>
    <!-- Include your CSS and JS files here -->

    <!-- Favicons -->
    <link rel="shortcut icon" href="../asset/img/svg/amanah_logo.svg" type="image/x-icon">
    <link href="../landing-page/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../landing-page/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../landing-page/assets/css/main.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

    <?php include "template/header.php" ?>

    <div class="container" style="margin-top: 150px; margin-bottom: 50px;">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="No_Identitas">No Pelanggan</label>
                            <input type="text" name="No_Identitas" class="form-control"
                                value="<?php echo $pelanggan['No_Identitas']; ?>" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="Nama"
                                value="<?php echo $pelanggan['Nama']; ?>" placeholder="Masukan Nama">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"
                                value="<?php echo $pelanggan['email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="Alamat"
                                value="<?php echo $pelanggan['Alamat']; ?>" placeholder="Masukan Alamat">
                        </div>
                        <div class="form-group mb-3">
                            <label>No. Hp</label>
                            <input type="text" class="form-control" name="No_Hp"
                                value="<?php echo $pelanggan['No_Hp']; ?>" placeholder="Masukan No. Hp">
                        </div>
                        <div class="form-group mb-3">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="foto">
                            <?php if (!empty($pelanggan['Foto'])) : ?>
                            <p><strong>Foto Saat Ini:</strong> <img src="../uploads/<?php echo $pelanggan['Foto']; ?>"
                                    alt="Foto Pelanggan" width="200"></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                    <a href="pelanggan_tampil.php"><input type="button" class="btn btn-danger" value="Batal"></a>
                </div>
            </form>
        </div>
    </div>

    <?php include "template/footer.php" ?>

    <!-- Vendor JS Files -->
    <script src="../landing-page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../landing-page/assets/vendor/aos/aos.js"></script>
    <script src="../landing-page/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../landing-page/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../landing-page/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../landing-page/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="../landing-page/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="../landing-page/assets/js/main.js"></script>

    <!-- Include your JS files here -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>