<?php
  ob_start();
  session_start();
  require '../../config/config.php'; 
  
  if (!isset($_SESSION['username'])) {
  	header("Location:".$link."login/");
  	exit();
  }

  $user = $_SESSION['username'];
  $ambil = mysqli_query($konek, "SELECT * FROM user WHERE username = '$user'");
  $data = mysqli_fetch_array($ambil);

  //EDIT DATA
  if (isset($_POST['edit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $phone = $_POST['phone'];

    if (empty($email) OR empty($pass) OR empty($phone)) {
      setcookie('gagal', 'Data kurang lengkap', time()+2);
      header("Location:".$link."dashboard/profile/");
    }else{
      $kunci = rand(38273652,99917251621);
      require 'mail.php';
      $_SESSION['kunci'] = $kunci;
      header("Location:".$link."dashboard/profile/");
    }
  }
  
  //Konfirmasi Perubahan
  if(@$_GET['konfir'] == @$_SESSION['kunci']) {
    $id = $data['id_user'];
    $email = @$_GET['e'];
    $pass = @$_GET['p'];
    $phone = @$_GET['n'];
    if (empty($email) OR empty($pass) OR empty($phone)) {
      echo "";
    }else{
      $update = mysqli_query($konek, "UPDATE user SET username = '$email', password = '$pass', no_telp = '$phone' WHERE id_user = '$id'");
        setcookie('berhasil','Data Profile Berhasil di Perbaharui',time()+2);
        unset($_SESSION['kunci']);
        header("Location:".$link."dashboard/profile/");
    }
  }else{
    echo '';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS SENDIRI -->
    <link rel="stylesheet" href="../../css/style.css">

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="../../img/favicon.png">

    <title>Our Team | Sutra Salon</title>
</head>
<body style="background-color:#ff9ff3">
    <!-- NAVBAR -->
    <?php
      require '../navbar.php';
    ?>
    <!-- END NAVBAR -->

    <!-- ISI -->
    <div class="container-fluid rounded">
      <img src="<?=$link?>img/user.png" alt="User" class="circle mx-auto d-block mt-4" width="200">

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <form action="" method="POST">
            <table class="table table-hover table-bordered mt-4 table-light">
              <?php 
              if (isset($_COOKIE['gagal'])){ 
                echo '<div class="alert alert-danger mx-auto" role="alert" style="margin-top:20px;margin-bottom:3px;">'.$_COOKIE['gagal'].'</div>';
              }else if (isset($_COOKIE['berhasil'])){
                echo '<div class="alert alert-success mx-auto" role="alert" style="margin-top:20px;margin-bottom:3px;">'.$_COOKIE['berhasil'].'<div id="msg"></div></div>';
              }
              ?>
              <tr>
                <th>ID</th>
                <td><input class="form-control" type="number" name="id" value="<?= $data['id_user']?>" readonly></td>
              </tr>
              <tr>
                <th>Nama</th>
                <td><input class="form-control" type="text" name="nama" value="<?= $data['nama_depan'].' '.$data['nama_belakang']?>" readonly></td>
              </tr>
              <tr>
                <th>Email</th>
                <td><input class="form-control" type="email" name="email" value="<?= $data['username']?>"></td>
              </tr>
              <tr>
                <th>Password</th>
                <td><input class="form-control" type="text" name="password" value="<?= $data['password']?>"></td>
              </tr>
              <tr>
                <th>Phone</th>
                <td><input class="form-control" type="number" name="phone" value="<?= $data['no_telp']?>"></td>
              </tr>
              <tr>
                <th>Level</th>
                <td><input class="form-control" type="text" name="level" value="<?= $data['level']?>" readonly></td>
              </tr>
            </table>
            <input class="btn btn-Lpage mb-4 text-light" style="width:100%;background-color: #9b59b6;" type="submit" name="edit" value="Edit Akun">
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- END ISI -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>