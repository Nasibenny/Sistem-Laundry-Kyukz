<!doctype html>
<?php
include 'koneksi.php';
session_start();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaundryPesisir | laundry</title>
    <!-- SweetAlert  -->
     <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.26/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.26/dist/sweetalert2.min.js"></script>
    
    <!-- Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Offline -->
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="./img/island_wht.svg">
    
    <!-- Asset -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="./style./style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   
    <link rel="stylesheet" href="./style/style.css">
  </head>
  <body>
    <div class="wrapper"> 
    <!-- Navbar -->
    <aside id="sidebar" class="py-2 " >
    
        <div class="d-flex">
          <button id="toggle-btn" type="button">
                <img class="" src="./img/laundry-wht.png" style="width:52px" alt="">

          </button>
    <!-- Logo -->
          <div class="sidebar-logo">
              <!-- <a href="#">LaundryPesisir</a> -->
          </div>
        </div>
    <!-- Logo -->
        <ul class="sidebar-nav "  id="sidebar-active" >
          <li class="sidebar-item ">
              <a href="dashboard.php?page=dashboard" class="sidebar-link  ">
                  <i class="lni lni-home"></i>
                  <span>Home</span>
              </a>
          </li>
    <!-- Menu Admin  -->
        <?php
            if($_SESSION['role']=='admin'){
        ?> 
          <li class="sidebar-item">
              <a href="#" class="sidebar-link has-dropdown collapsed dropdown-toggle"  data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                  <i class="lni lni-package"></i>
                  <span>Data Master</span>
              </a>

              <ul id="auth" class="sidebar-dropdown list-unstyled collapse"  data-bs-parent="#sidebar ">
                <li class="sidebar-item">
                   <a class="sidebar-link" href="dashboard.php?page=paket">Paket</a>
                </li>
                <li class="sidebar-item">
                   <a class="sidebar-link" href="dashboard.php?page=outlet">Outlet</a>
                </li>
              </ul>
          </li>

            <li class="sidebar-item">
              <a href="dashboard.php?page=member" class="sidebar-link"  >
                   <i class="lni lni-users"></i>
                  <span>Registrasi Pelanggan</span>
              </a>
          </li>
          <li class="sidebar-item">
              <a href="dashboard.php?page=tambah_transaksi" class="sidebar-link "  >
                  <i class="lni lni-dollar"></i>
                  <span>Entri transaksi</span>
              </a>
          </li>
         
          <li class="sidebar-item">
              <a href="dashboard.php?page=laporan" class="sidebar-link "  >
                  <i class="lni lni-remove-file"></i>
                  <span>Laporan</span>
              </a>
          </li>
       <!--Akhir Menu-->
       <!-- Menu Kasir -->
        <?php
        }elseif(@$_SESSION['role']=='kasir'){
        ?>   
         <li class="sidebar-item">
              <a href="dashboard.php?page=member" class="sidebar-link"  >
                   <i class="lni lni-users"></i>
                  <span>Registrasi Pelanggan</span>
              </a>
          </li>
          <li class="sidebar-item">
              <a href="dashboard.php?page=tambah_transaksi" class="sidebar-link "  >
                  <i class="lni lni-dollar"></i>
                  <span>Entri transaksi</span>
              </a>
          </li>
          <li class="sidebar-item">
              <a href="dashboard.php?page=laporan" class="sidebar-link "  >
                  <i class="lni lni-remove-file"></i>
                  <span>Laporan</span>
              </a>
          </li>
        <!--Akhir Kasir-->
        <!-- Menu Owner -->
        <?php
        }else{
        ?>
         <li class="sidebar-item">
              <a href="dashboard.php?page=laporan" class="sidebar-link "  >
                  <i class="lni lni-remove-file"></i>
                  <span>Laporan</span>
              </a>
          </li>
        <?php
          }
        ?>
        </ul>
        <div class="sidebar-footer">
            <a href="logout.php" class="sidebar-link">
              <i class="lni lni-exit"></i>
              <span>Logout</span>
            </a>
        </div>
        
      </aside>
    
      <div class="main ">
          <!-- Navbar Atas  -->
          <nav class=" navbar navbar-expand px-5 py-3 ">          
                  <ul class="navbar-nav ms-auto ">
                      <li class="">
                          <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">
                            
                              <img src="./img/user.png" class="avatar img-fluid" alt="">
                              
                          </a>
                      </li>
                      <li class="text-center ">
                        <?php
                        // $tampil = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT role FROM tb_user WHERE id_user=' $_SESSION[role]' "));
                        ?>
            

                        <h6 class="fw-bold text-capitalize "><?= $_SESSION['username'] ?></h6> <h6 class="text-capitalize"><?= $_SESSION['role'] ?></h6>
                      </li>
                  </ul>
             
          </nav>
          <!-- Navbar Atas  -->
     
          <!-- Content Dashboard  -->
          <main class="content px-3 py-4 ">
           
           
              <div class="container">
             
                       
                <?php
                //laundry_beni/dashboard.php?page=(nama page)
                switch(@$_GET['page']){
                case "dashboard":
                    include_once 'view/view_home.php';
                break;
                case "outlet":
                    include_once 'view/view_outlet.php';
                break;
                case "tambah_outlet":
                    include_once 'tambah/tambah_outlet.php';
                break;
                case "edit_outlet":
                    include_once 'edit/edit_outlet.php';
                break;
                case "delete_outlet":
                    include_once 'tambah/delete_outlet.php';
                break;
                //CASE  MEMBER
                case"member";
                include_once 'view/view_member.php';
                break;
                case "tambah_member":
                include_once 'tambah/tambah_member.php';
                break;
                case"edit_member";
                include_once 'edit/edit_member.php';
                break;
                //CASE PAKET
                case"paket";
                include_once 'view/view_paket.php';
                break;
                case"tambah_paket";
                include_once 'tambah/tambah_paket.php';
                break;
                case"edit_paket";
                include_once 'edit/edit_paket.php';
                break;
                //CASE TRANSAKSI
                case"tambah_transaksi";
                include_once 'tambah/tambah_transaksi.php';
                break;
                case"detail_transaksi";
                include_once 'tambah/detail_transaksi.php';
                break;
                //CASE LAPORAN
                case"laporan";
                include_once 'view/view_laporan.php';
                break;
               
                }
               
                ?>
              </div>
          </main>
          <!-- Footer -->
          
      </div>
    </div>


   <script src="./js/script.js"></script>             
   <!-- Online -->           
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <!-- Offline -->
   <script src="./bootstrap/js/bootstrap.min.js"></script>  
    <!--ICON LINK-->
   <script src="https://kit.fontawesome.com/f143f4fbae.js" crossorigin="anonymous"></script>
   
  </body>
</html>