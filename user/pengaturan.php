<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: ../auth/login.php"); // Redirect ke halaman login jika belum login
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Pengaturan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>



<body>


  <div>
    <nav class="navbar p-3 shadow-sm position-sticky top-0 start-0 end-0 gap-3 flex-nowrap rounded-bottom-4" style="background-color: #03C3EC;">
      <div class="w-100 d-block">
        <div class="row justify-content-between">
          <div class="col-auto d-flex align-items-center gap-3">
            <button class="navbar-toggler py-1 px-2 btn-sm bg-secondary-subtle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" style="border: none; outline: none; box-shadow: none">
              <i class="fa-solid fa-bars"></i>
            </button>
            <h1 class="m-0" style="font-weight: 600;">Pengaturan</h1>
          </div>
          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                <img src="../image/logo.svg" alt="" style="width: 150px" />
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 gap-2">
                <li class="nav-item bg-secondary-subtle rounded">
                  <a class="nav-link p-2 d-flex align-items-center gap-3" href="../dashboard/index.php">
                    <i class="fa-solid fa-house"></i> Dasbor
                  </a>
                </li>
                <li class="nav-item dropdown bg-secondary-subtle rounded">
                  <a class="nav-link dropdown-toggle p-2 d-flex justify-content-between align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                      <i class="fa-solid fa-book me-1"></i>
                      <span>Pencatatan</span>
                    </div>
                  </a>
                  <ul class="dropdown-menu bg-secondary-subtle">
                    <li><a class="dropdown-item" href="../pencatatan/pencatatan-masuk.php">Pemasukan</a></li>
                    <li><a class="dropdown-item" href="../pencatatan/pencatatan-keluar.php">Pengeluaran</a></li>
                  </ul>
                </li>
                <li class="nav-item bg-secondary-subtle rounded">
                  <a class="nav-link p-2 d-flex align-items-center gap-3" href="../menu/index.php">
                    <i class="fa-solid fa-burger"></i>Menu</a>
                </li>
                <li class="nav-item dropdown bg-secondary-subtle rounded">
                  <a class="nav-link dropdown-toggle p-2 d-flex justify-content-between align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center gap-3">
                      <i class="fa-solid fa-clock-rotate-left" style="margin-right: 2px"></i>
                      <span>Riwayat</span>
                    </div>
                  </a>
                  <ul class="dropdown-menu bg-secondary-subtle">
                    <li><a class="dropdown-item" href="../pencatatan/riwayat/riwayat-masuk.php">Pemasukan</a></li>
                    <li><a class="dropdown-item" href="../pencatatan/riwayat/riwayat-keluar.php">Pengeluaran</a></li>
                  </ul>
                </li>
                <li class="nav-item bg-secondary-subtle rounded">
                  <a class="nav-link p-2 d-flex align-items-center gap-3" href="../lokasi/">
                    <i class="fa-solid fa-location-dot me-1"></i> Lokasi</a>
                </li>
                <li class="nav-item bg-secondary-subtle rounded">
                  <a class="nav-link p-2 d-flex align-items-center gap-3" href="#">
                    <i class="fa-solid fa-gear me-1"></i> Pengaturan</a>
                </li>

              </ul>
            </div>
          </div>
        </div>

      </div>
    </nav>

    <div class="p-3" style="border: none;">
      <div class="text-center p-3">
        <div class="row border-bottom border-secondary" style="margin-top: 1%;">
          <div class="col-8 text-start mb-2">
            <i class="fa-solid fa-user me-4"></i> Profil
          </div>
          <div class="col-4 text-end">
            <a href="./profil.php" class="text-body">
              <i class="fa-solid fa-chevron-right"></i>
            </a>
          </div>
        </div>
        <div class="row border-bottom border-secondary" style="margin-top: 2%;">
          <div class="col-8 text-start mb-2">
            <i class="fa-solid fa-user-plus me-3"></i> Tambah Admin
          </div>
          <div class="col-4 text-end">
            <a href="./tambah-admin.php" class="text-body">
              <i class="fa-solid fa-chevron-right"></i>
            </a>
          </div>
        </div>
        <div class="row border-bottom border-secondary" style="margin-top: 2%;">
          <div class="col-8 text-start mb-2">
            <i class="fa-solid fa-right-from-bracket me-4"></i> Keluar
          </div>
          <div class="col-4 text-end">
            <a id="logoutAkun" class="text-body" style="cursor: pointer;">
              <i class="fa-solid fa-chevron-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>


  </div>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Mendapatkan tombol "Hapus Profil"
      const btnlogoutAkun = document.getElementById('logoutAkun');

      // Menambahkan event listener untuk mengonfirmasi penghapusan profil
      btnlogoutAkun.addEventListener('click', function() {
        // Tampilkan SweetAlert untuk konfirmasi
        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Anda akan keluar dari akun!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, keluar!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            // Jika pengguna mengonfirmasi penghapusan, arahkan ke halaman hapus profil
            window.location.href = "../auth/logout.php";
          }
        });
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>
</body>

</html>