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
							<li><a href="list_prod_admin.php">Productos</a></li>
							<li><a href="list_insumoprod.php">Insumos de Produccion</a></li>
							<li><a href="list_insumoempaq.php">Insumos de Empaquetado</a></li>
							<li><a href="list_materia.php">Materia Prima</a></li>
							<li><a href="list_emple.php">Empleados</a></li>
							<li><a href="list_prov.php">Proveedores</a></li>
						</ul>
					</li>
					<li><a href="">Crear</a>
						<ul>
							<li><a href="../crear/crear_prod.php">Nuevo Producto</a></li>
							<li><a href="../crear/crearinsumoprod.php">Nuevo Insumo de Produccion</a></li>
							<li><a href="../crear/crearinsumoempaq.php">Nuevo Insumo de Empaquetado</a></li>
							<li><a href="../crear/crearmateria.php">Nueva Materia Prima</a></li>
							<li><a href="../crear/crear_empleado.php">Nuevo Empleado</a></li>
							<li><a href="../crear/nuevo_admin.php">Nuevo Administrador</a></li>
							<li><a href="../crear/crear_prov.php">Nuevo proveedor</a></li>
						</ul>
					</li>
					<li><a href="../../servicios/finalizar.php">Cerrar Sesion</a></li>
				</ul>
			</nav>
		</div><br>
		<div class="search-place">
			<form method="POST" action="list_prod_admin.php" onSubmit="return validarForm(this)">
    			<div class="buscador">
					<input class="busqueda" type="text" placeholder="Buscar producto" name="palabra">
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
								<td>Codigo</td>
								<td>Nombre</td>
								<td>Descripcion</td>
								<td>Stock</td>
								<td>Precio</td>
								<td colspan="2">Opciones</td>
							</tr>
					       <?php
					       //obtenemos la información introducida anteriormente desde nuestro buscador PHP
					       $buscar = $_POST["palabra"];
					 
					       $consulta_mysql= mysqli_query ($con, "SELECT * FROM productos WHERE id like '%$buscar%' or nombre like '%$buscar%'");
					 
					       while($registro = mysqli_fetch_assoc($consulta_mysql)) 
					       {
					           ?> 
					           <tr>
					               <!--mostramos el codigo y nombre de las tuplas que han coincidido con la 
					               cadena insertada en nuestro formulario-->
					               <td><?php echo $registro['id']; ?></td>
									<td><?php echo $registro['nombre']; ?></td>
									<td><?php echo $registro['descripcion']; ?></td>
									<td><?php echo $registro['cantidad']; ?></td>
									<td><?php echo $registro['precio_venta']; ?></td>
									<td><a href="ACTUALIZAR/productos.php?prod=<?php echo $registro['id']?>"><input type="button" name="Editar" value="Editar" class="boton_tablas"></a></td>
									<td><a href="ELIMINAR/eliminarprod.php?prod=<?php echo $registro['id']?>"><input type="button" name="eliminar" value="Eliminar" class="boton_tablas"></a></td>
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
			<h1>Productos</h1>
			<a href="../../Pdf/reporte_producto.PHP" target="_blank"><button class="generador">Generar PDF</button></a>
			</div>			
			<table>
				<tr class="strong">
					<td>Codigo</td>
					<td>Nombre</td>
					<td>Descripcion</td>
					<td>Cantidad Actual</td>
					<td>Precio</td>
					<td colspan="2">Opciones</td>
				</tr>
				<?php
				
				$query ="SELECT id, nombre, descripcion, cantidad, precio_venta from productos";

				$consulta=mysqli_query($con,$query);


				while ($mostrar =mysqli_fetch_array($consulta)) {
					
				?>
				<tr>
					<td><?php echo $mostrar['id']; ?></td>
					<td><?php echo $mostrar['nombre']; ?></td>
					<td><?php echo $mostrar['descripcion']; ?></td>
					<td><?php echo $mostrar['cantidad']; ?></td>
					<td><?php echo $mostrar['precio_venta']; ?></td>
					<td><a href="ACTUALIZAR/productos.php?prod=<?php echo $mostrar['id']?>"><input type="button" name="Editar" value="Editar" class="boton_tablas" ></a></td>
					<td><a href="ELIMINAR/eliminarprod.php?prod=<?php echo $mostrar['id']?>"><input type="button" name="eliminar" value="Eliminar" class="boton_tablas" ></a></td>
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