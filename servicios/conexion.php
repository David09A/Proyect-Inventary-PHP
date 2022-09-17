<?php

	$host = "localhost";
	$user = "root";
	$pass = "";
	$base = "ganjha_productos";

	$con = mysqli_connect($host, $user, $pass, $base);

	if (!$con) {
		 $respuesta = "Lo lamento, no hay conexion con la base de datos";
	}
	else {
		   $respuesta = "Conexion a la base de datos exitosa";
	}
?>