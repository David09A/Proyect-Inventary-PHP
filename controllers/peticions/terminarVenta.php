<?php
if(!isset($_POST["total"])) exit;


session_start();
$usuarioadm = $_SESSION['useradmin'];
$addmin = $usuarioadm['num_cedula'];

$total = $_POST["total"];
include_once "../../db/pdo_con.php";


$sentencia = $base_de_datos->prepare("INSERT INTO `vt006m_sale` (`v_sale_total`, `k_identi_vent`) VALUES (?, ?, ?, ?);");
$sentencia->execute([$total, $addmin]);

$sentencia = $base_de_datos->prepare("SELECT k_idsale FROM vt006m_sale ORDER BY k_idsale DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->k_idsale;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO vt007d_sale(k_idsale, cod_producto, cant_prod, total_prod_cant) VALUES (?, ?, ?, ?);");
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