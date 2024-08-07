<?php
session_start();
if (isset($_SESSION['id'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amanah Laundry</title>

    <?php
        include "include/header.php";
        ?>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
    .welcome-card {
        text-align: center;
        padding: 30px;
    }

    .welcome-card .icon {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #007bff;
        /* Ubah warna ikon sesuai kebutuhan */
    }
    </style>
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">

        <?php
            include "include/list.php";
            ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Dashboard</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <?php
                                include "include/koneksi.php";
                                // Query untuk menghitung jumlah pelanggan
                                $query = "SELECT COUNT(*) AS total_pelanggan FROM pelanggan";
                                $result = mysqli_query($conn, $query);
                                $data = mysqli_fetch_assoc($result);
                                $total_pelanggan = $data['total_pelanggan'];

                                // Query untuk menghitung jumlah transaksi
                                $query_transaksi = "SELECT COUNT(*) AS total_transaksi FROM transaksi";
                                $result_transaksi = mysqli_query($conn, $query_transaksi);
                                $data_transaksi = mysqli_fetch_assoc($result_transaksi);
                                $total_transaksi = $data_transaksi['total_transaksi'];

                                // Query untuk menghitung jumlah layanan
                                $query_layanan = "SELECT COUNT(*) AS total_layanan FROM layanan";
                                $result_layanan = mysqli_query($conn, $query_layanan);
                                $data_layanan = mysqli_fetch_assoc($result_layanan);
                                $total_layanan = $data_layanan['total_layanan'];

                                // Query untuk menghitung jumlah pakaian
                                $query_pakaian = "SELECT COUNT(*) AS total_pakaian FROM pakaian";
                                $result_pakaian = mysqli_query($conn, $query_pakaian);
                                $data_pakaian = mysqli_fetch_assoc($result_pakaian);
                                $total_pakaian = $data_pakaian['total_pakaian'];
                                ?>
                            <div class="col-6 col-lg-3 col-md-6">
                                <a href="pelanggan.php">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-xxl-4 d-flex justify-content-start">
                                                    <div class="stats-icon purple mb-2">
                                                        <i class="iconly-boldUser"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-8">
                                                    <h6 class="text-muted font-semibold">Jumlah Pelanggan</h6>
                                                    <h6 class="font-extrabold mb-0"><?php echo $total_pelanggan; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <a href="transaksi.php">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-xxl-4 d-flex justify-content-start">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="iconly-boldDocument"></i> <!-- Mengganti ikon -->
                                                    </div>
                                                </div>
                                                <div class="col-xxl-8">
                                                    <h6 class="text-muted font-semibold">Jumlah Transaksi</h6>
                                                    <h6 class="font-extrabold mb-0"><?php echo $total_transaksi; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <a href="layanan.php">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-xxl-4 d-flex justify-content-start">
                                                    <div class="stats-icon green mb-2">
                                                        <i class="iconly-boldAdd-User"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-8">
                                                    <h6 class="text-muted font-semibold">Layanan</h6>
                                                    <h6 class="font-extrabold mb-0"><?php echo $total_layanan; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <a href="pakaian.php">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-xxl-4 d-flex justify-content-start">
                                                    <div class="stats-icon red mb-2">
                                                        <i class="iconly-boldBookmark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-8">
                                                    <h6 class="text-muted font-semibold">Jumlah Pakaian</h6>
                                                    <h6 class="font-extrabold mb-0"><?php echo $total_pakaian; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="welcome-card">
                                        <i class="fas fa-user-shield icon"></i>
                                        <h1>Selamat Datang, Admin</h1>
                                        <p>Selamat datang di halaman admin. Ini adalah tempat di mana Anda dapat
                                            mengelola
                                            berbagai aspek dari situs web atau aplikasi Anda. Silakan jelajahi menu dan
                                            fitur yang tersedia untuk memulai pekerjaan Anda.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

            <?php
                include "include/footer.php";
                ?>
        </div>
    </div>


</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Interval polling (dalam milidetik)
    const pollingInterval = 60000; // 1 menit

    function checkNewBookings() {
        fetch('check_new_booking.php')
            .then(response => response.json())
            .then(data => {
                if (data.new_bookings > 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Booking Baru',
                        text: `Ada booking baru.`,
                        showConfirmButton: true,
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Jalankan polling pertama kali
    checkNewBookings();

    // Atur polling untuk berjalan setiap interval tertentu
    setInterval(checkNewBookings, pollingInterval);
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk tombol burger
    var burgerBtn = document.querySelector('.burger-btn');
    var sidebar = document.querySelector('#sidebar');
    if (burgerBtn) {
        burgerBtn.addEventListener('click', function(event) {
            event.preventDefault();
            sidebar.classList.toggle('active');
        });
    }

    // Event listener untuk tombol close (sidebar-toggler)
    var sidebarHideBtn = document.querySelector('.sidebar-hide');
    if (sidebarHideBtn) {
        sidebarHideBtn.addEventListener('click', function(event) {
            event.preventDefault();
            sidebar.classList.remove('active');
        });
    }
});
</script>

</html>
<?php
} else {
    header("location:login/index.php");
}
?>