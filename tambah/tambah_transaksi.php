<center><br>
    <h1>TAMBAH TRANSAKSI</h1>
     <?php  
    
            if(@$_POST['selanjutnya']){
                $id_outlet = $_SESSION['id_outlet'];
                
                @$kode_invoice_terakhir = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT kode_invoice FROM tb_transaksi ORDER BY id_transaksi DESC LIMIT 1"));
                if(!$kode_invoice_terakhir){
                    $kode_invoice = "INV/".date("Y/m/d")."/1";
                }else{
                    $pecah_string = explode("/", $kode_invoice_terakhir['kode_invoice']);
                    $bulan_sebelum = $pecah_string[2];
                    $bulan_saat_ini = date('m');
                    if($bulan_saat_ini != $bulan_sebelum) {
                        $number_urut = 1;
                    }else{
                        $number_urut = $pecah_string[4];
                        $number_urut++;
                    }
                    $kode_invoice = "INV/".date("Y/m/d")."/".$number_urut;            
                
                }

                $nama_member = $_POST['nama_member'];
                $cari_id_member = mysqli_fetch_assoc( mysqli_query($koneksi,"SELECT id_member FROM tb_member WHERE nama= '$nama_member' "));
                $id_member = $cari_id_member['id_member'];

                //Tanggal & batas waktu
                date_default_timezone_set('Asia/Makassar');
                $tanggal = date("Y-m-d H:i:s");
                $batas_waktu = date("Y-m-d H:i:s" , strtotime($tanggal . " +3days"));
        
                
               
                

                $dibayar = @$_POST['dibayar'];
                if($dibayar == 'dibayar'){
                    $tgl_bayar = $tanggal;
                }else{
                    $tgl_bayar = NULL;
                }
                
                if(@$_POST['biaya_tambahan']){
                    $biaya_tambahan = $_POST['biaya_tambahan'];
                }else{
                    $biaya_tambahan = 0;

                }

                $cari_transaksi = mysqli_num_rows(mysqli_query($koneksi,"SELECT id_member FROM tb_transaksi WHERE id_member='$id_member'"));
                if($cari_transaksi % 3 == 0 && $cari_transaksi != 0){
                    $diskon = 0.1;
                }else{
                    $diskon = 0;
                }
                $pajak = 0.0075;
                $status = "baru";

                $id_user = $_SESSION['id_user'];

                $dibayar = "belum_dibayar";

                $hasil = mysqli_query($koneksi,"INSERT INTO tb_transaksi VALUES(NULL,'$id_outlet','$kode_invoice','$id_member','$tanggal','$batas_waktu',NULL,'$biaya_tambahan','$diskon','$pajak','$status','$dibayar','$id_user')");
                $id_transaksi = mysqli_fetch_row(mysqli_query($koneksi,"SELECT LAST_INSERT_ID()"));
                $_SESSION['idtransaksi'] = $id_transaksi[0];
                if(!$hasil){
                    echo"Gagal Tambah Data Transaksi : ". mysqli_error($koneksi);
                }else{
                ?>
                <script>
                     window.location.href = 'dashboard.php?page=detail_transaksi';
                </script>
                <?php
                 
                    // header('Location:dashboard.php?page=detail_transaksi.php');
                
                    exit;
                }
               
            }
        
            ?>
               
    <br>

    <form action="dashboard.php?page=tambah_transaksi" method="POST">
        <table >
            <tr>
                <!-- <td>id Transaksi</td> -->
                <td>
                      <input hidden type="number" name="biaya_tambahan" autocomplate="off" placeholder="Biaya Tambahan" >
                     <div class="input-group mb-3 ">
                        <input type="text" class="form-control px-5" list="nama_pelanggan" name="nama_member" autocomplate="off" placeholder="Cari Nama Pelanggan">
                    </div>

                    <datalist id="nama_pelanggan">
                        <?php
                     
                        $query = mysqli_query($koneksi,"SELECT nama FROM tb_member");
                        while($data_pelanggan = mysqli_fetch_assoc($query)){

                        ?>
                        <option value="<?=$data_pelanggan['nama']?>"></option>
                        <?php
                        }
                        
                        ?>
                    </datalist>
                    
                    
                    
                </td>
                
            </tr>
           <tr>
                <td>
                    <input type="submit" class="btn btn-primary w-100"  name="selanjutnya" value="Selanjutnya">
                </td>
           </tr>
        </table>
    </form>
</center>