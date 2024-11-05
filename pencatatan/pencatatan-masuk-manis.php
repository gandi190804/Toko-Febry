<?php
session_start();
require_once '../helper/connection.php';

// Tangkap parameter kategori_menu dari URL
$kategori = $_GET['kategori'] ?? '';

function tampilkanMenu($connection, $kategori)
{
  $query = "SELECT * FROM menus WHERE kategori_menu = ? AND deleted_at IS NULL"; // Menambahkan kondisi deleted_at IS NULL
  $stmt = $connection->prepare($query);
  $stmt->bind_param('s', $kategori);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $stokTersedia = $row['stok'] == 1;
      $cardClass = $stokTersedia ? 'card-barang2' : 'card-barang not-available';
      $buttonClass = $stokTersedia ? 'btn-info' : 'btn-secondary disabled';

      echo "<div id='swiper-slide' class='p-2 col-6 col-sm-6 col-md-4 col-xl-3 mb-4'>";
      echo "<div class='$cardClass p-0 border rounded'>";
      echo "<img src='../image/foto_menu/" . htmlspecialchars($row['foto_menu']) . "' class='card-img rounded-top' alt=''>";
      echo "<div class='card-body d-flex flex-column justify-content-center lg:mt-3 p-3'>";
      echo "<h2 class='card-title text-start text-truncate' style='font-weight: 600;'>" . htmlspecialchars($row['nama_menu']) . "</h2>";
      if ($row['penjualan'] == 'Berat') {
        echo '<p class="card-text text-start text-truncate" style="margin-top: -0%;">Rp' . htmlspecialchars($row['harga']) . ' (' . htmlspecialchars($row['berat_makanan']) . ' gram)</p>';
      } elseif ($row['penjualan'] == 'Bungkus') {
        echo '<p class="card-text text-start text-truncate" style="margin-top: -0%;">Rp' . htmlspecialchars($row['harga']) . ' (Bungkus)</p>';
      }
      echo "<p class='card-text text-start text-truncate' style='margin-top: -5%; color: #03C3EC;'>" . ($stokTersedia ? 'Tersedia' : 'Tidak Tersedia') . "</p>";
      echo "<a href='get-menu-id.php?id=" . htmlspecialchars($row['id']) . "' class='btn $buttonClass text-white btn-sm rounded-pill px-3 w-100 btn-detail' data-bs-toggle='modal' data-bs-target='#exampleModal' data-id='" . htmlspecialchars($row['id']) . "'>Tambah</a>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }
  } else {
    echo "Tidak ada menu dalam kategori ini.";
  }

  $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Menu</title>
  <link rel="stylesheet" href="../css/style.css">
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    body {
      font-family: "Poppins", sans-serif;
    }


    .swiper-slide {
      width: max-content;
      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }


    .swiper-container {
      /* Tambahkan properti berikut */
      overflow: hidden;
      position: relative;
      width: 100%;
      margin: 0 auto;
      /* Tambahkan style flex untuk menempatkan swiper-wrapper secara horizontal */
      display: flex;
    }

    .swiper-wrapper {
      /* Tambahkan style flex untuk menyusun swiper-slide secara horizontal */
      display: flex;
      transition: transform 0.3s ease;
    }


    .swiper-slide1 {
      width: 200px;
    }

    .card-img-top {
      width: 100%;
      height: auto;
      aspect-ratio: 1/1;
      /* Membuat gambar persegi */
      object-fit: cover;
      /* Mengisi ruang gambar */
    }
  </style>
</head>

<body>
  <nav class="navbar z-3 shadow-sm position-sticky top-0 start-0 end-0 gap-3 flex-nowrap rounded-bottom-4" style="background-color: #03C3EC;">
    <div class="py-1 mx-3 w-100 d-block">
      <div class="row justify-content-between">

        <div class="col-auto d-flex align-items-center gap-3">
          <a href="./pencatatan-masuk.php" class="text-dark bg-secondary-subtle py-1 px-2 rounded"><i class="fa-solid fa-chevron-left"></i></a>
          <h1 class="m-0" style="font-weight: 600;"><?= ucwords($kategori) ?></h1>
        </div>

        <div class="col-auto d-flex align-items-center">
          <a href="../cart/cart.php" class="text-dark bg-secondary-subtle py-1 px-2 rounded"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
      </div>
      <div class="row pt-3 justify-content-center">
        <form class="col-12 col-sm-6 col-xl-5 w-100" role="search">
          <input class="form-control form-control-sm bg-secondary-subtle" type="search" placeholder="Search" aria-label="Search" id="searchInput" />
        </form>
      </div>
    </div>
  </nav>

  <main>
    <div class="row mt-3 px-2 mx-0">
      <?php
      tampilkanMenu($connection, $kategori);
      ?>
    </div>
  </main>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" style="font-weight: 600;" id="exampleModalLabel">Menu</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalButton"></button>
        </div>
        <div class="container" style="margin-top: 10px;">
          <div class="row">
            <div class="col-md-6">
              <div class="bg-primary p-0 d-flex align-items-center justify-content-center">
                <img id="img-menu" src="../image/donut.avif" class="w-100 img-mobile" alt="...">
              </div>
            </div>
            <div class="col-md-6">
              <div class="p-3 d-flex align-items-center justify-content-between flex-wrap">
                <h2 id="nama_menu" class="card-title text-start text-truncate" style="font-weight: 600; font-size: 20px;">Astor Coklat</h2>
              </div>
              <div class="p-3 container border-bottom">
                <h3 id="penjualan" class="text-black"></h3>
              </div>
              <div class=" p-lg-4 p-3 ps-4 d-flex mt-1">
                <div class="justify-content-between">
                  <h4>
                    <span id="berat_makanan"></span>
                  </h4>
                </div>
                <h4 id="harga" style="margin-left: 190px;"><span id="hargaMenu"></span></h4>
              </div>
              <div class="p-3 container border-top">
                <h3 id="stok" style="color: #03C3EC;"><span id="statusMenu"></span></h3>
              </div>
            </div>
          </div>
          <div id="jumlahpesanan" class="d-grid gap-2 col-6 mx-auto fixed-bottom" style="margin-bottom: 30px;">
            <div id="jumlahpesanan1" class="d-flex align-items-center w-100 justify-content-between">
              <p>Jumlah Pesanan</p>
              <div class="d-flex align-items-center gap-2">
                <i class='bx bxs-minus-circle' style="color: #03C3EC; font-size: 2rem;"></i>
                <p class="mt-3" id="peritem">1</p>
                <i class='bx bxs-plus-circle' style="color: #03C3EC; font-size: 2rem;"></i>
              </div>
            </div>
            <a>
              <button class="btn" id="tambahButton" style="background-color: #03C3EC;" type="button">Tambah</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const detailButtons = document.querySelectorAll('.btn-detail');
      const modalTitle = document.querySelector('#nama_menu');
      const modalImg = document.querySelector('#img-menu');
      const penjualanContainer = document.querySelector('#penjualan');
      const hargaContainer = document.querySelector('#harga');
      const statusContainer = document.querySelector('#stok');
      const beratContainer = document.querySelector('#berat_makanan');

      let jumlahPesanan = 1; // jumlah pesanan awal
      detailButtons.forEach(button => {
        button.addEventListener('click', function() {
          const productId = this.getAttribute('data-id');
          getMenuInfo(productId)
            .then(menu => {
              modalTitle.textContent = menu.nama_menu;
              modalImg.src = '../image/foto_menu/' + menu.foto_menu;
              if (menu.penjualan === 'Berat') {
                penjualanContainer.textContent = 'Harga ' + menu.penjualan + ' per-gram';
                beratContainer.textContent = menu.berat_makanan + ' gram';
              } else if (menu.penjualan === 'Bungkus') {
                penjualanContainer.textContent = 'Harga per-' + menu.penjualan;
                beratContainer.textContent = menu.berat_makanan + ' bungkus';
              }
              hargaContainer.textContent = 'Rp' + menu.harga;
              statusContainer.textContent = menu.stok == 1 ? 'Tersedia' : 'Tidak Tersedia';

              const tambahButton = document.querySelector('#tambahButton');
              tambahButton.addEventListener('click', function() {
                tambahkanKeKeranjang(productId);
              });

              function tambahkanKeKeranjang(productId) {
                const jumlahPesanan = document.querySelector('#peritem').textContent;

                const data = new FormData();
                data.append('id_menu', productId);
                data.append('banyak_item', parseInt(jumlahPesanan));
                data.append('total_harga', parseInt(jumlahPesanan) * parseInt(menu.harga));

                fetch('store-cart.php', {
                    method: 'POST',
                    body: data
                  })
                  .then(response => response.json())
                  .then(data => {
                    if (data.status === 'success') {
                      alert('Pesanan berhasil ditambahkan!');
                    } else {
                      alert('Gagal menambahkan pesanan!');
                    }
                  })
                  .catch(error => {
                    console.error('Error:', error);
                    console.log('Error adding to cart:', error);
                  });
              }

              document.querySelector('.bxs-plus-circle').addEventListener('click', function() {
                jumlahPesanan++; // Tingkatkan jumlah pesanan
                updateHarga(); // Panggil fungsi untuk memperbarui harga
              });

              // Event listener untuk tombol minus
              document.querySelector('.bxs-minus-circle').addEventListener('click', function() {
                if (jumlahPesanan > 1) {
                  jumlahPesanan--; // Kurangi jumlah pesanan jika lebih dari 1
                  updateHarga(); // Panggil fungsi untuk memperbarui harga
                }
              });

              document.querySelector('#closeModalButton').addEventListener('click', function() {
                jumlahPesanan = 0;
                document.querySelector('#peritem').textContent = 1;
              });

              function updateHarga() {
                document.querySelector('#peritem').textContent = jumlahPesanan;
                const totalHarga = menu.harga * jumlahPesanan;
                hargaContainer.textContent = 'Rp' + totalHarga.toFixed(2); // Menampilkan total harga dengan format Rp
              }

            })
            .catch(error => console.error('Error:', error));
        });
      });

      function getMenuInfo(productId) {
        return new Promise((resolve, reject) => {
          const xhr = new XMLHttpRequest();
          xhr.open('GET', `get-menu-id.php?id=${productId}`, true);
          xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
              const menuInfo = JSON.parse(xhr.responseText);
              resolve(menuInfo);
            } else {
              reject(xhr.statusText);
            }
          };
          xhr.onerror = function() {
            reject(xhr.statusText);
          };
          xhr.send();
        });
      }
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchForm = document.querySelector('form[role="search"]');
      const searchInput = document.getElementById('searchInput');
      const swiperSlides = document.querySelectorAll('#swiper-slide');

      function updateSwiperSlides(searchText) {
        swiperSlides.forEach(slide => {
          const cardTitle = slide.querySelector('.card-title');
          if (cardTitle) {
            const menuName = cardTitle.textContent.toLowerCase();
            if (menuName.includes(searchText)) {
              slide.style.display = 'block';
            } else {
              slide.style.display = 'none';
            }
          }
        });
      }

      searchForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const searchText = searchInput.value.toLowerCase();
        updateSwiperSlides(searchText);
      });

      searchInput.addEventListener('input', function() {
        const searchText = searchInput.value.toLowerCase();
        updateSwiperSlides(searchText);
      });
    });
  </script>

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
</body>

</html>