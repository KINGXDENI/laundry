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
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                        <h5 class="card-title">Book Laundry</h5>
                                        <p class="card-text">Make a booking for your laundry needs.</p>
                                        <a href="#" class="btn btn-primary">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-truck fa-3x mb-3"></i>
                                        <h5 class="card-title">Pickup Service</h5>
                                        <p class="card-text">Request a pickup for your laundry.</p>
                                        <a href="#" class="btn btn-primary">Request Pickup</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-user fa-3x mb-3"></i>
                                        <h5 class="card-title">Profile</h5>
                                        <p class="card-text">Manage your profile and settings.</p>
                                        <a href="#" class="btn btn-primary">View Profile</a>
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