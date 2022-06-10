<?php

//Localhost
//$konek = mysqli_connect('localhost','root','', 'sutra_salon');

//Website
$konek = mysqli_connect('localhost','qokpseqj_root','satuduatiga', 'qokpseqj_sutra_salon');

//Lolcahost
//$link = 'http://localhost/sutra_salon/';

//Website
$link = 'https://sutrasalon.xyz/';


//Waktu
date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d H:i:s");
if (!isset($_SESSION['date'])) {
	//waktu Login
	$TimeLogin = strtotime(date("d-m-Y H:i:s"));
	//Menyimpan waktu
	$_SESSION['date'] = $TimeLogin;
}
//echo "Waktu di Session : ".$_SESSION['date'];
$sekarang = strtotime(date("d-m-Y H:i:s"));
//echo "<br>Waktu Sekarang : ".$sekarang;
$selisih = $sekarang - $_SESSION['date'];

//Rumus Hitung
$hari = floor($selisih / (60 * 60 * 24));
$jam   = floor($selisih / (60 * 60));
$menit = floor(($selisih - $jam * (60 * 60))/60);

//echo '<br>Waktu Tersisa tinggal: '. $hari .'Hari, '. $jam .  ' jam, ' . $menit . ' menit';
?>