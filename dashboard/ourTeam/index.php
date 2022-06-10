<?php session_start();
  require '../../config/config.php';
  
  if (!isset($_SESSION['username'])) {
  	header("Location:".$link."login/");
  	exit();
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
      <h2 class="text-center pt-3 text-light"><strong>OUR TEAM</strong></h2>
      <center><hr width="150" size="5" color="white"></center>
      <div class="container mt-5">
        <div class="row justify-content-center">
          <?php 
          $query_hairstylist = mysqli_query($konek, "SELECT * FROM hairstylist");
          while($data = mysqli_fetch_array($query_hairstylist)){
          ?>
          <div class="col-md-4 mb-3 bg-light mx-2 p-4">
            <img src="<?=$link?>img/user.png" alt="Shawn" class="mx-auto d-block" width="100">
            <h4 class="text-center mt-3 text-dark"><strong><?=$data['nama_depan']." ".$data['nama_belakang']?></strong></h4>
          </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <!-- END ISI -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>