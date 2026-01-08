<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
 
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM tb_member WHERE id_member='$id'");
    $baris = mysqli_fetch_assoc($query);
?>
<center><br>
    <h1>EDIT MEMBER</h1>
    <br>

    <form action="edit/proses_edit_member.php" method="POST">
        <input type="text" hidden name="id_member" value="<?=$id?>">
        <table cellpadding="10">
            <tr>
                <td>Nama Pelanggan</td>
                <td><input type="text" name="nama" value="<?=$baris['nama'];?>"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?=$baris['alamat'];?>"></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
            <select name="jenis_kelamin"  aria-label="Default select example" required>
                <option value="<?=$baris['jenis_kelamin'];?>" ><?=$baris['jenis_kelamin'] ; 'selected' ?> </option>
                <option value="Laki-Laki" <?= ($baris['jenis_kelamin'] == 'Laki-Laki') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="perempuan" <?= ($baris['jenis_kelamin'] == 'perempuan') ? 'selected' : '' ?>>Perempuan</option>   
            </select>
                
                
                </td>
            </tr>
            <tr>
                <td>No telephone</td>
                <td><input type="text" name="tlp" value="<?=$baris['tlp'];?>"></td>
            </tr>
            <tr>
            
                <td></td>
                <td><input type="submit" style="float:right;  padding:20px;" value="Save"></td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>