<?php
session_start();
require_once '../helper/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $no_hp = $_POST['no_hp'];

    
    $foto_user = ''; 
    if ($_FILES['foto_user']['name']) {
        $foto_user = $_FILES['foto_user']['name'];


        $target_dir = "../image/foto_profile/";

        $target_file = $target_dir . basename($_FILES["foto_user"]["name"]);

        if (move_uploaded_file($_FILES["foto_user"]["tmp_name"], $target_file)) {
            echo "File " . basename($_FILES["foto_user"]["name"]) . " berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }

    $query = "INSERT INTO viewers (id, nama, username, password, no_hp, foto_user) VALUES (uuid(), '$nama', '$username', '$password', '$no_hp', '$foto_user')";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Akun Berhasil dibuat!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Gagal membuat Akun!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Custom styles untuk halaman tambah-admin */
        .container {
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        .btn-primary,
        .btn-secondary {
            margin-top: 20px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div>
        <nav class="navbar p-3 shadow-sm position-sticky top-0 start-0 end-0 gap-3 flex-nowrap rounded-bottom-4" style="background-color: #03C3EC;">
            <div class="w-100 d-block">
                <div class="w-100 d-block">
                    <div class="row justify-content-between">
                        <div class="col-auto d-flex align-items-center gap-3">
                            <a href="login.php" class="text-dark bg-secondary-subtle py-1 px-2 rounded">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                            <h1 class="m-0" style="font-weight: 600;">Daftar</h1>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="p-3 mt-3">
        <form action="signup.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="foto_user" class="form-label">Foto Profil</label>
                <input type="file" class="form-control" id="foto_user" name="foto_user">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mb-3">
                <button class="btn" style="background-color: red;" type="button" onclick="window.location.href='pengaturan.php'">Batal</button>
                <button class="btn" style="background-color: #03C3EC;" type="submit">Simpan</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>