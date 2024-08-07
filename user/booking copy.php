<?php
session_start();
// Pastikan user sudah login
if (!isset($_SESSION['email'])) {
    // Redirect ke halaman login jika belum login
    header('Location: login.php');
    exit();
}

include "include/koneksi.php";

// Ambil nomor booking terakhir
$result = $conn->query("SELECT no_booking FROM bookings ORDER BY id_booking DESC LIMIT 1");
$last_booking_no = "BK-000";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_booking_no = $row['no_booking'];
}

// Ekstrak angka dari nomor booking terakhir dan tambahkan 1
$last_number = (int)substr($last_booking_no, 3);
$new_number = $last_number + 1;

// Format nomor booking baru
$new_booking_no = "BK-" . str_pad($new_number, 3, '0', STR_PAD_LEFT);

$email_user = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Layanan Antar Jemput</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="text-center">Booking Layanan Antar Jemput</h2>
        <form action="booking_proses.php" method="POST" class="php-email-form">
            <div class="row gy-4">
                <div class="col-md-6">
                    <label for="nama-field" class="pb-2">Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" id="nama-field" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="email-field" class="pb-2">Email</label>
                    <input type="email" class="form-control" name="email_pelanggan" id="email-field" value="<?php echo htmlspecialchars($email_user); ?>" required readonly>
                </div>
                <div class="col-md-6">
                    <label for="telepon-field" class="pb-2">Nomor Telepon</label>
                    <input type="text" class="form-control" name="nomor_telepon" id="telepon-field" required>
                </div>
                <div class="col-md-6">
                    <label for="alamat-field" class="pb-2">Alamat Penjemputan</label>
                    <input type="text" class="form-control" name="alamat_penjemputan" id="alamat-field" required>
                </div>
                <div class="col-md-12">
                    <label for="layanan-field" class="pb-2">Layanan</label>
                    <select class="form-control" name="jenis_layanan" id="layanan-field" required>
                        <option value="Cuci Kering">Cuci Kering</option>
                        <option value="Cuci Setrika">Cuci Setrika</option>
                        <option value="Cuci Satuan">Cuci Satuan</option>
                        <option value="Antar Jemput">Antar Jemput</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="booking-field" class="pb-2">Nomor Booking</label>
                    <input type="text" class="form-control" name="no_booking" id="booking-field" value="<?php echo $new_booking_no; ?>" required readonly>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>