<?php session_start();
  require '../config/config.php';
  if (!isset($_SESSION['username'])) {
    header("Location:".$link."login/");
    exit();
  }

  if (isset($_GET['layanan'])) {
    $pilih = $_GET['pilih'];
    $layanan = $_GET['layanan'];
  }else{
    if (!isset($_GET['pilih']) OR !isset($_GET['layanan'])) {
      header("Location:".$link."layanan/hair/index.php?pilih=".$pilih);
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
    <link rel="stylesheet" href="../css/style.css">

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="../img/favicon.png">

    <title>Pilih Artist | Sutra Salon</title>
</head>
<body style="background-color:#9b59b6">

    <!-- ISI -->
    <div class="container-fluid rounded">
	  <h4 class="text-center text-light mt-4">Silahkan Pilih Artist Anda</h4>
	  <h6 class="text-center text-light">Salah memilih layanan ? 
	  	<a href="
	  	<?php
      echo $link."layanan/index.php?pilih=".$pilih;
	  	/*if(isset($_GET['body_kirim'])){
	  	?>
	  	body/
	  	<?php
	  	}elseif(isset($_GET['hair_kirim'])){
	  	?>
	  	hair/?
	  	<?php
	  	}elseif(isset($_GET['makeup_kirim'])){
	  	?>
	  	makeup/
	  	<?php
	  	} */
	  	?>
	  	">Click Here</a></h6>
	  <div class="container mt-5">
        <div class="row justify-content-center">
          <?php
          $query_hairstylist = mysqli_query($konek, "SELECT * FROM hairstylist");
          $query_treatment = mysqli_query($konek, "SELECT * FROM treatment WHERE id_treatment = '$layanan'");
          $data_treatment = mysqli_fetch_array($query_treatment);
          while($data_hairstylist = mysqli_fetch_array($query_hairstylist)){
            $data_keahlian = $data_hairstylist['keahlian'];
            $exp_keahlian = explode(',', $data_keahlian);
            foreach ($exp_keahlian as $keahlian){
              if ($keahlian == $data_treatment['nama_treatment']) {
          ?>
		      <div class="col-md-4 mb-5">
            <img src="../img/user.png" alt="Artis" class="circle mx-auto d-block" width="150">
            <h4 class="text-center mt-3 text-light"><strong><?=$data_hairstylist['nama_depan']." ".$data_hairstylist['nama_belakang'];?></strong></h4>
            <form action="date.php" method="GET">
              <input type="text" name="pilih" value="<?=$pilih;?>" hidden>
              <input type="text" name="layanan" value="<?=$layanan;?>" hidden>
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