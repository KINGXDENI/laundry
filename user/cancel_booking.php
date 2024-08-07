<?php
session_start();
include "../include/koneksi.php";

// Pastikan user sudah login
if (!isset($_SESSION['email'])) {
    // Redirect ke halaman login jika belum login
    header('Location: login.php');
    exit();
}

// Mendapatkan data dari permintaan AJAX
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_booking'])) {
    $id_booking = $data['id_booking'];

    // Mengubah status booking menjadi "Dibatalkan"
    $sql = $conn->prepare("UPDATE bookings SET status = 'Dibatalkan' WHERE id_booking = ?");
    $sql->bind_param("i", $id_booking);

    if ($sql->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $sql->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID booking tidak ditemukan.']);
}

$conn->close();
