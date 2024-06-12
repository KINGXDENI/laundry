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
                    <h3>Data Pelanggan</h3>
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tombol mb-3">
                                        <a href="tambahdatapelanggan.php"><button type="button" class="btn btn-primary btn-md">Tambah Data</button></a>
                                    </div>
                                    <table id="table" class="table table-striped table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">No</th>
                                                <th>No. Identitas</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No. Hp</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            include "./include/koneksi.php";
                                            $i = 0 + 1;
                                            $sql = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY `No_Identitas`");
                                            while ($hasil = mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i; ?></td>
                                                    <td><?php echo $hasil['No_Identitas']; ?></td>
                                                    <td><?php echo $hasil['Nama']; ?></td>
                                                    <td><?php echo $hasil['Alamat']; ?></td>
                                                    <td><?php echo $hasil['No_Hp']; ?></td>
                                                    <td style="text-align: center;">
                                                        <a href="editdatapelanggan.php?edit=<?php echo $hasil['No_Identitas']; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                        <a href="#" class="btn btn-danger delete-btn" data-id="<?php echo $hasil['No_Identitas']; ?>" onclick="confirmDelete(<?php echo $hasil['No_Identitas']; ?>)"><i class="bi bi-trash"></i></a>
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
                    </section>
                </div>

                <?php
                include "include/footer.php";
                ?>
            </div>
        </div>

        <script>
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
                        // Redirect to the delete process
                        window.location.href = 'proses-hapus-pelanggan.php?hapus=' + id;
                    }
                });
            }
        </script>


        <script>
            $(document).ready(function() {
                $('#table').DataTable();
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