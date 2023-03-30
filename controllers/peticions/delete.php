<?php
include_once "../../db/pdo_con.php";//Incluir la conexion
session_start();

$tableName = $_GET['tableName'];
$id = $_GET['id'];

if ($tableName == "pr005m_prod") {
    $sentencia = $base_de_datos->prepare("DELETE FROM pr005m_prod WHERE k_refprod = ?");
    $sentencia->execute([$id]);
    if ($sentencia) {
        header("location: ./../results/get/list_prod.php?status=1&id=$id");
    }else{
        header("location: ./../results/get/list_prod.php?status=2&id=$id");
    }
}else{
    $sentencia = $base_de_datos->prepare("DELETE FROM gr002det_user WHERE k_identi = ?");
    $sentencia->execute([$id]);
    if ($sentencia) {
        header("location: ./../results/get/list_prov.php?status=1&id=$id");
    }else{
        header("location: ./../results/get/list_prov.php?status=2&id=$id");
    }
}
// otro

?>