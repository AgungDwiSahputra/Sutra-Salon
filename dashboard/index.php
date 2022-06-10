<?php session_start();
  require '../config/config.php';
  
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
    <link rel="stylesheet" href="../css/style.css">

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="../img/favicon.png">

    <title>Dashboard | Sutra Salon</title>
</head>
<body style="background-color:#ff9ff3">
	  <!-- NAVBAR -->
    <?php
      require 'navbar.php';
    ?>
    <!-- END NAVBAR -->

    <!-- LIST AWAL -->
    <div class="container-fluid mt-3" style="min-height: 100px !important;">
    	<div class="row">
    		<div class="col-md-6">
    			<div class="container p-4" style="background-color:white;border-radius: 10px;">
    				<div class="row">
              <?php 
                if (isset($_COOKIE['gagal'])){ 
                  echo '<div class="alert alert-danger mx-auto alert-dismissible fade show" role="alert" style="padding: 10px 0 !important;"><span class="ms-3">'.$_COOKIE['gagal'].'</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 15px !important;"></button>
              </div>';
                }else if (isset($_COOKIE['berhasil'])){
                  echo '<div class="alert alert-success mx-auto alert-dismissible fade show" role="alert" style="padding: 10px 0 !important;"><span class="ms-3">'.$_COOKIE['berhasil'].'</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 15px !important;"></button>
              </div>';
                }
              ?>
    					<div class="col-4" >
    						<img src="<?=$link?>img/user.png" alt="User" class="circle mx-auto d-block" width="100">
    						<div class="text-center"><?= $data['nama_depan']." ".$data['nama_belakang'];?></div>
    						<div class="text-center mb-2">(<?= $data['id_user'] ?>)</div>
    						<div class="text-center" style="color:#999;">Terakhir login <?=$jam?> Jam <?=$menit?> Menit yang lalu</div>
    					</div>
    					
    					<div class="col-8">
    						<div class="mt-4">Hai <?= $data['nama_depan']." ".$data['nama_belakang'];?>, Apa yang bisa kami bantu hari ini? Reservasi layanan mu sekarang!</div>
    					</div>
    				</div>
    			</div>
    		</div>

    		<div class="col-md-6 py-2 mt-md-0 mt-3">
    			<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
	                <div class="carousel-inner">
	                  <div class="carousel-item active">
	                    <img src="../img/dashboard/carousel/1.jpg" class="d-block" width="100%" alt="...">
	                  </div>
	                  <div class="carousel-item">
	                    <img src="../img/dashboard/carousel/2.jpg" class="d-block" width="100%" alt="...">
	                  </div>
	                  <div class="carousel-item">
	                    <img src="../img/dashboard/carousel/3.jpg" class="d-block" width="100%" alt="...">
	                  </div>
	                </div>
	                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
	                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	                  <span class="visually-hidden">Previous</span>
	                </button>
	                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
	                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
	                  <span class="visually-hidden">Next</span>
	                </button>
              	</div>
    		</div>
    	</div>
    </div>
    <!-- END LIST -->

    <!-- LIST KEDUA -->
    <div class="container-fluid my-4 text-dark text-center">
    	<div class="row">
    		<div class="col-md-4" style="display: flex !important;">
    			<div class="container py-4" style="background-color:white;border-radius: 10px;">
    				<div class="row">
    					<div class="col-6">
    						<img src="../img/reservation/reservation1.jpg" alt="" class="img-fluid rounded">
    					</div>
    					<div class="col-6" style="margin-top: 80px;">
    						<h5>HAIR TREATMENT</h5>
                <form action="../layanan/index.php" method="GET">
                <input type="text" name="pilih" value="Hair Treatment" hidden>
    						<a href=""><button class="btn text-light mt-2" style="background-color:#9b59b6;">Click Here</button></a>
                </form>
    					</div>
    				</div>
    			</div>
    		</div>
        
    		<div class="col-md-4 mt-md-0 mt-3">
    			<div class="container py-4" style="background-color:white;border-radius: 10px;">
    				<div class="row">
    					<div class="col-6">
    						<img src="../img/reservation/reservation2.jpg" alt="" class="img-fluid rounded">
    					</div>

    					<div class="col-6" style="margin-top: 80px;">
    						<h5>BODY TREATMENT</h5>
                <form action="../layanan/index.php" method="GET">
                <input type="text" name="pilih" value="Body Treatment" hidden>
    						<a href=""><button class="btn text-light mt-2" style="background-color:#9b59b6;">Click Here</button></a>
                </form>
    					</div>
    				</div>
    			</div>
    		</div>

    		<div class="col-md-4 mt-md-0 mt-3">
    			<div class="container py-4" style="background-color:white;border-radius: 10px;">
    				<div class="row">
    					<div class="col-6">
    						<img src="../img/reservation/reservation3.jpg" alt="" class="img-fluid rounded">
    					</div>

    					<div class="col-6" style="margin-top: 80px;">
    						<h5>MAKE UP</h5>
    						<form action="../layanan/index.php" method="GET">
                <input type="text" name="pilih" value="Makeup" hidden>
                <a href=""><button class="btn text-light mt-2" style="background-color:#9b59b6;">Click Here</button></a>
                </form>
    					</div>
    				</div>
    			</div>
    		</div>

    	</div>
    </div>
    <!-- END LIST -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>