<?php session_start();
  require '../../config/config.php';
  
  if (!isset($_SESSION['username'])) {
  	header("Location:".$link."login/");
  	exit();
  }

  if (isset($_GET['del_trx'])) {
    $id_trx = $_GET['del_trx'];

    //AMBIL DATA DARI TABEL MENCATAT
    $query_mencatat = mysqli_query($konek, "SELECT * FROM mencatat WHERE id_trx = '$id_trx'");
    $data_mencatat = mysqli_fetch_array($query_mencatat);

    $id_hairstylist = $data_mencatat['id_hairstylist'];
    //HAPUS DATA
    $query_melayani = mysqli_query($konek, "DELETE FROM melayani WHERE id_hairstylist = '$id_hairstylist'");
    $query_mencatat = mysqli_query($konek, "DELETE FROM mencatat WHERE id_trx = '$id_trx'");
    $query_trx= mysqli_query($konek, "DELETE FROM trx_pesanan WHERE id_trx = '$id_trx'");

    if ($query_melayani AND $query_mencatat AND $query_trx) {
      setcookie('berhasil','Berhasil Menghapus Data Pesanan',time()+2);
      header("Location:".$link."dashboard/reservation/");
    }else{
      setcookie('gagal','System Error',time()+2);
      header("Location:".$link."dashboard/reservation/");
    }
  }
  //EDIT DATA PESANAN
  if (isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    if (!empty($id) AND !empty($status)) {
      $query = mysqli_query($konek,"UPDATE trx_pesanan SET status = '$status' WHERE id_trx = '$id'");
      setcookie('berhasil','Berhasil Edit Data Pesanan',time()+2);
      header("Location:".$link."dashboard/reservation/");
    }else{
      setcookie('gagal','Data masih ada yang kosong',time()+2);
      header("Location:".$link."dashboard/reservation/");
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
    <link rel="stylesheet" href="../../css/style.css">

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="../../img/favicon.png">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

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
            <img src="<?=$link?>img/user.png" alt="User" class="circle mx-auto d-block mt-3" width="100">
            <div class="text-center"><?= $data['nama_depan']." ".$data['nama_belakang'];?></div>
            <div class="text-center mb-1">(<?= $data['id_user'] ?>)</div>
            <div class="text-center mb-4" style="color:#999;">Terakhir login <?=$jam?> Jam <?=$menit?> Menit yang lalu</div>
            <a href="<?=$link?>dashboard/"><button class="btn btn-opacity text-light" style="width: 100%; background-color:#9b59b6;">Add Reservation</button></a>
          </div>

          <div class="col-md-8 mb-5 ps-4 table-responsive" style="height: 45vh;overflow: scroll;">
            <table class="table table-hover table-light caption-top">
              <?php 
              $id = $data['id_user'];
              $query = mysqli_query($konek, "SELECT * FROM mencatat WHERE id_user = '$id'");
              $jml_dataTRX = mysqli_num_rows($query);
              ?>
              <caption>Jumlah Reservation : <?= $jml_dataTRX ?></caption>
              <thead class="table-warning">
                <th>No Pesanan</th>
                <th>Jadwal</th>
                <th>Waktu Pemesanan</th>
                <th>Layanan</th>
                <th>Hairstylist</th>
                <th>Metode Pembayaran</th>
                <th>Harga</th>
                <th>Aksi</th>
              </thead>
              <?php 
              $query_reservation = mysqli_query($konek, "SELECT * FROM mencatat INNER JOIN user ON user.id_user = mencatat.id_user INNER JOIN treatment ON treatment.id_treatment = mencatat.id_treatment INNER JOIN trx_pesanan ON trx_pesanan.id_trx = mencatat.id_trx WHERE username = '$user' ORDER BY waktu_pemesanan ASC");
              $query_hairstylist = mysqli_query($konek, "SELECT * FROM mencatat INNER JOIN user ON user.id_user = mencatat.id_user INNER JOIN hairstylist ON hairstylist.id_hairstylist = mencatat.id_hairstylist WHERE username = '$user'");
              
              $no = 1;
              while($data_reservation = mysqli_fetch_array($query_reservation)){
                $data_hairstylist = mysqli_fetch_array($query_hairstylist);
              ?>
              <tbody>
                <tr>
                  <td><?= $data_reservation['id_trx'] ?></td>
                  <td><?= $data_reservation['time_trx']; ?></td>
                  <td><?= $data_reservation['waktu_pemesanan']; ?></td>
                  <td><?= $data_reservation['nama_treatment']; ?></td>
                  <td><?= $data_hairstylist['nama_depan']." ".$data_hairstylist['nama_belakang']; ?></td>
                  <td><?= $data_reservation['metode_pembayaran'] ?></td>
                  <td>Rp. <?= number_format($data_reservation['harga'],0,",","."); ?></td>
                  <td>
                    <a href="<?=$link?>dashboard/reservation/edit/hairstylist.php?edit=<?=$data_reservation['id_trx']?>&layanan=<?=$data_reservation['id_treatment']?>">
                      <button type="button" id="Edit" data-bs-toggle="modal" data-bs-target="#Edit" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button></a>
                  </td>
                </tr>
              </tbody>
              <?php 
              $no++;
              }
              ?>
            </table>
          </div>

        </div>


        <!-- BAGIAN ADMIN -->
        <?php 
        if ($data['level'] == 'admin') {
          // TAMPILKAN BAGIAN ADMIN
        ?>
        <div class="row justify-content-center">
          <div class="col mb-5 table-responsive">
            <h5><strong>Tabel Seluruh Transaksi</strong></h5>
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
            <table class="table table-hover table-light caption-top">
              <?php 
              $query = mysqli_query($konek, "SELECT * FROM mencatat");
              $jml_dataTRX_admin = mysqli_num_rows($query);
              ?>
              <caption>Jumlah Reservation : <?= $jml_dataTRX_admin ?></caption>
              <thead class="table-primary">
                <th>No</th>
                <th>No Pesanan</th>
                <th>Nama</th>
                <th>Jadwal</th>
                <th>Waktu Pemesanan</th>
                <th>Layanan</th>
                <th>Hairstylist</th>
                <th>Harga</th>
                <th>Metode Pembayaran</th>
                <th>Status</th>
                <th>Action</th>
              </thead>
              <?php 
              $query_reservation = mysqli_query($konek, "SELECT * FROM mencatat INNER JOIN user ON user.id_user = mencatat.id_user INNER JOIN treatment ON treatment.id_treatment = mencatat.id_treatment INNER JOIN trx_pesanan ON trx_pesanan.id_trx = mencatat.id_trx ORDER BY waktu_pemesanan ASC");
              $query_hairstylist = mysqli_query($konek, "SELECT * FROM mencatat INNER JOIN hairstylist ON hairstylist.id_hairstylist = mencatat.id_hairstylist");
              $no = 1;
              while($data_reservation = mysqli_fetch_array($query_reservation)){
              $data_hairstylist = mysqli_fetch_array($query_hairstylist);
              ?>
              <tbody>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $data_reservation['id_trx'] ?></td>
                  <td><?= $data_reservation['nama_depan']." ".$data_reservation['nama_belakang']; ?></td>
                  <td><?= $data_reservation['time_trx']; ?></td>
                  <td><?= $data_reservation['waktu_pemesanan']; ?></td>
                  <td><?= $data_reservation['nama_treatment'] ?></td>
                  <td><?= $data_hairstylist['nama_depan']." ".$data_hairstylist['nama_belakang']; ?></td>
                  <td>Rp. <?= number_format($data_reservation['harga'],0,",","."); ?></td>
                  <td><?= $data_reservation['metode_pembayaran'] ?></td>
                  <td>
                    <form action="" method="POST">
                      <input type="text" name="id" value="<?=$data_reservation['id_trx']?>" hidden>
                    <select class="form-select" name="status" aria-label="Default select example" onchange="this.form.submit();">
                      <option value="<?=$data_reservation['status']?>"><?=$data_reservation['status']?></option>
                      <option value="BELUM">BELUM</option>
                      <option value="SUDAH">SUDAH</option>
                    </select>
                    </form>
                  </td>
                  <td>
                    <a href="<?=$link?>dashboard/reservation/edit/hairstylist.php?edit=<?=$data_reservation['id_trx']?>&layanan=<?=$data_reservation['id_treatment']?>">
                      <button type="button" id="Edit" data-bs-toggle="modal" data-bs-target="#Edit" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button></a>
                    <strong> | </strong>
                    <a href="<?=$link?>dashboard/reservation/index.php?del_trx=<?=$data_reservation['id_trx']?>"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                  </td>
                </tr>
              </tbody>
              <?php 
              $no++;
              }
              ?>
            </table>
          </div>

        </div>
        <?php
        }
        ?>
        <!-- ==================================================== -->
      </div>
    </div>

    <!-- END ISI -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- J_QUERY -->
    <script src="<?=$link?>js/jquery-3.6.0.min.js"></script>

</body>
</html>