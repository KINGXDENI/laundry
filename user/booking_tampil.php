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
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Amanah Laundry</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="shortcut icon" href="../asset/img/svg/amanah_logo.svg" type="image/x-icon">
    <link href="../landing-page/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../landing-page/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../landing-page/assets/css/main.css" rel="stylesheet">
    <style>
    .card-header-custom {
        background-color: #3e4e6b;
        color: white;
    }

    .status-pending {
        color: chartreuse;
        font-weight: bold;
    }

    .status-confirmed {
        color: green;
        font-weight: bold;
    }

    .status-jemput {
        color: blue;
        font-weight: bold;
    }

    .status-proses {
        color: aqua;
        font-weight: bold;
    }

    .status-batal {
        color: red;
        font-weight: bold;
    }
    </style>
</head>

<body>

    <?php include "template/header.php" ?>

    <div class="container" style="margin-top: 150px;">
        <div class="row">
            <?php
            $sql = $conn->prepare("SELECT * FROM bookings WHERE email_pelanggan = ? ORDER BY id_booking");
            $sql->bind_param("s", $email_user);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                while ($hasil = $result->fetch_assoc()) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header card-header-custom">
                        <h5 class="card-title m-0">Booking No: <?php echo $hasil['no_booking']; ?></h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row">Nama Pelanggan</th>
                                    <td><?php echo $hasil['nama_pelanggan']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Email Pelanggan</th>
                                    <td><?php echo $hasil['email_pelanggan']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">No Telpon</th>
                                    <td><?php echo $hasil['nomor_telepon']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat Penjemputan</th>
                                    <td><?php echo $hasil['alamat_penjemputan']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Jenis Layanan</th>
                                    <td><?php echo $hasil['jenis_layanan']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Booking</th>
                                    <td><?php echo $hasil['tanggal_booking']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Status</th>
                                    <td>
                                        <?php
                                                $status_class = '';
                                                if ($hasil['status'] == 'Pending') {
                                                    $status_class = 'status-pending';
                                                } else if ($hasil['status'] == 'Selesai') {
                                                    $status_class = 'status-confirmed';
                                                } elseif ($hasil['status'] == 'Dijemput') {
                                                    $status_class = 'status-jemput';
                                                } elseif ($hasil['status'] == 'Diproses') {
                                                    $status_class = 'status-proses';
                                                } elseif ($hasil['status'] == 'Dibatalkan') {
                                                    $status_class = 'status-batal';
                                                }
                                                ?>
                                        <span
                                            class="<?php echo $status_class; ?>"><?php echo $hasil['status']; ?></span>
                                    </td>
                                </tr>
                                <?php if ($hasil['status'] == 'Pending') { ?>
                                <tr>
                                    <td colspan="2" class="text-right">
                                        <button class="btn btn-danger cancel-booking-btn"
                                            data-id="<?php echo $hasil['id_booking']; ?>">Batalkan</button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<div class='col-md-12 mb-3'><h2 class='text-center'>Anda belum ada riwayat transaksi.</h2></div>";
            }
            $sql->close();
            ?>
        </div>
    </div>

    <?php include "template/footer.php" ?>

    <!-- Vendor JS Files -->
    <script src="../landing-page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../landing-page/assets/vendor/aos/aos.js"></script>
    <script src="../landing-page/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../landing-page/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../landing-page/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../landing-page/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="../landing-page/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main JS File -->
    <script src="../landing-page/assets/js/main.js"></script>
    <script>
    document.querySelectorAll('.cancel-booking-btn').forEach(button => {
        button.addEventListener('click', function() {
            const bookingId = this.dataset.id;
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batalkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('cancel_booking.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id_booking: bookingId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Dibatalkan!',
                                    'Booking Anda telah dibatalkan.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Gagal membatalkan booking. Coba lagi nanti.',
                                    'error'
                                );
                            }
                        });
                }
            });
        });
    });
    </script>

</body>

</html>