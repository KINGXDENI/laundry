<?php
session_start();
if (isset($_SESSION['id'])) {
    include "./include/koneksi.php";

    // Cek jika bulan dipilih
    if (isset($_GET['bulan'])) {
        $bulan = $_GET['bulan'];
    } else {
        die("Bulan tidak ditentukan.");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuntungan Bulanan - Amanah Laundry</title>

    <style>
    @media print {
        .no-print {
            display: none;
        }
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <h2>Laporan Keuntungan Bulanan</h2>
        <p>Bulan: <?php echo htmlspecialchars($bulan); ?></p>

        <?php
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
        <table>
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
                    <td><?php echo htmlspecialchars($row['No_Order']); ?></td>
                    <td><?php echo htmlspecialchars($row['Tgl_Terima']); ?></td>
                    <td><?php echo htmlspecialchars($row['Nama']); ?></td>
                    <td><?php echo 'Rp ' . number_format($row['Total_Bayar'], 0, ',', '.'); ?></td>
                </tr>
                <?php
                    }
                    ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" style="text-align: right;">Total Pendapatan:</th>
                    <th><?php echo 'Rp ' . number_format($totalPendapatan, 0, ',', '.'); ?></th>
                </tr>
            </tfoot>
        </table>
        <?php
        } else {
            echo "<p>Tidak ada data untuk bulan yang dipilih.</p>";
        }
        ?>
    </div>
</body>

</html>

<?php
} else {
    header("location:login/index.php");
}
?>