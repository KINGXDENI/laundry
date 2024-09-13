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
                <h3>Form Edit Transaksi Laundry</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form name="form" action="proses-edit-transaksi.php" method="POST">
                                            <?php
                                                include "./include/koneksi.php";

                                                $No_Order = $_GET['edit'];

                                                // Ambil data transaksi yang sedang diedit
                                                $sql_transaksi = mysqli_query($conn, "SELECT No_Order, No_Identitas, Tgl_Terima, total_berat, diskon, Total_Bayar FROM transaksi WHERE No_Order='$No_Order'");
                                                $transaksi = mysqli_fetch_array($sql_transaksi);

                                                // Jika data transaksi tidak ditemukan
                                                if (!$transaksi) {
                                                    echo "Data transaksi tidak ditemukan.";
                                                    exit();
                                                }
                                                ?>

                                            <div class="form-group">
                                                <label>No. Order</label>
                                                <input type="text" class="form-control" name="No_Order"
                                                    value="<?php echo $transaksi['No_Order']; ?>" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Nama Pelanggan</label>
                                                <select class="form-control" name="No_Identitas">
                                                    <?php
                                                        $sql_pelanggan = mysqli_query($conn, "SELECT No_Identitas, Nama FROM pelanggan ORDER BY Nama");
                                                        while ($hasil = mysqli_fetch_array($sql_pelanggan)) {
                                                            // Tentukan opsi yang dipilih
                                                            $selected = ($hasil['No_Identitas'] == $transaksi['No_Identitas']) ? 'selected' : '';
                                                            echo "<option value='" . $hasil['No_Identitas'] . "' $selected>" . $hasil['Nama'] . "</option>";
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Layanan</label>
                                                <select class="form-control" name="No_Identitas">
                                                    <?php
                                                        $sql_layanan = mysqli_query($conn, "SELECT id_layanan, nama_layanan FROM layanan ORDER BY nama_layanan");
                                                        while ($hasil = mysqli_fetch_array($sql_layanan)) {
                                                            // Tentukan opsi yang dipilih
                                                            $selected = ($hasil['id_layanan'] == $transaksi['id_layanan']) ? 'selected' : '';
                                                            echo "<option value='" . $hasil['id_layanan'] . "' $selected>" . $hasil['nama_layanan'] . "</option>";
                                                        }
                                                        ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Total Berat</label>
                                                <input type="text" id="total_berat" class="form-control"
                                                    name="total_berat" placeholder="Total Berat"
                                                    value="<?php echo $transaksi['total_berat']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" id="diskon" class="form-control" name="diskon"
                                                    placeholder="Diskon" value="<?php echo $transaksi['diskon']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Total Bayar</label>
                                                <input type="text" class="form-control" name="total_bayar"
                                                    value="<?php echo $transaksi['Total_Bayar']; ?>" readonly>
                                            </div>
                                            <input type="hidden" class="form-control" name="tanggal"
                                                value="<?php echo date('Y-m-d'); ?>">

                                            <input type="button" value="Tampil Total Bayar" onClick="tambah()"
                                                class="btn btn-primary" />
                                            <input type="submit" name="submit" value="Simpan" class="btn btn-success">
                                            <a href="transaksi.php"><input type="button" class="btn btn-default"
                                                    value="Batal"></a>
                                        </form>

                                    </div>
                                    <div class="col-md-6  col-md-offset-2">
                                        <div id="pesan"></div>
                                        <div class="tombol">
                                            <button type="button" class="btn btn-success btn-md " data-toggle="modal"
                                                data-target="#ModalTambah"><span
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
                                                        $i = 0 + 1;
                                                        $sql = mysqli_query($conn, "SELECT pakaian.Jenis_Pakaian, detail_transaksi.No_Order, detail_transaksi.Id_Pakaian, detail_transaksi.Jumlah_pakaian FROM detail_transaksi join pakaian on detail_transaksi.Id_Pakaian = Pakaian.Id_Pakaian Where No_Order = $No_Order");
                                                        while ($hasil = mysqli_fetch_array($sql)) {
                                                        ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $i; ?></td>
                                                        <td><?php echo $hasil['Jenis_Pakaian']; ?></td>
                                                        <td><?php echo $hasil['Jumlah_pakaian']; ?></td>
                                                        <td style="text-align: center;">
                                                            <a href="proses-hapus-detail-transaksi-edit.php?order=<?php echo $hasil['No_Order']; ?>&pakaian=<?php echo $hasil['Id_Pakaian']; ?>"
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
                                <div class="modal fade" id="ModalTambah" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Tambah Transaksi Pakaian</h4>
                                            </div>

                                            <div class="modal-body">
                                                <form id="tambah" method="POST">
                                                    <?php
                                                        $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi WHERE No_Order = $No_Order");
                                                        while ($hasil = mysqli_fetch_array($sql)) {
                                                            $na = $hasil['No_Order'];
                                                        }
                                                        ?>
                                                    <input type="text" class="form-control" name="No_Order"
                                                        value="<?php echo $na;  ?>">
                                                    <div class="form-group">
                                                        <label>Jenis Pakaian</label>
                                                        <select class="form-control" name="Id_Pakaian">
                                                            <?php
                                                                $sql = mysqli_query($conn, "SELECT * FROM pakaian ORDER BY Jenis_Pakaian");
                                                                while ($hasil = mysqli_fetch_array($sql)) {

                                                                ?>
                                                            <option value="<?= $hasil['Id_Pakaian']; ?>">
                                                                <?= $hasil['Jenis_Pakaian']; ?></option>
                                                            <?php
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jumlah Pakaian</label>
                                                        <input type="text" class="form-control" name="Jumlah_Pakaian"
                                                            placeholder="Jumlah pakaian">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-success" type="submit">Simpan</button>
                                                        <button class="btn btn-default" data-dismiss="modal"
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


    <script type="text/javascript">
    function tambah() {
        a = eval(form.total_berat.value)
        b = eval(form.diskon.value)
        c = (a * 7000) - b
        // b=eval(form.b.value)
        // c=a+b
        form.total_bayar.value = c
    }


    $('#tambah').submit(function() {
        $.ajax({
            type: 'POST',
            url: 'proses-tambah-detail-transaksi-edit.php',
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


</body>

</html>
<?php
} else {
    header("location:login/index.php");
}
?>