<?php 
	include '../../servicios/conexion.php';
	session_start();
	error_reporting(E_ERROR | E_PARSE);
	$usuarioadm = $_SESSION['useradmin'];
	$admin = $usuarioadm['nombres'];


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
							<li><a href="../listas/list_prod_admin.php">Productos</a></li>
							<li><a href="../listas/list_insumoprod.php">Insumos de Produccion</a></li>
							<li><a href="../listas/list_insumoempaq.php">Insumos de Empaquetado</a></li>
							<li><a href="../listas/list_materia.php">Materia Prima</a></li>
							<li><a href="../listas/list_emple.php">Empleados</a></li>
							<li><a href="../listas/list_prov.php">Proveedores</a></li>
						</ul>
					</li>
					<li><a href="">Crear</a>
						<ul>
							<li><a href="crear_prod.php">Nuevo Producto</a></li>
							<li><a href="crearinsumoprod.php">Nuevo Insumo de Produccion</a></li>
							<li><a href="crearinsumoempaq.php">Nuevo Insumo de Empaquetado</a></li>
							<li><a href="crearmateria.php">Nueva Materia Prima</a></li>
							<li><a href="nuevo_admin.php">Nuevo Administrador</a></li>
							<li><a href="crear_prov.php">Nuevo proveedor</a></li>
						</ul>
					</li>
					<li><a href="../../servicios/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="crear_prod">
			<h2>Crear Insumo</h2>
			<form action="crearinsumoprod.php" method="POST">
				<h3>Nombre de Insumo de Produccion:</h3>
				<input type="text" name="nom_produccion" class="entrada" placeholder="Ingrese Nombre del producto" required>
				<br>
				<h3>Cantidad:</h3>
				<input type="text" name="cantidad" class="entrada" placeholder="Ingrese Cantidad del producto" required>
				<br>
				<h3>Ubicacion:</h3>
				<select name="ubicacion" class="seleccion">
					<option value="Bodega">Bodega</option>
					<option value="Almacen">Almacen</option>
				</select>
				<br>
				<h3>Proveedor:</h3>
				<select class="seleccion" name="nit_proveedor">
					<option value="0">Seleccione:</option>
			        <?php
			// Realizamos la consulta para extraer los datos
			          $query = $con -> query ("SELECT * FROM proveedor");
			          while ($valores = mysqli_fetch_array($query)) {
			// En esta sección estamos llenando el select con datos extraidos de una base de datos.
			            echo '<option value="'.$valores[nit].'">'.$valores[nom_empresa].'</option>';
			          }
			        ?>
						</select>
				<br><br>
				<input type="submit" value="Registrar" id="boton" name="insert"><br><br>
			</form>

	<?php
		if(isset($_POST['insert'])){
			$nom_produccion = $_POST['nom_produccion'];
			$cantidad = $_POST['cantidad'];
			$ubicacion = $_POST['ubicacion'];
			$nit_proveedor = $_POST['nit_proveedor'];

	//insertar datos en la base de datos
			$insertar = "INSERT INTO insumos_para_produccion (nom_produccion, cantidad, ubicacion, nit_proveedor) VALUES ('$nom_produccion', '$cantidad', ' $ubicacion', '$nit_proveedor')";

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
						<td><?php echo $nom_produccion;?></td>
						<td><?php echo $cantidad;?></td>	
						<td><?php echo $ubicacion;?></td>
						<td><?php echo $nit_proveedor;?></td>
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