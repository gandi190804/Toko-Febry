<?php
require_once '../helper/connection.php';

$id = $_GET['id'];
$query = mysqli_query($connection, "SELECT * FROM menus WHERE id='$id'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Edit Menu</title>
  <link rel="stylesheet" href="../css/style.css">
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body style="font-family: Poppins,sans-serif;">
  <nav class="navbar z-3 shadow-sm p-3 position-sticky top-0 start-0 end-0 gap-3 flex-nowrap rounded-bottom-4" style="background-color: #03C3EC;">
    <div class="w-100 d-block">
      <div class="row justify-content-between">
        <div class="col-auto d-flex align-items-center gap-3">
          <a href="index.php" class="text-dark bg-secondary-subtle py-1 px-2 rounded"><i class="fa-solid fa-chevron-left"></i></a>
          <h1 class="m-0" style="font-weight: 600;">Edit Menu</h1>
        </div>
      </div>
    </div>
  </nav>

  <div class="p-3 mt-4">
    <form action="update.php" method="post" enctype="multipart/form-data">
      <?php
      while ($row = mysqli_fetch_array($query)) {
      ?>
        <div class="row align-items-center">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <div class="col-md-6 text-center">
            <img src="../image/foto_menu/<?= $row['foto_menu'] ?>" class="rounded img-fluid symmetrical-img" alt="Foto Profil">
          </div>
          <div class="col-md-6 mb-3" style="justify-content: center; display: flex; margin-top: 10px;">
            <input type="file" class="form-control" style="width: 50%;" id="gambarMakanan" name="foto_menu">
          </div>
          <div class="mb-3">
            <label for="beratMakanan" class="form-label">Kategori</label>
            <select class="form-select" name="kategori_menu">
              <option selected>Pilih Kategori Makanan</option>
              <option value="manis" <?php if ($row['kategori_menu'] == 'manis') echo 'selected'; ?>>Manis</option>
              <option value="asin" <?php if ($row['kategori_menu'] == 'asin') echo 'selected'; ?>>Asin</option>
              <option value="pedas" <?php if ($row['kategori_menu'] == 'pedas') echo 'selected'; ?>>Pedas</option>
              <option value="kerupuk" <?php if ($row['kategori_menu'] == 'kerupuk') echo 'selected'; ?>>Kerupuk</option>
              <option value="biskuit" <?php if ($row['kategori_menu'] == 'biskuit') echo 'selected'; ?>>Biskuit</option>
              <option value="kacang" <?php if ($row['kategori_menu'] == 'kacang') echo 'selected'; ?>>Kacang</option>
              <option value="permen" <?php if ($row['kategori_menu'] == 'permen') echo 'selected'; ?>>Permen</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="namaMakanan" class="form-label">Nama Makanan</label>
            <input type="text" class="form-control" id="namaMakanan" placeholder="Masukkan nama makanan" name="nama_menu" value="<?= $row['nama_menu'] ?>">
          </div>
          <div class="mb-3">
            <label for="hargaMakanan" class="form-label">Harga</label>
            <input type="text" class="form-control" id="hargaMakanan" placeholder="Masukkan harga makanan" name="harga" value="<?= $row['harga'] ?>">
          </div>
          <div class="mb-3">
            <label for="beratMakanan" class="form-label">Penjualan</label>
            <select class="form-select" name="penjualan">
              <option selected>Pilih Penjualan</option>
              <option value="Bungkus" <?php if ($row['penjualan'] == 'Bungkus') echo 'selected'; ?>>Bungkus</option>
              <option value="Berat" <?php if ($row['penjualan'] == 'Berat') echo 'selected'; ?>>Berat</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="hargaMakanan" class="form-label">Berat Makanan</label>
            <input type="text" class="form-control" name="berat_makanan" value="<?= $row['berat_makanan'] ?>">
          </div>
          <div class="mb-3">
            <label for="stokMakanan" class="form-label">Stok</label>
            <select class="form-select" id="stokMakanan" name="stok" required>
              <option value="1" <?php if ($row['stok'] == 1) echo 'selected'; ?>>Tersedia</option>
              <option value="0" <?php if ($row['stok'] == 0) echo 'selected'; ?>>Tidak Tersedia</option>
            </select>
          </div>
          <div div class="d-grid gap-2 col-6 mx-auto mb-3" style="margin-top: 30px;">
            <button class="btn popup__btn " style="background-color: #03C3EC;" type="submit" id="tombolTambah">Simpan</button>
          </div>
        <?php } ?>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>