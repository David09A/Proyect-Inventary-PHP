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
	 <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
	<meta name="viewport" content="initial-scale=1">
</head>
<body>
	<div class="contain1">
		<center>
		<h1>Bienvenido <?php echo $usuariow['nombres']; ?></h1>
		<br><hr>
		<div>
			<nav id="menu">
				<ul>
					<li><a href="crearventa.php"><strong>Crear Venta</strong></a></li>
					<li><a href="">Ver y Actualizar Listas</a>
						<ul>
							<li><a href="../listas/list_prod_emple.php">Productos</a></li>
							<li><a href="../listas/list_insumoprod.php">Insumos de Produccion</a></li>
							<li><a href="../listas/list_insumoempaq.php">Insumos de Empaquetado</a></li>
							<li><a href="../listas/list_materia.php">Materia Prima</a></li>
						</ul>
					</li>
					<li><a href="">Crear</a>
						<ul>
							<li><a href="../crear/crear_prod.php">Nuevo Producto</a></li>
							<li><a href="../crear/crearinsumoprod.php">Nuevo Insumo de Produccion</a></li>
							<li><a href="../crear/crearinsumoempaq.php">Nuevo Insumo de Empaquetado</a></li>
							<li><a href="../crear/crearmateria.php">Nueva Materia Prima</a></li>
						</ul>
					</li>
					<li><a href="../../servicios/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
	</center>
		<center>
		<div class="ventas">
			<a href="ventas.php" target="_blank"><button class="generador">Ventas del Sistema</button></a>
			<?php 
				include_once "../../administrador/ventas/cliente.php";
			 ?>
		
			<div class="vendedor">
					<h2>Datos de la venta</h2>
			<?php

include '../../servicios/conexion.php';

if (isset($_POST['ceduboton'])){
							?>
							<table>
								<tr class="strong">
									<td>Cedula</td>
									<td>Nombre Completo</td>
									<td>Agregar</td>
								</tr>
								<?php
					       //obtenemos la información introducida anteriormente desde nuestro buscador PHP
					       $buscli = $_POST["cedu"];
					 
					       $consulta_mysql= mysqli_query($con, "SELECT * FROM cliente WHERE cedula like '%$buscli%' or nomb_compl_cli like '%$buscli%'");
					 
					       while($registro = mysqli_fetch_assoc($consulta_mysql)) 
					       {
					           ?> 
					           <tr>
					               <!--mostramos el codigo y nombre de las tuplas que han coincidido con la 
					               cadena insertada en nuestro formulario-->
					                <td><?php echo $registro['cedula']; ?></td>
									<td><?php echo $registro['nomb_compl_cli']; ?></td>
									<td><a class="boton_tablas" href="<?php echo "agregar_cliente.php?client=" .$registro['cedula']?>">Agregar</a></td>
					           </tr>
					           <?php 
					       } //fin blucle
					    ?>
							</table>
    <?php
}



					if(isset($_POST['insertcli'])){
						$cedula_cli = $_POST['cedula'];
						$nombre = $_POST['nombre'];
						$telefono = $_POST['telefono'];
						$correo = $_POST['correo'];
						$direccion = $_POST['direccion'];

				//insertar datos en la base de datos
						$insertar = "INSERT INTO cliente (cedula, nomb_compl_cli, telefono, correo, direccion) VALUES ('$cedula_cli', '$nombre', '$telefono', '$correo', '$direccion');";
						$ejecutar = mysqli_query($con,$insertar);
						if($ejecutar){
							echo "<h3>Insertado Correctamente</h3>";
							?>
							<table>
								<tr class="strong">
									<td>Cedula</td>
									<td>Nombre Completo</td>
									<td>Agregar</td>
								</tr>
					           <tr>
					               <!--mostramos el codigo y nombre de las tuplas que han coincidido con la 
					               cadena insertada en nuestro formulario-->
					                <td><?php echo $cedula_cli; ?></td>
									<td><?php echo $nombre; ?></td>
									<td><a class="boton_tablas" href="<?php echo "agregar_cliente.php?client=" . $cedula_cli?>">Agregar</a></td>
					           </tr>
							</table>
						    <?php
						}//Cerrar el if
						else{
							echo "<h3>No se pudo insertar</h3>";
						}

					}
?>		
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
								echo "<h3 class='clienteh2'>Debe Agregar un cliente</h3>";
							}else{
								echo "<h3 class='clienteh2'>".$usuariocli['nomb_compl_cli']."</h3>";
							} ?></td>
						<tr>
							<th>Código</th>
							<th>Nombre</th>
							<th>Precio de venta</th>
							<th>Cantidad</th>
							<th>Total</th>
							<th>Quitar</th>
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
							<td><a class="boton_tablas" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>">Quitar</a></td>
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

</body>
</html>

