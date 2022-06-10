<?php
ob_start();
require '../config/config.php';
session_start();

if (isset($_SESSION['username'])) {
  header("Location:".$link."dashboard/");
  exit();
}

if (isset($_POST['kirim'])) {
	$random = rand(10000,1000000);
	//Untuk Daftar
	$id = $random;
	$namaD = $_POST['namaD'];
	$namaB = $_POST['namaB'];
	$email = $_POST['email'];
	$nomor = $_POST['nomor'];
	$pass = $_POST['password'];
	if (empty($namaD) || empty($namaB) || empty($email) || empty($nomor) || empty($pass)) {
		setcookie("gagal", "Data masih ada yang kosong", time()+2);
		header("Location:".$link."register/");
	}else{
		$queryS_user = "SELECT * FROM user WHERE username = '$email'";
		$queryI_user = "INSERT INTO user VALUES ('$id', '$email', '$pass', '$namaD', '$namaB', '$nomor', 'member', 'NO')";
		$data = mysqli_num_rows(mysqli_query($konek, $queryS_user));
		if ($data > 0) {
			setcookie("gagal", "Email Sudah Digunakan", time()+2);
			header("Location:".$link."register/");
		}else{
			if (mysqli_query($konek, $queryI_user)) {
				require 'mail.php';
				//setcookie("berhasil", "Pendaftaran Berhasil. Lihat Email untuk melakukan Konfirmasi", time()+2);
				header("Location:".$link."register/");
			}
		}
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

    <title>Register | Sutra Salon</title>

</head>
<body>
	<div class="layout_bg">
		<div class="container">
		  	<div class="row">
		  		<div class="col-12">

		  			<div class="card text-center">
						<div class="card-body" style="background:url('../img/watercolor.png');">
							<img class="img-fluid rounded mx-auto d-block mt-3 mb-5" src="../img/Logo[Text Bawah].png" alt="Logo Sutra Salon" width="130px">
						<h5 class="mb-4"><strong>Join Us! Sign Up!</strong></h5>
						<?php 
						if (isset($_COOKIE['gagal'])){ 
						 	echo '<div class="alert alert-danger mx-auto" role="alert" style="max-width: 80%; padding: 10px 0 !important;">'.$_COOKIE['gagal'].'</div>';
	                    }else if (isset($_COOKIE['berhasil'])){
	                    	echo '<div class="alert alert-success mx-auto" role="alert" style="max-width: 80%; padding: 10px 0 !important;">'.$_COOKIE['berhasil'].'<div id="msg"></div></div>';
	                    }
	                    ?>
						<form action="" method="POST" class="mx-5">
							<div class="mb-2">
								<input type="text" name="namaD" class="form-control" placeholder="Nama Depan">
							</div>
							<div class="mb-2">
								<input type="text" name="namaB" class="form-control" placeholder="Nama Belakang">
							</div>
							<div class="mb-2">
								<input type="email" name="email" class="form-control" placeholder="Email">
							</div>
							<div class="mb-2">
								<input type="text" name="nomor" class="form-control" placeholder="Whatsapp">
							</div>
							<div class="mb-2">
								<input type="Password" name="password" class="form-control" placeholder="Password">
							</div>
						    <div class="d-grid mt-4">
						    	<input type="submit" class="btn btn-Lpage" name="kirim" value="Register" style="background-color: #ff9ff3;">
						    </div>
						</form>
						<p class="mt-4 text-center">
							Sudah memiliki akun? <a href="../login/" style="color:#ff9ff3;">Login</a>
						</p>
						</div>
					</div>
		  		</div>
		  	</div>
		  </div>
	</div>

	<script>
        var url = <?= $link?>"dashboard/"; // membuat url tujuan
        var count = 3; // membuat hitungan kedalam detik
        function countDown() {
            if (count > 0) {
                count--;
                var waktu = count + 1;
                $('#msg').html('Anda akan otomatis dialihkan dalam hitungan: ' + waktu + ' detik.'+'<i>');
                setTimeout("countDown()", 1000);
            } else {
                window.location.href = url;
            }
        }
        countDown();
    </script>
</body>
</html>