<?php
session_start();
require_once '../helper/connection.php';

// Ambil id_pencatatan dari URL
$id_pencatatan = $_GET['id'];

$query = "
    SELECT 
        m.nama_menu, m.foto_menu, c.tanggal, p.hasil, p.tanggal, c.deleted_at
    FROM 
        pengeluaran p
    JOIN 
        users u ON p.id_user = u.id
    JOIN 
        cart_pengeluaran c ON u.id = c.id_user
    JOIN 
        menus m ON c.id_menu = m.id
    WHERE 
        p.id = ? AND p.tanggal = c.deleted_at
";

$stmt = $connection->prepare($query);
$stmt->bind_param('i', $id_pencatatan);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

$stmt->close();
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Detail</title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- fontawesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

  
  </head>

  <body style=" 
    font-family: 'Poppins',sans-serif;">
    <nav class="navbar z-3 shadow-sm p-3 position-sticky top-0 start-0 end-0 gap-3 flex-nowrap rounded-bottom-4" style="background-color: #03C3EC;">
      <div class="w-100 d-block">
        <div class="row justify-content-between">

          <div class="col-auto d-flex align-items-center gap-3">
            <a href="./riwayat/riwayat-keluar.php" class="text-dark bg-secondary-subtle py-1 px-2 rounded"
              ><i class="fa-solid fa-chevron-left"></i></a>
              <h1 class="m-0">Detail<h1>
          </div>
        </div>
      </div>
    </nav>

    <main >
        <div class="p-3" style="margin-top: 30px;">
        <?php if (!empty($items)) : ?>
            <?php foreach ($items as $item) : ?>
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4 p-0 d-flex align-items-center justify-content-center">
                            <img src="../image/foto_menu/<?php echo $item['foto_menu'] ?>" id="img-keranjang" class="rounded p-2" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body1">
                                <h2 class="card-title"><?php echo $item['nama_menu']; ?></h2>
                                <h3 class="card-text" style="color: black;">
                                    <small class="text-angka mt-3">
                                        Rp<?php echo number_format($item['hasil'], 0, ',', '.'); ?>
                                    </small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Tidak ada detail pesanan.</p>
        <?php endif; ?> 
        </div>

 
    </main>


    

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

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
