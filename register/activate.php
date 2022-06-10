<?php
session_start();
require '../config/config.php';
$t=$_GET['t'];
$sql_cek=mysqli_query($konek,"SELECT * FROM user WHERE id_user='$t' AND aktif='NO'");
$data = mysqli_fetch_array($sql_cek);
//Menghitung Jumlah Data
$jml_data=mysqli_num_rows($sql_cek);
if($jml_data > 0){
 //update data users status aktif
 $aktif = mysqli_query($konek,"UPDATE user SET aktif='YES' WHERE id_user='$t' AND aktif='NO'");
 if($aktif){
 	setcookie('berhasil','Akun Anda telah terverifikasi',time()+2);
 	$_SESSION['username'] = $data['username'];
 	header('Location:../dashboard/');
 }
}else{
//data tidak di temukan
	setcookie('gagal','Gagal Verifikasi. Token tidak di temukan!!!',time()+2);
 	header('Location:../register/');
}

?>