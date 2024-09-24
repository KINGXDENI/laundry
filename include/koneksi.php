<?php
require '../vendor/autoload.php'; // Sesuaikan jalur jika perlu

// Mengatur jalur ke file .env
$dotenvPath = __DIR__ . '/../.env';
if (file_exists($dotenvPath)) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Jalur ke folder yang tepat
    $dotenv->load();

    // Ambil nilai dari variabel lingkungan
    $server = getenv('DB_SERVER');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    $database = getenv('DB_DATABASE');
} else {
    // Jika .env tidak ada, gunakan nilai default
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "laundry";
}

// Koneksi ke database
$conn = mysqli_connect($server, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi berhasil";
