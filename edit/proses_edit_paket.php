<?php
include "../koneksi.php";


$id_paket = $_POST['id_paket'];
$jenis = $_POST['jenis'];
$nama_paket = $_POST['nama_paket'];
$harga = $_POST['harga'];
$query = mysqli_query($koneksi, "UPDATE tb_paket SET id_paket='$id_paket',jenis='$jenis',nama_paket='$nama_paket',harga='$harga'  WHERE id_paket='$id_paket'");



if (!$query) {
      
        echo "Gagal Mengedit Data Paket: " . mysqli_error($koneksi);
    } else {

        header('Location:../dashboard.php?page=paket'); 
    exit;
}

?>
