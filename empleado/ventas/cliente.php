<div class="cliente">
				<div class="uno">
					<h2>Datos del Cliente</h2>
					<button type="submit" class="boton_tablas" onfocus="desplegar1()">Existente</button>
					<button type="submit" class="boton_tablas" onfocus="desplegar2()">Nuevo Cliente</button>
				</div>
			</div>
			<div id="existente">
				<form method="post" action="resultado.php" class="buscador">
					<label>Cedula del Cliente:</label>
					<input autocomplete="off" autofocus class="busqueda" name="cedu" type="text" id="cedula" placeholder="Escribe la cedula">
					<input type="submit" value="Buscar" class="botonbusq" name="ceduboton">
					
				</form>
			</div>
			<div id="nuevo">
					<form action="resultado.php" method="POST">
						<div>
							<div>
								<h3>Cedula:</h3>
								<input type="text" name="cedula" class="entrada" placeholder="Ingrese Nombre del producto" required>
							</div>
							<div>
								<h3>Nombre Completo:</h3>
								<input type="text" name="nombre" class="entrada" placeholder="Ingrese Nombre Completo" required>
							</div>
							<div>
								<h3>Telefono:</h3>
								<input type="text" name="telefono" class="entrada" placeholder="Ingrese proveedor" required>
							</div>
							<div>
								<h3>Correo:</h3>
								<input type="email" name="correo" class="entrada" placeholder="Ingrese proveedor" required>
							</div>
							<div>
								<h3>Direccion:</h3>
								<input type="text" name="direccion" class="entrada" placeholder="Ingrese proveedor" required>
							</div>
							<br><br>
							<input type="submit" value="Registrar" id="boton" name="insertcli"><br>
						</div>
						
					
							</form>
							</div>
			</div>
			<script>
function desplegar1() {
  document.getElementById("existente").style.display = "block";
  document.getElementById("nuevo").style.display = "none";
}
function desplegar2() {
  document.getElementById("nuevo").style.display = "block";
  document.getElementById("existente").style.display = "none";
}

</script>