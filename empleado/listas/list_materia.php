<?php 
	include '../../servicios/conexion.php';
	session_start();
	$usuario = $_SESSION['username'];

	if (!isset($usuario)) {
			header("location:../../logearse.html");
		}	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>INICIO</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../../estilos/index.css">
	<link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="initial-scale=1">
</head>
<body>
	<div class="contain1">
		<center>
		<h1>Bienvenido <?php echo $usuario; ?></h1>
		<br><hr>
		<div>
			<nav id="menu">
				<ul>
					<li><a href="../ventas/crearventa.php">Crear Venta</a></li>
					<li><a href="">Ver y Actualizar Listas</a>
						<ul>
							<li><a href="list_prod_emple.php">Productos</a></li>
							<li><a href="list_insumoprod.php">Insumos de Produccion</a></li>
							<li><a href="list_insumoempaq.php">Insumos de Empaquetado</a></li>
							<li><a href="list_materia.php">Materia Prima</a></li>
						</ul>
					</li>
					<li><a href="">Crear</a>
						<ul>
							<li><a href="../crear/crear_prod.php">Nuevo Producto</a></li>
							<li><a href="../crear/crearinsumoprod.php">Nuevo Insumo de Produccion</a></li>
							<li><a href="../crear/crearinsumoempaq.php">Nuevo Insumo de Empaquetado</a></li>
							<li><a href="../crear/crearmateria.php">Nueva Materia Prima</a></li>
							<li><a href="../crear/crear_prov.php">Nuevo proveedor</a></li>
						</ul>
					</li>
					<li><a href="../../servicios/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="products-list">
			<div class="header">
			<h1>Materia Prima</h1>
			<a href="../../Pdf/reporte_materia.PHP" target="_blank"><button class="generador">Generar PDF</button></a>
			</div>
			<table>
				<tr class="strong">
					<td>Cod.</td>
					<td>Nombre</td>
					<td>Cantidad Actual</td>
					<td>Ubicacion</td>
					<td>Proveedor</td>
					<!--<td>Opciones</td>-->

				</tr>
				<?php
				
				$query ="SELECT * from materia_prima";

				$consulta=mysqli_query($con,$query);


				while ($mostrar =mysqli_fetch_array($consulta)) {
					
				?>
				<tr>
					<td><?php echo $mostrar['id_mat']; ?></td>
					<td><?php echo $mostrar['nom_materia_prima']; ?></td>
					<td><?php echo $mostrar['cantidad']; ?></td>
					<td><?php echo $mostrar['ubicacion']; ?></td>
					<td><?php echo $mostrar['nit_proveedor']; ?></td>
					<!--<td><a href="servicios/actualizar_empleado.php?id=<?php echo $mostrar['nom_materia_prima']?>"><input type="button" name="Editar" value="Editar"></a></td>-->
				</tr>
				<?php 
				}
				 ?>
			</table>
		</div>
	</center>
	</div>
</body>
</html>