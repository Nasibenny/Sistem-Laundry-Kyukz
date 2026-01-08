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
                    $data = mysqli_query($koneksi, "SELECT * FROM tb_member"); 
                    while($baris = mysqli_fetch_assoc($data)){
                        // Cek apakah member memiliki transaksi yang terkait
                        $id_member = $baris['id_member'];
                        $cek_transaksi = mysqli_query($koneksi, "SELECT * FROM tb_transaksi WHERE id_member = '$id_member'");
                        $transaksi_terkait = mysqli_num_rows($cek_transaksi);
                    ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$baris['nama']?></td>
                            <td><?=$baris['alamat']?></td>
                            <td><?=$baris['jenis_kelamin']?></td>
                            <td><?=$baris['tlp']?></td>
                            <td>
                                <a class="btn btn-warning" href="dashboard.php?page=edit_member&id=<?=$baris['id_member']?>">Edit</a>
                                <?php if ($transaksi_terkait == 0) { ?>
                                    <a class="btn btn-danger" href="./delete/delete_member.php?id_member=<?=$baris['id_member']?>">Delete</a>
                                <?php } else { ?>
                                    <button class="btn btn-danger" disabled>Delete</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php }
                    ?>
        </tbody>
    </table>
</div>

</table>
</body>