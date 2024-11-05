<?php
require_once '../helper/connection.php';
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Get the plain password from the form

    // Prepared statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ? AND deleted_at IS NULL LIMIT 1");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    if ($row) {
        // Verify password using password_verify()
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = $row;
            header('Location: ../dashboard/index.php');
            exit;
        } else {
            echo "Password salah";
        }
    } else {
        echo "Username tidak ditemukan atau akun sudah dihapus";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
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

    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #03C3EC;
            font-family: 'Poppins', sans-serif;
        }

   

        .container h2 {
            font-size: 24px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            border: 1px solid #03C3EC;
            border-radius: 5px;
            font-size: 16px;
     
        }

        button {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 5px;
            background-color: #03C3EC;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        @media (max-width: 576px){
            #toko-febri{
                margin-top: 27%;
                background-color: #03C3EC;
            }

        }

        @media (min-width: 576px){
            #toko-febri{
                margin-top: 5%;
            }

        }

    </style>

  
  </head>

  <body style=" 
    font-family: 'Poppins',sans-serif;">

    <main >
        <div class="container fixed-top text-center" id="toko-febri" style="color: #ffffff;">
            <h5 style="font-size: 40px; font-weight: bold;">TOKO FEBRI</h5>
        </div>
    </main>

    <div class="fixed-bottom position-fixed shadow-sm flex-nowrap rounded-top-5" style="padding: 20px; background-color: #ffffff; height: 70%;">
            <section class="p-0" style="background-color: #ffffff; padding: -20px;">
                <div class="login-container w-100" style="margin-top: 30px;">
                    <h2 class="text-center" style="color: #03C3EC; font-size: 35px; font-weight: bold;">Login</h2>
                    <form action="#" style="font-size: 20px; margin-top: 40px;" method="post">
                        <div class="form-group">
                            <label for="Username">Username:</label>
                            <input type="username" id="username" style="font-size: 20px;" name="username" required>
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="password">Password:</label>
                            <input type="password" style="font-size: 20px;" id="password" name="password" required>
                        </div>
                        <div class="col-auto d-flex align-items-center mb-3 gap-3" id="btn-keranjang">
                        <button class="btn w-100"style="margin-top: 40px;background-color: #03C3EC;color: #ffffff;font-weight: bold;width: 100%;font-size: 20px;" type="submit" name="submit">Login</button>
                        </div>
                    </form>
                </div>
            </section>
        
    </div>
    

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
