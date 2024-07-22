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
                <h3>Form Edit Layanan</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="container">
                        <div class="card mt-2">
                            <div class="card-body">
                                <?php
                                    include "./include/koneksi.php";
                                    $id_layanan = $_GET['edit'];

                                    $sql = mysqli_query($conn, "SELECT * FROM layanan WHERE id_layanan='" . $id_layanan . "'");
                                    while ($hasil = mysqli_fetch_array($sql)) {
                                    ?>
                                <form action="layanan_edit_proses.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="id_layanan">Id Layanan</label>
                                                <input type="text" name="id_layanan" class="form-control"
                                                    id="basicInput" value="<?php echo $hasil['id_layanan']; ?>"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_layanan">Nama Layanan</label>
                                                <input type="text" name="nama_layanan" class="form-control"
                                                    id="basicInput" value="<?php echo $hasil['nama_layanan']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control"
                                                    placeholder="Masukan Deskripsi"><?php echo $hasil['deskripsi']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="text" class="form-control" name="harga"
                                                    value="<?php echo $hasil['harga']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Estimasi Waktu</label>
                                                <input type="text" class="form-control" name="estimasi_waktu"
                                                    value="<?php echo $hasil['estimasi_waktu']; ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class=" form-group">
                                        <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                                        <a href="pelanggan.php"><input type="button" class="btn btn-danger"
                                                value="Batal"></a>
                                    </div>
                                </form>
                                <?php
                                    } ?>
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



    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownItems = document.querySelectorAll('.dropdown-item');
        const dropdownToggle = document.querySelector('.dropdown-toggle');

        dropdownItems.forEach(function(item) {
            item.addEventListener('click', function(event) {
                event.preventDefault();
                const selectedText = this.getAttribute('data-text');
                dropdownToggle.innerHTML = selectedText;
            });
        });
    });
    </script>
</body>
<?php
} else {
    header("location:login/index.php");
}