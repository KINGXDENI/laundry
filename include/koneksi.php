<?php
// $server = "localhost";
// $username = "root";
// $password = "";
// $database = "laundry";
$server = "uskkokws4w48444gw48c8048";
$username = "root";
$password = "jJrI3rG74rjvqIVrD56XSfM2T44DxZAuktMEHMlHLSezuuaqB60FbLQ8eJgfi0DN";
$database = "laundry";
// Koneksi ke database
$conn = mysqli_connect($server, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
