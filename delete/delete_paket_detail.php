<?php
include "../koneksi.php";


$id = $_GET['id_detail'];
$query = mysqli_query($koneksi, "DELETE FROM tb_detail_transaksi WHERE id_detail='$id'");
if(!$query){
    echo "😡 Gagal Delete Detail " . mysqli_error($koneksi);
}else{
    header('Location:../dashboard.php?page=detail_transaksi');
    exit;
}

?>