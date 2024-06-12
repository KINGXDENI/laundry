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
                <h3>Form Tambah Data Pakaian</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <form action="proses-tambah-pakaian.php" method="POST">

                                    <div class="form-group">
                                        <label>Kode Pakaian</label>
                                        <input type="text" class="form-control" name="Id_Pakaian"
                                            placeholder="Masukan Kode Pakaian">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Pakaian</label>
                                        <input type="text" class="form-control" name="Jenis_Pakaian"
                                            placeholder="Masukan Jenis Pakaian">
                                    </div>
                                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                                    <a href="pakaian.php"><input type="button" class="btn btn-danger" value="Batal"></a>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
            <?php
        include "include/footer.php";
        ?>
        </div>
    </div>

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
<?php
} else {
  header("location:login/index.php");
}