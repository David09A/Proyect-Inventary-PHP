<?php 
	require_once("../../db/config.php");//Incluir la conexion
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	$usuari = $_SESSION['user'];
	$admin = $usuari['n_name'];
	$usuariocli = $_SESSION['clie'];


	if (!isset($usuari)) {
			header("location: ../../index.php");
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
