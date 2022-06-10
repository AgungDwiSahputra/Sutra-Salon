<?php session_start();
	require '../../config/config.php';

  	if (!isset($_SESSION['username'])) {
    	header("Location:".$link."login/");
    	exit();
  	}

  	if (isset($_POST['bayar'])) {
  		$metode = $_POST['metode'];
  		$id_trx = $_GET['trx'];

      if (!empty($metode)) {
        if (mysqli_query($konek, "UPDATE trx_pesanan SET metode_pembayaran = '$metode' WHERE id_trx = '$id_trx'")) {
          setcookie("berhasil","Pemesanan berhasil dilakukan...",time()+5);
          header("Location:".$link."dashboard/reservation/");
          exit();
        }else{
          setcookie("gagal","System error",time()+2);
          header("Location:".$link."layanan/pembayaran/index.php?trx=".$id_trx);
        }
      }else{
        setcookie("gagal","Anda belum memilih metode pembayaran",time()+2);
        header("Location:".$link."layanan/pembayaran/index.php?trx=".$id_trx);
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


    <title>Pembayaran | Sutra Salon</title>
</head>
<body style="background-color:#9b59b6">

    <!-- ISI -->
    
    <div class="container mt-2">
      <div class="row justify-content-center">

        <div class="col-md-6 mt-3 p-5" style="background-color: white;">
          <?php 
            if (isset($_COOKIE['gagal'])){ 
              echo '<div class="alert alert-danger mx-auto text-center" role="alert" style="padding: 10px 0 !important;">'.$_COOKIE['gagal'].'</div>';
            }else if (isset($_COOKIE['berhasil'])){
              echo '<div class="alert alert-success mx-auto text-center" role="alert" style="padding: 10px 0 !important;">'.$_COOKIE['berhasil'].'<div id="msg"></div></div>';
            }
          ?>
          <h4 class="text-center text-dark"><strong>Silahkan Pilih Metode Pembayaran</strong></h4>
          <center><hr width="60%" class="mb-4"></center>
          <form action="" method="POST">
          	<!-- BCA -->
          	<input type="radio" class="btn-check" name="metode" id="bca" value="Bank BCA" autocomplete="off">
          	<label class="btn btn-outline-bayar" for="bca">
          	<center>
          	<div class="container">
          		<div class="row p-3 justify-content-center">
          			<div class="col-md-3 me-0 me-md-3">
          				<img src="<?=$link?>img/bank/BCA.png" alt="Bank BCA" class="img-fluid img-bayar">
          			</div>
          			<div class="col mt-2 mt-md-0">
          				<strong>No. Rekening : 8162612254251<br>a/n Khalid Fadlillah</strong>
          			</div>
          		</div>
          	</div>
          	</center>
			</label>

			<!-- BRI -->
          	<input type="radio" class="btn-check" name="metode" id="bri" value="Bank BRI" autocomplete="off">
          	<label class="btn btn-outline-bayar mt-3" for="bri">
          	<center>
          	<div class="container">
          		<div class="row p-3 justify-content-center">
          			<div class="col-md-3 me-0 me-md-3">
          				<img src="<?=$link?>img/bank/BRI.png" alt="Bank BRI" class="img-fluid img-bayar">
          			</div>
          			<div class="col mt-2 mt-md-0">
          				<strong>No. Rekening : 8162612254251<br>a/n Khalid Fadlillah</strong>
          			</div>
          		</div>
          	</div>
          	</center>
			</label>

			<!-- DANA -->
          	<input type="radio" class="btn-check" name="metode" id="dana" value="DANA" autocomplete="off">
          	<label class="btn btn-outline-bayar mt-3" for="dana">
          	<center>
          	<div class="container">
          		<div class="row p-3 justify-content-center">
          			<div class="col-md-3 me-0 me-md-3">
          				<img src="<?=$link?>img/bank/DANA.png" alt="DANA" class="img-fluid img-bayar">
          			</div>
          			<div class="col mt-2 mt-md-0">
          				<strong>No. Rekening : 081286172512<br>a/n Khalid Fadlillah</strong>
          			</div>
          		</div>
          	</div>
          	</center>
			</label>

			<!-- OVO -->
          	<input type="radio" class="btn-check" name="metode" id="ovo" value="OVO" autocomplete="off">
          	<label class="btn btn-outline-bayar mt-3" for="ovo">
          	<center>
          	<div class="container">
          		<div class="row p-3 justify-content-center">
          			<div class="col-md-3 me-0 me-md-3">
          				<img src="<?=$link?>img/bank/OVO.png" alt="OVO" class="img-fluid img-bayar">
          			</div>
          			<div class="col mt-2 mt-md-0">
          				<strong>No. Rekening : 081286172512<br>a/n Khalid Fadlillah</strong>
          			</div>
          		</div>
          	</div>
          	</center>
			</label>
      <div class="text-center text-danger mt-3">*Pembatalan pesanan akan dikenakan biaya 20% dari total biaya</div>
			<input type="submit" name="bayar" value="Bayar" class="btn btn-Lpage text-light mt-4" style="background-color:#9b59b6;width: 100% !important;">

          </form>
        </div>

      </div>
    </div>
    <br>
    <!-- END ISI -->

    <!-- J_QUERY -->
    <script src="<?=$link?>js/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script type="text/javascript">
      //Untuk Mengambil Nilai date dan Waktu
      document.getElementById("konfirmasi").addEventListener("click", tampil);

      function tampil(){
        var tanggal = document.getElementById("tanggal").value;
        var waktu = "";
        if (document.getElementById("btn-check-1").checked) {
          var waktu = document.getElementById("btn-check-1").value;
        }
        if (document.getElementById("btn-check-2").checked) {
          var waktu = document.getElementById("btn-check-2").value;
        }
        if (document.getElementById("btn-check-3").checked) {
          var waktu = document.getElementById("btn-check-3").value;
        }
        if (document.getElementById("btn-check-4").checked) {
          var waktu = document.getElementById("btn-check-4").value;
        }
        if (document.getElementById("btn-check-5").checked) {
          var waktu = document.getElementById("btn-check-5").value;
        }
        if (document.getElementById("btn-check-6").checked) {
          var waktu = document.getElementById("btn-check-6").value;
        }
        if (document.getElementById("btn-check-7").checked) {
          var waktu = document.getElementById("btn-check-7").value;
        }
        document.getElementById("Tanggal").innerHTML='<input type="text" class="form-control" name="tanggal" value="'+tanggal+'" readonly>';
        document.getElementById("Waktu").innerHTML='<input type="text" class="form-control" name="waktu" value="'+waktu+'" readonly>';
      }
      
    </script>

</body>
</html>
