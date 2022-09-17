<?php 
	include '../servicios/conexion.php';
	session_start();
	$usuario = $_SESSION['username'];

	if (!isset($usuario)) {
			header("location:../servicios/logearse.html");
		}	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>INICIO</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../estilos/index.css">
	<link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
	 <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
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
					<li><a href="crearventa.php"><strong>Crear Venta</strong></a></li>
					<li><a href="">Ver y Actualizar Listas</a>
						<ul>
							<li><a href="listas/list_prod_admin.php">Productos</a></li>
							<li><a href="listas/list_insumoprod.php">Insumos de Produccion</a></li>
							<li><a href="listas/list_insumoempaq.php">Insumos de Empaquetado</a></li>
							<li><a href="listas/list_materia.php">Materia Prima</a></li>
						</ul>
					</li>
					<li><a href="">Crear</a>
						<ul>
							<li><a href="crear/crear_prod.php">Nuevo Producto</a></li>
							<li><a href="crear/crearinsumoprod.php">Nuevo Insumo de Produccion</a></li>
							<li><a href="crear/crearinsumoempaq.php">Nuevo Insumo de Empaquetado</a></li>
							<li><a href="crear/crearmateria.php">Nueva Materia Prima</a></li>
						</ul>
					</li>
					<li><a href="../servicios/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
	</center>
	<center>
		<div class="ventas">
			<div class="cliente">
				<div class="uno">
					<h2>Datos del Cliente</h2>
					<button type="submit" onfocus="desplegar1()">Cliente Existente</button>
					<button type="submit" onfocus="desplegar2()">Nuevo Cliente</button>
				</div>
				<div id="existente">
					<form action="buscarcli.php" method="post">
						<label for="">Buscar Cliente</label>
						<input type="text" placeholder="Cedula" name="cedu" required>
						<input type="submit" value="Agregar" name="client">
					</form>
					
				</div>
				<div id="nuevo">
					<form action="crearventa.php" method="POST">
						<div>
							<div>
								<h3>Cedula:</h3>
								<input type="text" name="cedula" class="entrada2" placeholder="Ingrese Nombre del producto" required>
							</div>
							<div>
								<h3>Nombre:</h3>
								<input type="text" name="nombre" class="entrada2" placeholder="Ingrese Cantidad del producto" required>
							</div>
							<div>
								<h3>Apellido:</h3>
								<input type="text" name="apellido" class="entrada2" placeholder="Ingrese ubicacion" required>
							</div>
							<div>
								<h3>Telefono:</h3>
								<input type="text" name="telefono" class="entrada2" placeholder="Ingrese proveedor" required>
							</div>
							<div>
								<h3>Correo:</h3>
								<input type="email" name="correo" class="entrada2" placeholder="Ingrese proveedor" required>
							</div>
							<div>
								<h3>Direccion:</h3>
								<input type="text" name="direccion" class="entrada2" placeholder="Ingrese proveedor" required>
							</div>
							<br><br>
							<input type="submit" value="Registrar" id="boton" name="insertcli"><br>
						</div>
						
					<?php
					if(isset($_POST['insertcli'])){
						$cedula = $_POST['cedula'];
						$nombre = $_POST['nombre'];
						$apellido = $_POST['apellido'];
						$telefono = $_POST['telefono'];
						$correo = $_POST['correo'];
						$direccion = $_POST['direccion'];

				//insertar datos en la base de datos
						$insertar = "INSERT INTO cliente (cedula, nombre, apellido, telefono, correo, direccion) VALUES ('$cedula', '$nombre ', '$apellido', '$telefono', '$correo', '$direccion');";
						$ejecutar = mysqli_query($con,$insertar);
						if($ejecutar){
							echo "<h3>Insertado Correctamente</h3>";
						}else{
							echo "<h3>No se pudo insertar</h3>";
						}

						}?>
							</form>
							</div>
			</div>
			
		</div>
	</center>
</div><!-- Cierra Contain 1 -->
<script>
function desplegar1() {
  document.getElementById("existente").style.display = "block";
  document.getElementById("nuevo").style.display = "none";
}
function desplegar2() {
  document.getElementById("nuevo").style.display = "block";
  document.getElementById("existente").style.display = "none";
}

document.writeElementById()
</script>
</body>
</html>