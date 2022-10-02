<?php 
	require_once("../../../db/config.php");//Incluir la conexion
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	$usuari = $_SESSION['user'];
	$admin = $usuari['n_name'];

	if (!isset($usuari)) {
			header("location:../../../index.php");
		}	
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>INICIO</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../../assets/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="initial-scale=1">
</head>
<body>
	<div class="contain1">
		<center>
		<h1>Bienvenido <?php echo $admin; ?></h1>
		<br><hr>
		<div>
			<nav id="menu">
				<ul>
					<li><a href="../init.php">Crear Venta</a></li>
					<li><a href="">Ver y Actualizar Listas</a>
						<ul>
							<li><a href="../get/list_prod.php">Productos</a></li>
							<li><a href="../get/list_prov.php">Proveedores</a></li>
						</ul>
					</li>
					<li><a href="">Agregar</a>
						<ul>
							<li><a href="crear_prod.php">Nuevo Producto</a></li>
							<li><a href="crear_prov.php">Nuevo proveedor</a></li>
							<li><a href="new_admin.php">Nuevo Administrador</a></li>
						</ul>
					</li>
					<li><a href="../../peticions/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="crear_prod">
			<h2>Crear Admin</h2>
			<form action="new_admin.php" method="POST">
				<h3>Cedula:</h3>
				<input type="text" name="num_cedula" class="entrada" placeholder="Ingrese Cedula" required>
				<br>
				<h3>Nombre:</h3>
				<input type="text" name="nombres" class="entrada" placeholder="Ingrese Nombre" required>
				<br>
				<h3>Apellidos:</h3>
				<input type="text" name="apellidos" class="entrada" placeholder="Ingrese Apellidos" required>
				<br>
				<h3>Telefono:</h3>
				<input type="text" name="telefono" class="entrada" placeholder="Ingrese Telefono" required minlength="9" maxlength="12">
				<br>
				<h3>Correo:</h3>
				<input type="email" name="correo" class="entrada" placeholder="Ingrese Correo" required>
				<br>
				<h3>Contraseña:</h3>
				<input type="password" name="contraseña" class="entrada" placeholder="Ingrese Contraseña" required>
				<br>
				<h3>Direccion:</h3>
				<input type="text" name="direccion" class="entrada" placeholder="Ingrese direccion" required>
				<br>
				<h3>Areas de Supervicion:</h3>
				<select name="areas_a_supervisar" class="seleccion">
					<option value="Todas">Todas</option>
					<option value="Ventas">Ventas</option>
					<option value="General">General</option>
					<option value="Otras">Otras</option>
				</select>
				<br>
				<h3>Estado Civil:</h3>
				<input type="text" name="estado_civil" class="entrada" placeholder="Ingrese estado Civil" required>
				<br>
				<h3>Tipo de Sangre:</h3>
				<input type="text" name="RH" class="entrada" placeholder="Ingrese RH" required>
				<br><br>
				<input type="submit" value="Registrar" id="boton" name="insert"><br><br>
			</form>

	<?php
		if(isset($_POST['insert'])){
			$num_cedula = $_POST['num_cedula'];
			$nombres = $_POST['nombres'];
			$apellidos = $_POST['apellidos'];
			$telefono = $_POST['telefono'];
			$correo = $_POST['correo'];
			$contraseña = $_POST['contraseña'];
			$direccion = $_POST['direccion'];
			$areas_a_supervisar = $_POST['areas_a_supervisar'];
			$estado_civil = $_POST['estado_civil'];
			$RH = $_POST['RH'];

	//insertar datos en la base de datos
			$insertar = "INSERT INTO directivo (num_cedula, nombres, apellidos, telefono, correo, contraseña, direccion, areas_a_supervisar, estado_civil, RH, quien_registra) VALUES ('$num_cedula', '$nombres', '$apellidos', '$telefono', '$correo', '$contraseña', '$direccion', '$areas_a_supervisar', '$estado_civil', '$RH', '$usuario');";

			$ejecutar = mysqli_query($con,$insertar);
			if($ejecutar){
				echo "<h3>Insertado Correctamente</h3>";
			?>
				<!--creamos una tabla-->
				<br/></div>
				<br/>
				<center>
				<h3>Datos Ingresados</h3>
				
					<table>
					<tr align="center">
						<td><?php echo $num_cedula;?></td>
						<td><?php echo $nombres;?></td>	
						<td><?php echo $apellidos;?></td>
						<td><?php echo $telefono;?></td>	
						<td><?php echo $correo;?></td>
						<td><?php echo $contraseña;?></td>	
						<td><?php echo $direccion;?></td>
						<td><?php echo $areas_a_supervisar;?></td>	
						<td><?php echo $estado_civil;?></td>
						<td><?php echo $RH;?></td>
					</tr>
					</table>
				</center>
			<?php
			}else{
				echo "No se pudo registrar";
			}
		}
	?>
	
</center>
	</div>
</body>
</html>