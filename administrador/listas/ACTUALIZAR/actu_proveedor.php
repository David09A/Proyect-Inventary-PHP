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
					<li><a href="../generador_reportes.php">Generar Reporte</a></li>
					<li><a href="../servicios/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="crear_prod">
		<?php
		error_reporting(E_ERROR | E_PARSE);
			$nit = $_POST['nit'];
			$nom_empresa = $_POST['nom_empresa'];
			$telefono = $_POST['telefono'];
			$correo = $_POST['correo'];
			$direccion = $_POST['direccion'];

			$ini = $_POST['prov_ini'];

			$actualizar = "UPDATE `proveedor` SET `nit` = '$nit', `nom_empresa` = '$nom_empresa', `telefono` = '$telefono', `correo` = '$correo', `direccion` = '$direccion' WHERE `proveedor`.`nit` = $ini";

			$resultado = mysqli_query($con, $actualizar);
			if(!$resultado)
			{
				echo "<h1>No se pudo actualizar</h1>"."<br>";
			}
			else
			{
				echo "<h1>Producto Actualizado </h1>"."<br>";
				?>
				<a href="../list_prov.php" style="color: #fff;"><h2>Volver</h2></a>
				<?php
			}

		 ?>
		
		</div>
		</center>
	</div>
</body>
</html>