<?php 
	require_once("../../../db/config.php");//Incluir la conexion
	session_start();
	//error_reporting(E_ERROR | E_PARSE);
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$usuari = $_SESSION['user'];
	$admin = $usuari['n_name'];

	if (!isset($usuari)) {
			header("location:../../../index.php");
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
							<li><a href="crear_prod.php">Nuevo Producto</a></li>
							<li><a href="crear_prov.php">Nuevo proveedor</a></li>
							<li><a href="new_admin.php">Nuevo Administrador</a></li>
						</ul>
					</li>
					<li><a href="../../peticions/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="crear_prod">
			<h2>Crear Admin</h2>
			<form action="new_admin.php" method="POST">
				<h3>Cedula:</h3>
					<input type="text" name="k_identi" class="entrada" placeholder="Ingrese Cedula" required>
				<br>
				<h3>Nombre:</h3>
				<input type="text" name="n_name" class="entrada" placeholder="Ingrese Nombre" required>
				<br>
				<h3>Apellido:</h3>
				<input type="text" name="n_lastname" class="entrada" placeholder="Ingrese Apellido" required>
				<br>
				<h3>Telefono o Celular:</h3>
					<input type="number" name="v_phone" class="entrada" placeholder="Ingrese numero de contacto" required>
				<br>
				<h3>Direccion:</h3>
					<input type="text" name="n_address" class="entrada" placeholder="Ingrese Direccion"  required>
				<br>
				<h3>Correo electronico:</h3>
					<input type="email" name="n_mail" class="entrada" placeholder="Ingrese correo electronico" required>
				<br>
					<input type="submit" value="Registrar" id="boton" name="insert"><br><br>
			</form>

	<?php
		if(isset($_POST['insert'])){
			$k_identi = $_POST['k_identi'];
			$n_name = $_POST['n_name'];
			$n_lastname = $_POST['n_lastname'];
			$v_phone = $_POST['v_phone'];
			$n_address = $_POST['n_address'];
			$n_mail = $_POST['n_mail'];
			$k_rol = 'ADM';

	//insertar datos en la base de datos
			$insertar = "INSERT INTO gr002det_user (k_identi, n_name, n_lastname, v_phone, n_address, n_mail, k_rol) values 
			('$k_identi', '$n_name', '$n_lastname', '$v_phone', '$n_address', '$n_mail', '$k_rol')";

			$ejecutar = mysqli_query($con, $insertar);
			if($ejecutar){
				echo "<h3>Insertado Correctamente</h3>";
			?>
		</div>
				<!--creamos una tabla-->
				<br/>
				<br/>
				<center>
				<h3>Datos Ingresados</h3>
				
					<table>
					<tr>
						<th>Nit.</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Celular</th>
						<th>Direccion</th>
						<th>Correo</th>
					</tr>
					<tr align="center">
						<td><?php echo $k_identi;?></td>
						<td><?php echo $n_name;?></td>
						<td><?php echo $n_lastname;?></td>
						<td><?php echo $v_phone;?></td>	
						<td><?php echo $n_address;?></td>
						<td><?php echo $n_mail;?></td>
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