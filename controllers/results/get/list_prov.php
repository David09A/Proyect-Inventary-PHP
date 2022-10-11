<?php 
	require_once("../../../db/config.php");//Incluir la conexion
	session_start();
	error_reporting(E_ERROR | E_PARSE);
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
					<li><a href="../init.php">Crear Venta</a></li>
					<li><a href="">Ver y Actualizar Listas</a>
						<ul>
							<li><a href="list_prod.php">Productos</a></li>
							<li><a href="list_prov.php">Proveedores</a></li>
						</ul>
					</li>
					<li><a href="">Agregar</a>
						<ul>
							<li><a href="../insert/crear_prod.php">Nuevo Producto</a></li>
							<li><a href="../insert/crear_prov.php">Nuevo proveedor</a></li>
							<li><a href="../insert/new_admin.php">Nuevo Administrador</a></li>
						</ul>
					</li>
					<li><a href="../../peticions/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="search-place">
			<form method="POST" action="list_prov.php" onSubmit="return validarForm(this)">
    			<div class="buscador">
					<input class="busqueda" type="text" placeholder="Buscar proveedor" name="palabra">
    				<input class="botonbusq" type="submit" value="Buscar" name="buscar">
				</div><br>
    			<script type="text/javascript">
   					function validarForm(formulario){
        			if(formulario.palabra.value.length==0) 
        			{ //¿Tiene 0 caracteres?
            		formulario.palabra.focus();  // Damos el foco al control
            		alert('Debes rellenar este campo'); //Mostramos el mensaje
            		return false; 
         			} //devolvemos el foco  
         			return true; //Si ha llegado hasta aquí, es que todo es correcto 
     				}   
				</script>
			</form>
			<?php 
					if(isset($_POST['buscar'])) 
					{  
					   ?>
					   <!-- el resultado de la búsqueda lo encapsularemos en un tabla -->
					   <table>
					       <tr class="strong">
						<th>Nit.</th>
						<th>Nombre</th>
						<th>Celular</th>
						<th>Direccion</th>
						<th>Correo</th>
								<td colspan="2">Opciones</td>
							</tr>
					       <?php
					       //obtenemos la información introducida anteriormente desde nuestro buscador PHP
					       $buscar = $_POST["palabra"];
					 
					       $consulta_mysql= mysqli_query ($con, "SELECT * FROM gr002det_user WHERE (k_identi like '%$buscar%' or n_name like '%$buscar%') AND k_rol = 'PROV' LIMIT 5");
					 
					       while($registro = mysqli_fetch_assoc($consulta_mysql)) 
					       {
					           ?> 
					           <tr>
					               <!--mostramos el codigo y nombre de las tuplas que han coincidido con la 
					               cadena insertada en nuestro formulario-->
					              	<td><?php echo $registro['k_identi']; ?></td>
									<td><?php echo $registro['n_name']; ?></td>
									<td><?php echo $registro['v_phone']; ?></td>
									<td><?php echo $registro['n_address']; ?></td>
									<td><?php echo $registro['n_mail']; ?></td>
									<td><a href="../update/mod_prov.php?prov=<?php echo $registro['k_identi']?>"><input type="button" name="Editar" value="Editar" class="boton_tablas"></a></td>
									<td><a href="../../peticions/delete.php?tableName=gr002det_user&id=<?php echo $registro['k_identi']?>"><input type="button" name="eliminar" value="Eliminar" class="boton_tablas"></a></td>
					           </tr>
					           <?php 
					       } //fin blucle
					    ?>
					    </table>
    <?php
}
?>
		</div>
		<div class="products-list">
			<div class="header">
			<h1>Proveedores</h1>
			<a href="../../assets/pdf/reporte_prov.php" target="_blank"><button class="generador">Generar PDF</button></a>
			</div>
			<?php
			if($_GET["status"] === "1"){
				?>
					<div class="alertas">
						<strong>¡Correcto!</strong> Elimino el proveedor: <?php 
						$id = $_GET['id'];
						echo $id; ?>
					</div>
				<?php
			}elseif($_GET["status"] === "2"){
				?>
					<div class="alertas">
						<strong>¡Ohhhh!</strong> No se pudo eliminar el proveedor: <?php 
						$id = $_GET['id'];
						echo $id; ?>
					</div>
				<?php
			}
			?>				
			<table>
				<tr class="strong">
						<th>Nit.</th>
						<th>Nombre</th>
						<th>Celular</th>
						<th>Direccion</th>
						<th>Correo</th>
					<td colspan="2">Opciones</td>
				</tr>
				<?php
				
				$query ="SELECT k_identi, n_name, v_phone, n_address, n_mail from gr002det_user WHERE k_rol = 'PROV' LIMIT 15";

				$consulta=mysqli_query($con,$query);


				while ($mostrar =mysqli_fetch_array($consulta)) {
					
				?>
				<tr>
				<td><?php echo $mostrar['k_identi']; ?></td>
				<td><?php echo $mostrar['n_name']; ?></td>
				<td><?php echo $mostrar['v_phone']; ?></td>
				<td><?php echo $mostrar['n_address']; ?></td>
				<td><?php echo $mostrar['n_mail']; ?></td>
				<td><a href="../update/mod_prov.php?prov=<?php echo $mostrar['k_identi']?>"><input type="button" name="Editar" value="Editar" class="boton_tablas"></a></td>
				<td><a href="../../peticions/delete.php?tableName=gr002det_user&id=<?php echo $mostrar['k_identi']?>"><input type="button" name="eliminar" value="Eliminar" class="boton_tablas"></a></td>
			</tr>
				<?php 
				}
				 ?>
				 
			</table>
		</div>
	</center>
	</div>
</body>
</html>