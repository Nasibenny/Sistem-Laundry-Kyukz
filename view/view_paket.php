
<body>
  <div class="container d-flex  justify-content-between">
    
      <a class="btn btn-success my-4" href="dashboard.php?page=tambah_paket">Tambah</a>
     
  </div>


<div class="container">
    <table class="table table-striped table-hover text-center">
        <thead >
            <tr>
                <th>ID Paket</th>
                <th class="text-start">Nama Outlet</th>
                <th class="text-start">Jenis</th>
                <th class="text-start">Nama Paket</th>
                <th class="text-start">Harga</th>
               
                <th colspan="2">AKSI</th>
            </tr>
        </thead>
        <tbody>

        <?php
        
        $data = mysqli_query($koneksi, "SELECT tb_paket.id_paket AS  id_paket, tb_outlet.id_outlet AS id_outlet, nama, jenis,nama_paket,harga FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id_outlet ORDER BY tb_outlet.id_outlet ");  //ASCENDING  DESCENDING
        $last_outlet_id = null;
        $no = 1;
        while($baris = mysqli_fetch_assoc($data)){
            // var_dump($baris);
            if($last_outlet_id !== null && $last_outlet_id != $baris['id_outlet']){
            $no = 1;
        ?>
        <thead>
                <td colspan="7">&nbsp;</td>
        </thead>
          <thead >
            <tr>
                <th>ID Paket</th>
                <th class="text-start">Nama Outlet</th>
                <th class="text-start">Jenis</th>
                <th class="text-start">Nama Paket</th>
                <th class="text-start">Harga</th>
               
                <th colspan="2">AKSI</th>
            </tr>
        </thead>
            <?php
            }
            ?>
       
            <tr>
              
              
                <td><?=$no++?></td>
                <td class="text-start"><?=$baris['nama']?></td>
                <td class="text-capitalize text-start"><?=$baris['jenis']?></td>
                <td class="text-start"><?=$baris['nama_paket']?></td>
                <td class="text-start"><?=$baris['harga']?></td>
                <td>  <a class="btn btn-warning" href="dashboard.php?page=edit_paket&id=<?=$baris['id_paket']?>">Edit</a></td>
               
                <td>  
                    <?php
                    $id = $baris['id_paket'];
                    $hide_delete = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_paket INNER JOIN tb_detail_transaksi ON tb_paket.id_paket=tb_detail_transaksi.id_paket WHERE tb_paket.id_paket =$id "));
                    if($hide_delete[0]=='0'){
                    ?>          
                    <a class="btn btn-danger" onclick="return confirm('Apakah ingin menghapus data')" href="./delete/delete_paket.php?id_paket=<?=$baris['id_paket']?>">Delete</a>
                </td>

                    <?php
                    }else{?>
                      <button class="btn btn-danger" disabled>Delete</button>
                    <?php 
                    }
                    ?>
            </tr>
          
            
        <?php
             
        $last_outlet_id = $baris['id_outlet'];
            }
        ?>
        </tbody>
    </table>
</div>

</table>
<script>

</script>
</body>
