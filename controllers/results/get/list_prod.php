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
			<form method="POST" action="list_prod.php" onSubmit="return validarForm(this)">
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
								<td>Ref</td>
								<td>Nombre</td>
								<td>Descripcion</td>
								<td>Marca</td>
								<td>Cantidad</td>
								<td>Valor</td>
								<td>Proveedor</td>
								<td colspan="2">Opciones</td>
							</tr>
					       <?php
					       //obtenemos la información introducida anteriormente desde nuestro buscador PHP
					       $buscar = $_POST["palabra"];
					 
					       $consulta_mysql= mysqli_query ($con, "SELECT * FROM pr005m_prod WHERE k_refprod like '%$buscar%' or n_name_prod like '%$buscar%' LIMIT 5");
					 
					       while($registro = mysqli_fetch_assoc($consulta_mysql)) 
					       {
					           ?> 
					           <tr>
					               <!--mostramos el codigo y nombre de las tuplas que han coincidido con la 
					               cadena insertada en nuestro formulario-->
					              	<td><?php echo $registro['k_refprod']; ?></td>
									<td><?php echo $registro['n_name_prod']; ?></td>
									<td><?php echo $registro['n_desc_prod']; ?></td>
									<td><?php echo $registro['n_brand']; ?></td>
									<td><?php echo $registro['v_cant']; ?></td>
									<td><?php echo $registro['v_valor_prod']; ?></td>
									<td><?php echo $registro['k_prov_prod']; ?></td>
									<td><a href="ACTUALIZAR/productos.php?prod=<?php echo $registro['k_refprod']?>"><input type="button" name="Editar" value="Editar" class="boton_tablas"></a></td>
									<td><a href="ELIMINAR/eliminarprod.php?prod=<?php echo $registro['k_refprod']?>"><input type="button" name="eliminar" value="Eliminar" class="boton_tablas"></a></td>
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
			<a href="../../assets/pdf/reporte_producto.php" target="_blank"><button class="generador">Generar PDF</button></a>
			</div>			
			<table>
				<tr class="strong">
					<td>Ref</td>
					<td>Nombre</td>
					<td>Descripcion</td>
					<td>Marca</td>
					<td>Cantidad</td>
					<td>Valor</td>
					<td>Proveedor</td>
					<td colspan="2">Opciones</td>
				</tr>
				<?php
				
				$query ="SELECT k_refprod, n_name_prod, n_desc_prod, n_brand, v_cant, v_valor_prod, k_prov_prod from pr005m_prod LIMIT 15";

				$consulta=mysqli_query($con,$query);


				while ($mostrar =mysqli_fetch_array($consulta)) {
					
				?>
				<tr>
				<td><?php echo $mostrar['k_refprod']; ?></td>
				<td><?php echo $mostrar['n_name_prod']; ?></td>
				<td><?php echo $mostrar['n_desc_prod']; ?></td>
				<td><?php echo $mostrar['n_brand']; ?></td>
				<td><?php echo $mostrar['v_cant']; ?></td>
				<td><?php echo $mostrar['v_valor_prod']; ?></td>
				<td><?php echo $mostrar['k_prov_prod']; ?></td>
				<td><a href="ACTUALIZAR/productos.php?prod=<?php echo $mostrar['k_refprod']?>"><input type="button" name="Editar" value="Editar" class="boton_tablas"></a></td>
				<td><a href="ELIMINAR/eliminarprod.php?prod=<?php echo $mostrar['k_refprod']?>"><input type="button" name="eliminar" value="Eliminar" class="boton_tablas"></a></td>
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