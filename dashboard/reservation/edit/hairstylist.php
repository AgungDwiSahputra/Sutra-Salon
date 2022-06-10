<?php session_start();
  require '../../../config/config.php';
  if (!isset($_SESSION['username'])) {
    header("Location:".$link."login/");
    exit();
  }

  $id_trx = $_GET['edit'];
  $id_treatment = $_GET['layanan'];
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

    <title>Pilih Artist | Sutra Salon</title>
</head>
<body style="background-color:#9b59b6">

    <!-- ISI -->
    <div class="container-fluid rounded">
    <h4 class="text-center text-light mt-4">Silahkan Pilih Perubahan Artis</h4>
    <h6 class="text-center text-light">Batal Perubahan ? 
      <a href="../../reservation">Click Here</a>
    </h6>
    <div class="container mt-5">
        <div class="row justify-content-center">
          <?php
          $query_hairstylist = mysqli_query($konek, "SELECT * FROM hairstylist");
          $query_treatment = mysqli_query($konek, "SELECT * FROM treatment WHERE id_treatment = '$id_treatment'");
          $data_treatment = mysqli_fetch_array($query_treatment);
          while($data_hairstylist = mysqli_fetch_array($query_hairstylist)){
            $data_keahlian = $data_hairstylist['keahlian'];
            $exp_keahlian = explode(',', $data_keahlian);
            foreach ($exp_keahlian as $keahlian){
              if ($keahlian == $data_treatment['nama_treatment']) {
          ?>
          <div class="col-md-4 mb-5">
            <img src="<?=$link?>img/user.png" alt="Maria" class="circle mx-auto d-block" width="150">
            <h4 class="text-center mt-3 text-light"><strong><?=$data_hairstylist['nama_depan']." ".$data_hairstylist['nama_belakang'];?></strong></h4>
            <form action="date.php" method="GET">
              <input type="text" name="edit" value="<?=$id_trx;?>" hidden>
              <input type="text" name="layanan" value="<?=$id_treatment;?>" hidden>
              <input type="text" name="artis" value="<?=$data_hairstylist['id_hairstylist'];?>" hidden>
              <input class="btn btn-Lpage mx-auto d-block" style="background-color: white;" type="submit" name="artisB_kirim" value="Terpilih">
              <input type="text" name="tanggal" value="<?=date('Y-m-d')?>" hidden>
            </form>
          </div>
          <?php 
              }
            }
          } 
          ?>
        </div>
      </div>

    </div>
    <!-- END ISI -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>