<?php
include "../koneksi.php";


$id = $_GET['id_outlet'];
$query = mysqli_query($koneksi, "DELETE FROM tb_outlet WHERE id_outlet='$id'");
if(!$query){
    echo "😡 Gagal Menghapus Data Obat " . mysqli_error($koneksi);
}else{
    header('Location:../dashboard.php?page=outlet');
    exit;
}

?>