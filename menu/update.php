<?php
session_start();
require_once '../helper/connection.php';

$id = $_POST['id'];
$nama_menu = $_POST['nama_menu'];
$kategori_menu = $_POST['kategori_menu'];
$harga = $_POST['harga'];
$penjualan = $_POST['penjualan'];
$berat_makanan = $_POST['berat_makanan'];
$stok = ($_POST['stok'] == '1') ? 1 : 0;

if ($_FILES['foto_menu']['name']) {
    $foto_menu = $_FILES['foto_menu']['name'];

    // Upload file foto menu
    $target_dir = "../image/foto_menu/"; // Direktori tempat menyimpan file
    $target_file = $target_dir . basename($_FILES["foto_menu"]["name"]);

    if (move_uploaded_file($_FILES["foto_menu"]["tmp_name"], $target_file)) {
        echo "File " . basename($_FILES["foto_menu"]["name"]) . " berhasil diunggah.";
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
    }
} else {
    $query = mysqli_query($connection, "SELECT foto_menu FROM menus WHERE id='$id'");
    $row = mysqli_fetch_assoc($query);
    $foto_menu = $row['foto_menu'];
}

// Simpan data ke database
$sql = "UPDATE menus SET 
    nama_menu = '$nama_menu',
    kategori_menu = '$kategori_menu',
    harga = '$harga',
    penjualan = '$penjualan',
    berat_makanan = '$berat_makanan',
    stok = '$stok',
    foto_menu = '$foto_menu'
WHERE 
    id = '$id'";

if ($connection->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();
?>