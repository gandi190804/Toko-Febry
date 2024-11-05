<?php
session_start();
require_once '../helper/connection.php';

// Pastikan data terkirim dengan benar
if (isset($_SESSION['loginUser']['id'])) {
    $idUser = $_SESSION['loginUser']['id'];
    $timestamp = date('Y-m-d H:i:s');

    mysqli_begin_transaction($connection);

    $queryUpdate = "UPDATE viewers SET deleted_at = '$timestamp' WHERE id = '$idUser'";
    $resultUpdate = mysqli_query($connection, $queryUpdate);

    // Cek apakah operasi berhasil
    if ($resultUpdate) {
        // Commit transaksi jika berhasil
        mysqli_commit($connection);
        header("Location: ../authUser/logout.php");
        exit(); 
    } else {
        // Rollback transaksi jika operasi gagal
        mysqli_rollback($connection);
        echo "Gagal menghapus profil: " . mysqli_error($connection);
    }
} else {
    echo "Data tidak lengkap.";
}
?>
