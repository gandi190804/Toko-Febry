<?php
session_start();
require_once '../helper/connection.php';

if (!isset($_SESSION['loginUser']['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['loginUser']['id'];

$query = "SELECT * FROM viewers WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar p-3 shadow-sm position-sticky top-0 start-0 end-0 gap-3 flex-nowrap rounded-bottom-4" style="background-color: #03C3EC;">
        <div class="w-100 d-block">
            <div class="w-100 d-block">
                <div class="row justify-content-between">
                    <div class="col-auto d-flex align-items-center gap-3">
                        <a href="profil.php" class="text-dark bg-secondary-subtle py-1 px-2 rounded">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                        <h1 class="m-0" style="font-weight: 600;">Edit Profil</h1>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="p-3 mt-4">
        <form action="./update-profile.php" method="post" enctype="multipart/form-data">
            <div class="row align-items-center">
                <div class="col-md-6 text-center">
                    <img src="../image/foto_profile/<?= htmlspecialchars($user['foto_user']) ?>" class="rounded img-fluid symmetrical-img" alt="Foto Profil">
                </div>
                <div class="col-md-6 mb-3" style="justify-content: center; display: flex; margin-top: 10px;">
                    <input type="file" class="form-control" style="width: 50%;" name="foto_user">
                </div>
            </div>

            <div class="mb-3 mt-3">
                <label for="inputNama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="inputNama" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="inputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="inputUsername" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="**********************************">
            </div>
            <div class="mb-3">
                <label for="inputTelepon" class="form-label">Telepon</label>
                <input type="number" class="form-control" id="inputTelepon" name="no_hp" value="<?php echo htmlspecialchars($user['no_hp']); ?>" required>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mb-3">
                <button class="btn" style="background-color: red;" type="button" onclick="window.location.href='profil.php'">Batal</button>
                <button class="btn" style="background-color: #03C3EC;" type="submit">Simpan</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
