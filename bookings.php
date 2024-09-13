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

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
            <div class="page-heading d-flex justify-content-between align-items-center mb-4">
                <h3>Boookings</h3>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <!-- <a href="pelanggan_tambah.php" class="btn btn-primary btn-md mb-3">Tambah <i
                                            class="bi bi-plus"></i></a> -->
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">No</th>
                                                <th>No Booking</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Email Pelangan</th>
                                                <th>No Telpon</th>
                                                <th>Alamat Penjemputan</th>
                                                <th>Jenis Layanan</th>
                                                <th>Tanggal Booking</th>
                                                <th>Status</th>
                                                <th>aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                include "./include/koneksi.php";
                                                $i = 1;
                                                $sql = mysqli_query($conn, "SELECT * FROM bookings ORDER BY `id_booking`");
                                                while ($hasil = mysqli_fetch_array($sql)) {
                                                ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $i; ?></td>
                                                <td><?php echo $hasil['no_booking']; ?></td>
                                                <td><?php echo $hasil['nama_pelanggan']; ?></td>
                                                <td><?php echo $hasil['email_pelanggan']; ?></td>
                                                <td><?php echo $hasil['nomor_telepon']; ?></td>
                                                <td><?php echo $hasil['alamat_penjemputan']; ?></td>
                                                <td><?php echo $hasil['jenis_layanan']; ?></td>
                                                <td><?php echo $hasil['tanggal_booking']; ?></td>
                                                <td>
                                                    <form method="POST" action="bookings_ubah_status.php">
                                                        <input type="hidden" name="id_booking"
                                                            value="<?php echo $hasil['id_booking']; ?>">
                                                        <select name="status" class="form-control">
                                                            <option value="Pending"
                                                                <?php if ($hasil['status'] == 'Pending') echo 'selected'; ?>>
                                                                Pending</option>
                                                            <option value="Dijemput"
                                                                <?php if ($hasil['status'] == 'Dijemput') echo 'selected'; ?>>
                                                                Dijemput</option>
                                                            <option value="Diproses"
                                                                <?php if ($hasil['status'] == 'Diproses') echo 'selected'; ?>>
                                                                Diproses</option>
                                                            <option value="Selesai"
                                                                <?php if ($hasil['status'] == 'Selesai') echo 'selected'; ?>>
                                                                Selesai</option>
                                                            <option value="Dibatalkan"
                                                                <?php if ($hasil['status'] == 'Dibatalkan') echo 'selected'; ?>>
                                                                Dibatalkan</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-primary mt-2"><i
                                                                class="bi bi-check2-circle"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="POST" action="bookings_hapus.php"
                                                        onsubmit="confirmDelete(event);">
                                                        <input type="hidden" name="id_booking"
                                                            value="<?php echo $hasil['id_booking']; ?>">
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>

                                                </td>
                                            </tr>
                                            <?php
                                                    $i++;
                                                }
                                                ?>
                                        </tbody>
                                    </table>
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function confirmDelete(event) {
        event.preventDefault(); // Mencegah pengiriman form secara default

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
                // Kirim form jika konfirmasi berhasil
                event.target.submit();
            }
        });
    }
    </script>



    <script>
    $(document).ready(function() {
        $('#table').DataTable();

        // Cek jika ada parameter status di URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('status')) {
            const status = urlParams.get('status');
            if (status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Status booking berhasil diperbarui!',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (status === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menghapus booking.',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }
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
</body>

</html>
<?php
} else {
    header("location:login/index.php");
}
?>