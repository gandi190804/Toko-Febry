<?php
session_start();
require_once '../helper/connection.php';

// Periksa apakah parameter id telah disertakan dalam URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $current_date = date('Y-m-d H:i:s');

    // Lakukan permintaan update data ke database
    $result = mysqli_query($connection, "UPDATE menus SET deleted_at='$current_date' WHERE id='$id'");

    // Periksa apakah permintaan update berhasil
    if($result) {
        $_SESSION['success_message'] = "Data menu berhasil dihapus.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Gagal menghapus data reservasi.";
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "ID tidak diberikan.";
    header("Location: index.php");
    exit();
}
?>
