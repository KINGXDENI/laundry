<?php
session_start();
include "../include/koneksi.php";

if (isset($_POST['id_booking'])) {
    $id_booking = $_POST['id_booking'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $email_pelanggan = $_POST['email_pelanggan'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat_penjemputan = $_POST['alamat_penjemputan'];
    $jenis_layanan = $_POST['jenis_layanan'];

    // Update data booking
    $sql = "UPDATE bookings SET 
            nama_pelanggan='$nama_pelanggan',
            email_pelanggan='$email_pelanggan',
            nomor_telepon='$nomor_telepon',
            alamat_penjemputan='$alamat_penjemputan',
            jenis_layanan='$jenis_layanan'
            WHERE id_booking='$id_booking'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = 'Data booking berhasil diupdate!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Gagal mengupdate data booking: ' . $conn->error;
        $_SESSION['message_type'] = 'error';
    }

    header('Location: booking_tampil.php');
    exit();
} else {
    $_SESSION['message'] = 'Data booking tidak valid!';
    $_SESSION['message_type'] = 'error';
    header('Location: booking_tampil.php');
    exit();
}
