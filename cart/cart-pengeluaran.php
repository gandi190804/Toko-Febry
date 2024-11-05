<?php
session_start();
require_once '../helper/connection.php';

$totalHarga = 0;

$query = "SELECT cart_pengeluaran.*, menus.nama_menu, menus.foto_menu
          FROM cart_pengeluaran
          INNER JOIN menus ON cart_pengeluaran.id_menu = menus.id
          WHERE cart_pengeluaran.deleted_at IS NULL";
$result = mysqli_query($connection, $query);

$cartItems = array();
if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $cartItems[] = $row;
    $totalHarga += $row['jumlah_pengeluaran'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Keranjang</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <style>
    .select-menu-container {
      display: flex;
    }

    .select-menu {
      margin-right: 10px;
    }
  </style>
</head>

<body style="font-family: 'Poppins', sans-serif;">
  <nav class="navbar z-3 shadow-sm p-3 position-sticky top-0 start-0 end-0 gap-3 flex-nowrap rounded-bottom-4" style="background-color: #03C3EC;">
    <div class="w-100 d-block">
      <div class="row justify-content-between">
        <div class="col-auto d-flex align-items-center gap-3">
          <a href="../pencatatan/pencatatan-keluar.php" class="text-dark bg-secondary-subtle py-1 px-2 rounded"><i class="fa-solid fa-chevron-left"></i></a>
          <h1 class="m-0" style="font-weight: 600;">Keranjang</h1>
        </div>
      </div>
    </div>
  </nav>
  <main>
    <div class="p-3" style="margin-top: 20px;">
      <?php foreach ($cartItems as $item) : ?>
        <div class="card mb-3">
          <div class="card-body d-flex">
            <!-- Div pertama -->
            <div class="img-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 100px; height: 100px;">
              <img src="../image/foto_menu/<?php echo $item['foto_menu']; ?>" id="img-keranjang1" data-menu-id="<?php echo $item['id_menu']; ?>" class="rounded p-2 img-fluid" alt="<?php echo $item['nama_menu']; ?>" style="max-width: 100%;">
            </div>
            <!-- Div kedua -->
            <div class="txt-2 d-flex flex-column" style="flex: 2;">
              <div class="d-flex align-items-center justify-content-between" style="max-width: 100px;">
                <!-- Menggunakan CSS untuk mengatur potongan teks -->
                <h2 class="card-title text-start text-truncate flex-grow-1 me-3 mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item['nama_menu']; ?></h2>
              </div>
              <h3 class="card-text" style="color: black;">
                <small class="text-angka mt-3">
                  Rp<?php echo number_format($item['jumlah_pengeluaran'], 0, ',', '.'); ?>
                </small>
              </h3>
            </div>
            <!-- Div ketiga -->
            <div class="d-flex align-items-center justify-content-center ms-auto">
              <div class="bg-circle text-center">
                <a href="delete-cart-pengeluaran.php?id=<?php echo $item['id']; ?>">
                  <i class="bx bxs-trash-alt" style="font-size: 1.5rem; color: white;"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>



    <div class="border"></div>
    <div class="p-3 d-flex align-items-center justify-content-between" id="bawah-keranjang">
      <h3 class="">Tambah Menu Lain?</h3>
      <div class="d-flex align-items-center me-2 gap-2">
        <a href="../pencatatan/pencatatan-keluar.php">
          <button class="btn" style="background-color: #03C3EC;" type="button">Tambah</button>
        </a>
      </div>
    </div>
  </main>
  <div class="z-3 fixed-bottom position-fixed bg-body-tertiary shadow-sm flex-nowrap rounded-top-4">
    <div class="container-lg d-block">
      <div class="select-menu-container">
        <div class="select-menu ms-3">
          <select class="p-2" style="border-radius: 5px;" name="metode_pembayaran">
            <option selected>Pilih</option>
            <option value="tunai">Tunai</option>
            <option value="qris">Qris</option>
          </select>
        </div>
      </div>
      <div class="justify-content-center" style="width: 100%;">
        <div class="d-flex align-items-center p-3 justify-content-between">
          <div>
            <h4 class="">Total Harga</h4>
          </div>
          <div class="d-flex align-items-center gap-2">
            <h4 style="color: red; font-size: 22px;" name="hasil">Rp<?php echo number_format($totalHarga, 0, ',', '.'); ?></h4>
          </div>
        </div>
        <div class="col-auto d-flex align-items-center mb-3 gap-3" id="btn-keranjang">
          <a style="width: 100%;">
            <button class="btn w-100" style="background-color: #03C3EC;" type="button" id="btn-catat">Catat</button>
          </a>
        </div>
      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    const swiper = new Swiper(".swiper", {
      slidesPerView: "auto",
      spaceBetween: 10,
      freeMode: true,
      pagination: false,
    });
  </script>
  <script>
    document.getElementById('btn-catat').addEventListener('click', function() {
      var metodePembayaran = document.querySelector('[name="metode_pembayaran"]').value;
      var totalHarga = <?php echo $totalHarga; ?>;

      if (metodePembayaran === "Pilih") {
        alert("Silakan pilih metode pembayaran terlebih dahulu.");
        return;
      }

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'proses_pengeluaran.php', true); // Sesuaikan dengan nama file PHP yang akan menangani penyimpanan ke database
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            location.reload();
          } else {
            console.error('Terjadi kesalahan: ' + xhr.status);
          }
        }
      };
      var idCarts = <?php echo json_encode(array_column($cartItems, 'id')); ?>;
      xhr.send('metodePembayaran=' + encodeURIComponent(metodePembayaran) + '&totalHarga=' + encodeURIComponent(totalHarga) + '&idCarts=' + encodeURIComponent(JSON.stringify(idCarts)));
    });
  </script>
</body>

</html>