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

    <title>Reservation Status | Sutra Salon</title>
</head>
<body style="background-color:#ff9ff3">
    <!-- NAVBAR -->
    <?php
      require '../navbar.php';
    ?>
    <!-- END NAVBAR -->

    <!-- ISI -->
    <div class="container-fluid rounded">
      <h2 class="text-center pt-3 text-light"><strong>RESERVATION STATUS</strong></h2>
      <center><hr width="150" size="5" color="white"></center>
      <div class="container-fluid mt-5">
        <div class="row justify-content-center">

          <div class="col-md-4 mb-5" style="background-color:white;border-radius: 10px;">
            <img src="../../img/team/lee_jung.jpg" alt="" class="circle mx-auto d-block mt-3" width="100">
            <div class="text-center">Lee Jun<br>(1991)</div>
            <div class="text-center mb-3" style="color:#999;">Terakhir login 2 menit yang lalu</div>
            <a href=""><button class="btn btn-opacity mb-3 text-light" style="width: 100%; background-color:#9b59b6;">Add Reservation</button></a>
            <a href=""><button class="btn btn-opacity mb-3 text-light" style="background-color: #ff9ff3; width: 100%">Edit Reservation</button></a>
            <a href=""><button class="btn btn-danger mb-3" style="width: 100%">Delete Reservation</button></a>
          </div>

          <div class="col-md-8 mb-5 ps-4">
            <table class="table table-hover table-light">
              <thead class="table-warning">
                <th>No</th>
                <th>No Pesanan</th>
                <th>Nama</th>
                <th>Jadwal</th>
                <th>Layanan</th>
                <th>Hairstylist</th>
                <th>Harga</th>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>20200803125</td>
                  <td>Lee Jun</td>
                  <td>19 November 2021, 11:30</td>
                  <td>Haircut</td>
                  <td>Selena Gomez</td>
                  <td>IDR 150.000</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>20200803125</td>
                  <td>Lee Jun</td>
                  <td>19 November 2021, 11:30</td>
                  <td>Haircut</td>
                  <td>Selena Gomez</td>
                  <td>IDR 150.000</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>20200803125</td>
                  <td>Lee Jun</td>
                  <td>19 November 2021, 11:30</td>
                  <td>Haircut</td>
                  <td>Selena Gomez</td>
                  <td>IDR 150.000</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <!-- END ISI -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>