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
    if (trim($email) == '') {
        $errors[] = 'Email harus diisi.';
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
