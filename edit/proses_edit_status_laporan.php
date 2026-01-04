<?php
include "../koneksi.php";

// Ambil data dari URL
$id = mysqli_real_escape_string($koneksi, $_GET['id']); // ID transaksi
$status = mysqli_real_escape_string($koneksi, $_GET['status']); // Status baru
$currentStatus = mysqli_real_escape_string($koneksi, $_GET['currentStatus']); // Status filter saat ini

// Pastikan status valid
if (isset($status) && !empty($status) && in_array($status, ['baru', 'proses', 'selesai', 'diambil'])) {
    // Query untuk mengupdate status transaksi berdasarkan ID
    $query = mysqli_query($koneksi, "UPDATE tb_transaksi SET status='$status' WHERE id_transaksi='$id'");

    // Redirect kembali ke halaman laporan dengan status yang dipilih
    if ($query) {
        echo "<script>window.location.href='../dashboard.php?page=laporan&status=" . $currentStatus . "'</script>";
    } else {
        echo "Gagal memperbarui status transaksi!";
    }
} else {
    echo "Status tidak valid!";
}
?>
