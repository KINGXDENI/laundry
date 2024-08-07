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

// Periksa apakah pengguna sudah terdaftar sebagai pelanggan
$query = "SELECT * FROM pelanggan WHERE email = '$email_user'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Jika sudah terdaftar, tampilkan data pelanggan
    $pelanggan = mysqli_fetch_assoc($result);
    $show_form = false;
} else {
    // Jika belum terdaftar, tampilkan form pendaftaran
    $show_form = true;

    // Query untuk mendapatkan nomor identitas terakhir
    $result = mysqli_query($conn, "SELECT No_Identitas FROM pelanggan ORDER BY No_Identitas DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);

    // Mendapatkan nomor urut terakhir dan menambah 1 untuk nomor baru
    if ($row) {
        $last_no_identitas = $row['No_Identitas'];
        $number = intval(substr($last_no_identitas, 2)) + 1;
    } else {
        $number = 1;
    }

    // Format nomor identitas baru
    $new_no_identitas = 'P-' . str_pad($number, 2, '0', STR_PAD_LEFT);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $show_form) {
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
    if (move_uploaded_file($foto_tmp, $foto_path)) {
        $foto_sql = ", Foto = '$foto'";
    } else {
        $foto_sql = "";
    }

    if (empty($No_Identitas) || empty($Nama) || empty($Alamat) || empty($No_Hp) || empty($email)) {
        // Handle error if needed
    } else {
        $sql = "INSERT INTO pelanggan (No_Identitas, Nama, Alamat, No_Hp, email, foto ) VALUES ('$No_Identitas', '$Nama', '$Alamat', '$No_Hp', '$email', $foto_sql)";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data berhasil ditambahkan!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'pelanggan.php';
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'pelanggan.php';
                    }
                });
            </script>";
        }
    }
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
    <style>
    .profile-card {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        background-color: #fff;
    }

    .profile-card img {
        border-radius: 50%;
        margin-right: 20px;
    }

    .profile-card .profile-info {
        max-width: 400px;
    }

    .profile-card .profile-info p {
        margin-bottom: 10px;
    }
    </style>
</head>

<body>

    <?php include "template/header.php" ?>

    <div class="container" style="margin-top: 150px; margin-bottom: 50px;">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h3>Data Pelanggan</h3>
                    <div class="profile-card">
                        <?php if (!empty($pelanggan['Foto'])) : ?>
                        <img src="../uploads/<?php echo $pelanggan['Foto']; ?>" alt="Foto Pelanggan" width="150">
                        <?php endif; ?>
                        <div class="profile-info">
                            <table>
                                <tr>
                                    <th>No Identitas</th>
                                    <td>:</td>
                                    <td> <?php echo $pelanggan['No_Identitas']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td> <?php echo $pelanggan['Nama']; ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>:</td>
                                    <td> <?php echo $pelanggan['Alamat']; ?></td>
                                </tr>
                                <tr>
                                    <th>No Telepon</th>
                                    <td>:</td>
                                    <td> <?php echo $pelanggan['No_Hp']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td><?php echo $pelanggan['email']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a href="pelanggan_edit.php" class="btn btn-warning mt-3">Edit Profil</a>
                </div>
            </div>
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
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>