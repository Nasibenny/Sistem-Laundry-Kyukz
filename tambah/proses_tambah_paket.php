<?php
include "../koneksi.php";

$id_outlet = $_POST['id_outlet'];
$jenis = $_POST['jenis'];
$nama_paket = $_POST['nama_paket'];
$harga = $_POST['harga'];



$hasil = mysqli_query($koneksi, "INSERT INTO tb_paket VALUES(NULL,'$id_outlet','$jenis','$nama_paket','$harga')");

if(!$hasil){
    echo "Gagal Memasukkan Data Paket" . mysqli_error($koneksi);
}else{
     
    // echo "<script>location.href='view_obat.php'</script>"; 
    header('Location:../dashboard.php?page=paket');
    exit;
}


?>