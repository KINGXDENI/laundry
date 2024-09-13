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
    <?php include "include/header.php"; ?>

    <style>
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        margin: 0;
    }

    .modal-body input,
    .modal-body select {
        margin-bottom: 15px;
    }
    </style>
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
                <h3>Form Transaksi Laundry</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form name="form" action="proses-tambah-transaksi.php" method="POST">
                                            <?php
                                                include "./include/koneksi.php";
                                                $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi  ORDER BY No_Order Desc LIMIT 1");
                                                while ($hasil = mysqli_fetch_array($sql)) {
                                                ?>
                                            <div class="form-group">
                                                <label>No. Order</label>
                                                <input type="text" class="form-control" name="No_Order"
                                                    value="<?php echo $hasil['No_Order']; ?>" readonly>
                                            </div>
                                            <?php
                                                }
                                                ?>
                                            <div class="form-group">
                                                <label for="basicSelect">Nama Pelanggan</label>
                                                <select class="form-select" id="basicSelect" name="No_Identitas">
                                                    <option value="#">----- Pilih Nama Pelanggan -----</option>
                                                    <?php
                                                        $sql = mysqli_query($conn, "SELECT No_Identitas, Nama, No_Hp FROM pelanggan ORDER BY Nama");
                                                        while ($hasil = mysqli_fetch_array($sql)) {
                                                        ?>
                                                    <option value="<?php echo $hasil['No_Identitas']; ?>">
                                                        <?php echo $hasil['Nama'] . " (" . $hasil['No_Hp'] . ")"; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="layananSelect">Layanan</label>
                                                <select class="form-select" id="layananSelect" name="id_layanan"
                                                    onchange="updateHarga()">
                                                    <option value="">----- Pilih Layanan -----</option>
                                                    <?php
                                                        $sql = mysqli_query($conn, "SELECT id_layanan, nama_layanan, harga, estimasi_waktu FROM layanan ORDER BY nama_layanan");
                                                        while ($hasil = mysqli_fetch_array($sql)) {
                                                        ?>
                                                    <option value="<?php echo $hasil['id_layanan']; ?>"
                                                        data-harga="<?php echo $hasil['harga']; ?>"
                                                        data-estimasi="<?php echo $hasil['estimasi_waktu']; ?>">
                                                        <?php echo $hasil['nama_layanan'] . " (" . $hasil['estimasi_waktu'] . ")"; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_per_kg">Harga per Kg:</label>
                                                <input type="text" class="form-control" id="harga_per_kg"
                                                    name="harga_per_kg" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="estimasi_waktu">Estimasi Waktu:</label>
                                                <input type="text" class="form-control" id="estimasi_waktu"
                                                    name="estimasi_waktu" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Total Berat</label>
                                                <input type="text" id="total_berat" class="form-control"
                                                    name="total_berat" placeholder="Total Berat" value="0">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="diskon" class="form-control" name="diskon"
                                                    placeholder="Diskon" value="0">
                                            </div>
                                            <div class="form-group">
                                                <label>Total Bayar</label>
                                                <input type="text" class="form-control" id="total_bayar"
                                                    name="total_bayar" readonly>
                                            </div>
                                            <input type="hidden" class="form-control" name="tanggal"
                                                value="<?php echo date('Y-m-d'); ?>">
                                            <input type="button" value="Tampil Total Bayar" onClick="updateTotal()"
                                                class="btn btn-primary" />
                                            <input type="submit" name="submit" value="Simpan" class="btn btn-success">
                                            <a href="transaksi.php"><input type="button" class="btn btn-danger"
                                                    value="Batal"></a>
                                        </form>
                                    </div>
                                    <div class="col-md-6 col-md-offset-2">
                                        <div id="pesan"></div>
                                        <div class="tombol">
                                            <button type="button" class="btn btn-success btn-md mt-3"
                                                data-toggle="modal" data-target="#ModalTambah"><span
                                                    class="glyphicon glyphicon-plus "></span> Tambah Detail
                                                Pakaian</button>
                                        </div>
                                        <br>
                                        <div class="table-responsive">
                                            <table id="table" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">No</th>
                                                        <th>Jenis Pakaian</th>
                                                        <th>Jumlah Pakaian</th>
                                                        <th style="text-align: center;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi  ORDER BY No_Order Desc LIMIT 1");
                                                        while ($hasil = mysqli_fetch_array($sql)) {
                                                            $no = $hasil['No_Order'];
                                                        }

                                                        $no_o = $no + 1;
                                                        $i = 0 + 1;
                                                        $sql = mysqli_query($conn, "SELECT pakaian.Jenis_Pakaian, detail_transaksi.No_Order, detail_transaksi.Id_Pakaian, detail_transaksi.Jumlah_pakaian FROM detail_transaksi join pakaian on detail_transaksi.Id_Pakaian = Pakaian.Id_Pakaian Where No_Order = $no_o");
                                                        while ($hasil = mysqli_fetch_array($sql)) {
                                                        ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $i; ?></td>
                                                        <td><?php echo $hasil['Jenis_Pakaian']; ?></td>
                                                        <td><?php echo $hasil['Jumlah_pakaian']; ?></td>
                                                        <td style="text-align: center;">
                                                            <a href="proses-hapus-detail-transaksi.php?order=<?php echo $hasil['No_Order']; ?>&pakaian=<?php echo $hasil['Id_Pakaian']; ?>"
                                                                class="btn btn-danger">Hapus</a>
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

                                <!-- Modal Tambah Detail Pakaian -->
                                <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog"
                                    aria-labelledby="ModalTambahLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalTambahLabel">Tambah Detail Pakaian</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="tambah" method="POST">
                                                    <?php
                                                        $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi ORDER BY No_Order Desc LIMIT 1");
                                                        while ($hasil = mysqli_fetch_array($sql)) {
                                                            $na = $hasil['No_Order'];
                                                        }
                                                        ?>
                                                    <div class="form-group">
                                                        <label>No. Order</label>
                                                        <input type="text" class="form-control" name="No_Order"
                                                            value="<?php echo $na + 1; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pakaianSelect">Jenis Pakaian</label>
                                                        <select class="form-select" id="pakaianSelect"
                                                            name="Id_Pakaian">
                                                            <option value="#">----- Pilih Jenis Pakaian -----</option>
                                                            <?php
                                                                $sql = mysqli_query($conn, "SELECT * FROM pakaian ORDER BY Jenis_Pakaian");
                                                                while ($hasil = mysqli_fetch_array($sql)) {
                                                                ?>
                                                            <option value="<?php echo $hasil['Id_Pakaian']; ?>">
                                                                <?php echo $hasil['Jenis_Pakaian']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jumlah Pakaian</label>
                                                        <input type="text" class="form-control" name="Jumlah_Pakaian"
                                                            placeholder="Jumlah pakaian">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success" type="submit">Simpan</button>
                                                        <button class="btn btn-secondary" data-dismiss="modal"
                                                            aria-hidden="true">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
    // Function to update harga_per_kg field and estimasi_waktu field based on selected service
    function updateHarga() {
        var layananSelect = document.getElementById('layananSelect');
        var hargaPerKgInput = document.getElementById('harga_per_kg');
        var estimasiWaktuInput = document.getElementById('estimasi_waktu');

        var hargaPerKg = layananSelect.options[layananSelect.selectedIndex].getAttribute('data-harga');
        var estimasiWaktu = layananSelect.options[layananSelect.selectedIndex].getAttribute('data-estimasi');

        if (!isNaN(hargaPerKg)) {
            hargaPerKgInput.value = hargaPerKg;
        } else {
            hargaPerKgInput.value = '';
        }

        if (estimasiWaktu) {
            estimasiWaktuInput.value = estimasiWaktu;
        } else {
            estimasiWaktuInput.value = '';
        }
    }

    // Call updateHarga function when layananSelect changes
    $('#layananSelect').change(function() {
        updateHarga();
    });
    </script>

    <script type="text/javascript">
    d = eval(form.No_Order.value)
    e = d + 1
    form.No_Order.value = e

    function updateTotal() {
        var totalBerat = parseFloat(document.getElementById('total_berat').value);
        var diskon = parseFloat(document.getElementById('diskon').value);
        var hargaPerKg = parseFloat(document.getElementById('harga_per_kg').value);
        var totalBayar = (totalBerat * hargaPerKg) - diskon;

        if (!isNaN(totalBayar)) {
            document.getElementById('total_bayar').value = totalBayar;
        } else {
            document.getElementById('total_bayar').value = 0;
        }
    }

    $('#tambah').submit(function() {
        $.ajax({
            type: 'POST',
            url: 'proses-tambah-detail-transaksi.php',
            data: $(this).serialize(),
            success: function(data) {
                $("#pesan").addClass("css_pesan");
                $("#ModalTambah").modal('hide');
                $('#pesan').html(data);
            }
        })
        return false;
    });

    function hapus(order, id) {
        swal({
                title: "Apa anda yakin?",
                text: "Anda tidak akan bisa mengembalikan data yang sudah terhapus!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya, hapus!",
                closeOnConfirm: false
            },

            function() {
                var no_id = id;
                var no_order = order;
                $.ajax({
                    url: "crud/hapus.php",
                    type: "GET",
                    data: {
                        Id_Pakaian: no_id,
                        No_Order: no_order
                    },
                    success: function(data) {
                        swal("Terhapus!", "Data berhasil dihapus.", "success");

                    }
                });
                //document.location = url;
                setTimeout("location.href='tambahdatatransaksi.php';", 1000);
            }

        );
    };
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