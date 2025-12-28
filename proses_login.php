<?php
include "koneksi.php";
session_start();
$username = $_POST['username'];
$password = $_POST['password'];


$query_login = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username'");
$data_user = mysqli_fetch_assoc($query_login);

$cek = password_verify($password, $data_user['password']);

if($cek > 0){
    $_SESSION['username'] = $username;
    $_SESSION['id_outlet'] = $data_user['id_outlet'] ;
    $_SESSION['id_user'] = $data_user['id_user'] ;
    $_SESSION['role'] = $data_user['role'];
    @$_SESSION['idtransaksi'];
    $_SESSION['id_outlet'] = $data_user['id_outlet'];
  
    echo "<script>alert('berhasil login');window.location.href='dashboard.php?page=dashboard'</script>";
}else{
    echo "<script>alert('gagal login');window.location.href='index.php'</script>";
}

?>