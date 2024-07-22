<?php

include "include/koneksi.php";

$Id_Pakaian = $_GET['hapus'];

$query = "DELETE FROM pakaian WHERE Id_Pakaian='" . $Id_Pakaian . "'";

if ($sql) {
  echo '<meta http-equiv="refresh" content="0; url=pakaian.php">';
} else {
  echo "<script language='javascript'>alert('Gagal di Hapus');</script>";
  echo '<meta http-equiv="refresh" content="0; url=pakaian.php">';
}
