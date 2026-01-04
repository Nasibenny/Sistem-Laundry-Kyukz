<?php
include "../koneksi.php";

$nama           = $_POST['nama'];
$username       = $_POST['username'];
$password       = $_POST['password'];
$password_hash  = password_hash($password,PASSWORD_DEFAULT);
$id_outlet      = $_POST['id_outlet'];
$role           = $_POST['role'];

$query_username = mysqli_query($koneksi, "SELECT username FROM tb_user WHERE username='$username'");

$cek = mysqli_num_rows($query_username);

if($cek != 0){
    echo "
        <script>
            alert('username sudah ada, silahkan masukkan username yang lain');
            window.location.href='register.php';
        </script>
    ";
}else{
    $hasil = mysqli_query($koneksi, "INSERT INTO tb_user VALUES(NULL,'$nama','$username','$password_hash','$id_outlet','$role')");
    
    if(!$hasil){
        $message = "Gagal Memasukan User"; 
        echo "<script type='text/javascript'>alert('$message');   window.location.href='../index.php'; </script>"  ;
        
    }else{
        header('Location:../index.php');
        exit;
    } 
}





?>