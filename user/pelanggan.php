<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

include "../include/koneksi.php";

$email_user = $_SESSION['email'];
$query = "SELECT * FROM pelanggan WHERE email = '$email_user'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $pelanggan = mysqli_fetch_assoc($result);
    $show_form = false;
} else {
    $show_form = true;
    $result = mysqli_query($conn, "SELECT No_Identitas FROM pelanggan ORDER BY No_Identitas DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $number = $row ? intval(substr($row['No_Identitas'], 2)) + 1 : 1;
    $new_no_identitas = 'P-' . str_pad($number, 2, '0', STR_PAD_LEFT);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $show_form) {
    $No_Identitas = $_POST["No_Identitas"] ?? '';
    $Nama = $_POST["Nama"] ?? '';
    $Alamat = $_POST["Alamat"] ?? '';
    $No_Hp = $_POST["No_Hp"] ?? '';
    $email = $_POST["email"] ?? '';

    if (empty($No_Identitas) || empty($Nama) || empty($Alamat) || empty($No_Hp) || empty($email)) {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Semua field harus diisi!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {
        $foto = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_path = '../uploads/' . basename($foto);
        
        if ($foto && move_uploaded_file($foto_tmp, $foto_path)) {
            $foto_column = "Foto";
            $foto_value = "'$foto'";
        } else {
            $foto_column = "";
            $foto_value = "NULL";
        }

        $columns = "No_Identitas, Nama, Alamat, No_Hp, email" . ($foto_column ? ", $foto_column" : "");
        $values = "'$No_Identitas', '$Nama', '$Alamat', '$No_Hp', '$email'" . ($foto_value ? ", $foto_value" : "");

        $sql = "INSERT INTO pelanggan ($columns) VALUES ($values)";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data berhasil ditambahkan!',
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
                    text: 'Terjadi kesalahan saat menambahkan data!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    }
}

if (!$show_form) {
    header("Location: pelanggan_tampil.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Amanah Laundry</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="shortcut icon" href="../asset/img/svg/amanah_logo.svg" type="image/x-icon">
    <link href="../landing-page/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="../landing-page/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../landing-page/assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <?php include "template/header.php" ?>
    <div class="container" style="margin-top: 150px; margin-bottom: 50px;">
        <div class="card-body">
            <?php if ($show_form) : ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="form-group mb-3">
                            <label for="No_Identitas">No Pelanggan</label>
                            <input type="text" name="No_Identitas" class="form-control" id="basicInput"
                                value="<?php echo $new_no_identitas; ?>" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="Nama" placeholder="Masukan Nama">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $email_user; ?>"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="Alamat" placeholder="Masukan Alamat">
                        </div>
                        <div class="form-group mb-3">
                            <label>No. Hp</label>
                            <input type="text" class="form-control" name="No_Hp" placeholder="Masukan No. Hp">
                        </div>
                        <div class="form-group mb-3">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="foto">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                    <a href="pelanggan.php"><input type="button" class="btn btn-danger" value="Batal"></a>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
    <?php include "template/footer.php" ?>
    <script src="../landing-page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../landing-page/assets/vendor/aos/aos.js"></script>
    <script src="../landing-page/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../landing-page/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../landing-page/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../landing-page/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="../landing-page/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../landing-page/assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>