<?php session_start();
  require '../../../config/config.php';
  if (!isset($_SESSION['username'])) {
    header("Location:".$link."login/");
    exit();
  }

  if (isset($_POST['tambah'])) {
    $random = rand(1000000,9999999);
    $namaD = $_POST['namaD'];
    $namaB = $_POST['namaB'];
    $keahlian = $_POST['keahlian'];

    if (!empty($namaD) AND !empty($namaB) AND !empty($keahlian)) {
      if ($query = mysqli_query($konek, "INSERT INTO hairstylist VALUES ('$random','$namaD','$namaB','$keahlian')")) {
        setcookie("berhasil","Data Hairstylist Berhasil di Tambahkan",time()+2);
        header("Location:../bio");
      }else{
        setcookie("gagal","System Error",time()+2);
        header("Location:../bio/add.php");
      }
    }else{
        setcookie("gagal","Data masih ada yang kosong",time()+2);
        header("Location:../bio/add.php");
    }
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
    <link rel="stylesheet" href="<?=$link?>css/style.css">

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="<?=$link?>img/favicon.png">

    <title>Tambah Artist | Admin Sutra Salon</title>
</head>
<body style="background-color:#9b59b6">

    <!-- ISI -->
    <h4 class="text-center text-light mt-4">Tambah Data Hairstylist</h4>
    <h6 class="text-center text-light">Kembali 
      <a href="../bio">Click Here</a></h6>
    <div class="container mt-4">
      <div class="row justify-content-center">

        <div class="col-md-6 mt-3 p-5" style="background-color: white;">
          <?php 
            if (isset($_COOKIE['gagal'])){ 
              echo '<div class="alert alert-danger mx-auto text-center" role="alert" style="padding: 10px 0 !important;">'.$_COOKIE['gagal'].'</div>';
            }else if (isset($_COOKIE['berhasil'])){
              echo '<div class="alert alert-success mx-auto text-center" role="alert" style="padding: 10px 0 !important;">'.$_COOKIE['berhasil'].'<div id="msg"></div></div>';
            }
          ?>
          <form action="" method="POST">
            <div class="mb-2"><strong>Nama Depan</strong></div>
            <input type="text" name="namaD" class="form-control mb-3">
            <div class="mb-2"><strong>Nama Belakang</strong></div>
            <input type="text" name="namaB" class="form-control mb-3">
            <div class="mb-2"><strong>Keahlian</strong></div>
            <input type="text" name="keahlian" class="form-control mb-3">
            <input type="submit" name="tambah" class="btn btn-opacity mt-5 text-light ms-auto d-block" style="background-color:#9b59b6" value="Tambah Hairstylist">
            </form>
        </div>

      </div>
    </div>
    <!-- END ISI -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>