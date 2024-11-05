<?php
session_start();
require_once '../helper/connection.php';

$id_user = $_SESSION['login']['id'];
$query_foto_profil = $connection->prepare("SELECT foto_user FROM users WHERE id = ?");
$query_foto_profil->bind_param("i", $id_user);
$query_foto_profil->execute();
$result_foto_profil = $query_foto_profil->get_result();

if ($result_foto_profil->num_rows > 0) {
  $row_foto_profil = $result_foto_profil->fetch_assoc();
  $foto_profil = $row_foto_profil['foto_user'];
} else {
  $foto_profil = 'default.jpg';
}

$foto_profil_path = "../image/foto_profile/" . $foto_profil;

$query_pemasukan = $connection->prepare("SELECT SUM(hasil) AS total_pemasukan FROM pencatatan WHERE id_user = ?");
$query_pemasukan->bind_param("i", $id_user);
$query_pemasukan->execute();
$result_pemasukan = $query_pemasukan->get_result();
$row_pemasukan = $result_pemasukan->fetch_assoc();
$total_pemasukan = ($row_pemasukan['total_pemasukan'] !== null) ? $row_pemasukan['total_pemasukan'] : 0;

// Query untuk mengambil total pengeluaran
$query_pengeluaran = $connection->prepare("SELECT SUM(hasil) AS total_pengeluaran FROM pengeluaran WHERE id_user = ?");
$query_pengeluaran->bind_param("i", $id_user);
$query_pengeluaran->execute();
$result_pengeluaran = $query_pengeluaran->get_result();
$row_pengeluaran = $result_pengeluaran->fetch_assoc();
$total_pengeluaran = ($row_pengeluaran['total_pengeluaran'] !== null) ? $row_pengeluaran['total_pengeluaran'] : 0;

$total_profit = $total_pemasukan - $total_pengeluaran;

// Kondisi untuk menentukan warna berdasarkan nilai profit
$profit_class = ($total_profit < 0) ? 'negative-profit' : '';

$query_transaksi = $connection->prepare("
    SELECT p.tanggal, p.hasil, m.nama_menu
    FROM pengeluaran p
    JOIN cart_pengeluaran c ON p.id_user = c.id_user
    JOIN menus m ON c.id_menu = m.id
    WHERE p.id_user = ?
    ORDER BY p.tanggal DESC
    LIMIT 5
");
$query_transaksi->bind_param("i", $id_user);
$query_transaksi->execute();
$result_transaksi = $query_transaksi->get_result();

$query_pengeluaran_bulanan = $connection->prepare("
    SELECT DATE_FORMAT(tanggal, '%Y-%m') AS bulan, SUM(hasil) AS total_pengeluaran
    FROM pengeluaran WHERE id_user = ?
    GROUP BY bulan
");
$query_pengeluaran_bulanan->bind_param("i", $id_user);
$query_pengeluaran_bulanan->execute();
$result_pengeluaran_bulanan = $query_pengeluaran_bulanan->get_result();

$query_pemasukan_bulanan = $connection->prepare("
    SELECT DATE_FORMAT(tanggal, '%Y-%m') AS bulan, SUM(hasil) AS total_pemasukan
    FROM pencatatan WHERE id_user = ?
    GROUP BY bulan
");
$query_pemasukan_bulanan->bind_param("i", $id_user);
$query_pemasukan_bulanan->execute();
$result_pemasukan_bulanan = $query_pemasukan_bulanan->get_result();

$pengeluaran_bulanan = [];
$pemasukan_bulanan = [];
$bulan = [];

while ($row = $result_pengeluaran_bulanan->fetch_assoc()) {
  $bulan[] = $row['bulan'];
  $pengeluaran_bulanan[] = $row['total_pengeluaran'];
}

while ($row = $result_pemasukan_bulanan->fetch_assoc()) {
  $pemasukan_bulanan[] = $row['total_pemasukan'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Dasbor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .negative-profit {
      color: red;
    }


    @media (max-width: 576px) {
      .card .card-body {
        margin-top: -10px;
        margin-bottom: -35px;
      }
    }
  </style>
</head>

<body>

  <div class="w-100">
    <nav class="navbar z-3 shadow-sm position-sticky top-0 start-0 end-0 gap-3 flex-nowrap rounded-bottom-4" style="background-color: #03C3EC;">
      <div class="py-1 mx-3 w-100 d-block">
        <div class="row justify-content-between">
          <div class="col-auto d-flex align-items-center gap-3">
            <button class="navbar-toggler py-1 px-2 btn-sm bg-secondary-subtle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" style="border: none; outline: none; box-shadow: none">
              <i class="fa-solid fa-bars"></i>
            </button>
            <h1 class="m-0" style="font-weight: 600;">Dasbor</h1>
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
                  <a class="nav-link p-2 d-flex align-items-center gap-3" href="../user/pengaturan.php">
                    <i class="fa-solid fa-gear me-1"></i> Pengaturan</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <div class="row align-items-center w-100" style="margin-top: 2%;">
      <div class="slmt-dtg col-md-6 d-flex align-items-center m-3">
        <img src="<?= $foto_profil_path ?>" class="img-dasbor2 rounded-circle img-fluid symmetrical-img">
        <div class="txt-dsbr">
          <h2 class="text-start mb-0">Halo, <?= $_SESSION['login']['nama'] ?></h2>
          <h4 class="text-start mb-0">Selamat Datang Kembali</h4>
        </div>
      </div>
    </div>

    <div class="row mt-3 p-1 w-100 mx-0">
      <div class="col-md-4 col-6">
        <div class="card" style="background-color: #f0f0f0; border: none;">
          <div class="card-body p-4">
            <img src="../image/pemasukan.svg" class="img-dasbor symmetrical-img" alt="Foto Profil">
            <p class="card-text1" style="color: #03C3EC;">Pemasukan</p>
            <p class="card-text2" style="color: #03C3EC;">Rp<?= number_format($total_pemasukan, 0, ',', '.') ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-6">
        <div class="card" style="background-color: #f0f0f0; border: none;">
          <div class="card-body p-4">
            <img src="../image/pengeluaran.svg" class="img-dasbor symmetrical-img" alt="Foto Profil">
            <p class="card-text1" style="color: #03C3EC;">Pengeluaran</p>
            <p class="card-text2" style="color: #03C3EC;">Rp<?= number_format($total_pengeluaran, 0, ',', '.') ?></p>
          </div>
        </div>
      </div>
      <div class="card3 col-md-4 col-6">
        <div class="card" style="background-color: #f0f0f0; border: none;">
          <div class="card-body p-4">
            <img src="../image/profit.svg" class="img-dasbor symmetrical-img" alt="Foto Profil">
            <p class="card-text1" style="color: #03C3EC;">Profit</p>
            <p class="card-text2 <?= $profit_class ?>" style="color: #03C3EC;">Rp<?= number_format($total_profit, 0, ',', '.') ?></p>
          </div>
        </div>
      </div>
    </div>

    <div class="table mt-3 p-3">
      <div class="p-3" style="background-color: #f0f0f0; border-radius: 5px;">
        <h3>Grafik Pemasukan dan Pengeluaran</h3>
        <canvas id="pengeluaranPemasukanChart" width="400" height="200"></canvas>
      </div>
    </div>

    <div class="table mt-3 p-3">
      <div class="p-3" style="background-color: #f0f0f0; border-radius: 5px;">
        <h3>Transaksi Terakhir</h3>
        <?php if (mysqli_num_rows($result_transaksi) > 0) : ?>
          <table class="table table-bordered text-center" style="border-radius: 5px;">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Harga</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row_transaksi = mysqli_fetch_assoc($result_transaksi)) {
                echo "<tr>";
                echo "<th scope='row'>" . $no . "</th>";
                echo "<td>" . $row_transaksi['nama_menu'] . "</td>";
                echo "<td>" . date('d-m-Y', strtotime($row_transaksi['tanggal'])) . "</td>";
                echo "<td>Rp" . number_format($row_transaksi['hasil'], 0, ',', '.') . "</td>";
                echo "</tr>";
                $no++;
              }
              ?>
            </tbody>
          </table>
        <?php else : ?>
          <p>Tidak ada transaksi terakhir.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../js/script.js"></script>
  <script>
    const ctx = document.getElementById('pengeluaranPemasukanChart').getContext('2d');
    const pengeluaranPemasukanChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?= json_encode($bulan) ?>,
        datasets: [{
            label: 'Pengeluaran',
            data: <?= json_encode($pengeluaran_bulanan) ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
          },
          {
            label: 'Pemasukan',
            data: <?= json_encode($pemasukan_bulanan) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          }
        ]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>

</html>