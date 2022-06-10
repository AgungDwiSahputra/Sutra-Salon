<?php session_start();
  require '../config/config.php';

  if (!isset($_SESSION['username'])) {
    header("Location:".$link."login/");
    exit();
  }

  if (isset($_GET['pilih'])) {
    $pilih = $_GET['pilih'];
    $query = mysqli_query($konek,"SELECT * FROM treatment WHERE kategori_treatment = '$pilih'");
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

    <title>Hair Treatment | Sutra Salon</title>
</head>
<body style="background-color:#9b59b6">

    <!-- ISI -->
    <h4 class="text-center text-light mt-4">Silahkan Pilih Layanan Anda</h4>
    <h6 class="text-center text-light">Salah memilih Kategori Layanan ? <a href="../dashboard/">Click Here</a></h6>
    <div class="container mt-4">
      <div class="row justify-content-center">
        <?php
        while ($data = mysqli_fetch_array($query)){
        ?>
        <div class="col-md-4 mt-3">
          <div class="container py-4" style="background-color:white;border-radius: 10px;">
            <div class="row">
              <div class="col-6">
                <?php 
                if ($pilih == 'Hair Treatment') {
                  echo '<img src="'.$link.'img/layanan/hair/4.jpg" alt="Hair Treatment" class="img-fluid rounded">';
                }elseif ($pilih == 'Body Treatment') {
                  echo '<img src="'.$link.'img/layanan/body/2.jpg" alt="Body Treatment" class="img-fluid rounded">';
                }elseif ($pilih == 'Makeup') {
                  echo '<img src="'.$link.'img/layanan/makeup/3.jpg" alt="Makeup" class="img-fluid rounded">';
                }
                ?>
                
              </div>

              <div class="col-6" style="margin-top: 50px;">
                <h5><?=$data['nama_treatment'];?></h5>
                <form action="artist.php" method="GET">
                <input type="text" name="pilih" value="<?=$pilih?>" hidden>
                <input type="text" name="layanan" value="<?=$data['id_treatment'];?>" hidden>
                <a href="#"><input class="btn text-light mt-2" type="submit" name="hair_kirim" value="Book Now" style="background-color:#9b59b6;"></a>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php
        } 
        ?>

      </div>
    </div>
    <br>
    <!-- END ISI -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>