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
			$prod = $_GET['prod'];

			$consultar = "SELECT * from productos where id = '$prod'";
			$resultado = mysqli_query($con, $consultar);
			$mostrar = mysqli_fetch_array($resultado);
			?>
			<form action="actu_productos.php" method="POST">
				<h3>Nombre:</h3>
				<input  value="<?php echo $mostrar['nombre'];?>" type="text" name="nombre" class="entrada" placeholder="Ingrese Nombre del producto" required>
				<br>
				<h3>Presentacion:</h3>
				<input  value="<?php echo $mostrar['presentacion'];?>" type="text" name="presentacion" class="entrada" placeholder="Ingrese Presentacion del producto" required>
				<br>
				<h3>Descripcion:</h3>
				<input  value="<?php echo $mostrar['descripcion'];?>" type="text" name="descripcion" class="entrada" placeholder="Ingrese descripcion" required>
				
				<h3>Ubicacion:</h3>
				<input  value="<?php echo $mostrar['ubicacion'];?>" type="text" name="ubicacion" class="entrada" placeholder="Ingrese ubicacion"  required>
				<br>
				<h3>Precio de venta:</h3>
				<input  value="<?php echo $mostrar['precio_venta'];?>" type="text" name="precio_venta" class="entrada" placeholder="Ingrese precio de venta" required>
				<br>
				<h3>Precio de Produccion:</h3>
				<input  value="<?php echo $mostrar['precio_produccion'];?>" type="text" name="precio_produccion" class="entrada" placeholder="Ingrese Precio de Produccion"  required>
				<br>
				<h3>Cantidad:</h3>
				<input  value="<?php echo $mostrar['cantidad'];?>" type="text" name="cantidad" class="entrada" placeholder="Ingrese Cantidad"  required>
				<br>
				<h3>Tipo de Empaque:</h3>
				<input  value="<?php echo $mostrar['nom_empaque'];?>" type="text" name="nom_empaque" class="entrada" placeholder="Ingrese Tipo de Empaque"  required>
				<br>
				<h3>Id Insumos Produccion:</h3>
				<input  value="<?php echo $mostrar['nom_produccion'];?>" type="text" name="nom_produccion" class="entrada" placeholder="Ingrese Tipo de Insumo de Produccion"  required>
				<br>
				<h3>Materia Prima:</h3>
				<input  value="<?php echo $mostrar['nom_materia_prima'];?>" type="text" name="nom_materia_prima" class="entrada" placeholder="Ingrese Tipo de Materia Prima"  required>
				<br><br>
				<input type="hidden" name="prod_ini" value="<?php echo $mostrar['id'];?>">
				<input type="submit" value="Guardar" id="boton" name="insert"><br><br>
				<a href="../list_prod_admin.php"><input type="button" id="boton" value="Cancelar" ></a>
			</form>
		</div>
		</center>
	</div>
</body>
</html>