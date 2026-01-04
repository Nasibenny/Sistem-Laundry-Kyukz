<?php
if(@$_GET['status'] == 'baru'){
    $status = "WHERE status='baru'";
}elseif(@$_GET['status'] == 'proses'){
    $status = "WHERE status='proses'";
}elseif(@$_GET['status'] == 'selesai'){
    $status = "WHERE status='selesai'";
}elseif(@$_GET['status'] == 'diambil'){
    $status = "WHERE status='diambil'";
}else{
    $status = "";
}

if(@$_SESSION['role'] == 'admin' OR @$_SESSION['role'] == 'owner'){
    // $query = mysqli_query($koneksi, "SELECT *, tb_outlet.id_outlet AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id_transaksi AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi
    // INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id_transaksi
    // INNER JOIN tb_member ON tb_transaksi. id_member=tb_member.id_member
    // INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket
    // INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id_outlet
    // INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id_user $status GROUP BY kode_invoice");

     $query = mysqli_query($koneksi, "
        SELECT 
            tb_transaksi.*,
            tb_outlet.nama AS nama_outlet,
            tb_member.nama AS nama_member
        FROM tb_transaksi
        INNER JOIN tb_member 
            ON tb_transaksi.id_member = tb_member.id_member
        INNER JOIN tb_outlet 
            ON tb_transaksi.id_outlet = tb_outlet.id_outlet
        INNER JOIN tb_user 
            ON tb_transaksi.id_user = tb_user.id_user
        $status
        ORDER BY tb_transaksi.id_transaksi DESC
    ");
    

}else{
    // $id_outlet = $_SESSION['id_outlet'];
    // if($status != ""){
    // $outlet = "AND tb_outlet.id_outlet='$id_outlet'";
    // } else{
    // $outlet = "WHERE tb_outlet.id_outlet='$id_outlet'";    
    // }
    // $query = mysqli_query($koneksi, "SELECT *, tb_outlet.id_outlet AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id_transaksi AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi
    // INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id_transaksi
    // INNER JOIN tb_member ON tb_transaksi. id_member=tb_member.id_member
    // INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket
    // INNER JOIN tb_outlet ON tb_transaksi. id_outlet=tb_outlet.id_outlet
    // INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id_user $status $outlet GROUP BY kode_invoice");

    $id_outlet = $_SESSION['id_outlet'];

    if($status != ""){
        $outlet = "AND tb_transaksi.id_outlet='$id_outlet'";
    }else{
        $outlet = "WHERE tb_transaksi.id_outlet='$id_outlet'";
    }

    $query = mysqli_query($koneksi, "
        SELECT 
            tb_transaksi.*,
            tb_outlet.nama AS nama_outlet,
            tb_member.nama AS nama_member
        FROM tb_transaksi
        INNER JOIN tb_member 
            ON tb_transaksi.id_member = tb_member.id_member
        INNER JOIN tb_outlet 
            ON tb_transaksi.id_outlet = tb_outlet.id_outlet
        INNER JOIN tb_user 
            ON tb_transaksi.id_user = tb_user.id_user
        $status
        $outlet
        ORDER BY tb_transaksi.id_transaksi DESC
    ");


}

?>

<div class="container">
    <div class="justify-content-center">
        <br>
        <form class="mt-2" action="cetak/cetak_laporan.php" target="_blank" method="POST">
            <div class="row">
                <div class="col">
                    <label for="masukkan_tgl_awal" class="form-label px-3">Tanggal Awal</label>
                    <input type="date" class="form-control" id="masukkan_tgl_awal" name="masukkan_tgl_awal" required>
                </div>
                <div class="col">
                    <label for="masukkan_tgl_akhir" class="form-label px-3">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="masukkan_tgl_akhir" name="masukkan_tgl_akhir" required>
                </div>
            </div>
            <div class="row mt-3 justify-content-end">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary" name="tombol_cetak_laporan">Generate Laporan</button>
                </div>
            </div>
        </form>
        </br>
        <br>
        
        <table border="1" class="table" cellspacing="0">
            <!-- Judul Kolom -->
            <thead>
                <tr>
                    <th>Kode Invoice</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Paket</th>
                    <th>
                        <select name="pilih_status" onchange="pilihStatus1(this.options[this.selectedIndex].value)">
                            <option value="semua ">
                                Semua Status 
                            </option>
                            <option value="baru" <?php if(@$_GET['status']=='baru' ){echo "selected";}?>>
                                Baru
                            </option>
                            <option value="proses" <?php if(@$_GET['status']=='proses' ){echo "selected";}?>>
                                Proses
                            </option>
                            <option value="selesai" <?php if(@$_GET['status']=='selesai' ){echo "selected";}?>>
                                Selesai
                            </option>
                            <option value="diambil" <?php if(@$_GET['status']=='diambil' ) {echo "selected";}?>>
                                Diambil
                            </option>
                        </select>
                        <script>
                        function pilihStatus1(value) {
                            window.location.href = 'dashboard.php?page=laporan&status=' + value;
                        }
                        
                        </script>
                    </th>
                </tr>
            </thead>
            <!-- judul kolom -->

            <tbody>
                <?php
            while($baris = mysqli_fetch_assoc($query) ){
            if(@$_SESSION['role'] == 'admin' OR @$_SESSION['role'] == 'owner'){
            ?>
                <tr>
                    <td align="left">Nama Outlet : <b> <?= $baris['nama_outlet']?></b></td>
                </tr>
                <?php
            }
            ?>



                <tr>
                    <td align="left">
                        <?php
                    $pecah_string_tanggal = explode(" ", $baris['batas_waktu']);
                    $pecah_string_hari = explode("-", $pecah_string_tanggal['0']);
                    $pecah_string_jam = explode(":", $pecah_string_tanggal['1']);

                    echo "Batas Pengambilan : ".$pecah_string_hari['2']."-".$pecah_string_hari['1']."-".$pecah_string_hari['0'];
                    echo "<br>";
                    echo "Jam : ".$pecah_string_jam['0'].":".$pecah_string_jam['1'];
                    echo "<br><br>";

                    echo "<b>".$baris['kode_invoice']."<b>";
                    ?>
                    </td>




                    <td class="fw-bold fst-italic"> <?=$baris['nama_member']?></td>




                    <td align="left">
                        <?php
                    $id_transaksi = $baris['id_transaksi'];
                    $query_paket = mysqli_query($koneksi, "SELECT nama_paket, qty FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi='$id_transaksi'");
                    while($data_paket = mysqli_fetch_assoc($query_paket)){
                    echo $data_paket['nama_paket'];
                    echo "<br>";
                    }

                    echo "<br>";

                    $grand_total = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi='$id_transaksi'"));
                    $pajak = $grand_total['0'] * $baris['pajak'];
                    $diskon = $grand_total['0'] * $baris['diskon'];
                    $total_keseluruhan = ($grand_total['0']+$baris['biaya_tambahan']+$pajak)-$diskon;
                    echo "Total Harga : <b>Rp.".number_format($total_keseluruhan, 0, ',', '.')."</b>";
                    ?>
                    </td>



                    <td>
                        <select onchange="pilihStatus2(this.options[this.selectedIndex].value, <?= $baris['id_transaksi'] ?>)">
                            <option value="baru" <?php if($baris['status']=='baru') {echo "selected" ;}?>>
                                Baru
                            </option>
                            <option value="proses" <?php if ($baris['status']=='proses'){echo "selected" ;}?>>
                                Proses
                            </option>
                            <option value="selesai" <?php if ($baris['status']=='selesai'){echo "selected" ;}?>>
                                Selesai
                            </option>
                            <option value="diambil" <?php if($baris['status']=='diambil'){echo "selected" ;}?>>
                                Diambil
                            </option>
                        </select>
                        <script>
                   
                     function pilihStatus2(value, id) {
                        // Menyimpan status yang dipilih dan ID transaksi
    var currentStatus = new URLSearchParams(window.location.search).get('status');
    
    // Buat URL yang akan digunakan untuk mengubah status item tertentu
    var url = 'edit/proses_edit_status_laporan.php?status=' + value + '&id=' + id + '&currentStatus=' + currentStatus;

    // Arahkan ke URL tersebut untuk mengupdate status item tanpa mengubah filter di table head
    window.location.href = url;
                    }
                        </script>

                        <?php
                    if($baris['dibayar'] == 'belum_dibayar'){
                        $warna = "#ffbc00"; //kuning
                    }else{
                        $warna = "#60dd60"; //hijau
                    }
                    ?>
                        <br>
                        <a style="color : <?=$warna?>"
                            href="dashboard.php?page=detail_transaksi&idtransaksi=<?=$baris['id_transaksi']?>">Lihat
                            Detail</a>
                    </td>

                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>





