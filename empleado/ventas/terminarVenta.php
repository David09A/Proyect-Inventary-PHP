<?php
if(!isset($_POST["total"])) exit;


session_start();
$usuariow = $_SESSION['username'];
$usuarioww = $usuariow['num_cedula'];

$ccliente = $_GET['clie'];

$total = $_POST["total"];
include_once "../../servicios/conexion2.php";
//include_once "../../servicios/conexion.php";

date_default_timezone_set('America/Bogota');
$ahora = date("Y-m-d H:i:s");


//echo gettype($addmin);
//echo gettype($ccliente);
//echo gettype($total);
//echo gettype($ahora);
$sentencia = $base_de_datos->prepare("INSERT INTO `ventas` (`valor_total`, `usuario_venta`, `client_venta`, `fecha_venta`) VALUES (?, ?, ?, ?);");
$sentencia->execute([$total, $usuarioww, $ccliente, $ahora]);

$sentencia = $base_de_datos->prepare("SELECT id_venta FROM ventas ORDER BY id_venta DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->id_venta;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO det_ventas(id_venta, cod_producto, cant_prod, total_prod_cant) VALUES (?, ?, ?, ?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE productos SET cantidad = cantidad - ? WHERE id = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->total;
	$sentencia->execute([$idVenta, $producto->id, $producto->caantidad, $producto->total]);
	$sentenciaExistencia->execute([$producto->caantidad, $producto->id]);
}
$base_de_datos->commit();
unset($_SESSION["carrito"]);
unset($_SESSION["clie"]);
$_SESSION["carrito"] = [];
header("Location: ./crearventa.php?status=1&idvent=$idVenta&cli=$cliente");
?>