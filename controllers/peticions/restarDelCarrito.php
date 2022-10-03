<?php
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];
session_start(); 
$_SESSION["carrito"][$indice]->caantidad--;
$_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->caantidad * $_SESSION["carrito"][$indice]->v_valor_prod;

header("Location: ../results/init.php");
 ?>