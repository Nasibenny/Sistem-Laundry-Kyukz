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
    $query_outlet = mysqli_query($koneksi, "SELECT * FROM tb_outlet WHERE id_outlet='$id'");
    $baris_outlet = mysqli_fetch_assoc($query_outlet);
?>
<center><br>
    <h1>EDIT OUTLET</h1>
    <br>

    <form action="edit/proses_edit_outlet.php" method="POST">
        <input type="text" hidden name="id_outlet" value="<?=$id?>">
        <table cellpadding="10">
            <tr>
                <td>Nama Outlet</td>
                <td><input type="text" name="nama" value="<?=$baris_outlet['nama'];?>"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?=$baris_outlet['alamat'];?>"></td>
            </tr>
            <tr>
                <td>No telephone</td>
                <td><input type="text" name="tlp" value="<?=$baris_outlet['tlp'];?>"></td>
            </tr>
            
                <td></td>
                <td><input type="submit" style="float:right;  padding:20px;" value="Save"></td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>