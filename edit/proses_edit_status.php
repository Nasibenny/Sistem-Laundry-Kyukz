<?php
include "../koneksi.php";


$id = $_GET['id'];
$status = $_GET['status'];

$query = mysqli_query($koneksi, "UPDATE tb_transaksi SET status='$status' WHERE id_transaksi='$id'");



if (!$query) {
      
        echo "Gagal Mengedit Laporan: " . mysqli_error($koneksi);
    } else {

       echo"<script>window.location.href='../dashboard.php?page=detail_transaksi'</script>";
    exit;
}

?>
