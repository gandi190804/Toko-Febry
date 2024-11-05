<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Tambah Makanan</title>
  <link rel="stylesheet" href="../css/style.css">
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body style="font-family: Poppins,sans-serif;">
  <nav class="navbar p-3 z-3 shadow-sm position-sticky top-0 start-0 end-0 gap-3 flex-nowrap rounded-bottom-4" style="background-color: #03C3EC;">
    <div class="w-100 d-block">
      <div class="row justify-content-between">
        <div class="col-auto d-flex align-items-center gap-3">
          <a href="index.php" class="text-dark bg-secondary-subtle py-1 px-2 rounded"><i class="fa-solid fa-chevron-left"></i></a>
          <h1 class="m-0" style="font-weight: 600;">Tambah Menu</h1>
        </div>
      </div>
    </div>
  </nav>
  <div class="p-3 mt-4">
    <form action="store.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="gambarMakanan" class="form-label">Gambar</label>
        <input type="file" class="form-control" id="gambar_menu" name="foto_menu">
      </div>
      <div class="mb-3">
        <label for="beratMakanan" class="form-label">Kategori</label>
        <select class="form-select" id="beratMakanan" name="kategori_menu">
          <option selected>Pilih Kategori Makanan</option>
          <option value="manis">Manis</option>
          <option value="asin">Asin</option>
          <option value="pedas">Pedas</option>
          <option value="kerupuk">Kerupuk</option>
          <option value="biskuit">Biskuit</option>
          <option value="kacang">Kacang</option>
          <option value="permen">Permen</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="namaMakanan" class="form-label">Nama Makanan</label>
        <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Masukkan nama makanan">
      </div>
      <div class="mb-3">
        <label for="hargaMakanan" class="form-label">Harga</label>
        <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan harga makanan">
      </div>
      <!-- Sisipkan atribut name untuk select -->
      <div class="mb-3">
        <label for="beratMakanan" class="form-label">Penjualan</label>
        <select class="form-select" id="penjualan" name="penjualan">
          <option selected>Pilih Penjualan</option>
          <option value="Bungkus">Bungkus</option>
          <option value="Berat">Berat</option>
        </select>
      </div>
      <!-- Ganti id dan name pada input untuk berat makanan -->
      <div class="mb-3">
        <label for="beratMakanan" class="form-label">Kuantitas</label>
        <input type="text" class="form-control" id="berat" name="berat_makanan" placeholder="Masukkan kuantitas makanan">
      </div>
      <!-- Ganti id dan name pada select untuk stok -->
      <div class="mb-3">
        <label for="beratMakanan" class="form-label">Stok</label>
        <select class="form-select" id="stok" name="stok">
          <option selected>Pilih Stok</option>
          <option value="tersedia">Tersedia</option>
          <option value="tidak-tersedia">Tidak Tersedia</option>
        </select>
      </div>
      <!-- Ganti id dan name pada input untuk harga makanan -->
      <div class="d-grid gap-2 col-6 mx-auto mb-3" style="margin-top: 30px;">
        <button class="btn popup__btn " style="background-color: #03C3EC;" type="submit" id="tombolTambah">Simpan</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>