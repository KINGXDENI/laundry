<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Booking Antar Jemput</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="shortcut icon" href="../asset/img/svg/amanah_logo.svg" type="image/x-icon">
    <link href="./landing-page/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="./landing-page/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./landing-page/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./landing-page/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="./landing-page/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="./landing-page/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="./landing-page/assets/css/main.css" rel="stylesheet">


    <style>
    /* Tambahkan ini ke file main.css */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    /* Tambahkan ini ke file main.css */
    @media (max-width: 768px) {
        .btn-primary {
            width: 100%;
            font-size: 18px;
        }
    }
    </style>

</head>

<body class="index-page">

    <?php include 'booking/header.php' ?>

    <main class="main">

        <!-- Booking Form Section -->
        <section id="booking" class="booking section dark-background">

            <div class="container">
                <?php
                session_start();
                if (!isset($_SESSION['user_id'])) {
                    header("Location: Login/index.php");
                    exit();
                }

                if (!isset($_GET['id'])) {
                    echo "ID booking tidak ditemukan.";
                    exit();
                }

                $booking_id = intval($_GET['id']);

                // Ambil data booking dari database
                $conn = new mysqli('localhost', 'username', 'password', 'database');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM bookings WHERE id_booking = $booking_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $booking = $result->fetch_assoc();
                } else {
                    echo "Booking tidak ditemukan.";
                    exit();
                }

                $conn->close();
                ?>
                <div class="card">
                    <h2>Detail Booking</h2>
                    <p><strong>Nama Lengkap:</strong> <?php echo htmlspecialchars($booking['nama_pelanggan']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($booking['email_pelanggan']); ?></p>
                    <p><strong>Nomor Telepon:</strong> <?php echo htmlspecialchars($booking['nomor_telepon']); ?></p>
                    <p><strong>Alamat Penjemputan:</strong>
                        <?php echo htmlspecialchars($booking['alamat_penjemputan']); ?></p>
                    <p><strong>Layanan:</strong> <?php echo htmlspecialchars($booking['jenis_layanan']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($booking['status']); ?></p>
                    <?php if ($booking['status'] === 'Pending') : ?>
                    <a href="confirm_booking.php?id=<?php echo $id_booking; ?>" class="button">Konfirmasi Booking</a>
                    <?php else : ?>
                    <p>Pesanan telah dikonfirmasi.</p>
                    <?php endif; ?>
                </div>
            </div>

        </section><!-- /Booking Form Section -->

    </main>

    <?php include 'booking/footer.php' ?>



    <!-- Vendor JS Files -->
    <script src="./landing-page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./landing-page/assets/vendor/aos/aos.js"></script>
    <script src="./landing-page/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="./landing-page/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="./landing-page/assets/vendor/php-email-form/validate.js"></script>

    <!-- Main JS File -->
    <script src="./landing-page/assets/js/main.js"></script>

</body>

</html>