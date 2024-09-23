<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<style>
/* Menyembunyikan tulisan "Amanah Laundry" di layar kecil */
@media (max-width: 768px) {
    .sitename {
        display: none;
    }
}
</style>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <img src="../asset/img/svg/amanah_logo.svg" width="40" height="auto" class="d-inline-block align-top"
                alt="Amanah Logo">
            <h1 class="sitename">Amanah Laundry</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="../user/booking.php"
                        class="<?php echo ($current_page == 'booking.php') ? 'active' : ''; ?>">Booking</a></li>
                <li><a href="../user/booking_tampil.php"
                        class="<?php echo ($current_page == 'booking_tampil.php') ? 'active' : ''; ?>">Riwayat</a></li>
                <li><a href="pelanggan.php"
                        class="<?php echo ($current_page == 'pelanggan.php') || ($current_page == 'pelanggan_tampil.php') || ($current_page == 'pelanggan_edit.php') ? 'active' : ''; ?>">Pelanggan</a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a id="logout-button" class="btn-getstarted" href="../logout.php">Logout</a>

    </div>
</header>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoutButton = document.getElementById('logout-button');

    if (logoutButton) {
        logoutButton.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah pengalihan default

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari akun ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke URL logout jika konfirmasi berhasil
                    window.location.href = logoutButton.href;
                }
            });
        });
    }
});
</script>