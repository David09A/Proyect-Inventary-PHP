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
							<li><a href="../listas/list_prod_emple.php">Productos</a></li>
							<li><a href="../listas/list_insumoprod.php">Insumos de Produccion</a></li>
							<li><a href="../listas/list_insumoempaq.php">Insumos de Empaquetado</a></li>
							<li><a href="../listas/list_materia.php">Materia Prima</a></li>
						</ul>
					</li>
					<li><a href="">Crear</a>
						<ul>
							<li><a href="crear_prod.php">Nuevo Producto</a></li>
							<li><a href="crearinsumoprod.php">Nuevo Insumo de Produccion</a></li>
							<li><a href="crearinsumoempaq.php">Nuevo Insumo de Empaquetado</a></li>
							<li><a href="crearmateria.php">Nueva Materia Prima</a></li>
							<li><a href="crear_prov.php">Nuevo proveedor</a></li>
						</ul>
					</li>
					<li><a href="../../servicios/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="crear_prod">
			<h2>Crear Proveedor</h2>
			<form action="crear_prov.php" method="POST">
				<h3>Nit de la Empresa:</h3>
				<input type="text" name="nit" class="entrada" placeholder="Ingrese nit de la empresa" required>
				<br>
				<h3>Nombre:</h3>
				<input type="text" name="nom_empresa" class="entrada" placeholder="Ingrese Nombre" required>
				<br>
				<h3>Telefono:</h3>
				<input type="text" name="telefono" class="entrada" placeholder="Ingrese telefono" required>
				<br>
				<h3>Correo:</h3>
				<input type="text" name="correo" class="entrada" placeholder="Ingrese Correo" required>
				<br>
				<h3>Direccion:</h3>
				<input type="text" name="direccion" class="entrada" placeholder="Ingrese Direccion" required>
				<br><br>
				<input type="submit" value="Registrar" id="boton" name="insert"><br><br>
			</form>

	<?php
		if(isset($_POST['insert'])){
			$nit = $_POST['nit'];
			$nom_empresa = $_POST['nom_empresa'];
			$telefono = $_POST['telefono'];
			$correo = $_POST['correo'];
			$direccion = $_POST['direccion'];

	//insertar datos en la base de datos
			$insertar = "INSERT INTO `proveedor` (`nit`, `nom_empresa`, `telefono`, `correo`, `direccion`) VALUES ('$nit', '$nom_empresa', '$telefono', '$correo', '$direccion')";

			$ejecutar = mysqli_query($con,$insertar);
			if($ejecutar){
				echo "<h3>Insertado Correctamente</h3>";
			?>
				<!--creamos una tabla-->
				<br/>
				<br/>
				<center>
				<h3>Datos Ingresados</h3>
				
					<table>
					<tr align="center">
						<td><?php echo $nit;?></td>
						<td><?php echo $nom_empresa;?></td>	
						<td><?php echo $telefono;?></td>
						<td><?php echo $correo;?></td>
						<td><?php echo $direccion;?></td>
					</tr>
					</table>
				</center>
			<?php
			}else{
				echo "No se pudo registrar";
			}
		}
	?>
	</div>
</center>
	</div>
</body>
</html>