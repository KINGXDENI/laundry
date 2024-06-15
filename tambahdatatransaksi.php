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
                                                    <label>No. Order</label>
                                                    <input type="text" class="form-control" name="No_Order"
                                                        value="<?php echo $hasil['No_Order']; ?>" readonly>
                                                </div>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <label>Nama Pelanggan</label>
                                                    <select class="form-control" name="No_Identitas">
                                                        <?php
                                                $sql = mysqli_query($conn, "SELECT No_Identitas, Nama FROM pelanggan ORDER BY Nama");
                                                while ($hasil = mysqli_fetch_array($sql)) {
                                                ?>
                                                        <option value="<?php echo $hasil['No_Identitas']; ?>">
                                                            <?php echo $hasil['Nama']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Total Berat</label>
                                                    <input type="text" id="total_berat" class="form-control"
                                                        name="total_berat" placeholder="Total Berat" value="0">
                                                </div>
                                                <div class="form-group">
                                                    <label>Diskon</label>
                                                    <input type="text" id="diskon" class="form-control" name="diskon"
                                                        placeholder="Diskon" value="0">
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
                                                <a href="transaksi.php"><input type="button" class="btn btn-default"
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

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span> by <a
                                href="https://saugi.me">Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
<?php
} else {
    header("location:login/index.php");
}
?>