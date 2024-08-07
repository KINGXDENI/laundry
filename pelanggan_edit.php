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
                <h3>Form Tambah Data Pelanggan</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="container">
                        <div class="card mt-2">
                            <div class="card-body">
                                <?php
                                    include "./include/koneksi.php";
                                    $No_Identitas = $_GET['edit'];

                                    $sql = mysqli_query($conn, "SELECT * FROM pelanggan WHERE No_Identitas='" . $No_Identitas . "'");
                                    while ($hasil = mysqli_fetch_array($sql)) {
                                    ?>
                                <form action="proses-edit-pelanggan.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Identitas</label>
                                                <input type="text" class="form-control" name="No_Identitas"
                                                    placeholder="No. Identitas" readonly="readonly"
                                                    value="<?php echo $hasil['No_Identitas']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" name="Nama" placeholder="Nama"
                                                    value="<?php echo $hasil['Nama']; ?>">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="<?php echo $hasil['email']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" class="form-control" name="Alamat"
                                                    placeholder="Alamat" value="<?php echo $hasil['Alamat']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>No. Hp</label>
                                                <input type="text" class="form-control" name="No_Hp"
                                                    placeholder="No. Hp" value="<?php echo $hasil['No_Hp']; ?>">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Foto</label>
                                                <input type="file" class="form-control" name="foto">
                                                <?php if (!empty($hasil['Foto'])) : ?>
                                                <p><strong>Foto Saat Ini:</strong> <img
                                                        src="../uploads/<?php echo $hasil['Foto']; ?>"
                                                        alt="Foto Pelanggan" width="200"></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group">
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
</body>
<?php
} else {
    header("location:login/index.php");
}