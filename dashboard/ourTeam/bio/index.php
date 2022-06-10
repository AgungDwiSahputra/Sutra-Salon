<?php session_start();
  require '../../../config/config.php';
  
  if (!isset($_SESSION['username'])) {
  	header("Location:".$link."login/");
  	exit();
  }

  if (isset($_GET['hapusID'])) {
    $id = $_GET['hapusID'];
    if ($query = mysqli_query($konek, "DELETE FROM hairstylist WHERE id_hairstylist = '$id'")) {
      setcookie("berhasil","Data Hairstylist dengan ID ".$id." Berhasil di Hapus",time()+2);
      header("Location:../bio");
    }else{
      setcookie("gagal","Gagal Hapus Data Hairstylist dengan ID ".$id,time()+2);
      header("Location:../bio");
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

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" >

    <title>Biodata Team | Sutra Salon</title>
</head>
<body style="background-color:#ff9ff3">
    <!-- NAVBAR -->
    <?php
      require '../../navbar.php';
    ?>
    <!-- END NAVBAR -->

    <!-- ISI -->
    <div class="container-fluid rounded">
      <h2 class="text-center pt-3 text-light"><strong>BIODATA TEAM</strong></h2>
      <center><hr width="150" size="5" color="white"></center>
      <div class="container mt-5">
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
        <div class="row justify-content-center">
          <?php 
          $query_hairstylist = mysqli_query($konek, "SELECT * FROM hairstylist");
          while($data_hairstylist = mysqli_fetch_array($query_hairstylist)){
          $data_keahlian = $data_hairstylist['keahlian'];
          $exp_keahlian = explode(',', $data_keahlian);
          ?>
          <div class="col-md-6">
            <div class="container card-default p-4 mb-4">
              <div class="row">
                <div class="col-md-3">
                  <img src="<?=$link?>img/user.png" alt="<?= $data_hairstylist['nama_depan']." ".$data_hairstylist['nama_belakang']; ?>" class="circle mx-auto d-block" width="100">
                </div>
                <div class="col-md-6 table-responsive">
                  <table class="table table-hover text-dark">
                    <tr>
                      <th>ID</th>
                      <td>:</td>
                      <td><?= $data_hairstylist['id_hairstylist']; ?></td>
                    </tr>
                    <tr>
                      <th>Nama</th>
                      <td>:</td>
                      <td><?= $data_hairstylist['nama_depan']." ".$data_hairstylist['nama_belakang']; ?></td>
                    </tr>
                    <tr>
                      <th>Skill</th>
                      <td>:</td>
                      <td>
                        <ol>
                        <?php
                        foreach ($exp_keahlian as $keahlian) {
                          echo "<li>".$keahlian."</li>";
                        }
                        ?>
                        </ul>
                      </td>
                    </tr>
                    <tr>
                  </table>
                </div>

                <?php
                if ($data['level'] == 'admin') {
                  //TAMPIL KHUSUS ADMIN
                ?>
                <div class="col-md-3 mb-5 pt-5 ps-3">
                  <a href="edit.php?IDHairstylist=<?=$data_hairstylist['id_hairstylist']?>"><button class="btn btn-warning btn-sm text-light"><i class="fa fa-pencil"></i></button></a> | <a href="../bio/index.php?hapusID=<?=$data_hairstylist['id_hairstylist']?>"><button class="btn btn-danger btn-sm text-light"><i class="fa fa-trash"></i></button></a>
                </div>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
          <?php } ?>

      </div>
      <?php
      if ($data['level'] == 'admin') {
        //TAMPIL KHUSUS ADMIN
      ?>
      <div class="row justify-content-center">
        <div class="col-12">
            <a href="add.php"><button class="btn btn-opacity text-light w-100 mb-4" style="background-color:#9b59b6;">Tambah Hairstylist</button></a>
        </div>
      </div>
      <?php 
      }
      ?>
    </div>
    <!-- END ISI -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
