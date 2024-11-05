<?php
session_start();
require_once '../helper/connection.php';

if (!isset($_SESSION['loginUser']['id'])) {
    header("Location: ../authUser/login.php");
    exit();
}

$user_id = $_SESSION['loginUser']['id'];

// Get the current user data
$query = "SELECT * FROM viewers WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$current_user = $result->fetch_assoc();

if (!$current_user) {
    echo "User tidak ditemukan.";
    exit();
}

// Handle file upload
if ($_FILES['foto_user']['name']) {
    $target_dir = "../image/foto_profile/";
    $target_file = $target_dir . basename($_FILES["foto_user"]["name"]);
    move_uploaded_file($_FILES["foto_user"]["tmp_name"], $target_file);
    $foto_user = $_FILES["foto_user"]["name"];
} else {
    $foto_user = $current_user['foto_user']; // Keep the current photo if no new photo is uploaded
}

// Handle password
if (!empty($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
} else {
    $password = $current_user['password']; // Keep the current password hash if no new password is entered
}

// Update user data
$query = "UPDATE viewers SET nama = ?, username = ?, password = ?, no_hp = ?, foto_user = ? WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("sssssi", $_POST['nama'], $_POST['username'], $password, $_POST['no_hp'], $foto_user, $user_id);

if ($stmt->execute()) {
    // Update session data
    $_SESSION['loginUser']['nama'] = $_POST['nama'];
    $_SESSION['loginUser']['username'] = $_POST['username'];
    $_SESSION['loginUser']['foto_user'] = $foto_user;

    header("Location: profil.php");
} else {
    echo "Gagal mengupdate profil.";
}
$stmt->close();
$connection->close();
?>
