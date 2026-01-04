<?php
include "../koneksi.php";
session_start();
$tgl_awal = $_POST['masukkan_tgl_awal'];
$tgl_akhir = $_POST['masukkan_tgl_akhir'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan</title>
    <link rel="icon" type="image/png" href="../img/island_wht.svg">
    <style>
            .outlet {
            background-color: yellow;
            /* warna element nama outlet menjadi warna kuning */
            }
            @media print {
            .outlet {
            background-color: yellow !important;
            -webkit-print-color-adjust: exact;
            /* ketika print maka warna yang ada di web juga ikut di print */
            }
            }
    </style>
</head>
<body>
</body>
    <h2 class="align-center">Laporan Transaksi Laundry</h2>
    <h3>Periode : <?= $tgl_awal." sampai ".$tgl_akhir; ?></h3>
    <!-- Algoritma pencari nama paket sering dipilih-->
    <?php
    if(@$_SESSION['role']=="admin" OR @$_SESSION['role']=="owner"){
        $nama_paket = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT nama_paket, COUNT(nama_paket) AS jumlah_penggunaan 
        FROM tb_transaksi INNER JOIN tb_detail_transaksi ON tb_transaksi.id_transaksi = tb_detail_transaksi.id_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id_paket
        WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' 
        GROUP BY nama_paket
        ORDER BY jumlah_penggunaan DESC"));
    }else{
        $id_outlet = $_SESSION['id_outlet'];
        $nama_paket = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT nama_paket, COUNT(nama_paket) AS jumlah_penggunaan FROM tb_transaksi INNER JOIN tb_detail_transaksi ON tb_transaksi.id_transaksi = tb_detail_transaksi.id_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id_paket INNER JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id_outlet ON tb_transaksi.id_outlet = tb_outlet.id_outlet WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id_outlet='$id_outlet''
        GROUP BY nama_paket
        ORDER BY jumlah_penggunaan DESC"));
    }
    echo "Paket yang sering dipilih pelanggan : <b>".$nama_paket['nama_paket']."</b>";
    ?>
    <!-- Algoritma pencari nama paket sering dipilih-->

    <hr style="width:100%" , size=3, color=black><!--garis itam--></hr>

    <?php
    if(@$_SESSION['role']=='admin' OR @$_SESSION['role']=='owner'){
        $query_outlet = mysqli_query($koneksi,"SELECT tb_outlet.id_outlet AS id_outlet, tb_outlet.nama AS nama_outlet FROM tb_detail_transaksi
        INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id_transaksi
        INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id_outlet WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' GROUP BY tb_outlet.id_outlet ");
    }else{
         $id_outlet = $_SESSION['id_outlet'];
        $query_outlet = mysqli_query($koneksi,"SELECT tb_outlet.id_outlet AS id_outlet, tb_outlet.nama AS nama_outlet FROM tb_detail_transaksi
        INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id_transaksi
        INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id_outlet WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id_outlet = '$id_outlet' GROUP BY tb_outlet.id_outlet ");
    }
    ?>

    <center>
        <table border="1" cellpadding="10" cellspacing="0">
            <?php
                $total_semua = 0;
                while ($baris_outlet = mysqli_fetch_assoc($query_outlet)) {
                    if(@$_SESSION['role']=='admin' OR @$_SESSION['role']=='owner'){
                        $id_outlet = $baris_outlet['id_outlet'];
                        $query = mysqli_query($koneksi, "
    SELECT 
        tb_transaksi.*, 
        tb_outlet.id_outlet AS id_outlet_tb_outlet, 
        tb_outlet.nama AS nama_outlet, 
        tb_transaksi.id_transaksi AS id_transaksi, 
        tb_member.nama AS nama_member
    FROM tb_detail_transaksi
    INNER JOIN tb_transaksi 
        ON tb_detail_transaksi.id_transaksi = tb_transaksi.id_transaksi
    INNER JOIN tb_member 
        ON tb_transaksi.id_member = tb_member.id_member
    INNER JOIN tb_paket 
        ON tb_detail_transaksi.id_paket = tb_paket.id_paket
    INNER JOIN tb_outlet 
        ON tb_transaksi.id_outlet = tb_outlet.id_outlet
    INNER JOIN tb_user 
        ON tb_transaksi.id_user = tb_user.id_user
    WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' 
    AND dibayar='dibayar' 
    AND tb_outlet.id_outlet = '$id_outlet'
    GROUP BY tb_transaksi.id_transaksi, tb_outlet.id_outlet, tb_member.id_member, tb_user.id_user, tb_paket.id_paket
");
                    }else{
                        $id_outlet = $baris_outlet['id_outlet'];
                        $query = mysqli_query($koneksi,"SELECT *, tb_outlet.id_outlet AS id_outlet_tb_outlet, tb_outlet.nama AS nama_outlet, tb_transaksi.id_transaksi AS id_transaksi, tb_member.nama AS nama_member FROM tb_detail_transaksi
                        INNER JOIN tb_transaksi ON tb_detail_transaksi.id_transaksi=tb_transaksi.id_transaksi
                        INNER JOIN tb_member ON tb_transaksi.id_member=tb_member.id_member
                        INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket
                        INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.id_outlet
                        INNER JOIN tb_user ON tb_transaksi.id_user=tb_user.id_user WHERE tgl BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' AND dibayar='dibayar' AND tb_outlet.id_outlet = '$id_outlet' GROUP BY kode_invoice ");
                    }
                
            ?>
            <tr>
                <td align="left" class="outlet" colspan="3">Nama Outlet :
                    <b><?=$baris_outlet['nama_outlet']?></b>
                </td>
            </tr>
            <?php
            $no = 1;
            while($baris = mysqli_fetch_assoc($query)){

            
            ?>
            <tr>
                <td><?=$no++?></td>
                <td><?="Pelanggan: ".$baris['nama_member']?></td>
                <td align="left">
                    <?php
                        $id_transaksi = $baris['id_transaksi'];
                        $query_paket = mysqli_query($koneksi, "SELECT nama_paket, qty FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi='$id_transaksi'");
                        while($data_paket = mysqli_fetch_assoc($query_paket)){
                            echo $data_paket['nama_paket'];
                            echo"<br>";
                        }
                    ?>
                </td>
                <td>
                    <?php
                    $grand_total = mysqli_fetch_row(mysqli_query($koneksi, "SELECT SUM(total_harga) FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi='$id_transaksi'"));
                    $pajak = $grand_total['0'] * $baris['pajak'];
                    $diskon = $grand_total['0'] * $baris['diskon'];
                    $total_keseluruhan = ($grand_total['0']+$baris['biaya_tambahan']+$pajak)-$diskon; 
                    $tampil_total = number_format($total_keseluruhan, 0,',','.');
                    echo "Total Harga : <b>Rp ".$tampil_total."</b>";
                    $total_semua += (int)$tampil_total;
                    ?>
                </td>
            </tr>
            <?php
            }
        }
            ?>
            <tr align="right">
                <td colspan="3"><b>Total Pendapatan</b>
                    <br>
                    <?php echo "Dari tanggal : ".$tgl_awal." sampai ".$tgl_akhir ?>
                </td>
                <td>
                    <?php
                    echo "<h2>Rp ".number_format($total_semua, 3,'.','.')."</h2>";
                    $pajak_semua = $total_semua*0.0075;
                    echo "Pajak : Rp ".number_format($pajak_semua, 3, '.','.');
                    ?>
                </td>
            </tr>
        </table>
    <center>

    <script>
        window.print();//auto ngeprint
    </script>
</body>
</html>