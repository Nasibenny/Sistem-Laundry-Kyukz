<?php


if (@$_GET['idtransaksi']) {
    $idtransaksi = $_GET['idtransaksi'];
    $_SESSION['idtransaksi'] = $idtransaksi;
} elseif (@$_SESSION['idtransaksi']) {
    $idtransaksi = $_SESSION['idtransaksi'];
}

$data_transaksi = mysqli_fetch_row(mysqli_query($koneksi,"SELECT * FROM tb_transaksi 
INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id_member
INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id_outlet
INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id_user WHERE tb_transaksi.id_transaksi = '$idtransaksi' "));

if(@$_POST['pilih_paket']){
    $qty = $_POST['qty'];
    $nama_paket = $_POST['nama_paket'];
    $row_paket = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM tb_paket WHERE nama_paket='$nama_paket'"));
    $harga_paket = $row_paket['harga'];
    $total_harga = $qty * $harga_paket;
    $id_paket = $row_paket['id_paket'];
    $keterangan = $_POST['keterangan'];
    mysqli_query($koneksi,"INSERT INTO tb_detail_transaksi VALUES(NULL ,'$idtransaksi','$id_paket','$qty','$keterangan','$harga_paket','$total_harga' ) ");
    // header("Location: " . $_SERVER["REQUEST_URI"]);
    echo"<script>window.location.href=window.location.href</script>";

}if(@$_POST['bayar_sekarang']){
//update kolom tgl_bayar jika klik tombol bayar sekarang
 date_default_timezone_set('Asia/Makassar');
 $tgl_bayar = date("Y-m-d H:i:s");
 mysqli_query($koneksi, "UPDATE tb_transaksi SET tgl_bayar='$tgl_bayar' WHERE id_transaksi='$idtransaksi'");

//update kolom tgl_bayar ketika klik tombol bayar sekarang
  mysqli_query($koneksi, "UPDATE tb_transaksi SET dibayar='dibayar' WHERE id_transaksi='$idtransaksi'");
    // header("location: " . $_SERVER["PHP_SELF"]);
  echo"<script>window.location.href=window.location.href</script>";


}

if($data_transaksi['11']=='belum_dibayar'){
    $pembayaran = "Belum Bayar";
    $warna = "#ffbc00";

}else{
    $pembayaran = "Lunas";
    $warna = "#60dd60";
}

if(@$_POST['tombol_biaya_tambahan']){
    $biaya_tambahan = $_POST['biaya_tambahan'];
    mysqli_query($koneksi, "UPDATE tb_transaksi SET biaya_tambahan='$biaya_tambahan' WHERE id_transaksi='$idtransaksi'");
?>
<script>
    window.location.href =  <?= $_SERVER["REQUEST_URI"] ?>;
</script>
<?php  
    // header("Location: " . $_SERVER["REQUEST_URI"]);
}
?>
<div class="d-flex justify-content-evenly ">
    <!-- Info Chekoutnya -->
    <div class="">
                
                <!--Tabel Atas-->
                          
                   
                    <h1 class="text-center fw-bold"><?=$pembayaran?></h1>
                    <br>
                        <table cellpadding="15" style=" border : 10px solid <?= $warna ?>; ">
                        
                            <tr>
                                <td class="fw-bold">Kode Invoicsse</td>
                                <td><?=$data_transaksi['2'];?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Nama Pelanggan</td>
                                <td><?=$data_transaksi['14'];?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">No Telp</td>
                                <td><?=$data_transaksi['17'];?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Alamat Pelanggan</td>
                                <td><?=$data_transaksi['15'];?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Nama Kasir</td>
                                <td><?=$data_transaksi['23'];?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Ambil Sebelum</td>
                                <td>
                                    <?php
                                    $data_transaksi['5'];
                                    $pecah_string_tanggal = explode(" ", $data_transaksi['5']);
                                    $pecah_string_hari = explode("-", $pecah_string_tanggal['0']);
                                    $pecah_string_jam = explode(":", $pecah_string_tanggal['1']);
                                    
                                    echo "Tanggal : ".$pecah_string_hari['2']."-".$pecah_string_hari['1']."-".$pecah_string_hari['0'];
                                    echo "<br>";
                                    echo "Jam : ".$pecah_string_jam['0'].":".$pecah_string_jam['1'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Status</td>
                                <td>
                                    <select onchange="pilihStatus(this.options[this.selectedIndex].value, <?= $data_transaksi['0']?>)" >
                                            <option value="baru" <?php if($data_transaksi['10']=='baru'){echo"selected";} ?>>
                                                Baru
                                            </option>
                                            <option value="proses" <?php if($data_transaksi['10']=='proses'){echo"selected";} ?>>
                                                Proses
                                            </option>
                                            <option value="selesai" <?php if($data_transaksi['10']=='selesai'){echo"selected";} ?>>
                                                Selesai
                                            </option>
                                            <option value="diambil" <?php if($data_transaksi['10']=='diambil'){echo"selected";} ?>>
                                                Sudah Diambil
                                            </option>

                                    </select>
                                    <script>
                                        function pilihStatus(value, id){
                                            window.location.href = 'edit/proses_edit_status.php?status=' + value + '&id=' +
                                            id;
                                        } 
                                    </script>
                                </td>
                            </tr>
                            
                        </table>
                <!--Tabel Atas-->
                <br>
                <br>
    </div>
    <!-- Info Chekoutnya --> 

    <!-- Input & Table Cekout -->
    <div class="pt-5">
        
            <?php
            if($data_transaksi['11']=='belum_dibayar'){
            ?>
            <!-- Input Paket -->
            <form action="dashboard.php?page=detail_transaksi" method="POST">
                <table class="" border="0" cellspacing="0" style="width: 50%">
                 <br>   
                        <tr>
                            <td>Nama Paket</td>
                            <td>Quantity</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nama_paket" list="nama_paket" autocomplate="off" required >
                                <datalist id="nama_paket">  
                                    <?php
                                    echo $id_outlet=$data_transaksi['18'];
                                    $query_paket = mysqli_query($koneksi, "SELECT nama_paket FROM tb_paket WHERE id_outlet='$id_outlet' ");
                                    while($data_paket = mysqli_fetch_assoc($query_paket)){
                                
                                    ?> 
                                    <option value="<?=$data_paket ['nama_paket'] ?>"></option>
                                    <?php
                                    }
                                    ?>
                                </datalist>
                            
                                <td>
                                    <input type="number" name="qty" required>
                                </td>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="keterangan" autocomplate="off">

                            </td>
                            <td>
                                <input type="submit" class="btn btn-success" value="Massukan Paket" name="pilih_paket">
                            </td>
                        </tr>
                        
                        
                        
                </table>
            </form>
            <!-- Input Paket -->                             
            <?php
            }
            ?>

            
            <!-- tabel Paket  -->
            <div class="">
                    <table class="table" border="1" cellspacing="0" >
                        <thead>
                            <tr style="font-weight:700">
                                <td>Nama Paket</td>
                                <td align="right">Keterangan</td>
                                <td align="center">Qty</td>
                                <td>Harga</td>
                                <td align="right">Total Harga</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result_detail = mysqli_query($koneksi, "SELECT * FROM tb_detail_transaksi WHERE id_transaksi='$idtransaksi'");
                            while($detail = mysqli_fetch_assoc($result_detail)) {
                            ?>
                        </tbody>
                            <tr>
                                <td>
                                    <?php
                                        $idpaket = $detail['id_paket'];
                                        $paket = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_paket, jenis, harga FROM tb_paket WHERE id_paket='$idpaket'"));
                                        echo $paket['nama_paket'];
                                        echo'<br>';
                                        echo $paket['jenis'];
                                    ?>
                                </td>
                                <td align="right"><?=$detail['keterangan']?></td>
                                <td align="center"><?=$detail['qty']?></td>
                                <td><?=number_format($detail['harga_paket'],0, ',', '.')?></td>
                                <td align="right" style="font-weight:700">
                                    Rp.<?=number_format($detail['total_harga'],0,',','.')?></td>
                                </td>
                                <?php
                                if($data_transaksi['11']=='belum_dibayar'){
                                ?>
                                <form action="delete/delete_paket_detail.php" method="GET">
                                    <input type="text" name="id_detail" hidden value="<?=$detail['id_detail']?>">
                                    <td><button type="submit">delete</button>
                                    </td>
                                </form>

                                <?php
                            }
                                ?>
                            </tr>
                            <?php
                            }
                            ?>

                            <?php
                            $grand_total = mysqli_fetch_row(mysqli_query($koneksi," SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi='$idtransaksi'"));
                            if(!$grand_total['0']=='0'){
                            ?>
                            <tr>
                                <td colspan="4" style="font-weight:700">Pajak</td>
                                <td align="right" style="font-weight:700">
                                    <?php
                                    echo "0,75%";
                                    echo "<br>";
                                    $pajak = $grand_total[0] * 0.0075
                                    ;
                                    echo "Rp.".number_format($pajak, 0,',','.');
                                    ?>
                                </td>
                            </tr>

                        <?php
                            if($data_transaksi['7']!='0'){
                            ?>
                            <tr>
                                <td colspan="4" style="font-weight:700">Biaya Tamabahan</td>
                                <td align="right" style="font-weight:700">
                                    <?php
                                        echo "Rp.".number_format($data_transaksi['7'], 0,',','.');
                                    ?>
                                </td>
                            </tr>

                            <?php
                            }
                            if($data_transaksi['8']!='0'){
                            ?>
                            <tr>
                                <td colspan="4" style="font-weight:700">Diskon</td>
                                <td align="right" style="font-weight:700">
                                    <?php
                                    echo "10%";
                                    echo "<br>";
                                    $diskon = $grand_total['0'] * $data_transaksi['8'];
                                    echo "Rp.".number_format($diskon,0,',','.');
                                    ?>
                                </td>
                            </tr>

                            <?php
                            }else{
                                $diskon = 0;
                            }
                            ?>
                            <tr>
                                <td colspan="4" style="font-weight:700">Total Keseluruhan</td>
                                <td align="right" style="font-weight:700">
                                    <?php
                                        $total_keseluruhan = ($grand_total[0]+$data_transaksi['7']+$pajak)-$diskon;
                                        echo "Rp.".number_format($total_keseluruhan,0,',','.');
                                    ?>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>
                                <!-- Bayar Sekarang  -->
                                        <form action="dashboard.php?page=detail_transaksi" method="POST">
                                            <table>
                                                <tr >
                                                    <td>
                                                        <input type="submit" <?php if($data_transaksi['11']=='dibayar') echo"hidden"; ?> class="btn btn-success " value="Bayar Sekarang?" name="bayar_sekarang" onclick="return confirm('Ingin bayar Sekarang?')">
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                <!-- Bayar Sekarang  -->
                                </td>
                            </tr>
                            <?php
                            }

                            ?>
                            
                            </tbody>
                            </br>  
                    </table>   
            </div>
            <!-- tabel Paket  -->  

            <!-- biaya tambahan -->
            <div class="">
                <table class="" style="width: 50%">
                <tr >
            
                </tr>
                <tr>
                    <td>  
                        <!-- Biaya tambahan -->
                        <?php
                            if($data_transaksi['11']=='belum_dibayar'){
                            ?>
                            <form action="dashboard.php?page=detail_transaksi" method="POST">
                                <table>
                                    <tr>
                                        <td>
                                            <input type="number" placeholder="Biaya tambahan" name="biaya_tambahan"> 
                                                
                                        </td>
                                        <td><input type="submit" class="btn btn-success" value="Tambah Biaya" name="tombol_biaya_tambahan"></td>
                                    </tr>
                                </table>
                            </form>    
                            <?php
                            }
                            ?>
                            <!-- Biaya tambahan -->  
                    </td>   
                    <td>
                        
                    </td>
                </tr>
                <br>
                
                </table>
            </div>    
            <!-- biaya tambahan -->  
    </div>

    
</div>




 </center>