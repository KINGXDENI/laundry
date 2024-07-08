	<?php
	include "include/koneksi.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$No_Order = $_POST["No_Order"];
		$No_Identitas = $_POST["No_Identitas"];
		$id_layanan = $_POST["id_layanan"];
		$total_berat = $_POST["total_berat"];
		$diskon = isset($_POST["diskon"]) ? $_POST["diskon"] : null;
		$total_bayar = $_POST["total_bayar"];
		$Tgl_Terima = $_POST["tanggal"];
		$harga_per_kg = $_POST["harga_per_kg"];

		// Pastikan semua data yang diperlukan tidak kosong
		if (empty($No_Order) || empty($No_Identitas) || empty($id_layanan) || empty($total_berat) || empty($total_bayar) || empty($Tgl_Terima)) {
			// Pesan error jika ada data yang kosong
			echo "<script language='javascript'>alert('Semua data harus diisi!');</script>";
			echo '<meta http-equiv="refresh" content="0; url=tambahdatatransaksi.php">';
		} else {
			// Query INSERT ke dalam tabel transaksi
			// Gunakan mysqli_real_escape_string atau parameterized query untuk menghindari SQL Injection
			$diskon = mysqli_real_escape_string($conn, $diskon);
			$sql = "INSERT INTO `transaksi` (`No_Order`, `No_Identitas`, `id_layanan`, `Tgl_Terima`, `Tgl_Ambil`, `total_berat`, `diskon`, `Total_Bayar`)
					VALUES ('$No_Order', '$No_Identitas', '$id_layanan', '$Tgl_Terima', NULL, '$total_berat', '$diskon', '$total_bayar')";

			$kueri = mysqli_query($conn, $sql);

			// Periksa apakah query INSERT berhasil atau tidak
			if ($kueri) {
				echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
				echo '<meta http-equiv="refresh" content="0; url=transaksi.php">';
			} else {
				echo "Error: " . mysqli_error($conn); // Tampilkan pesan error dari MySQL
			}
		}
	}
