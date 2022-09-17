<?php 
	include '../../servicios/conexion.php';
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	$usuarioadm = $_SESSION['useradmin'];
	$admin = $usuarioadm['nombres'];


	if (!isset($usuarioadm)) {
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
		<h1>Bienvenido <?php echo $admin; ?></h1>
		<br><hr>
		<div>
			<nav id="menu">
				<ul>
					<li><a href="../ventas/crearventa.php">Crear Venta</a></li>
					<li><a href="">Ver y Actualizar Listas</a>
						<ul>
							<li><a href="list_prod_admin.php">Productos</a></li>
							<li><a href="list_insumoprod.php">Insumos de Produccion</a></li>
							<li><a href="list_insumoempaq.php">Insumos de Empaquetado</a></li>
							<li><a href="list_materia.php">Materia Prima</a></li>
							<li><a href="list_emple.php">Empleados</a></li>
							<li><a href="list_prov.php">Proveedores</a></li>
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
							<li><a href="../crear/crear_prov.php">Nuevo proveedor</a></li>
						</ul>
					</li>
					<li><a href="../../servicios/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="products-list">
			<div class="header">
			<h1>Lista de Ventas</h1>
			<a href="../ventas/ventas.php" target="_blank"><button class="generador">Generar PDF</button></a>
			</div>
			<div>
				<button>Filtrar por Empleados</button>
				<button>Filtrar por Clientes</button>
				<button>Filtrar por Fecha</button>
			</div>
			<table>
				<tr class="strong">
					<td>Id Venta</td>
					<td>Cedula vendedor</td>
					<td>Cedula Cliente</td>
					<td>Total Venta</td>
					<td>Fecha</td>
				</tr>
				<?php
				
				$query ="SELECT * from ventas";

				$consulta=mysqli_query($con,$query);


				while ($mostrar =mysqli_fetch_array($consulta)) {
					
				?>
				<tr>
					<td><?php echo $mostrar['id_venta']; ?></td>
					<td><?php echo $mostrar['client_venta']; ?></td>
					<td><?php echo $mostrar['usuario_venta']; ?></td>
					<td><?php echo $mostrar['valor_total']; ?></td>
					<td><?php echo $mostrar['fecha_venta']; ?></td>
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