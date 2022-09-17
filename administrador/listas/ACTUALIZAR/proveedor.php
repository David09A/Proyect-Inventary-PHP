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
			<h2>Actualizar Productos</h2>
			<?php
			$prov = $_GET['prov'];

			$consultar = "SELECT * from proveedor where nit = '$prov'";
			$resultado = mysqli_query($con, $consultar);
			$mostrar = mysqli_fetch_array($resultado);
			?>
			<form action="actu_proveedor.php" method="POST">
				<h3>Nit de la Empresa:</h3>
				<input  value="<?php echo $mostrar['nit'];?>" type="text" name="nit" class="entrada" placeholder="Ingrese nit de la empresa" required>
				<br>
				<h3>Nombre:</h3>
				<input  value="<?php echo $mostrar['nom_empresa'];?>" type="text" name="nom_empresa" class="entrada" placeholder="Ingrese Nombre" required>
				<br>
				<h3>Telefono:</h3>
				<input  value="<?php echo $mostrar['telefono'];?>" type="text" name="telefono" class="entrada" placeholder="Ingrese telefono" required minlength="6" maxlength="12">
				<br>
				<h3>Correo:</h3>
				<input  value="<?php echo $mostrar['correo'];?>" type="email" name="correo" class="entrada" placeholder="Ingrese Correo" required>
				<br>
				<h3>Direccion:</h3>
				<input  value="<?php echo $mostrar['direccion'];?>" type="text" name="direccion" class="entrada" placeholder="Ingrese Direccion" required>
				<br><br>
				<input type="hidden" name="prov_ini" value="<?php echo $mostrar['nit'];?>">
				<input type="submit" value="Guardar" id="boton" name="insert"><br><br>
				<a href="../list_prov.php"><input type="button" id="boton" value="Cancelar" ></a>
			</form>
		</div>
		</center>
	</div>
</body>
</html>