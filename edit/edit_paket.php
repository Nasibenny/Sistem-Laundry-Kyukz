<?php
$id = $_GET['id'];
$query_paket = mysqli_query($koneksi, "SELECT * FROM tb_paket INNER JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id_outlet WHERE id_paket='$id'");
$baris_paket = mysqli_fetch_assoc($query_paket);
?>
<center><br>
    <h1>EDIT PAKET</h1>
    <br>
    <div class="col-5">
        <form action="edit/proses_edit_paket.php" method="post">
            <input clss="text-center" type="text" name="id_paket" value="<?=$id?>" hidden>
            <div class="input-group flex-nowrap mb-3">
                <input type="text" class="form-control" readonly aria-describedby="addon-wrapping" name="nama_outlet"
                    value="<?= $baris_paket['nama']?>">
            </div>
            <select name="jenis" class="form-select mb-3" aria-label="Default select example" required>
                <option value="Kiloan" <?= ($baris_paket['jenis'] == 'Kiloan') ? 'selected' : '' ?>>Kiloan</option>
                <option value="Selimut" <?= ($baris_paket['jenis'] == 'Selimut') ? 'selected' : '' ?>>Selimut</option>
                <option value="Bed_Cover" <?= ($baris_paket['jenis'] == 'Bed Cover') ? 'selected' : '' ?>>Bed cover
                </option>
                <option value="Kaos" <?= ($baris_paket['jenis'] == 'Kaos') ? 'selected' : '' ?>>Kaos</option>
                <option value="Lain" <?= ($baris_paket['jenis'] == 'Lain') ? 'selected' : '' ?>>Lain</option>
            </select>
            <div class="input-group flex-nowrap mb-3">
                <input type="text" class="form-control" aria-describedby="addon-wrapping" name="nama_paket"
                    value="<?=$baris_paket['nama_paket']?>" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Rp.</span>
                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                    name="harga" value="<?=$baris_paket['harga']?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</center>