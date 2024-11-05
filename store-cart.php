<?php
session_start();
require_once 'helper/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = array();

    try {
        $id_menu = $_POST['id_menu'];
        $id_user = $_SESSION['loginUser']['id'];
        $banyak_item = $_POST['banyak_item']; 
        $total_harga = $_POST['total_harga'];
        $tanggal = date('Y-m-d');
        $waktu = date('H:i:s');

        $query = "INSERT INTO cart_users (id, id_menu, id_viewer, total_harga, banyak_item, tanggal, waktu) VALUES (uuid(), '$id_menu', '$id_user', '$total_harga', '$banyak_item', '$tanggal', '$waktu')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $response['status'] = "success";
        } else {
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
