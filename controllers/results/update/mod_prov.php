<?php 
	require_once("../../../db/config.php");//Incluir la conexion
	session_start();
	//error_reporting(E_ERROR | E_PARSE);
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$usuari = $_SESSION['user'];
	$admin = $usuari['n_name'];
	$prov = $_GET['prov'];

	if (!isset($usuari)) {
		header("location:../../../index.php");
	}elseif (!isset($prov)){
		header("location:../get/list_prov.php");
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>INICIO</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../../assets/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
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
					<li><a href="../init.php">Crear Venta</a></li>
					<li><a href="">Ver y Actualizar Listas</a>
						<ul>
							<li><a href="../get/list_prod.php">Productos</a></li>
							<li><a href="../get/list_prov.php">Proveedores</a></li>
						</ul>
					</li>
					<li><a href="">Agregar</a>
						<ul>
							<li><a href="../crear_prod.php">Nuevo Producto</a></li>
							<li><a href="../crear_prov.php">Nuevo proveedor</a></li>
							<li><a href="../new_admin.php">Nuevo Administrador</a></li>
						</ul>
					</li>
					<li><a href="../../peticions/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="crear_prod">
			<h2>Actualizar Proveedor</h2>
			<?php
			$consultar = "SELECT * FROM gr002det_user WHERE k_identi = '$prov'";
			$resultado = mysqli_query($con, $consultar);
			$mostrar = mysqli_fetch_array($resultado);
			?>
			<form action="../../peticions/update-prov.php?prov=<?php echo $mostrar['k_identi']?>" method="POST">
				<h3>Nombre:</h3>
				<input  value="<?php echo $mostrar['n_name'];?>" type="text" name="n_name" class="entrada" placeholder="Ingrese Nombre del proveedor" required>
				<br>
				<h3>Celular:</h3>
				<input  value="<?php echo $mostrar['v_phone'];?>" type="text" name="v_phone" class="entrada" placeholder="Ingrese descripcion del proveedor" required>
				<br>
				<h3>Direccion:</h3>
				<input  value="<?php echo $mostrar['n_address'];?>" type="text" name="n_address" class="entrada" placeholder="Ingrese Direccion" required>
				
				<h3>Correo Electronico:</h3>
				<input  value="<?php echo $mostrar['n_mail'];?>" type="email" name="n_mail" class="entrada" placeholder="Ingrese correo"  required>
				<br>
				<input type="submit" value="Guardar" id="boton" name="insert"><br><br>
				<a href="../get/list_prod.php"><input type="button" id="boton" value="Cancelar" ></a>
			</form>
		</div>
		</center>
	</div>
</body>
</html>