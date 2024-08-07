<?php
session_start();
include "../include/koneksi.php";

// Pastikan user sudah login
if (!isset($_SESSION['email'])) {
    // Redirect ke halaman login jika belum login
    header('Location: login.php');
    exit();
}

$email_user = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <?php
            $sql = $conn->prepare("SELECT * FROM bookings WHERE email_pelanggan = ? ORDER BY id_booking");
            $sql->bind_param("s", $email_user);
            $sql->execute();
            $result = $sql->get_result();

            while ($hasil = $result->fetch_assoc()) {
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <th>No Booking</th>
                                    <td> :</td>
                                    <th><?php echo $hasil['no_booking']; ?></th>
                                </tr>
                                <tr>
                                    <td>Nama Pelanggan</td>
                                    <td> :</td>
                                    <td><?php echo $hasil['nama_pelanggan']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email Pelanggan</td>
                                    <td> :</td>
                                    <td><?php echo $hasil['email_pelanggan']; ?></td>
                                </tr>
                                <tr>
                                    <td>No Telpon</td>
                                    <td> :</td>
                                    <td><?php echo $hasil['email_pelanggan']; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td> :</td>
                                    <td><?php echo $hasil['alamat_penjemputan']; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td> :</td>
                                    <td><?php echo $hasil['jenis_layanan']; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td> :</td>
                                    <td><?php echo $hasil['tanggal_booking']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            <?php
            }
            $sql->close();
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>