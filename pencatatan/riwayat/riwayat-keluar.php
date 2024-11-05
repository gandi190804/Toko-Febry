<?php
session_start();
require_once '../../helper/connection.php';

if (!isset($_SESSION['login'])) {
  header('Location: ../../auth/login.php'); 
  exit();
}

$id_user = $_SESSION['login']['id'];

$metode_pembayaran = isset($_GET['metode_pembayaran']) ? $_GET['metode_pembayaran'] : '';

$query = "SELECT * FROM pengeluaran WHERE id_user = '$id_user'";

if (!empty($metode_pembayaran)) {
  $query .= " AND metode_pembayaran = '$metode_pembayaran'";
}

$query .= " ORDER BY tanggal DESC";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Riwayat | Keluar</title>
  <link rel="stylesheet" href="../../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body style="font-family: 'Poppins', sans-serif;">
  <nav class="navbar z-3 shadow-sm p-3 position-sticky top-0 start-0 end-0 gap-3 flex-nowrap rounded-bottom-4" style="background-color: #03C3EC;">
    <div class="w-100 d-block">
      <div class="row justify-content-between">
        <div class="col-auto d-flex align-items-center gap-3">
          <button class="navbar-toggler py-1 px-2 btn-sm bg-secondary-subtle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" style="border: none; outline: none; box-shadow: none">
            <i class="fa-solid fa-bars"></i>
          </button>
          <h1 class="m-0" style="font-weight: 600; font-size: 22px;">Riwayat Pengeluaran</h1>
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
              <img src="../../image/logo.svg" alt="" style="width: 150px" />
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 gap-2">
              <li class="nav-item bg-secondary-subtle rounded">
                <a class="nav-link p-2 d-flex align-items-center gap-3" href="../../dashboard/">
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
                  <li><a class="dropdown-item" href="../../pencatatan/pencatatan-masuk.php">Pemasukan</a></li>
                  <li><a class="dropdown-item" href="../../pencatatan/pencatatan-keluar.php">Pengeluaran</a></li>
                </ul>
              </li>
              <li class="nav-item bg-secondary-subtle rounded">
                <a class="nav-link p-2 d-flex align-items-center gap-3" href="../../menu/">
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
                  <li><a class="dropdown-item" href="./riwayat-masuk.php">Pemasukan</a></li>
                  <li><a class="dropdown-item" href="#">Pengeluaran</a></li>
                </ul>
              </li>
              <li class="nav-item bg-secondary-subtle rounded">
                <a class="nav-link p-2 d-flex align-items-center gap-3" href="../../lokasi/">
                  <i class="fa-solid fa-location-dot me-1"></i> Lokasi</a>
              </li>
              <li class="nav-item bg-secondary-subtle rounded">
                <a class="nav-link p-2 d-flex align-items-center gap-3" href="../../user/pengaturan.php">
                  <i class="fa-solid fa-gear me-1"></i> Pengaturan</a>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </nav>



  <div class="select-menu p-3">
    <form method="GET" action="riwayat-keluar.php">
      <select name="metode_pembayaran" class="p-2" style="border-radius: 5px;" onchange="this.form.submit()">
        <option value="">Pilih</option>
        <option value="tunai" <?php if ($metode_pembayaran == 'tunai') echo 'selected'; ?>>Tunai</option>
        <option value="qris" <?php if ($metode_pembayaran == 'qris') echo 'selected'; ?>>Qris</option>
      </select>
    </form>
  </div>

  <div class="p-3">
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $tanggal = $row['tanggal'];
        $total_pemasukan = $row['hasil'];
    ?>
        <div class="card mb-3">
          <div class="card-header" style="background-color: #03C3EC; font-weight: 500;">
            <?php echo date('d M Y', strtotime($tanggal)); ?> * <?php echo date('H:i', strtotime($tanggal)); ?>
          </div>
          <div class="card-body2 p-3 d-flex justify-content-between align-items-center">
            <div>
              <h2 class="card-title">Rp<?php echo number_format($total_pemasukan, 0, ',', '.'); ?></h2>
              <a href="../detail-keluar.php?id=<?php echo $id; ?>" style="text-decoration: none;">
                <h2 class="card-title text-danger" id="detail" style="text-decoration: none;">detail</h2>
              </a>
            </div>
            <div>
            </div>
          </div>
        </div>
    <?php
      }
    } else {
      echo "<p>Tidak ada riwayat pengeluaran.</p>";
    }
    ?>
  </div>

 <!-- Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".swiper", {
      slidesPerView: "auto",
      spaceBetween: 30,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
</body>

</html>