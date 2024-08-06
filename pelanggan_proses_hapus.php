<?php
include "include/koneksi.php";

if (isset($_GET['hapus'])) {
    $No_Identitas = $_GET['hapus'];

    // Menggunakan prepared statements untuk keamanan tambahan
    $stmt = $conn->prepare("DELETE FROM pelanggan WHERE No_Identitas = ?");
    $stmt->bind_param("s", $No_Identitas);

    if ($stmt->execute()) {
        // Redirect setelah berhasil menghapus data
        header("Location: pelanggan.php");
        exit;
    } else {
        // Jika terjadi kesalahan saat menghapus data
        echo "<script>
                alert('Terjadi kesalahan saat menghapus data!');
                window.location.href = 'pelanggan.php';
              </script>";
    }

    $stmt->close();
} else {
    // Jika parameter hapus tidak ditemukan
    header("Location: pelanggan.php");
    exit;
}

$conn->close();