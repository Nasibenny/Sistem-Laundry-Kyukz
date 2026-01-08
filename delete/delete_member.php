<?php
include "../koneksi.php";


$id = $_GET['id_member'];
$query = mysqli_query($koneksi, " DELETE FROM tb_member WHERE id_member = '$id'");
if(!$query){
    echo "😡 Gagal Menghapus Data Member " . mysqli_error($koneksi);
}else{
    header('Location:../dashboard.php?page=member');
    exit;
}

?>