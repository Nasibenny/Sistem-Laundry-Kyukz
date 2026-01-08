<?php
include '../koneksi.php';

$id = $_POST['id_outlet'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$tlp = $_POST['tlp'];


$hasil = mysqli_query($koneksi, "UPDATE tb_outlet SET nama='$nama',alamat='$alamat',tlp='$tlp' WHERE id_outlet='$id'");

if(!$hasil){
    echo mysqli_error($koneksi);
}else{
    // echo "<script>location.href='view_obat.php'</script>"; 
    header('Location:../dashboard.php?page=outlet');
    exit;
}


?>