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
                    <input type="text" name="nama" id="nama-field" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="email-field" class="pb-2">Email</label>
                    <input type="email" class="form-control" name="email" id="email-field" required>
                </div>
                <div class="col-md-6">
                    <label for="telepon-field" class="pb-2">Nomor Telepon</label>
                    <input type="text" class="form-control" name="telepon" id="telepon-field" required>
                </div>
                <div class="col-md-6">
                    <label for="alamat-field" class="pb-2">Alamat Penjemputan</label>
                    <input type="text" class="form-control" name="alamat" id="alamat-field" required>
                </div>
                <div class="col-md-12">
                    <label for="layanan-field" class="pb-2">Layanan</label>
                    <select class="form-control" name="layanan" id="layanan-field" required>
                        <option value="Cuci Kering">Cuci Kering</option>
                        <option value="Cuci Setrika">Cuci Setrika</option>
                        <option value="Cuci Satuan">Cuci Satuan</option>
                        <option value="Antar Jemput">Antar Jemput</option>
                    </select>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>