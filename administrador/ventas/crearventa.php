<?php 
	include '../../servicios/conexion.php';
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	$usuarioadm = $_SESSION['useradmin'];
	$admin = $usuarioadm['nombres'];
	$usuariocli = $_SESSION['clie'];


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
	<link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
	<meta name="viewport" content="initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="contain1">
		<center>
		<h1>Bienvenido <?php echo $admin; ?></h1>
		<br><hr>
		<div>
			<nav id="menu">
				<ul>
					<li><a href="crearventa.php"><strong>Crear Venta</strong></a></li>
					<li><a href="">Ver y Actualizar Listas</a>
						<ul>
							<li><a href="../listas/list_prod_admin.php">Productos</a></li>
							<li><a href="../listas/list_insumoprod.php">Insumos de Produccion</a></li>
							<li><a href="../listas/list_insumoempaq.php">Insumos de Empaquetado</a></li>
							<li><a href="../listas/list_materia.php">Materia Prima</a></li>
							<li><a href="../listas/list_emple.php">Empleados</a></li>
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
	</center>
	<center>
		<div class="ventas">
			<a href="ventas.php" target="_blank"><button class="generador"><i class="fas fa-file-download"></i> Ventas del Sistema</button></a>
			<?php 
				include_once "cliente.php";
			 ?>
			<br>
			<div class="vendedor">
					<h2>Datos de la venta</h2>
					<div>
					<?php

					error_reporting(E_ERROR | E_PARSE);
					if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
					$granTotal = 0;
				if(isset($_GET["status"])){
					if($_GET["status"] === "1"){
						?>
							<div class="alertas">
								<strong>¡Correcto!</strong> Venta realizada correctamente el # es: <?php 
								$idvt = $_GET['idvent'];
								echo $idvt; ?>
								<a href="Factura.php?idvt=<?php echo $idvt ?>" target="_blank"><button class="generador"><i class="fas fa-file-download"></i> Ver Comprobante</button></a>
							</div>
						<?php
					}else if($_GET["status"] === "2"){
						?>
						<div class="alertas">
								<strong>Venta cancelada</strong>
							</div>
						<?php
					}else if($_GET["status"] === "3"){
						?>
						<div class="alertas">
								<strong>Ok</strong> Producto quitado de la lista
							</div>
						<?php
					}else if($_GET["status"] === "4"){
						?>
						<div class="alertas">
								<strong>Error:</strong> El producto que buscas no existe
							</div>
						<?php
					}else if($_GET["status"] === "5"){
						?>
						<div class="alertas">
								<strong>Error: </strong>El producto está agotado
							</div>
						<?php
					}else if($_GET["status"] === "6"){
						?>
						<div class="alertas">
								<strong>Cliente:</strong> <?php echo $usuariocli['nomb_compl_cli']; ?>
							</div>
						<?php
					}else if($_GET["status"] === "7"){
						?>
						<div class="alertas">
								<strong>Error:</strong> Debe agregar un cliente
							</div>
						<?php
					}else{
						?>
						<div class="alertas">
								<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
							</div>
						<?php
					}
				}
			?>
			</div>
			<br>
			<div class="venta">
				<form method="post" action="agregarAlCrarrito.php" class="buscador">
					<label for="codigo">Código del Producto:</label>
					<input autocomplete="off" autofocus class="busqueda" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
					<input type="submit" value="Buscar" class="botonbusq">
				</form>
				<br><br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th colspan="7">Cliente</th>
						</tr>
							<td colspan="7"><?php if (!$usuariocli) {
								echo "<h3 class='clienteh2'>Para Generar una venta debe Agregar un cliente</h3>";
							}else{
								echo "<h3 class='clienteh2'>".$usuariocli['nomb_compl_cli']."</h3>";
							} ?></td>
						<tr>
							<th>Código</th>
							<th>Nombre</th>
							<th>Precio de venta</th>
							<th>Cantidad</th>
							<th>Total</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
								$granTotal += $producto->total;
							?>
						<tr>
							<td><?php echo $producto->id ?></td>
							<td><?php echo $producto->nombre ?></td>
							<td><?php echo $producto->precio_venta ?></td>
							<td><?php echo $producto->caantidad ?></td>
							<td><?php echo $producto->total ?></td>
							<td>
								<a class="boton_tablas" href="<?php echo "aumentarDelCarrito.php?indice=" . $indice?>"><i class="fas fa-plus" title="Añadir otra unidad"></i></a>
								<a class="boton_tablas" href="<?php echo "restarDelCarrito.php?indice=" . $indice?>"><i class="fas fa-minus" title="Quitar una unidad"></i></a>
								<a class="boton_tablas" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="fas fa-trash-alt" title="Quitar el Producto de la lista"></i></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="total">
				<h3>Total: <?php echo $granTotal; ?></h3>
				<form action="<?php echo"./terminarVenta.php?clie=".$usuariocli['cedula'] ?>" method="POST">
				<input name="total" type="hidden" value="<?php echo $granTotal;?>">
				<?php 
					if ($usuariocli) {?>
						<button type="submit" class="boton_tablas">Terminar venta</button>
						<?php
					}
				 ?>
				
				<a href="cancelarVenta.php" class="boton_tablas">Cancelar venta</a>
			</form>
			</div>
			
		</div>
	</div><!-- Cierra ventas -->
	</center>
</div><!-- Cierra Contain 1 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js" integrity="sha512-cyAbuGborsD25bhT/uz++wPqrh5cqPh1ULJz4NSpN9ktWcA6Hnh9g+CWKeNx2R0fgQt+ybRXdabSBgYXkQTTmA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>