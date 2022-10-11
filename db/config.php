<?php
/**
 * +------------------ !!! 30-SEP-2022 -------------------------+
 * | Creación   30-SEP-2022              						|
 * | Configuracion de conexion inicial db proyect-inventory-php |
 * +------------------------------------------------------------+
 *
 * Comentarios
 *
 * @author    German David Navas 
 * @version   1
 */
	$host = "localhost";
	$user = "root";
	$pass = "";
	$base = "proyect-inventory-php";

	$con = mysqli_connect($host, $user, $pass, $base);

	if (!$con) {
		 $respuesta = "Lo lamento, no hay conexion con la base de datos";
	}
	else {
		   $respuesta = "Conexion a la base de datos exitosa";
	}
?>
