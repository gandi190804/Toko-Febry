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
    <title>Profil</title>
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
                        <a href="./pengaturan.php" class="text-dark bg-secondary-subtle py-1 px-2 rounded">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                        <h1 class="m-0" style="font-weight: 600;">Profil</h1>
                    </div>
                </div>
            </div>

            <div class="row align-items-center" style="margin-top: 2%;">
                <div class="col-md-6 text-center">
                    <img src="../image/foto_profile/<?= $user['foto_user'] ?>" class="rounded-circle img-fluid symmetrical-img" style="height: 120px; width: 120px;">
                </div>
                <div class="col-md-6">
                    <h2 class="text-center"><?php echo htmlspecialchars($user['nama']); ?></h2>
                </div>
            </div>
        </div>
    </nav>

    <div class="p-3">
        <div class="p-3 text-center">
            <div class="row row-cols-2" style="margin-top: 1%;">
                <div class="col text-start">Username</div>
                <div class="col text-end"><?php echo htmlspecialchars($user['username']); ?></div>
            </div>
            <div class="row row-cols-2" style="margin-top: 1%;">
                <div class="col text-start">No. Telepon</div>
                <div class="col text-end"><?php echo htmlspecialchars($user['no_hp']); ?></div>
            </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto fixed-bottom" style="margin-bottom: 30px;">
            <a href="./edit-profile.php" id="btn-ubah-profil">
                <button class="btn" style="background-color: #03C3EC;" type="button">Edit Profil</button>
            </a>
            <button id="btn-hapus-profil" class="btn" style="background-color: #03C3EC;" type="button">Hapus Profil</button>
        </div>
    </div>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan tombol "Hapus Profil"
            const btnHapusProfil = document.getElementById('btn-hapus-profil');

            // Menambahkan event listener untuk mengonfirmasi penghapusan profil
            btnHapusProfil.addEventListener('click', function() {
                // Tampilkan SweetAlert untuk konfirmasi
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan profil setelah dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengonfirmasi penghapusan, arahkan ke halaman hapus profil
                        window.location.href = "./delete-profile.php";
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>

</html>