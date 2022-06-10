<?php 
session_start();
require '../config/config.php';
session_destroy();
header("Location:".$link."login/");
exit();
?>