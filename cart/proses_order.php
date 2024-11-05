<?php
session_start();
require_once '../helper/connection.php';

// Pastikan data terkirim dengan benar
if (isset($_SESSION['login']['id'], $_POST['metodePembayaran'], $_POST['totalHarga'], $_POST['idCarts'])) {
    $idUser = $_SESSION['login']['id'];
    $pembayaran = $_POST['metodePembayaran'];
    $totalHarga = $_POST['totalHarga'];
    $idCarts = json_decode($_POST['idCarts'], true); // Decode JSON string ke array PHP
    $tanggal = date('Y-m-d H:i:s'); 

    // Mulai transaksi
    mysqli_begin_transaction($connection);

    // Lakukan operasi INSERT untuk menyimpan data baru ke dalam tabel
    $queryInsert = "INSERT INTO pencatatan (id, id_user, metode_pembayaran, hasil, tanggal) 
                    VALUES (uuid(), '$idUser', '$pembayaran', '$totalHarga', '$tanggal')";
    $resultInsert = mysqli_query($connection, $queryInsert);

    // Siapkan operasi UPDATE untuk mengupdate data di tabel cart berdasarkan id cart
    $updateSuccess = true;
    foreach ($idCarts as $idCart) {
        $queryUpdate = "UPDATE cart SET deleted_at = '$tanggal' WHERE id = '$idCart'";
        $resultUpdate = mysqli_query($connection, $queryUpdate);
        if (!$resultUpdate) {
            $updateSuccess = false;
            break;
        }
    }
    // Cek apakah kedua operasi berhasil
    if ($resultInsert && $updateSuccess) {
        // Commit transaksi jika kedua operasi berhasil
        mysqli_commit($connection);
        echo "Data berhasil disimpan dan diperbarui.";
    } else {
        // Rollback transaksi jika salah satu operasi gagal
        mysqli_rollback($connection);
        echo "Gagal menyimpan atau memperbarui data: " . mysqli_error($connection);
    }
} else {
    echo "Data tidak lengkap.";
}
?>
