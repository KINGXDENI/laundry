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
          <h3>Data Pelanggan</h3>
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
                          <th>Berat</th>
                          <th>Diskon</th>
                          <th>Total Bayar</th>
                          <th style="text-align: center;">Aksi</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        include "./include/koneksi.php";
                        $i = 0 + 1;
                        $sql = mysqli_query($conn, "SELECT transaksi.*, pelanggan.Nama FROM transaksi join pelanggan where transaksi.No_Identitas = pelanggan.No_Identitas  ORDER BY `No_Order` DESC");
                        while ($hasil = mysqli_fetch_array($sql)) {
                        ?>
                          <tr>
                            <td style="text-align: center;"><?php echo $i; ?></td>
                            <td><?php echo $hasil['No_Order']; ?></td>
                            <td><?php echo $hasil['Nama']; ?></td>
                            <td><?php echo $hasil['Tgl_Terima']; ?></td>
                            <td><?php echo $hasil['Tgl_Ambil']; ?></td>
                            <td><?php echo $hasil['total_berat'] . ' Kg'; ?></td>
                            <td><?php echo $hasil['diskon'] . '%'; ?></td>
                            <td><?php echo 'Rp ' . number_format($hasil['Total_Bayar'], 0, ',', '.'); ?>
                            </td>
                            <td style="text-align: center;">
                              <?php if ($hasil['Tgl_Ambil'] == "") {
                              ?>
                                <a href="proses-Konfirmasi.php?No_Order=<?php echo $hasil['No_Order']; ?>" class="btn btn-primary"><i class="bi bi-check2-circle"></i></a>
                              <?php
                              } else {
                              ?>
                                <a href="#" class="btn btn-primary"><i class="bi bi-check2-circle"></i></a>
                              <?php
                              }
                              ?>
                              <a href="download-laporan.php?cetak=<?php echo $hasil['No_Order']; ?>" class="btn btn-info"><i class="bi bi-printer"></i></a>
                              <a href="editdatatransaksi.php?edit=<?php echo $hasil['No_Order']; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                              <a href="javascript:void(0)" class="btn btn-danger" onclick="confirmDelete('<?php echo $hasil['No_Order']; ?>')"><i class="bi bi-trash"></i></a>
                            </td>
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