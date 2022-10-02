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
			<h2>Crear Producto</h2>
			<form action="crear_prod.php" method="POST">
				<h3>Prefijo:</h3>
				<select class="seleccion" name="prefijo">
					<option value="0">Seleccione:</option>
			        <?php
					// Realizamos la consulta para extraer los datos
			          	$query1 = mysqli_query($con, "SELECT n_code, n_descri FROM `db004dm_domains` WHERE domain_name = 'DM_PREFIX'");
						if ($query1) {
							while ($valores = mysqli_fetch_array($query1)) {
						  // En esta sección estamos llenando el select con datos extraidos de una base de datos.
							  echo '<option value="'.$valores['n_code'].'">'.$valores['n_code'].' - '.$valores['n_descri'].'</option>';
							}
						}else
			        ?>
				</select>
				<br>
				<h3>Nombre del producto:</h3>
					<input type="text" name="n_name_prod" class="entrada" placeholder="Ingrese nombre del producto" required>
				<br>
				<h3>Descripcion:</h3>
				<input type="text" name="n_desc_prod" class="entrada" placeholder="Ingrese Descripcion" required>
				<br>
				<h3>Marca:</h3>
					<input type="text" name="n_brand" class="entrada" placeholder="Ingrese marca del producto" required>
				<br>
				<h3>Cantidad a Ingresar:</h3>
					<input type="text" name="v_cant" class="entrada" placeholder="Ingrese cantidad"  required>
				<br>
				<h3>Precio de venta:</h3>
					<input type="text" name="v_valor_prod" class="entrada" placeholder="Ingrese precio de venta" required>
				<br>
				<h3>Proveedor:</h3>
				<select class="seleccion" name="k_prov_prod">
					<option value="0">Seleccione:</option>
			        <?php
						// Realizamos la consulta para extraer los datos
			          	$query1 = mysqli_query($con, "SELECT k_identi, n_name FROM gr002det_user WHERE k_rol = 'PROV'");
			          	while ($valores = mysqli_fetch_array($query1)) {
						// En esta sección estamos llenando el select con datos extraidos de una base de datos.
			            echo '<option value="'.$valores['k_identi'].'">'.$valores['n_name'].'</option>';

			          }
			        ?>
						</select>
				<br>
					<input type="submit" value="Registrar" id="boton" name="insert"><br><br>
			</form>

	<?php
		if(isset($_POST['insert'])){
			$prefijo = $_POST['prefijo'];
			$n_name_prod = $_POST['n_name_prod'];
			$n_desc_prod = $_POST['n_desc_prod'];
			$n_brand = $_POST['n_brand'];
			$v_cant = $_POST['v_cant'];
			$v_valor_prod = $_POST['v_valor_prod'];
			$k_prov_prod  = $_POST['k_prov_prod'];
			$k_identi_add = $usuari['k_identi'];

	//insertar datos en la base de datos
			$insertar = "INSERT INTO pr005m_prod (relative, k_refprod, prefijo, n_name_prod, n_desc_prod, n_brand, v_cant, v_valor_prod, k_prov_prod, k_identi_add) values 
			(NULL, NULL, '$prefijo', '$n_name_prod', '$n_desc_prod', '$n_brand', '$v_cant', '$v_valor_prod', '$k_prov_prod', '$k_identi_add')";

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
						<th>Ref.</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Marca</th>
						<th>Cantidad</th>
						<th>Valor</th>
						<th>Proveedor</th>
					</tr>
					<?php
							// Realizamos la consulta para extraer la referencia del producto
			          		$query1 = mysqli_query($con, "SELECT * FROM pr005m_prod WHERE prefijo = '$prefijo' AND n_name_prod = '$n_name_prod'");
			          		while ($valores = mysqli_fetch_array($query1)) {
			            	$krefprod = $valores['k_refprod'];
			         		}
			        		?>
					<tr align="center">
						<td><?php echo $krefprod;?></td>
						<td><?php echo $n_name_prod;?></td>
						<td><?php echo $n_desc_prod;?></td>
						<td><?php echo $n_brand;?></td>	
						<td><?php echo $v_cant;?></td>
						<td><?php echo $v_valor_prod;?></td>
						<td><?php echo $k_prov_prod;?></td>
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