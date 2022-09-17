<?php
include '../../servicios/conexion.php';

session_start();

//if(!isset($_GET["client"])) return;
$cedd = $_GET["client"];

$consultarcli=mysqli_query($con, "SELECT  * from cliente WHERE cedula = $cedd");
$resul=mysqli_fetch_assoc($consultarcli);

$consultarcli2 = mysqli_query($con,"SELECT  COUNT(*) AS conteo from cliente WHERE cedula = $cedd");
$rows = mysqli_fetch_array($consultarcli2);

if ($rows['conteo']>0) {
	$_SESSION['clie'] = $resul;
	header("Location: ./crearventa.php?status=6");
}else{
	header("Location: ./crearventa.php?status=7");
}



?>