<?php
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];
session_start(); 
$v_cantActual = $_SESSION["carrito"][$indice]->caantidad;
$v_cantExistente = $_SESSION["carrito"][$indice]->v_cant;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($v_cantActual + 1 > $v_cantExistente) {
        header("Location: ../results/init.php?status=6");
        exit;
    }
$_SESSION["carrito"][$indice]->caantidad++;
$_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->caantidad * $_SESSION["carrito"][$indice]->v_valor_prod;

header("Location: ../results/init.php");
 ?>