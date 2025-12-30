<center><br>
    <h1>TAMBAH MEMBER</h1>
    <br>

    <form action="tambah/proses_tambah_member.php" method="POST">
        <table cellpadding="10">
            <tr>
                <td>Nama Member</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat"></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><select name="jenis_kelamin"  >
                
                    <option disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki Laki</option>
                    <option value="Perempuan">Perempuan</option>
                    </select>
                </td>
            </tr>
           <tr>
                <td>No Telephone</td>
                <td><input type="text" name="tlp"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="btn btn-success" style="float:right" value="Simpan Data Member"></td>
            </tr>
        </table>
    </form>
</center>