<?php 
 require_once("../../db/config.php");//Incluir la conexion
 session_start();

 $user = $_POST['user'];
 $pass = $_POST['pass'];//llamar los datos


 $nomb = mysqli_query($con, "SELECT gr001.k_identi, gr002.n_name FROM `gr001m_user_db` as gr001, `gr002det_user` as gr002 WHERE gr001.k_identi = gr002.k_identi AND gr001.n_user = '$user' AND gr001.n_password = '$pass'");
 $resut=mysqli_fetch_assoc($nomb);



$consulta = "SELECT COUNT(*) AS contar FROM gr001m_user_db WHERE n_user = '$user' and n_password = '$pass'";
$resultado = mysqli_query($con, $consulta);

$filas = mysqli_fetch_array($resultado);

if ($filas['contar']>0) {
	$_SESSION['user'] = $resut;
	header("location: ../results/init.php");
}else{
	?>
	<?php
	include("../results/loggin.php");
	?>
	<center><h1>Error en la autentificacion</h1></center>
	<?php
}
?>
