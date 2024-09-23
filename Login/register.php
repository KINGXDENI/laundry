<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Mazer Admin Dashboard</title>

    <link rel="shortcut icon" href="../assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/compiled/css/app.css">
    <link rel="stylesheet" href="../assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../assets/compiled/css/auth.css">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<style>
    .auth-logo img {
        max-width: 80% !important;
        height: auto !important;
        display: block !important;
        margin: 0 auto 20px !important;
    }
</style>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <img src="../asset/img/logo/logo2.png" alt="Logo">
                    </div>
                    <h1 class="auth-title">Sign Up</h1>

                    <?php
                    include "../include/koneksi.php";

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $email = $_POST['email'];
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $confirm_password = $_POST['confirm_password'];
                        $level = 'user'; // Default level user

                        // Validasi input
                        $errors = [];
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $errors[] = 'Format email tidak valid.';
                        }
                        if (trim($username) == '') {
                            $errors[] = 'Username harus diisi.';
                        }
                        if (trim($password) == '') {
                            $errors[] = 'Password harus diisi.';
                        }
                        if ($password !== $confirm_password) {
                            $errors[] = 'Password dan konfirmasi password tidak cocok.';
                        }

                        // Cek apakah email sudah ada di database
                        $email_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
                        $result = mysqli_query($conn, $email_check_query);
                        if (mysqli_num_rows($result) > 0) {
                            $errors[] = 'Email sudah terdaftar.';
                        }

                        // Jika ada error, tampilkan pesan error
                        if (!empty($errors)) {
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                            echo '<script>
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error",
                                        html: "' . implode('<br>', $errors) . '",
                                        confirmButtonText: "Kembali"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "register.php";
                                        }
                                    });
                                  </script>';
                        } else {
                            // Hash password dengan MD5
                            $hashed_password = md5($password);

                            // Insert data ke database
                            $sql = "INSERT INTO user (email, user_name, password, level) VALUES ('$email', '$username', '$hashed_password', '$level')";
                            if (mysqli_query($conn, $sql)) {
                                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                                echo '<script>
                                        Swal.fire({
                                            icon: "success",
                                            title: "Registrasi Berhasil",
                                            text: "Silahkan login sekarang.",
                                            confirmButtonText: "OK"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = "index.php";
                                            }
                                        });
                                      </script>';
                            } else {
                                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                                echo '<script>
                                        Swal.fire({
                                            icon: "error",
                                            title: "Registrasi Gagal",
                                            text: "' . mysqli_error($conn) . '",
                                            confirmButtonText: "Kembali"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = "register.php";
                                            }
                                        });
                                      </script>';
                            }
                        }
                    }
                    ?>

                    <form action="" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="email" class="form-control form-control-xl" placeholder="Email"
                                required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="username" class="form-control form-control-xl"
                                placeholder="Username" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl"
                                placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="confirm_password" class="form-control form-control-xl"
                                placeholder="Confirm Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Sudah punya akun? <a href="index.php" class="font-bold">Log
                                in</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>