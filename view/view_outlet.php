<div class="container d-flex justify-content-between">
    <h4 class="my-4">Data Outlet</h4>
    <a class="btn btn-success my-4" href="index.php?page=tambah_outlet">
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
        while ($row = mysqli_fetch_assoc($data)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['tlp'] ?></td>
                <td>
                    <a class="btn btn-warning btn-sm"
                       href="index.php?page=edit_outlet&id=<?= $row['id_outlet'] ?>">
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm"
                       href="delete/delete_outlet.php?id=<?= $row['id_outlet'] ?>"
                       onclick="return confirm('Yakin ingin menghapus data outlet ini?')">
                        Hapus
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>