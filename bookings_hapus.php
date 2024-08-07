<?php
session_start();
include "include/koneksi.php";

// Pastikan user sudah login
if (!isset($_SESSION['id'])) {
    header("location:login/index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_booking = $_POST['id_booking'];

    // Hapus data dari database
    $sql = "DELETE FROM bookings WHERE id_booking = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_booking);

    if ($stmt->execute()) {
        header("Location: bookings.php?status=success");
    } else {
        header("Location: bookings.php?status=error");
    }

    $stmt->close();
}
