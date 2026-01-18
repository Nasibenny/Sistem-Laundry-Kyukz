<?php
include "../koneksi.php";
include "../config/wablas.php";

$id     = $_GET['id'];
$status = $_GET['status'];

// UPDATE STATUS
$update = mysqli_query($koneksi, "UPDATE tb_transaksi SET status='$status' WHERE id_transaksi='$id'");

if (!$update) {
    die("Gagal update status: " . mysqli_error($koneksi));
}

// JIKA STATUS SELESAI → KIRIM WA
if ($status === 'selesai') {

    $q = mysqli_query($koneksi, "
        SELECT 
            tb_transaksi.kode_invoice,
            tb_member.nama,
            tb_member.tlp,
            tb_outlet.nama AS nama_outlet
        FROM tb_transaksi
        JOIN tb_member ON tb_transaksi.id_member = tb_member.id_member
        JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id_outlet
        WHERE tb_transaksi.id_transaksi = '$id'
    ");

    if (mysqli_num_rows($q) == 0) {
        die("Data member tidak ditemukan");
    }

    $data = mysqli_fetch_assoc($q);

    // NORMALISASI NOMOR
    $no_wa = preg_replace('/[^0-9]/', '', $data['tlp']);    
    if (substr($no_wa, 0, 1) === '0') {
        $no_wa = '62' . substr($no_wa, 1);
    }

    if (strlen($no_wa) < 10) {
        die("Nomor WA tidak valid");
    }

    $pesan = "Halo {$data['nama']} 👋

Laundry Anda dengan invoice *{$data['kode_invoice']}* telah *SELESAI* ✅

Silakan diambil di outlet:
{$data['nama_outlet']}

Terima kasih 🙏";

    // KIRIM KE WABLAS
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => WABLAS_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode([
            'phone'   => $no_wa,
            'message' => $pesan
        ]),
        CURLOPT_HTTPHEADER => [
            'Authorization: ' . WABLAS_API_KEY,
            'Content-Type: application/json'
        ],
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        die("Curl Error: " . curl_error($curl));
    }

    curl_close($curl);

    // OPTIONAL LOG
    // file_put_contents('wablas.log', $response.PHP_EOL, FILE_APPEND);
}

// REDIRECT TERAKHIR
header("Location: ../dashboard.php?page=detail_transaksi&idtransaksi=$id");
exit;
