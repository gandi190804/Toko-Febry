<?php
session_start();
require_once '../helper/connection.php';

$nama_menu = $_POST['nama_menu'];
$kategori_menu = $_POST['kategori_menu'];
$harga = $_POST['harga'];
$penjualan = $_POST['penjualan'];
$berat_makanan = $_POST['berat_makanan'];
$stok = ($_POST['stok'] == 'tersedia') ? 1 : 0;
$foto_menu = $_FILES['foto_menu']['name'];

// Upload file bukti pembayaran
$target_dir = "../image/foto_menu/"; // Direktori tempat menyimpan file
$target_file = $target_dir . basename($_FILES["foto_menu"]["name"]);

if (move_uploaded_file($_FILES["foto_menu"]["tmp_name"], $target_file)) {
    echo "File " . basename($_FILES["foto_menu"]["name"]) . " berhasil diunggah.";
} else {
    echo "Maaf, terjadi kesalahan saat mengunggah file.";
}
// Simpan data ke database
$sql = "INSERT INTO menus (id, nama_menu, kategori_menu, harga, penjualan, berat_makanan, stok, foto_menu) VALUES (uuid(), '$nama_menu', '$kategori_menu', '$harga', '$penjualan', $berat_makanan, '$stok', '$foto_menu')";

if ($connection->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();
?>
