<?php
include "../koneksi.php";

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jk = $_POST['jenis_kelamin'];
$tlp = $_POST['tlp'];


$hasil = mysqli_query($koneksi, "INSERT INTO tb_member VALUES(NULL,'$nama','$alamat','$jk','$tlp')");

if(!$hasil){
    echo "Gagal Memasukkan Data Obat" . mysqli_error($koneksi);
}else{
     
    // echo "<script>location.href='view_obat.php'</script>"; 
    header('Location:../dashboard.php?page=member');
    exit;
}


?>