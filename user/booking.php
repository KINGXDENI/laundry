<?php
session_start();
// Pastikan user sudah login
if (!isset($_SESSION['email'])) {
    // Redirect ke halaman login jika belum login
    header('Location: login.php');
    exit();
}

include "../include/koneksi.php";

// Ambil nomor booking terakhir
$result = $conn->query("SELECT no_booking FROM bookings ORDER BY id_booking DESC LIMIT 1");
$last_booking_no = "BK-000";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_booking_no = $row['no_booking'];
}

// Ekstrak angka dari nomor booking terakhir dan tambahkan 1
$last_number = (int)substr($last_booking_no, 3);
$new_number = $last_number + 1;

// Format nomor booking baru
$new_booking_no = "BK-" . str_pad($new_number, 3, '0', STR_PAD_LEFT);

$email_user = $_SESSION['email'];
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Jost:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../landing-page/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../landing-page/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Arsha
    * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
    * Updated: Jun 29 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

    <?php include "template/header.php" ?>

    <div class="container" style="margin-top: 150px;">
        <h2 class="text-center mb-3">Booking Layanan Antar Jemput</h2>
        <form action="booking_proses.php" method="POST" class="php-email-form">
            <div class="row gy-4">
                <div class="col-md-6">
                    <label for="booking-field" class="pb-2">Nomor Booking</label>
                    <input type="text" class="form-control" name="no_booking" id="booking-field" value="<?php echo $new_booking_no; ?>" required readonly>
                </div>
                <div class="col-md-6">
                    <label for="nama-field" class="pb-2">Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" id="nama-field" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="email-field" class="pb-2">Email</label>
                    <input type="email" class="form-control" name="email_pelanggan" id="email-field" value="<?php echo htmlspecialchars($email_user); ?>" required readonly>
                </div>
                <div class="col-md-6">
                    <label for="telepon-field" class="pb-2">Nomor Telepon</label>
                    <input type="text" class="form-control" name="nomor_telepon" id="telepon-field" required>
                </div>
                <div class="col-md-6">
                    <label for="alamat-field" class="pb-2">Alamat Penjemputan</label>
                    <input type="text" class="form-control" name="alamat_penjemputan" id="alamat-field" required>
                </div>
                <div class="col-md-6">
                    <label for="layanan-field" class="pb-2">Layanan</label>
                    <select class="form-control" name="jenis_layanan" id="layanan-field" required>
                        <option value="Cuci Kering">Cuci Kering</option>
                        <option value="Cuci Setrika">Cuci Setrika</option>
                        <option value="Cuci Satuan">Cuci Satuan</option>
                        <option value="Antar Jemput">Antar Jemput</option>
                    </select>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary mb-5">Pesan Sekarang</button>
                </div>
            </div>
        </form>
    </div>

    <?php include "template/footer.php" ?>

    <!-- Vendor JS Files -->
    <script src="../landing-page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="./landing-page/assets/vendor/php-email-form/validate.js"></script> -->
    <script src="../landing-page/assets/vendor/aos/aos.js"></script>
    <script src="../landing-page/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../landing-page/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../landing-page/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../landing-page/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="../landing-page/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="../landing-page/assets/js/main.js"></script>

</body>

</html>