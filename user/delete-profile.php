<?php
session_start();
require_once '../helper/connection.php';

// Pastikan data terkirim dengan benar
if (isset($_SESSION['login']['id'])) {
    $idUser = $_SESSION['login']['id'];
    $timestamp = date('Y-m-d H:i:s');

    mysqli_begin_transaction($connection);

    $queryUpdate = "UPDATE users SET deleted_at = '$timestamp' WHERE id = '$idUser'";
    $resultUpdate = mysqli_query($connection, $queryUpdate);

    // Cek apakah operasi berhasil
    if ($resultUpdate) {
        // Commit transaksi jika berhasil
        mysqli_commit($connection);
        // Redirect ke halaman logout setelah profil dihapus
        header("Location: ../auth/logout.php");
        exit(); // Penting untuk menghentikan eksekusi skrip setelah melakukan redirect
    } else {
        // Rollback transaksi jika operasi gagal
        mysqli_rollback($connection);
        echo "Gagal menghapus profil: " . mysqli_error($connection);
    }
} else {
    echo "Data tidak lengkap.";
}
?>
