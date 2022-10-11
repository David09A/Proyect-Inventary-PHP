<?php 
	require_once("../../../db/config.php");//Incluir la conexion
	session_start();
	//error_reporting(E_ERROR | E_PARSE);
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$usuari = $_SESSION['user'];
	$admin = $usuari['n_name'];
	$prod = $_GET['prod'];

	if (!isset($usuari)) {
		header("location:../../../index.php");
	}elseif (!isset($prod)){
		header("location:../get/list_prod.php");
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
			<h2>Actualizar Producto</h2>
			<?php
			$consultar = "SELECT * FROM pr005m_prod WHERE k_refprod = '$prod'";
			$resultado = mysqli_query($con, $consultar);
			$mostrar = mysqli_fetch_array($resultado);
			?>
			<form action="../../peticions/update-prod.php?prod=<?php echo $mostrar['k_refprod']?>" method="POST">
				<h3>Nombre:</h3>
				<input  value="<?php echo $mostrar['n_name_prod'];?>" type="text" name="nombre" class="entrada" placeholder="Ingrese Nombre del producto" required>
				<br>
				<h3>Descripcion:</h3>
				<input  value="<?php echo $mostrar['n_desc_prod'];?>" type="text" name="descripcion" class="entrada" placeholder="Ingrese descripcion del producto" required>
				<br>
				<h3>Marca:</h3>
				<input  value="<?php echo $mostrar['n_brand'];?>" type="text" name="marca" class="entrada" placeholder="Ingrese Marca" required>
				
				<h3>Cantidad:</h3>
				<input  value="<?php echo $mostrar['v_cant'];?>" type="text" name="cantidad" class="entrada" placeholder="Ingrese cantidad"  required>
				<br>
				<h3>Precio del producto:</h3>
				<input  value="<?php echo $mostrar['v_valor_prod'];?>" type="text" name="precio" class="entrada" placeholder="Ingrese precio de venta" required>
				<br>
				<h3>Proveedor:</h3>
				<input  value="<?php echo $mostrar['k_prov_prod'];?>" type="text" name="proveedor" class="entrada" placeholder="Ingrese Poveedor"  required>
				<br><br>
				<input type="submit" value="Guardar" id="boton" name="insert"><br><br>
				<a href="../get/list_prod.php"><input type="button" id="boton" value="Cancelar" ></a>
			</form>
		</div>
		</center>
	</div>
</body>
</html>