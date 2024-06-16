<?php
require 'vendor/autoload.php'; // Path ke autoloader Composer

use Dompdf\Dompdf;

$No_Order = $_GET['cetak'];

ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Struk Transaksi</title>
    <link rel="stylesheet" type="text/css" href="./asset/css/bootstrap.min.css">
    <style media="screen">
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
    }

    .header {
        text-align: center;
    }

    .header img {
        max-width: 100px;
    }

    .header h1 {
        margin: 10px 0 5px;
    }

    .header h3 {
        margin: 5px 0;
        font-weight: normal;
    }

    .content {
        margin-top: 20px;
    }

    .row {
        display: flex;
        justify-content: space-between;
    }

    .row .col {
        flex: 1;
    }

    .row .col p {
        margin: 5px 0;
    }

    table {
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    hr {
        border: 1px solid black;
    }

    .footer {
        margin-top: 20px;
        text-align: right;
    }

    .footer p {
        margin: 5px 0;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="./asset/images/logo.png" alt="Logo">
            <h1 style="font-family:fantasy">Amanah Laundry
            </h1>
            <h3>Laundry & Dry Cleaning</h3>
            <h3>Hp: 087 822 555 784</h3>
        </div>
        <hr>
        <?php
        include "./include/koneksi.php";

        $sql = mysqli_query($conn, "SELECT Nama, Alamat, Tgl_Terima, No_Order FROM pelanggan JOIN transaksi ON pelanggan.No_Identitas = transaksi.No_Identitas WHERE No_Order = '$No_Order'");
        while ($hasil = mysqli_fetch_array($sql)) {
            $tgl1 = $hasil['Tgl_Terima'];
            $tgl2 = date('Y-m-d', strtotime('+3 days', strtotime($tgl1)));
        ?>

        <div class="content">
            <div class="row">
                <div class="col">
                    <p>Nama: <?php echo $hasil['Nama']; ?><br>
                        Alamat: <?php echo $hasil['Alamat']; ?></p>
                </div>
                <div class="col">
                    <p>Tgl Terima: <?php echo $hasil['Tgl_Terima']; ?><br>
                        Tgl Ambil: <?php echo $tgl2; ?></p>
                </div>
            </div>
            <hr>
            <p>No. Order: <?php echo $hasil['No_Order']; ?></p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Pakaian</th>
                            <th>Jumlah Pakaian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $sqlDetail = mysqli_query($conn, "SELECT Jenis_Pakaian, Jumlah_Pakaian FROM detail_transaksi JOIN pakaian ON detail_transaksi.Id_Pakaian = pakaian.Id_Pakaian WHERE No_Order = '$No_Order'");
                            while ($detail = mysqli_fetch_array($sqlDetail)) {
                            ?>
                        <tr>
                            <td style="text-align:center"><?php echo $i; ?></td>
                            <td><?php echo $detail['Jenis_Pakaian']; ?></td>
                            <td><?php echo $detail['Jumlah_Pakaian']; ?></td>
                        </tr>
                        <?php
                                $i++;
                            }
                            ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
        $sqlTotal = mysqli_query($conn, "SELECT total_berat, diskon, Total_Bayar FROM transaksi WHERE No_Order = '$No_Order'");
        while ($total = mysqli_fetch_array($sqlTotal)) {
            ?>
            <div class="footer">
                <p>Total Berat: <?php echo $total['total_berat']; ?> Kg</p>
                <p>Diskon (Rp): <?php echo $total['diskon']; ?></p>
                <p>Total Bayar (Rp): <?php echo $total['Total_Bayar']; ?></p>
            </div>
            <?php
        }
            ?>
        </div>
    </div>
</body>

</html>

<?php
$html = ob_get_clean();

$dompdf = new Dompdf();
$dompdf->setPaper('A5', 'portrait');
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('struk.pdf', ['Attachment' => false]);
?>