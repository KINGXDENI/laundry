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
                                <div class="col-12 col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form name="form" action="proses-tambah-transaksi.php" method="POST">
                                                <?php
                                                    include "./include/koneksi.php";
                                                    $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi ORDER BY No_Order DESC LIMIT 1");
                                                    while ($hasil = mysqli_fetch_array($sql)) {
                                                    ?>
                                                <div class="form-group">
                                                    <label for="No_Order">No. Order</label>
                                                    <input type="text" class="form-control" id="No_Order"
                                                        name="No_Order">
                                                </div>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <fieldset class="form-group">
                                                        <label>Nama Pelanggan</label>
                                                        <select class="form-select" id="basicSelect"
                                                            name="No_Identitas">
                                                            <option value="#">----- Pilih Nama Pelanggan -----</option>
                                                            <?php
                                                                $sql = mysqli_query($conn, "SELECT No_Identitas, Nama FROM pelanggan ORDER BY Nama");
                                                                while ($hasil = mysqli_fetch_array($sql)) {
                                                                ?>

                                                            <option value="<?php echo $hasil['No_Identitas'];  ?> ">
                                                                <?php echo $hasil['Nama']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="form-group">
                                                    <fieldset class="form-group">
                                                        <label>Layanan</label>
                                                        <select class="form-select" id="layananSelect" name="id_layanan"
                                                            onchange="updateTotal()">
                                                            <option value="">----- Pilih Layanan -----</option>
                                                            <?php
                                                                $sql = mysqli_query($conn, "SELECT id_layanan, nama_layanan, harga FROM layanan ORDER BY nama_layanan");
                                                                while ($hasil = mysqli_fetch_array($sql)) {
                                                                ?>
                                                            <option value="<?php echo $hasil['id_layanan']; ?>"
                                                                data-harga="<?php echo $hasil['harga']; ?>">
                                                                <?php echo $hasil['nama_layanan']; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga_per_kg">Harga per Kg:</label>
                                                    <input type="text" class="form-control" id="harga_per_kg"
                                                        name="harga_per_kg" readonly>
                                                </div>


                                                <div class="form-group">
                                                    <label>Total Berat</label>
                                                    <input type="text" id="total_berat" class="form-control"
                                                        name="total_berat" placeholder="Total Berat" value="0">
                                                </div>
                                                <div class="form-group">
                                                    <label>Diskon</label>
                                                    <input type="text" id="diskon" class="form-control" name="diskon"
                                                        placeholder="Diskon">
                                                </div>
                                                <div class="form-group">
                                                    <label>Total Bayar</label>
                                                    <input type="text" class="form-control" name="total_bayar" readonly>
                                                </div>
                                                <input type="hidden" class="form-control" name="tanggal"
                                                    value="<?php echo date('Y-m-d'); ?>">
                                                <input type="button" value="Tampil Total Bayar" onClick="tambah()"
                                                    class="btn btn-primary" />
                                                <input type="submit" name="submit" value="Simpan"
                                                    class="btn btn-success">
                                                <a href="transaksi.php"><input type="button" class="btn btn-danger"
                                                        value="Batal"></a>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="pesan"></div>
                                            <div class="tombol">
                                                <button type="button" class="btn btn-success btn-md" data-toggle="modal"
                                                    data-target="#ModalTambah">
                                                    <span class="glyphicon glyphicon-plus"></span> Tambah Detail Pakaian
                                                </button>
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
                                                            $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi ORDER BY No_Order DESC LIMIT 1");
                                                            while ($hasil = mysqli_fetch_array($sql)) {
                                                                $no = $hasil['No_Order'];
                                                            }

                                                            $no_o = $no + 1;
                                                            $i = 1;
                                                            $sql = mysqli_query($conn, "SELECT pakaian.Jenis_Pakaian, detail_transaksi.No_Order, detail_transaksi.Id_Pakaian, detail_transaksi.Jumlah_pakaian FROM detail_transaksi JOIN pakaian ON detail_transaksi.Id_Pakaian = pakaian.Id_Pakaian WHERE No_Order = $no_o");
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
    function updateTotal() {
        var layananSelect = document.getElementById('layananSelect');
        var totalBeratInput = document.getElementById('total_berat');
        var diskonInput = document.getElementById('diskon');
        var totalBayarInput = document.getElementsByName('total_bayar')[0];

        var hargaPerKg = layananSelect.options[layananSelect.selectedIndex].getAttribute('data-harga');
        var totalBerat = parseFloat(totalBeratInput.value);
        var diskon = parseFloat(diskonInput.value);

        if (!isNaN(hargaPerKg) && !isNaN(totalBerat)) {
            var totalBayar = hargaPerKg * totalBerat;
            if (!isNaN(diskon)) {
                totalBayar -= diskon;
            }
            totalBayarInput.value = totalBayar.toFixed(2);
        } else {
            totalBayarInput.value = '';
        }
    }

    function tambah() {
        updateTotal();
    }
    </script>

    <script>
    // Function to update harga_per_kg field based on selected service
    function updateHarga() {
        var layananSelect = document.getElementById('layananSelect');
        var hargaPerKgInput = document.getElementById('harga_per_kg');

        var hargaPerKg = layananSelect.options[layananSelect.selectedIndex].getAttribute('data-harga');

        if (!isNaN(hargaPerKg)) {
            hargaPerKgInput.value = hargaPerKg;
        } else {
            hargaPerKgInput.value = '';
        }
    }

    // Call updateHarga function when layananSelect changes
    $('#layananSelect').change(function() {
        updateHarga();
    });
    </script>


</body>

</html>
<?php
} else {
    header("location:login/index.php");
}
?>