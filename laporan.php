<?php
session_start();
if (isset($_SESSION['id'])) {
    include "./include/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amanah Laundry</title>

    <!-- Include header for styles and scripts -->
    <?php
        include "include/header.php";
        ?>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">

        <!-- Include list for navigation -->
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
                <h3>Laporan Keuntungan Bulanan</h3>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bulan">Pilih Bulan</label>
                                            <select class="form-control" id="bulan" name="bulan" required>
                                                <option value="">Pilih Bulan</option>
                                                <?php
                                                // Fetch unique months from transaksi table
                                                $bulanQuery = "SELECT DISTINCT DATE_FORMAT(Tgl_Terima, '%Y-%m') AS bulan FROM transaksi ORDER BY bulan DESC";
                                                $bulanResult = mysqli_query($conn, $bulanQuery);
                                                while ($bulanRow = mysqli_fetch_assoc($bulanResult)) {
                                                    echo '<option value="' . $bulanRow['bulan'] . '">' . $bulanRow['bulan'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
                                </form>

                                <!-- <a href="laporan_print.php" class="btn btn-primary mt-3 ">pdf</a> -->
                                <br>

                                <?php
                                    if (isset($_GET['bulan'])) {
                                        $bulan = $_GET['bulan'];
                                        $sql = "SELECT 
                                                    No_Order, Tgl_Terima, Nama, Total_Bayar 
                                                FROM transaksi 
                                                JOIN pelanggan ON transaksi.No_Identitas = pelanggan.No_Identitas
                                                WHERE DATE_FORMAT(Tgl_Terima, '%Y-%m') = '$bulan'
                                                ORDER BY Tgl_Terima ASC";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            $totalPendapatan = 0;
                                    ?>
                                <div class="table-responsive">
                                    <table id="monthlyReport" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">No</th>
                                                <th>No. Order</th>
                                                <th>Tanggal Terima</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Total Bayar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                        $i = 1;
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $totalPendapatan += $row['Total_Bayar'];
                                                        ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $i++; ?></td>
                                                <td><?php echo $row['No_Order']; ?></td>
                                                <td><?php echo $row['Tgl_Terima']; ?></td>
                                                <td><?php echo $row['Nama']; ?></td>
                                                <td><?php echo 'Rp ' . number_format($row['Total_Bayar'], 0, ',', '.'); ?>
                                                </td>
                                            </tr>
                                            <?php
                                                        }
                                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" style="text-align: right;">Total Pendapatan:</th>
                                                <th><?php echo 'Rp ' . number_format($totalPendapatan, 0, ',', '.'); ?>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <?php
                                        } else {
                                            echo "<p>Tidak ada data untuk bulan yang dipilih.</p>";
                                        }
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Include footer -->
            <?php
                include "include/footer.php";
                ?>
        </div>
    </div>

    <!-- DataTables and Bootstrap JS -->
    <script>
    $(document).ready(function() {
        $('#monthlyReport').DataTable();
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

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
} else {
    header("location:login/index.php");
}
?>