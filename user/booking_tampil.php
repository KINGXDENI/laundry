<?php
session_start();
include "../include/koneksi.php";

// Pastikan user sudah login
if (!isset($_SESSION['email'])) {
    // Redirect ke halaman login jika belum login
    header('Location: login.php');
    exit();
}

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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
        <div class="row">
            <?php
            $sql = $conn->prepare("SELECT * FROM bookings WHERE email_pelanggan = ? ORDER BY id_booking");
            $sql->bind_param("s", $email_user);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                while ($hasil = $result->fetch_assoc()) {
            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <th>No Booking</th>
                                        <td> :</td>
                                        <th><?php echo $hasil['no_booking']; ?></th>
                                    </tr>
                                    <tr>
                                        <td>Nama Pelanggan</td>
                                        <td> :</td>
                                        <td><?php echo $hasil['nama_pelanggan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email Pelanggan</td>
                                        <td> :</td>
                                        <td><?php echo $hasil['email_pelanggan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No Telpon</td>
                                        <td> :</td>
                                        <td><?php echo $hasil['nomor_telepon']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Penjemputan</td>
                                        <td> :</td>
                                        <td><?php echo $hasil['alamat_penjemputan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Layanan</td>
                                        <td> :</td>
                                        <td><?php echo $hasil['jenis_layanan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Booking</td>
                                        <td> :</td>
                                        <td><?php echo $hasil['tanggal_booking']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='col-md-12 mb-3'><h2 class='text-center'>Anda belum ada riwayat transaksi.</h2></div>";
            }
            $sql->close();
            ?>
        </div>
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