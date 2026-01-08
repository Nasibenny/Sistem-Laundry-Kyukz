<div class="container d-flex justify-content-between">
    <h4 class="my-4">Data Outlet</h4>
    <a class="btn btn-success my-4" href="dashboard.php?page=tambah_outlet">
        + Tambah Outlet
    </a>
</div>

<div class="container">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Outlet</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM tb_outlet");
        while($baris = mysqli_fetch_assoc($data)){
            // Cek apakah member memiliki transaksi yang terkait
            $id_outlet = $baris['id_outlet'];
            $cek_outlet = mysqli_query($koneksi, "SELECT * FROM tb_paket WHERE id_outlet = '$id_outlet'");
            $berisi_paket = mysqli_num_rows($cek_outlet);
     
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $baris['nama'] ?></td>
                <td><?= $baris['alamat'] ?></td>
                <td><?= $baris['tlp'] ?></td>
                <td>
                    <a class="btn btn-warning btn-sm" href="dashboard.php?page=edit_outlet&id=<?= $baris['id_outlet'] ?> ">
                        Edit
                    </a>
                     <?php if ($berisi_paket == 0) { ?>
                                    <a class="btn btn-danger btn-sm" href="./delete/delete_outlet.php?id_outlet=<?=$baris['id_outlet']?>">Delete</a>
                                <?php } else { ?>
                                    <button class="btn btn-danger btn-sm" disabled>Delete</button>
                     <?php } ?>

                   
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>