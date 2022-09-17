<?php

	include '../../servicios/conexion.php';
							
	$cedu = $_POST['cedu'];

	$consulta = "SELECT * FROM cliente WHERE cedula like '%$cedu%'";
	$query = mysqli_query($con, $consulta);

	$datos = mysqli_fetch_array($query);

	include 'crearventa.php';
	if ($datos) {
		header("Location: ./crearventa.php?status=6&cedudd=$datos");
	}else{
		echo "Cliente Desconocido";
	}

?>