<?php
session_start();
require_once '../helper/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendefinisikan respons awal
    $response = array();

    try {
        // Mengambil data yang dikirimkan melalui metode POST
        $id_menu = mysqli_real_escape_string($connection, $_POST['id_menu']);
        $id_user = mysqli_real_escape_string($connection, $_SESSION['login']['id']);
        $jumlah_pengeluaran = mysqli_real_escape_string($connection, $_POST['jumlah_pengeluaran']);
        $tanggal = date('Y-m-d');
        $waktu = date('H:i:s');

        // Query untuk menyimpan data pesanan ke database
        $query = "INSERT INTO `cart_pengeluaran` (`id`, `id_menu`, `id_user`, `jumlah_pengeluaran`, `tanggal`, `waktu`) VALUES (UUID(), '$id_menu', '$id_user', '$jumlah_pengeluaran', '$tanggal', '$waktu')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Jika penyimpanan berhasil
            $response['status'] = "success";
        } else {
            // Jika ada kesalahan dalam penyimpanan
            $response['status'] = "error";
            $response['message'] = "Gagal menyimpan pesanan ke database.";
        }
    } catch (Exception $e) {
        // Tangkap kesalahan jika ada
        $response['status'] = "error";
        $response['message'] = $e->getMessage();
    }

    // Atur header sebagai JSON
    header('Content-Type: application/json');

    // Keluarkan respons sebagai JSON
    echo json_encode($response);
    die();
}
?>
