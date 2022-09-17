<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	<title>Registrarse</title>
	<link rel="stylesheet" type="text/css" href="../estilos/logear.css">
	<meta name="viewport" content="initial-scale=1">
	<meta charset="utf-8">
</head>
<header>
	<a href="../logearse.html" class="botonprin">Atras</a>
</header>
<body>
	<center>
	<div class="contain1">
		<center><h1>Registrarse</h1></center>
		<form action="registrarse.php" method="POST" autocomplete="nope">
			<h2>Numero de cedula:</h2>
			<input type="number" name="num_cedula" class="entrada" placeholder="Numero de cedula" required>
			<br>
			<h2>Nombres:</h2>
			<input type="text" name="nombres" class="entrada" placeholder="Ingrese Nombres" required>
			<br>
			<h2>Apellidos:</h2>
			<input type="text" name="apellidos" class="entrada" placeholder="Ingrese Apellidos" required>
			<br>
			<h2>Direccion:</h2>
			<input type="text" name="direccion" class="entrada" placeholder="Ingrese Direccion" required>
			
			<h2>Telefono:</h2>
			<input type="text" name="telefono" class="entrada" placeholder="Ingrese Telefono"  required minlength="9" maxlength="12">
			<br>
			<h2>Correo:</h2>
			<input type="email" name="correo" class="entrada" placeholder="Ingrese Correo" required>
			<br>
			<h2>Contraseña:</h2>
			<input type="password" name="contraseña" class="entrada" placeholder="Ingrese Contraseña de 4 a 8 caracteres"  requiredd>
			<br>
			<h2>Cargo:</h2>
			<input type="text" name="cargo" class="entrada" placeholder="Ingrese Cargo" required>
			<br>
			<h2>Horario:</h2>
			<select name="horario" class="seleccion">
				<option value="Lunes-Viernes">Lunes-Viernes</option>
				<option value="Fines de Semana">Fines de Semana</option>
				<option value="Lunes a Sabado">Lunes a Sabado</option>
				<option value="Domingo a Domingo">Domingo a Domingo</option>
			</select>
			<br>
			<h2>Salario:</h2>
			<select name="asignacion_salarial" class="seleccion">
				<option value="Desconocido">Desconocido</option>
				<option value="Salario Minimo">Salario Minimo Legal Vigente</option>
				<option value="A convenir">A convenir</option>
			</select>
			<br>
			<h2>Estado civil:</h2>
			<input type="text" name="estado_civil" class="entrada" placeholder="Ingrese Estado civil" required>
			<br>
			<h2>Fecha de nacimiento:</h2>
			<input type="date" name="fecha_nacimiento" class="entrada" placeholder="Ingrese Fecha de nacimiento" required max="<?php date_default_timezone_set('America/Bogota');  $hoy=date("Y-m-d"); echo $hoy;?>">
			<br>
			<h2>RH:</h2>
			<input type="text" name="RH" class="entrada" placeholder="Ingrese RH" required>
			<br>
			<h2>Observaciones:</h2>
			<input type="text" name="observaciones" class="entrada" placeholder="Ingrese Observaciones" required>
			<br>
			<input type="submit" value="Registrarse" id="boton" name="insert"><br><br>
		</form>

	<?php
	require 'conexion.php';

		if(isset($_POST['insert'])){
			$num_cedula = $_POST['num_cedula'];
			$nombres = $_POST['nombres'];
			$apellidos = $_POST['apellidos'];
			$direccion = $_POST['direccion'];
			$telefono = $_POST['telefono'];
			$correo = $_POST['correo'];
			$contraseña = $_POST['contraseña'];
			$cargo = $_POST['cargo'];
			$horario = $_POST['horario'];
			$asignacion_salarial = $_POST['asignacion_salarial'];
			$estado_civil = $_POST['estado_civil'];
			$fecha_nacimiento = $_POST['fecha_nacimiento'];
			$RH = $_POST['RH'];
			$observaciones = $_POST['observaciones'];

	//insertar datos en la base de datos
			$insertar = "INSERT into empleados (num_cedula, nombres, apellidos, direccion, telefono, correo, contraseña, cargo, horario, asignacion_salarial, estado_civil, fecha_nacimiento, RH, observaciones) values ('$num_cedula', '$nombres', '$apellidos', '$direccion','$telefono', '$correo', '$contraseña', '$cargo', '$horario', '$asignacion_salarial', '$estado_civil', '$fecha_nacimiento', '$RH', '$observaciones')";

			$ejecutar = mysqli_query($con,$insertar);
			if($ejecutar){
				echo "<h3>Insertado Correctamente</h3>";
			?>
				<!--creamos una tabla-->
				<br/>
				<br/>
				<center>
				<h3>Datos de Ingreso</h3>
				
					<table class="tabla">
						<tr>
							<th>Identificacion</th>
							<th>Contraseña</th>
						</tr>
				
					<tr align="center">
						<td><?php echo $num_cedula;?></td>
						<td><?php echo $contraseña;?></td>	
					</tr>
					</table>
				</center>
			<?php
			}else{
				echo "No se pudo registrar";
			}
		}
	?>

	
		<a href="../logearse.html" class="links">¿Ya tiene usuario? Ingresar</a>
	</div>
</center>
</body>
</html>