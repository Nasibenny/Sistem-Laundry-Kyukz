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
  
     // Menyimpan session login sukses
    $_SESSION['login_success'] = "Berhasil login!";
    header('Location: dashboard.php?page=dashboard'); // Redirect ke dashboard
}else{
    $_SESSION['login_error'] = "Gagal login!";
    header('Location: index.php'); // Kembali ke halaman login

}

?>