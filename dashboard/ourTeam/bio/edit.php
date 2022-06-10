<?php session_start();
  require '../../../config/config.php';
  if (!isset($_SESSION['username'])) {
    header("Location:".$link."login/");
    exit();
  }

  $id = $_GET['IDHairstylist'];
  if (isset($_POST['edit'])) {
    $namaD = $_POST['namaD'];
    $namaB = $_POST['namaB'];
    $keahlian = $_POST['keahlian'];

    if (!empty($namaD) AND !empty($namaB) AND !empty($keahlian)) {
      if ($query = mysqli_query($konek, "UPDATE hairstylist SET nama_depan = '$namaD',nama_belakang = '$namaB',keahlian = '$keahlian' WHERE id_hairstylist = '$id'")) {
        setcookie("berhasil","Data Hairstylist Berhasil di Ubah",time()+2);
        header("Location:../bio");
      }else{
        setcookie("gagal","System Error",time()+2);
        header("Location:../bio/edit.php?IDHairstylist=".$id);
      }
    }else{
        setcookie("gagal","Data masih ada yang kosong",time()+2);
        header("Location:../bio/edit.php?IDHairstylist=".$id);
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

    <title>Edit Artist | Admin Sutra Salon</title>
</head>
<body style="background-color:#9b59b6">

    <!-- ISI -->
    <h4 class="text-center text-light mt-4">Edit Data Hairstylist</h4>
    <h6 class="text-center text-light">Kembali 
      <a href="../bio">Click Here</a></h6>
    <div class="container mt-4">
      <div class="row justify-content-center">

        <div class="col-md-6 mt-3 p-5" style="background-color: white;">
          <?php 
            $query_hairstylist = mysqli_query($konek, "SELECT * FROM hairstylist WHERE id_hairstylist = '$id'");
            $data_hairstylist = mysqli_fetch_array($query_hairstylist);
          ?>
          <form action="" method="POST">
            <div class="mb-2"><strong>Nama Depan</strong></div>
            <input type="text" name="namaD" class="form-control mb-3" value="<?=$data_hairstylist['nama_depan']?>">
            <div class="mb-2"><strong>Nama Belakang</strong></div>
            <input type="text" name="namaB" class="form-control mb-3" value="<?=$data_hairstylist['nama_belakang']?>">
            <div class="mb-2"><strong>Keahlian</strong></div>
            <input type="text" name="keahlian" class="form-control mb-3" value="<?=$data_hairstylist['keahlian']?>">
            <input type="submit" name="edit" class="btn btn-opacity mt-5 text-light ms-auto d-block" style="background-color:#9b59b6" value="Edit Hairstylist">
            </form>
        </div>

      </div>
    </div>
    <!-- END ISI -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>