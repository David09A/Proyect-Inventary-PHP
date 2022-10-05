<?php 
	require_once("../../db/config.php");//Incluir la conexion
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	$usuari = $_SESSION['user'];
	$admin = $usuari['n_name'];


	if (!isset($usuari)) {
			header("location:../../index.php");
		}	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>INICIO</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../assets/styles.css">
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
					<li><a href="init.php"><strong>Crear Venta</strong></a></li>
					<li><a href="">Ver y Actualizar Listas</a>
						<ul>
							<li><a href="get/list_prod.php">Productos</a></li>
							<li><a href="get/list_prov.php">Proveedores</a></li>
						</ul>
					</li>
					<li><a href="">Crear</a>
						<ul>
							<li><a href="insert/crear_prod.php">Nuevo Producto</a></li>
							<li><a href="insert/crear_prov.php">Nuevo Proveedor</a></li>
							<li><a href="insert/new_admin.php">Nuevo Administrador</a></li>
						</ul>
					</li>
					<li><a href="../peticions/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
	</center>
	<center>
		<div class="ventas">
			<a href="../assets/pdf/ventas.php" target="_blank"><button class="generador"><i class="fas fa-file-download"></i> Ventas del Sistema</button></a>
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
								<a href="../assets/pdf/facturacion.php?idvt=<?php echo $idvt ?>" target="_blank"><button class="generador"><i class="fas fa-file-download"></i> Ver Comprobante</button></a>
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
								<strong>Error: </strong>La cantidad maxima en stock se excede
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
				<form method="post" action="../peticions/addCart.php" class="buscador">
					<label for="codigo">Código del Producto:</label>
					<input autocomplete="off" autofocus class="busqueda" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
					<input type="submit" value="Buscar" class="botonbusq">
				</form>
				<br><br>
				<table class="table table-bordered">
					<thead>
						<tr>
							<td>Ref</td>
							<td>Nombre</td>
							<td>Cantidad</td>
							<td>Valor</td>
							<td>Proveedor</td>
							<td>Total</td>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
								$granTotal += $producto->total;
							?>
						<tr>
							<td><?php echo $producto->k_refprod ?></td>
							<td><?php echo $producto->n_name_prod ?></td>
							<td><?php echo $producto->caantidad ?></td>
							<td><?php echo $producto->v_valor_prod ?></td>
							<td><?php echo $producto->k_prov_prod ?></td>
							<td><?php echo $producto->total ?></td>
							<td>
								<a class="boton_tablas" href="<?php echo "../peticions/aumentarDelCarrito.php?indice=" . $indice?>"><i class="fas fa-plus" title="Añadir otra unidad"></i></a>
								<a class="boton_tablas" href="<?php echo "../peticions/restarDelCarrito.php?indice=" . $indice?>"><i class="fas fa-minus" title="Quitar una unidad"></i></a>
								<a class="boton_tablas" href="<?php echo "../peticions/quitarDelCarrito.php?indice=" . $indice?>"><i class="fas fa-trash-alt" title="Quitar el Producto de la lista"></i></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="total">
				<h3>Total: <?php echo $granTotal; ?></h3>
				<?php
				if($granTotal > 0){
					?>
					<form action="../peticions/terminarVenta.php" method="POST">
						<input name="total" type="hidden" value="<?php echo $granTotal;?>">
						<button type="submit" class="boton_tablas">Terminar venta</button>
						<a href="../peticions/cancelarVenta.php" class="boton_tablas">Cancelar venta</a>
					</form>
					<?php
				}
				?>
			</div>
			
		</div>
	</div><!-- Cierra ventas -->
	</center>
</div><!-- Cierra Contain 1 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js" integrity="sha512-cyAbuGborsD25bhT/uz++wPqrh5cqPh1ULJz4NSpN9ktWcA6Hnh9g+CWKeNx2R0fgQt+ybRXdabSBgYXkQTTmA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>