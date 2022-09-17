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
			<h2>Actualizar Materia Prima</h2>
			<?php
			$matpri = $_GET['matpri'];

			$consultar = "SELECT * from materia_prima where id_mat = '$matpri'";
			$resultado = mysqli_query($con, $consultar);
			$mostrar = mysqli_fetch_array($resultado);
			?>
			<form action="crearmateria.php" method="POST">
				<h3>Nombre de Materia Prima:</h3>
				<input  value="<?php echo $mostrar['nom_materia_prima'];?>" type="text" name="nom_materia_prima" class="entrada" placeholder="Ingrese Nombre del producto" required>
				<br>
				<h3>Cantidad:</h3>
				<input  value="<?php echo $mostrar['cantidad'];?>" type="text" name="cantidad" class="entrada" placeholder="Ingrese Cantidad del producto" required>
				<br>
				<h3>Ubicacion:</h3>
				<input  value="<?php echo $mostrar['ubicacion'];?>" type="text" name="ubicacion" class="entrada" placeholder="Ingrese ubicacion" required>
				<br>
				<h3>Proveedor:</h3>
				<input  value="<?php echo $mostrar['nit_proveedor'];?>" type="text" name="nit_proveedor" class="entrada" placeholder="Ingrese proveedor" required>
				<br><br>
				<input type="hidden" name="mat_ini" value="<?php echo $mostrar['id_mat'];?>">
				<input type="submit" value="Guardar" id="boton" name="insert"><br><br>
				<a href="../list_emple.php"><input type="button" id="boton" value="Cancelar" ></a>
			</form>
		</div>
		</center>
	</div>
</body>
</html>