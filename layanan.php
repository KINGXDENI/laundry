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

        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
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
                    <h3>Layanan</h3>
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">

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

        <script>
            $(document).ready(function() {
                $('#table').DataTable();
            });

            function confirmDelete(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'proses-hapus-transaksi.php?hapus=' + id;
                    }
                });
            }
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
    </body>

    </html>
<?php
} else {
    header("location:login/index.php");
}
?>