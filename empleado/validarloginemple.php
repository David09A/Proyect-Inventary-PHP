<?php 
 include '../servicios/conexion.php';//Incluir la conexion
 session_start();

 $user = $_POST['user'];
 $pass = $_POST['pass'];//llamar los datos
 $nomb = mysqli_query($con, "SELECT * from empleados WHERE num_cedula = '$user'");
 $resut=mysqli_fetch_assoc($nomb);

$consulta = "SELECT COUNT(*) AS contar FROM empleados WHERE num_cedula = '$user' and contraseña = '$pass'";
$resultado = mysqli_query($con, $consulta);

$filas = mysqli_fetch_array($resultado);

if ($filas['contar']>0) {
	$_SESSION['username'] = $resut;
	header("location: ventas/crearventa.php");
}else{
	?>
	<?php
	include("loginemple.php");
	?>
	<center><h1>Error en la autentificacion</h1></center>
	<?php
}
//mysqli_free_result($resultado);
//mysqli_close($con);
?>