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
                <h3>Data Transaksi</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">No</th>
                                                <th>No. Order</th>
                                                <th>Nama</th>
                                                <th>Tanggal Terima</th>
                                                <th>Tanggal Ambil</th>
                                                <th>Total Bayar</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include "./include/koneksi.php";
                                                $i = 1;
                                                $sql = mysqli_query($conn, "SELECT transaksi.*, pelanggan.Nama, layanan.nama_layanan 
                        FROM transaksi 
                        JOIN pelanggan ON transaksi.No_Identitas = pelanggan.No_Identitas
                        LEFT JOIN layanan ON transaksi.id_layanan = layanan.id_layanan
                        ORDER BY `No_Order` DESC");
                                                while ($hasil = mysqli_fetch_array($sql)) {
                                                ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $i; ?></td>
                                                <td><?php echo $hasil['No_Order']; ?></td>
                                                <td><?php echo $hasil['Nama']; ?></td>
                                                <td><?php echo $hasil['Tgl_Terima']; ?></td>
                                                <td><?php echo $hasil['Tgl_Ambil']; ?></td>
                                                <td><?php echo 'Rp ' . number_format($hasil['Total_Bayar'], 0, ',', '.'); ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if ($hasil['Tgl_Ambil'] == "") { ?>
                                                    <a href="proses-Konfirmasi.php?No_Order=<?php echo $hasil['No_Order']; ?>"
                                                        class="btn btn-primary mb-2"><i
                                                            class="bi bi-check2-circle"></i></a>
                                                    <?php } else { ?>
                                                    <a href="#" class="btn btn-primary mb-2"><i
                                                            class="bi bi-check2-circle"></i></a>
                                                    <?php } ?>
                                                    <a href="editdatatransaksi.php?edit=<?php echo $hasil['No_Order']; ?>"
                                                        class="btn btn-warning mb-2 "><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <a href="javascript:void(0)" class="btn btn-danger mb-2"
                                                        onclick="confirmDelete('<?php echo $hasil['No_Order']; ?>')"><i
                                                            class="bi bi-trash"></i></a>
                                                    <button type="button" class="btn btn-info mb-2" data-toggle="modal"
                                                        data-target="#transactionModal<?php echo $hasil['No_Order']; ?>"><i
                                                            class="bi bi-eye"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                                    $i++;
                                                }
                                                ?>
                                        </tbody>
                                    </table>

                                    <?php
                                        // Query untuk mendapatkan data transaksi
                                        $sql = mysqli_query($conn, "SELECT transaksi.*, pelanggan.Nama, layanan.nama_layanan 
FROM transaksi 
JOIN pelanggan ON transaksi.No_Identitas = pelanggan.No_Identitas
LEFT JOIN layanan ON transaksi.id_layanan = layanan.id_layanan
ORDER BY `No_Order` DESC");

                                        while ($hasil = mysqli_fetch_array($sql)) {
                                        ?>
                                    <!-- Modal for each transaction -->
                                    <div class="modal fade" id="transactionModal<?php echo $hasil['No_Order']; ?>"
                                        tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="transactionModalLabel">Detail Transaksi
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>ID Transaksi</td>
                                                                <td>:</td>
                                                                <td><?php echo $hasil['No_Order']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nama</td>
                                                                <td>:</td>
                                                                <td><?php echo $hasil['Nama']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Layanan</td>
                                                                <td>:</td>
                                                                <td><?php echo isset($hasil['nama_layanan']) ? $hasil['nama_layanan'] : 'Tidak ada layanan'; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tanggal Terima</td>
                                                                <td>:</td>
                                                                <td><?php echo $hasil['Tgl_Terima']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tanggal Ambil</td>
                                                                <td>:</td>
                                                                <td><?php echo $hasil['Tgl_Ambil']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Berat</td>
                                                                <td>:</td>
                                                                <td><?php echo $hasil['total_berat'] . ' Kg'; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Diskon</td>
                                                                <td>:</td>
                                                                <td><?php echo $hasil['diskon']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Bayar</td>
                                                                <td>:</td>
                                                                <td><?php echo 'Rp ' . number_format($hasil['Total_Bayar'], 0, ',', '.'); ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <a href="download-laporan.php?cetak=<?php echo $hasil['No_Order']; ?>"
                                                        class="btn btn-info"><i class="bi bi-printer"></i></a><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                        ?>


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

    <!-- Bootstrap JS, Popper.js, and jQuery -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
} else {
    header("location:login/index.php");
}
?>