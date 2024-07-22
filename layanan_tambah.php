<?php
session_start();
if (isset($_SESSION['id'])) {
    include "include/koneksi.php";

    // Query untuk mendapatkan ID layanan terakhir
    $result = mysqli_query($conn, "SELECT id_layanan FROM layanan ORDER BY id_layanan DESC LIMIT 1");
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $last_id_layanan = $row ? $row['id_layanan'] : null;

    // Debugging
    echo "Last ID Layanan: " . htmlspecialchars($last_id_layanan) . "<br>";

    if ($last_id_layanan) {
        $number = intval(substr($last_id_layanan, 2)) + 1;
    } else {
        $number = 1;
    }

    $new_id_layanan = 'L-' . str_pad($number, 2, '0', STR_PAD_LEFT);

    // Debugging
    echo "New ID Layanan: " . htmlspecialchars($new_id_layanan) . "<br>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amanah Laundry</title>

    <?php include "include/header.php"; ?>
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">

        <?php include "include/list.php"; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Form Tambah Layanan</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="container">
                        <div class="card mt-2">
                            <div class="card-body">
                                <form action="layanan_proses_tambah.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="id_layanan">ID Layanan</label>
                                                <input type="text" name="id_layanan" class="form-control"
                                                    id="basicInput"
                                                    value="<?php echo htmlspecialchars($new_id_layanan); ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_layanan">Nama Layanan</label>
                                                <input type="text" name="nama_layanan" class="form-control"
                                                    id="basicInput" placeholder="Masukan Nama Layanan">
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control"
                                                    placeholder="Masukan Deskripsi"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="text" class="form-control" name="harga"
                                                    placeholder="Masukan Harga">
                                            </div>
                                            <div class="form-group">
                                                <label>Estimasi Waktu</label>
                                                <input type="text" class="form-control" name="estimasi_waktu"
                                                    placeholder="Masukan Estimasi Waktu">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                                        <a href="layanan.php"><input type="button" class="btn btn-danger"
                                                value="Batal"></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php include "include/footer.php"; ?>
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

</html>
<?php
} else {
    header("location:login/index.php");
    exit();
}
?>