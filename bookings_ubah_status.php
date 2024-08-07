<?php
session_start();
include "./include/koneksi.php";

// Pastikan admin sudah login
if (!isset($_SESSION['id'])) {
    // Redirect ke halaman login jika belum login
    header('Location: login/index.php');
    exit();
}

// Proses perubahan status booking
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_booking = $_POST['id_booking'];
    $status = $_POST['status'];

    $sql = "UPDATE bookings SET status = ? WHERE id_booking = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $status, $id_booking);

    if ($stmt->execute()) {
        header("Location: bookings.php?status=success");
    } else {
        header("Location: bookings.php?status=failed");
    }

    $stmt->close();
}
