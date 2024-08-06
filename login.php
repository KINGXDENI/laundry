<?php
session_start();
include "include/koneksi.php";

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['pass'];

	// Menggunakan MD5 untuk hashing password
	$hashed_password = md5($password);

	// Cek login di tabel admin
	$sql_admin = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' AND pass='$hashed_password'");
	$num_admin = mysqli_num_rows($sql_admin);

	// Cek login di tabel user
	$sql_user = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' AND password='$hashed_password'");
	$num_user = mysqli_num_rows($sql_user);

	if ($num_admin > 0) {
		$num2_admin = mysqli_fetch_array($sql_admin);
		$_SESSION['id'] = $num2_admin['id'];
		$_SESSION['email'] = $email;
		$_SESSION['level'] = 'admin';
		echo '<meta http-equiv="refresh" content="0; url=index1.php">';
	} elseif ($num_user > 0) {
		$num2_user = mysqli_fetch_array($sql_user);
		$_SESSION['id'] = $num2_user['id_user'];
		$_SESSION['email'] = $email;
		$_SESSION['level'] = 'user';
		echo '<meta http-equiv="refresh" content="0; url=booking.php">';
	} else {
		echo "<script>alert('Email atau password salah')</script>";
		echo '<meta http-equiv="refresh" content="0; url=login/index.php">';
	}
}
