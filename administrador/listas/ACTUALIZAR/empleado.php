<?php 
	include '../../../servicios/conexion.php';
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	$usuarioadm = $_SESSION['useradmin'];
	$admin = $usuarioadm['nombres'];


	if (!isset($usuarioadm)) {
			header("location:../../../logearse.html");
		}	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>INICIO</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../../../estilos/index.css">
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
					<li><a href="../ventas/crearventa.php">Crear Venta</a></li>
					<li><a href="">Ver y Actualizar Listas</a>
						<ul>
							<li><a href="../list_prod_admin.php">Productos</a></li>
							<li><a href="../list_insumoprod.php">Insumos de Produccion</a></li>
							<li><a href="../list_insumoempaq.php">Insumos de Empaquetado</a></li>
							<li><a href="../list_materia.php">Materia Prima</a></li>
							<li><a href="../list_emple.php">Empleados</a></li>
						</ul>
					</li>
					<li><a href="">Crear</a>
						<ul>
							<li><a href="../crear/crear_prod.php">Nuevo Producto</a></li>
							<li><a href="../crear/crearinsumoprod.php">Nuevo Insumo de Produccion</a></li>
							<li><a href="../crear/crearinsumoempaq.php">Nuevo Insumo de Empaquetado</a></li>
							<li><a href="../crear/crearmateria.php">Nueva Materia Prima</a></li>
							<li><a href="../crear/crear_empleado.php">Nuevo Empleado</a></li>
							<li><a href="../crear/nuevo_admin.php">Nuevo Administrador</a></li>
						</ul>
					</li>
					<li><a href="../../servicios/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="crear_prod">
			<h2>Actualizar Empleado</h2>
			<?php
			$cedula = $_GET['cedula'];

			$consultar = "SELECT * from empleados where num_cedula = '$cedula'";
			$resultado = mysqli_query($con, $consultar);
			$mostrar = mysqli_fetch_array($resultado);
			?>
			<form action="actualizar_empleado.php" method="POST" autocomplete="nope">
			<h3>Numero de cedula:</h3>
			<input type="text" name="num_cedula" class="entrada" placeholder="Numero de cedula" value="<?php echo $mostrar['num_cedula'];?>">
			<br>
			<h3>Nombres:</h3>
			<input type="text" name="nombres" class="entrada" placeholder="Ingrese Nombres" value="<?php echo $mostrar['nombres'];?>">
			<br>
			<h3>Apellidos:</h3>
			<input type="text" name="apellidos" class="entrada" placeholder="Ingrese Apellidos" value="<?php echo $mostrar['apellidos'];?>">
			<br>
			<h3>Direccion:</h3>
			<input type="text" name="direccion" class="entrada" placeholder="Ingrese Direccion" value="<?php echo $mostrar['direccion'];?>">
			
			<h3>Telefono:</h3>
			<input type="text" name="telefono" class="entrada" placeholder="Ingrese Telefono"  value="<?php echo $mostrar['telefono'];?>">
			<br>
			<h3>Correo:</h3>
			<input type="email" name="correo" class="entrada" placeholder="Ingrese Correo" value="<?php echo $mostrar['correo'];?>">
			<br>
			<h3>Contraseña:</h3>
			<input type="password" name="contraseña" class="entrada" placeholder="Ingrese Contraseña"  value="<?php echo $mostrar['contraseña'];?>"d>
			<br>
			<h3>Cargo:</h3>
			<input type="text" name="cargo" class="entrada" placeholder="Ingrese Cargo" value="<?php echo $mostrar['cargo'];?>">
			<br>
			<h3>Horario:</h3>
			<input type="text" name="horario" class="entrada" placeholder="Ingrese Horario" value="<?php echo $mostrar['horario'];?>">
			<br>
			<h3>Salario:</h3>
			<input type="text" name="asignacion_salarial" class="entrada" placeholder="Ingrese Salario" value="<?php echo $mostrar['asignacion_salarial'];?>">
			<br>
			<h3>Estado civil:</h3>
			<input type="text" name="estado_civil" class="entrada" placeholder="Ingrese Estado civil" value="<?php echo $mostrar['estado_civil'];?>">
			<br>
			<h3>Fecha de nacimiento:</h3>
			<input type="date" name="fecha_nacimiento" class="entrada" placeholder="Ingrese Fecha de nacimiento" value="<?php echo $mostrar['fecha_nacimiento'];?>">
			<br>
			<h3>RH:</h3>
			<input type="text" name="RH" class="entrada" placeholder="Ingrese RH" value="<?php echo $mostrar['RH'];?>">
			<br>
			<h3>Observaciones:</h3>
			<input type="text" name="observaciones" class="entrada" placeholder="Ingrese Observaciones" value="<?php echo $mostrar['observaciones'];?>">
			<br>
			<input type="hidden" name="cedu_ini" value="<?php echo $mostrar['num_cedula'];?>">
			<input type="submit" value="Guardar" id="boton" name="insert"><br><br>
			<a href="../list_emple.php"><input type="button" id="boton" value="Cancelar" ></a>
		</form>
		</div>
		</center>
	</div>
</body>
</html>