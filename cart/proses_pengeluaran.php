<?php
session_start();
require_once '../helper/connection.php';

// Pastikan data terkirim dengan benar
if (isset($_SESSION['login']['id'], $_POST['metodePembayaran'], $_POST['totalHarga'], $_POST['idCarts'])) {
    $idUser = $_SESSION['login']['id'];
    $pembayaran = $_POST['metodePembayaran'];
    $totalHarga = $_POST['totalHarga'];
    $idCarts = json_decode($_POST['idCarts'], true);
    $timestamp = date('Y-m-d H:i:s');

    mysqli_begin_transaction($connection);

    $queryInsert = "INSERT INTO pengeluaran (id, id_user, metode_pembayaran, hasil, tanggal) 
                    VALUES (uuid(), '$idUser', '$pembayaran', '$totalHarga', '$timestamp')";
    $resultInsert = mysqli_query($connection, $queryInsert);

    if (!$resultInsert) {
        echo "Gagal menyimpan data pengeluaran: " . mysqli_error($connection);
        mysqli_rollback($connection);
        exit;
    }

    $updateSuccess = true;
    foreach ($idCarts as $idCart) {
        $queryUpdate = "UPDATE cart_pengeluaran SET deleted_at = '$timestamp' WHERE id = '$idCart'";
        $resultUpdate = mysqli_query($connection, $queryUpdate);
        if (!$resultUpdate) {
            $updateSuccess = false;
            break;
        }
    }

    if ($updateSuccess) {
        mysqli_commit($connection);
        echo "Data berhasil disimpan dan diperbarui.";
    } else {
        echo "Gagal memperbarui data cart_pengeluaran: " . mysqli_error($connection);
        mysqli_rollback($connection);
    }
} else {
    echo "Data tidak lengkap.";
}
?>
