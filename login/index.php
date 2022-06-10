<?php
ob_start();
session_start();
require '../config/config.php';

if (isset($_SESSION['username'])) {
  header("Location:".$link."dashboard/");
  exit();
}

if(isset($_POST['kirim'])) {
  $user = $_POST['email'];
  $pass = $_POST['pass'];
  $ambil = mysqli_query($konek, "SELECT * FROM user WHERE username = '$user'");
  $data = mysqli_fetch_array($ambil);
  $jum_data = mysqli_num_rows($ambil);

  if (empty($user) OR empty($pass)) {
    setcookie("gagal", "Data masih ada yang kosong", time()+2);
    header("Location:".$link."login/");
  }elseif ($data['aktif'] == 'NO') {
    setcookie("gagal", "Akun belum terverifikasi, Kontak Admin <a href='https://api.whatsapp.com/send?phone=+6281298623982'>081298623982</a>", time()+2);
    header("Location:".$link."login/");
  }else{
    if ($jum_data > 0) {
        if ($pass == $data['password']){
          $_SESSION['username'] = $user;
          setcookie("berhasil", "Login Berhasil..., Selamat datang di Website Sutra Salon", time()+2);
          header("Location:".$link."dashboard/");
          exit();
        }else{
            setcookie("gagal", "Email/Password salah", time()+2);
            header("Location:".$link."login/");
        }
    }else{
      setcookie("gagal", "Email/Password salah", time()+2);
      header("Location:".$link."login/");
    }
  }

}

if (isset($_POST['LupaPass'])) {
  $random = rand(10000,1000000);
  $email = $_POST['email'];
  $ambil = mysqli_query($konek, "SELECT * FROM user WHERE username = '$email'");
  $data = mysqli_fetch_array($ambil);
  $jum_data = mysqli_num_rows($ambil);

  if ($jum_data > 0) {
    $id = $data['id_user'];
    if (mysqli_query($konek, "UPDATE user SET password = '$random' WHERE id_user = '$id'")) {
      require 'mail.php';
      header("Location:".$link."login/");
    }
  }else{
    setcookie('gagal','Email tidak ditemukan',time()+2);
    header("Location:".$link."login/");
  }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS SENDIRI -->
    <link rel="stylesheet" href="<?= $link?>css/style.css">

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="<?= $link?>img/favicon.png">

    <title>Login | Sutra Salon</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row full-layar">
        <!-- FORM LOGIN -->
        <div class="col-md-4" style="background-color:#9b59b6;">
          <div class="container mt-5 p-5">
            <img class="img-fluid rounded mx-auto d-block mb-5" src="<?= $link?>img/Logo[Text Bawah](Putih).png" alt="Logo Sutra Salon" width="160px">
            <?php if (isset($_COOKIE['gagal'])){ ?>
              <div class="alert alert-danger mx-auto" role="alert">
                <?= $_COOKIE['gagal'] ?>
              </div>
            <?php }else if (isset($_COOKIE['berhasil'])){ ?>
              <div class="alert alert-success mx-auto" role="alert">
                <?= $_COOKIE['berhasil'] ?>
              </div>
            <?php } ?>
          <form action="" method="POST">
            <div class="mb-3">
              <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="pass" placeholder="Password">
            </div>
            <div class="d-grid mx-auto mt-4">
              <input type="submit" name="kirim" class="btn" style="background-color: #ff9ff3;" value="Login">
            </div>
          </form>
          <p class="mt-4 text-center" style="color: white;">
            Belum memiliki akun? <a href="../register/" style="color:#ff9ff3;">Register</a><br>
            <!-- Link pemanggil pop-up -->
            <a href="lp_password" data-bs-toggle="modal" data-bs-target="#lupaPassword" style="color:#ff9ff3;"> Lupa Password ?</a>
          </p>
          </div>
        </div>
        <!-- AKHIR FORM LOGIN -->

        <!-- About US -->
        <div class="col-md-8 mt-5 mt-md-0" style="background:url('../img/watercolor.png');">
          <h3 class="text-center mt-5"><strong>About Us</strong></h3>
          <div class="container px-5 mt-3 mt-md-5">
            <div class="row">
              <div class="col-md-6">
                <p class="text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident, fuga, voluptates voluptatem iste labore eum commodi aut ex reiciendis distinctio architecto sequi, quos possimus. Corrupti quisquam tempora, harum praesentium vel minima, culpa quibusdam facilis perspiciatis temporibus deserunt incidunt, animi eaque dolore, cum. Sint laboriosam non iusto nisi aliquam at architecto quos officiis sequi cumque nesciunt ea saepe hic, porro nobis nostrum debitis possimus dignissimos id doloribus obcaecati facilis omnis rerum laborum! Quibusdam rem, fugiat qui maxime saepe dolor voluptate illo ratione, cupiditate. </p>
              </div>

              <div class="col-md-6 mt-3 mt-md-0 mb-3 ">
                <img src="../img/about_us/kanan.jpg" class="img-fluid rounded mx-auto d-block" width="300px">
              </div>

            </div>
          </div>
        </div>
        <!-- Akhir About Us -->
      </div>
    </div>            

    <!-- pop-up Lupa Password-->
    <div class="modal fade" id="lupaPassword" tabindex="-1" aria-labelledby="LupaPassword" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="border: none;">
          <div class="modal-header" style="background-color: #9b59b6;">
            <h5 class="modal-title" id="LupaPasword" style="color: white;"><strong>Lupa Password</strong></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Masukan Email yang telah terdaftar pada Website Sutra Salon untuk mereset password Anda
            <form action="" method="POST">
              <input type="email" name="email" class="form-control mt-4 mb-2" placeholder="Email">
              <input type="submit" class="btn" name="LupaPass" value="Send" style="background-color: #9b59b6;color: white;">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Akhir Pop-up -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>