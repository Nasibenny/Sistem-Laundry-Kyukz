<?php
include "../koneksi.php";

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$tlp = $_POST['tlp'];


$hasil = mysqli_query($koneksi, "INSERT INTO tb_outlet VALUES(NULL,'$nama','$alamat','$tlp')");

if(!$hasil){
    echo "Gagal Memasukkan Data Obat" . mysqli_error($koneksi);
}else{
     
    // echo "<script>location.href='view_obat.php'</script>"; 
    header('Location:../dashboard.php?page=outlet');
    exit;
}


?>