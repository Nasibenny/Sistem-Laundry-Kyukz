<?php
// echo "FILE TERPANGGIL";
// exit;

include "../koneksi.php";
require_once __DIR__ . '/../config/wablas.php';


// Ambil data dari URL
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$status = mysqli_real_escape_string($koneksi, $_GET['status']);
$currentStatus = mysqli_real_escape_string($koneksi, $_GET['currentStatus']);

// Validasi status
$status_valid = ['baru', 'proses', 'selesai', 'diambil'];
if (!in_array($status, $status_valid)) {
    die("Status tidak valid");
}

// Update status
$update = mysqli_query($koneksi, "
    UPDATE tb_transaksi 
    SET status='$status' 
    WHERE id_transaksi='$id'
");

if ($update && trim($status) === 'selesai') {

    $q = mysqli_query($koneksi, "
        SELECT 
            t.kode_invoice,
            m.nama,
            m.tlp,
            o.nama
        FROM tb_transaksi t
        LEFT JOIN tb_member m ON t.id_member = m.id_member
        LEFT JOIN tb_outlet o ON t.id_outlet = o.id_outlet
        WHERE t.id_transaksi='$id'
    ");

    if(mysqli_num_rows($q) > 0){
        
        $d = mysqli_fetch_assoc($q);

        if(!empty($d['tlp'])){
            $no_wa = preg_replace('/[^0-9]/', '', $d['tlp']);
            if(substr($no_wa,0,1)=='0'){
                $no_wa = '62'.substr($no_wa,1);
            }

            $pesan = "Halo {$d['nama']} 👋
Laundry invoice *{$d['kode_invoice']}* telah *SELESAI* ✅
Silakan diambil di outlet {$d['nama']}";    

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => WABLAS_URL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode([
                    'phone' => $no_wa,
                    'message' => $pesan
                ]),
                CURLOPT_HTTPHEADER => [
                    'Authorization: ' . WABLAS_API_KEY,
                    'Content-Type: application/json'
                ],
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
        }
    }
}

// Redirect kembali
header("Location: ../dashboard.php?page=laporan&status=$currentStatus");
exit;
