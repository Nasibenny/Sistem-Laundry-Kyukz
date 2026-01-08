<?php
include "../koneksi.php";


$id_member = $_POST['id_member'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tlp = $_POST['tlp'];
$query = mysqli_query($koneksi, "UPDATE tb_member SET id_member='$id_member',nama='$nama',alamat='$alamat',jenis_kelamin='$jenis_kelamin', tlp='$tlp'  WHERE id_member='$id_member'");



if (!$query) {
      
        echo "Gagal Mengedit Data Member: " . mysqli_error($koneksi);
    } else {

        header('Location:../dashboard.php?page=member'); 
    exit;
}

?>
