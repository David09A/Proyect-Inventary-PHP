<?php
if(!isset($_POST["total"])) exit;


session_start();
$usuari = $_SESSION['user'];
$admin = $usuari['k_identi'];

$total = $_POST["total"];
include_once "../../db/pdo_con.php";


$sentencia = $base_de_datos->prepare("INSERT INTO `vt006m_sale` (`v_sale_total`, `k_identi_vent`) VALUES (?, ?);");
$sentencia->execute([$total, $admin]);

$sentencia = $base_de_datos->prepare("SELECT k_idsale FROM `vt006m_sale` ORDER BY k_idsale DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->k_idsale;
if (empty($idVenta)) {
	echo "No se encuentra el id de la venta";
}

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO vt007d_sale(k_idsale, k_refprod, v_cant_prod, v_total_prod_cant) VALUES (?, ?, ?, ?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE pr005m_prod SET v_cant = v_cant - ? WHERE k_refprod = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->total;
	$sentencia->execute([$idVenta, $producto->k_refprod, $producto->caantidad, $producto->total]);
	$sentenciaExistencia->execute([$producto->caantidad, $producto->k_refprod]);
}
$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ../results/init.php?status=1&idvent=$idVenta");
?>