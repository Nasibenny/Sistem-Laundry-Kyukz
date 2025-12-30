<center>
<div class="container">
    <br>
    <h1>TAMBAH PAKET</h1>
    <br>
    <?php
    if(@$_POST['selanjutnya']){
    ?>
    <form action="tambah/proses_tambah_paket.php" method="post">
        <input type="text" hidden name="id_outlet" value="<?=$_POST['id_outlet'];?>">
        
        <select  class="form-select mb-3" aria-label="Default select example" name="jenis" id="">
            <option selected>Silahkan Pilih</option>
            <option value="kiloan">Kiloan</option>
            <option value="selimut">Selimut</option>
            <option value="bed_cover">Bed Cover</option>
            <option value="kaos">Kaos</option>
            <option value="lain">Lain</option>
        </select>
        <div class="input-group mb-3">
            <input type="text" name="nama_paket" class="form-control" placeholder="Nama Paket" aria-label="Username" aria-describedby="basic-addon1">
         </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
            <input type="text" name="harga" class="form-control" placeholder="Harga" aria-label="Username" aria-describedby="basic-addon1">
         </div>
        
         <button type="submit" class="btn btn-success">Simpan</button>
    </form>

    <?php
         }else{
    ?>
      <form action="dashboard.php?page=tambah_paket" method="POST">
      
        <select class="form-select mb-3" aria-label="Default select example"  name="id_outlet" id="">
          <?php
          $query = mysqli_query($koneksi, "SELECT id_outlet , nama FROM tb_outlet");
          while($baris = mysqli_fetch_assoc($query)){
          ?>
          <option value="<?=$baris['id_outlet']?>"><?=$baris['nama']?></option>
         <?php
          }
        ?>
        </select>
       
      
       <input type="submit" class="btn btn-success" name="selanjutnya" value="Selanjutnya">
    </form>
    <?php
         }
    ?>
</div>
</center>