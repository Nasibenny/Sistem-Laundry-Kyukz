<?php
    include_once "../koneksi.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
 
    <link rel="icon" type="image/png" href="../img/island_wht.svg">
</head>
  
  <style>
    body{
      margin:0px;
      padding:0px;
      background-color:#F5F5F5;
      
      font-family: 'Poppins', sans-serif;
    }
  </style>
<body >

<div class="container  min-vh-100 d-flex flex-column justify-content-center align-items-center p-3 ">
      <div class="text-center mb-4">
        <img class="mb-2" src="../img/laundry.png" style="width:200px" alt="">
         <!-- <i class="lni lni-island"></i> -->
      </div>

  <div class=" ">

    <form action="proses_register_enkripsi.php" method="post">
  <div class="row g-2">
     <div class="col-md">
          <div class="form-floating mb-4 ">  
              <input type="name" name="nama" class="form-control px-5 " id="floatinginput">
              <label class="text-secondary" for="floatingInput">Full name</label>
          </div>
     </div>
      <div class="col-md">
          <div class="form-floating mb-4 ">  
              <input type="name" name="username" class="form-control px-5 " id="floatinginput">
              <label class="text-secondary" for="floatingInput">Username</label>
          </div>
     </div>
  </div>
     

      <div class="  form-floating mb-4"> 
        <input type="password" name="password" class="form-control px-5" id="floatingpassword"  >
        <label  class="text-secondary" for="floatingpassword">Password</label>
      </div>

      <div class="  form-floating mb-4">
        <select class="form-select" name="id_outlet" aria-label="Default select example">
             <option selected>Open this select menu</option>
            <?php                               
                 $query = mysqli_query($koneksi, "SELECT * FROM tb_outlet");
                 while($hasil = mysqli_fetch_assoc($query)){
             ?>
                
                <option value="<?=$hasil['id_outlet'];?>"><?=$hasil['nama'];?></option>
            <?php
                }
             ?>
        </select>
      </div>
     <div class="  form-floating mb-4"> 
       <select class="form-select" name="role" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="admin">ADMIN</option>
            <option value="kasir">KASIR</option>
            <option value="owner">OWNER</option>
       </select>
      </div>

         <button type="submit" class="btn btn-primary w-100 py-2 fs-6">Register</button>
         
     </form>
      
  </div>
   
  

 

        
   
</div>

</body>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>