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
							<li><a href="crear_empleado.php">Nuevo Empleado</a></li>
							<li><a href="nuevo_admin.php">Nuevo Administrador</a></li>
							<li><a href="crear_prov.php">Nuevo proveedor</a></li>
						</ul>
					</li>
					<li><a href="../../servicios/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="crear_prod">
			<h2>Crear Producto</h2>
			<form action="crear_prod.php" method="POST">
				<h3>Nombre:</h3>
				<input type="text" name="nombre" class="entrada" placeholder="Ingrese Nombre del producto" required>
				<br>
				<h3>Presentacion:</h3>
				<input type="text" name="presentacion" class="entrada" placeholder="Ingrese Presentacion del producto" required>
				<br>
				<h3>Descripcion:</h3>
				<input type="text" name="descripcion" class="entrada" placeholder="Ingrese descripcion" required>
				<br>
				<h3>Ubicacion:</h3>
				<select name="ubicacion" class="seleccion">
					<option value="Bodega">Bodega</option>
					<option value="Almacen">Almacen</option>
				</select>
				<br>
				<h3>Precio de venta:</h3>
				<input type="text" name="precio_venta" class="entrada" placeholder="Ingrese precio de venta" required>
				<br>
				<h3>Precio de Produccion:</h3>
				<input type="text" name="precio_produccion" class="entrada" placeholder="Ingrese Precio de Produccion"  required>
				<br>
				<h3>Cantidad a Ingresar:</h3>
				<input type="text" name="cantidad" class="entrada" placeholder="Ingrese Cantidad"  required>
				<br>
				<h3>Tipo de Empaque:</h3>
				<select class="seleccion" name="nom_empaque">
					<option value="0">Seleccione:</option>
			        <?php
			// Realizamos la consulta para extraer los datos
			          $query1 = $con -> query ("SELECT * FROM insumos_para_empacar");
			          while ($valores = mysqli_fetch_array($query1)) {
			// En esta sección estamos llenando el select con datos extraidos de una base de datos.
			            echo '<option value="'.$valores[id_empa].'">'.$valores[nom_empaque].'</option>';
			          }
			        ?>
						</select>
				<br>
				<h3>Id Insumos Produccion:</h3>
				<select class="seleccion" name="nom_produccion">
					<option value="0">Seleccione:</option>
			        <?php
			// Realizamos la consulta para extraer los datos
			          $query2 = $con -> query ("SELECT * FROM insumos_para_produccion");
			          while ($valores = mysqli_fetch_array($query2)) {
			// En esta sección estamos llenando el select con datos extraidos de una base de datos.
			            echo '<option value="'.$valores[id_produc].'">'.$valores[nom_produccion].'</option>';
			          }
			        ?>
						</select>
				<br>
				<h3>Materia Prima:</h3>
				<select class="seleccion" name="nom_materia_prima">
					<option value="0">Seleccione:</option>
			        <?php
			// Realizamos la consulta para extraer los datos
			          $query3 = $con -> query ("SELECT * FROM materia_prima");
			          while ($valores = mysqli_fetch_array($query3)) {
			// En esta sección estamos llenando el select con datos extraidos de una base de datos.
			            echo '<option value="'.$valores[id_mat].'">'.$valores[nom_materia_prima].'</option>';
			          }
			        ?>
						</select>
				<br><br>
				<input type="submit" value="Registrar" id="boton" name="insert"><br><br>
			</form>

	<?php
		if(isset($_POST['insert'])){
			$nombre = $_POST['nombre'];
			$presentacion = $_POST['presentacion'];
			$descripcion = $_POST['descripcion'];
			$ubicacion = $_POST['ubicacion'];
			$precio_venta = $_POST['precio_venta'];
			$precio_produccion = $_POST['precio_produccion'];
			$cantidad = $_POST['cantidad'];
			$nom_empaque  = $_POST['nom_empaque'];
			$nom_produccion = $_POST['nom_produccion'];
			$nom_materia_prima = $_POST['nom_materia_prima'];

	//insertar datos en la base de datos
			$insertar = "INSERT into productos 
			(nombre, presentacion, descripcion, ubicacion, precio_venta, precio_produccion, cantidad, nom_empaque, nom_produccion, nom_materia_prima) values 
			('$nombre', '$presentacion', '$descripcion', '$ubicacion', '$precio_venta', '$precio_produccion', '$cantidad', $nom_empaque, $nom_produccion, $nom_materia_prima)";

			$ejecutar = mysqli_query($con,$insertar);
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
						<th>Nombre</th>
						<th>Presentacion</th>
						<th>Descripcion</th>
						<th>Ubicacion</th>
						<th>Precio de Venta</th>
						<th>Precio de Produccion</th>
						<th>Tipo de Empaque</th>
						<th>Insumo de Produccion</th>
						<th>Materia Prima</th>
					</tr>
					<tr align="center">
						<td><?php echo $nombre;?></td>
						<td><?php echo $presentacion;?></td>	
						<td><?php echo $descripcion;?></td>
						<td><?php echo $ubicacion;?></td>
						<td><?php echo $precio_venta;?></td>
						<td><?php echo $precio_produccion;?></td>
						<td><?php echo $nom_empaque;?></td>
						<td><?php echo $nom_produccion;?></td>
						<td><?php echo $nom_materia_prima;?></td>
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