<!DOCTYPE html>
<html lang="es">
<head>
	<title>loggin</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="controllerS/assets/logear.css">
	<meta name="viewport" content="initial-scale=1">
</head>
<body>
	<center>
	<div class="contain1">
		<center><h1>Iniciar Sesion</h1></center><br>
		<form action="controllers/peticions/loggin.php" method="POST">
			<span>user: admin pass: admin</span>
			<h2>Ingrese su Usuario:</h2><br>
			<input type="text" name="user" class="entrada" placeholder="Usuario" required>
			<br><br>
			<h2>Ingrese su contraseña:</h2><br>
			<input type="password" name="pass" class="entrada" placeholder="Contraseña" pattern="[a-zA-Z0-9]+" required>
			<br><br>
			<?php 
				if (isset($_GET['e'])) {
					switch ($_GET['e']) {
						case '1':
							echo "<p>Error de Conexion</p>";
							break;
						case '2':
							echo "<p>Codigo Invalido</p>";
							break;
						case '3':
							echo "<p>Contraseña Invalida</p>";
							break;
						default:
							break;
					}
				}
			 ?>
			<input type="submit" value="Ingresar" name="loggin" id="boton"><br><br>
		</form>
	</div>
</center>
</body>
</html>