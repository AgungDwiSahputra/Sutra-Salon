<?php session_start();
  require '../../../config/config.php';

  if (!isset($_SESSION['username'])) {
    header("Location:".$link."login/");
    exit();
  }

  //Mengambil data pada GET URL
  if (isset($_GET['artis'])) {
    $id_trx = $_GET['edit'];
    $layanan = $_GET['layanan'];
    $artis = $_GET['artis'];
  }else{
    if (!isset($_GET['id_trx']) OR !isset($_GET['layanan']) OR !isset($_GET['artis'])) {
      header("Location:".$link."dashboard/reservation/edit/hairstylist.php?edit=".$id_trx."&layanan=".$layanan);
    }
  }

  //PROSES PENGAMBILAN DATA DARI TIAP ID (ID TREATMENT dan ID HIARSTYLIST)
  $query_hairstylist = mysqli_query($konek, "SELECT * FROM hairstylist WHERE id_hairstylist = '$artis'");
  $query_treatment = mysqli_query($konek, "SELECT * FROM treatment WHERE id_treatment = '$layanan'");
  $query_trxPesanan = mysqli_query($konek, "SELECT * FROM trx_pesanan WHERE id_trx = '$id_trx'");
  $data_hairstylist = mysqli_fetch_array($query_hairstylist);
  $data_treatment = mysqli_fetch_array($query_treatment);
  $data_trx = mysqli_fetch_array($query_trxPesanan);
  $exp_timetrx = explode(" ", $data_trx['time_trx']);
  //=====================================================

  //PROSES pada saat tombol memesan pada modal di tekan
  if (isset($_POST['memesan'])) {
    //AMBIL DATA DARI POST FORM
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];

    if (!empty($tanggal) AND !empty($waktu)) {
      $query_mencatat = mysqli_query($konek, "UPDATE mencatat SET id_hairstylist = '$artis', id_treatment = '$layanan' WHERE id_trx = '$id_trx'");
      $query_melayani = mysqli_query($konek, "UPDATE melayani SET id_hairstylist = '$artis', id_treatment = '$layanan' WHERE id_treatment = '$layanan'");
      $query_trx = mysqli_query($konek, "UPDATE trx_pesanan SET time_trx = '$tanggal $waktu' WHERE id_trx = '$id_trx'");
      if ($query_mencatat AND $query_melayani AND $query_trx) {
        setcookie("berhasil", "Anda berhasil mengubah data pesanan anda", time()+2);
        header("Location:../");
      }else{
        setcookie("gagal", "System error", time()+2);
        header("Location:".$link."dashboard/reservation/edit/date.php?edit=".$id_trx."&layanan=".$layanan."&artis=".$artis."&tanggal=".$tanggal);
      }
    }else{
      setcookie("gagal", "Data masih ada yang kosong", time()+2);
      header("Location:".$link."dashboard/reservation/edit/date.php?edit=".$id_trx."&layanan=".$layanan."&artis=".$artis."&tanggal=".$tanggal);
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

    <!--TANGGAL -->
    <link rel="stylesheet" href="<?=$link?>css/bootstrap-datepicker.min.css">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" >

    <title>Date Edit | Sutra Salon</title>
</head>
<body style="background-color:#9b59b6">

    <!-- ISI -->
    <h4 class="text-center text-light mt-4">Silahkan Pilih Tanggal Perubahan</h4>
    <h6 class="text-center text-light">Salah memilih Artis ? 
      <a href="
      <?php
        echo $link."dashboard/reservation/edit/hairstylist.php?edit=".$id_trx."&layanan=".$layanan; 
      ?>
      ">Click Here</a></h6>
    <div class="container mt-4">
      <div class="row justify-content-center">

        <div class="col-md-6 mt-3 p-5" style="background-color: white;">
          <?php 
            //NOTIFIKASI
            if (isset($_COOKIE['gagal'])){ 
              echo '<div class="alert alert-danger mx-auto text-center" role="alert" style="padding: 10px 0 !important;">'.$_COOKIE['gagal'].'</div>';
            }else if (isset($_COOKIE['berhasil'])){
              echo '<div class="alert alert-success mx-auto text-center" role="alert" style="padding: 10px 0 !important;">'.$_COOKIE['berhasil'].'<div id="msg"></div></div>';
            }
          ?>
          <form action="" method="GET">
          <input type="text" name="edit" value="<?=$_GET['edit'];?>" hidden>
          <input type="text" name="layanan" value="<?=$_GET['layanan'];?>" hidden>
          <input type="text" name="artis" value="<?=$_GET['artis'];?>" hidden>
            <h5 class="text-dark"><strong>Pilih Tanggal</strong></h5>
            <?php
            //Menonaktifkan Data pada saat jam diatas jam 20:00
            if (date("H") > 20) {
              $DisableDate = date("Y/m/d");
            }else{
              $DisableDate = date("");
            }
            ?>
            <div class="input-group date">
              <input type="text" name="tanggal" id="tanggal" class="form-control" onchange="this.form.submit();" value="<?=$_GET['tanggal'];?>"><span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
            <h5 class="mt-4 text-dark"><strong>Pilih Waktu</strong></h5>
            <center>
              <input type="radio" name="options-outlined" value="09:00" class="btn-check" id="btn-check-1" autocomplete="off">
              <label class="btn btn-outline-purple btn-sm mt-1" for="btn-check-1">9.00 WIB</label>
              <input type="radio" name="options-outlined" value="10:00" class="btn-check" id="btn-check-2" autocomplete="off">
              <label class="btn btn-outline-purple btn-sm mt-1" for="btn-check-2">10.00 WIB</label>
              <input type="radio" name="options-outlined" value="11:00" class="btn-check" id="btn-check-3" autocomplete="off">
              <label class="btn btn-outline-purple btn-sm mt-1" for="btn-check-3">11.00 WIB</label>
              <input type="radio" name="options-outlined" value="13:00" class="btn-check" id="btn-check-4" autocomplete="off">
              <label class="btn btn-outline-purple btn-sm mt-1" for="btn-check-4">13.00 WIB</label>
              <input type="radio" name="options-outlined" value="14:00" class="btn-check" id="btn-check-5" autocomplete="off">
              <label class="btn btn-outline-purple btn-sm mt-1" for="btn-check-5">14.00 WIB</label>
              <input type="radio" name="options-outlined" value="16:00" class="btn-check" id="btn-check-6" autocomplete="off">
              <label class="btn btn-outline-purple btn-sm mt-1" for="btn-check-6">16.00 WIB</label>
              <input type="radio" name="options-outlined" value="20:00" class="btn-check" id="btn-check-7" autocomplete="off">
              <label class="btn btn-outline-purple btn-sm mt-1" for="btn-check-7">20.00 WIB</label>
            </center>
            <!-- Button trigger modal -->
            <button type="button" id="konfirmasi" class="btn btn-Lpage mt-5 text-light ms-auto d-block" data-bs-toggle="modal" data-bs-target="#Modkonfirmasi" style="background-color:#9b59b6">
              Konfirmasi
            </button>
            </form>
        </div>

      </div>
    </div>
    <br>
    <!-- END ISI -->

    <!-- Modal -->
    <div class="modal fade" id="Modkonfirmasi" tabindex="-1" aria-labelledby="konfirmasi" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="konfirmasi">Konfirmasi Edit Pemesanan #<?=$id_trx?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="POST">
          <div class="modal-body">
            <div class="mb-3">
              <label for="Layanan" class="form-label">Layanan</label>
              <input type="text" class="form-control" id="Layanan" name="layanan" value="<?=$data_treatment['nama_treatment']?>" readonly>
            </div>
            <div class="mb-3">
              <label for="Artis" class="form-label">Artis</label>
              <input type="text" class="form-control" id="Artis" name="artis" value="<?=$data_hairstylist['nama_depan'].' '.$data_hairstylist['nama_belakang']?>" readonly>
            </div>
            <div class="mb-3">
              <label for="Tanggal" class="form-label">Tanggal</label>
              <div id="Tanggal"></div>
            </div>
            <div class="mb-3">
              <label for="Waktu" class="form-label">Waktu</label>
              <div id="Waktu"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="memesan" class="btn btn-primary">Edit Pesanan</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- J_QUERY -->
    <script src="<?=$link?>js/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- TANGGAL -->
    <script src="<?=$link?>js/bootstrap-datepicker.min.js"></script>
    <script src="<?=$link?>js/bootstrap-datepicker.id.min.js"></script>
    <script type="text/javascript">
      //Untuk Inputan Date (datepicker)
       $("#tanggal").datepicker({
            format: "yyyy-mm-dd",
            startDate: "-infinite",
            todayBtn: "linked",
            clearBtn: true,
            language: "id"
        });
    </script>
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
    <script type="text/javascript">
      var pilihTanggal = document.getElementById("tanggal").value;
      var tanggalSekarang = '<?= date('Y-m-d') ?>';
      var waktuSekarang = '<?= date('H:i:s') ?>';
      var hariTertentu = '<?= date('D')?>';

      //KONDISI JIKA HARI JUM'AT BUKA JAM 2
      if (hariTertentu == 'Fri') {
        document.getElementById('btn-check-1').disabled = true;
        document.getElementById('btn-check-2').disabled = true;
        document.getElementById('btn-check-3').disabled = true;
        document.getElementById('btn-check-4').disabled = true;
      }
      //KONDISI JIKA HARI MINGGU BUKA JAM 11
      if (hariTertentu == 'Sun' || hariTertentu == 'Sat') {
        document.getElementById('btn-check-1').disabled = true;
        document.getElementById('btn-check-2').disabled = true;
      }
      
      //KONDISI DIMANA TANGGAL SEKARANG DAN JAM SUDAH MELEWATI BATAS JAM TERTENTU AKAN DISABLE
      if (pilihTanggal == tanggalSekarang) {
        if (waktuSekarang > '09:00:00') {
        document.getElementById('btn-check-1').disabled = true;
        }
        if (waktuSekarang > '10:00:00') {
          document.getElementById('btn-check-2').disabled = true;
        }
        if (waktuSekarang > '11:00:00') {
          document.getElementById('btn-check-3').disabled = true;
        }
        if (waktuSekarang > '13:00:00') {
          document.getElementById('btn-check-4').disabled = true;
        }
        if (waktuSekarang > '14:00:00') {
          document.getElementById('btn-check-5').disabled = true;
        }
        if (waktuSekarang > '16:00:00') {
          document.getElementById('btn-check-6').disabled = true;
        }
        if (waktuSekarang > '20:00:00') {
          document.getElementById('btn-check-7').disabled = true;
        }
      }

      <?php 
      $query_trx = mysqli_query($konek, "SELECT * FROM trx_pesanan");
      while($data_trx = mysqli_fetch_array($query_trx)){
        $exp_dataTRX = explode(" ", $data_trx['time_trx']);
      ?>
       var tanggalDipilih = '<?=$exp_dataTRX[0]?>';
       var waktuDipilih = '<?=$exp_dataTRX[1]?>';
       if (pilihTanggal == tanggalDipilih) {
        if (waktuDipilih == '09:00:00') {
          document.getElementById('btn-check-1').disabled = true;
        }else if (waktuDipilih == '10:00:00') {
          document.getElementById('btn-check-2').disabled = true;
        }else if (waktuDipilih == '11:00:00') {
          document.getElementById('btn-check-3').disabled = true;
        }else if (waktuDipilih == '13:00:00') {
          document.getElementById('btn-check-4').disabled = true;
        }else if (waktuDipilih == '14:00:00') {
          document.getElementById('btn-check-5').disabled = true;
        }else if (waktuDipilih == '16:00:00') {
          document.getElementById('btn-check-6').disabled = true;
        }else if (waktuDipilih == '20:00:00') {
          document.getElementById('btn-check-7').disabled = true;
        }
       }

      <?php
      }
      ?>
    </script>

</body>
</html>