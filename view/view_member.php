<body>
  <div class="container d-flex  justify-content-between">
    
      <a class="btn btn-success my-4" href="dashboard.php?page=tambah_member">+ Tambah</a>
     
  </div>


<div class="container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                
                <th>No </th>
                <th>Nama </th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>No telepon</th>
               
                <th colspan="2">AKSI</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM tb_member ");  //ASCENDING  DESCENDING
        while($baris = mysqli_fetch_assoc($data)){
            // var_dump($baris);
        ?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$baris['nama']?></td>
                <td><?=$baris['alamat']?></td>
                <td><?=$baris['jenis_kelamin']?></td>
                <td><?=$baris['tlp']?></td>
                
                <td>
                    <a class="btn btn-warning" href="dashboard.php?page=edit_member&id=<?=$baris['id_member']?>">Edit</a>
                    <a class="btn btn-danger" href="./delete/delete_outlet.php?id_outlet=<?=$baris['id_member']?>">Delete</a>
                </td>

            </tr>
        <?php        }
        ?>
        </tbody>
    </table>
</div>

</table>
</body>