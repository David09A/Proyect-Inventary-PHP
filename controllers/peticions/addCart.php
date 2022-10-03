<?php
if (!isset($_POST["codigo"])) {
    return;
}

$codigo = $_POST["codigo"];
include_once "../../db/pdo_con.php";


$sentencia = $base_de_datos->prepare("SELECT * FROM pr005m_prod WHERE k_refprod = ? LIMIT 1;");
$sentencia->execute([$codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
# Si no existe, salimos y lo indicamos
if (!$producto) {
    header("Location: ../results/init.php?status=4");
    exit;
}
# Si no hay existencia...
if ($producto->v_cant < 1) {
    header("Location: ../results/init.php?status=5");
    exit;
}

session_start();
# Buscar producto dentro del cartito
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if ($_SESSION["carrito"][$i]->k_refprod == $codigo) {
        $indice = $i;
        break;
    }
}
# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->caantidad = 1;
    $producto->total = $producto->v_valor_prod;
    array_push($_SESSION["carrito"], $producto);
} else {
    $v_cantExistente = $_SESSION["carrito"][$indice]->caantidad;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($v_cantExistente + 1 > $producto->v_cant) {
        header("Location: ../results/init.php?status=5");
        exit;
    }
    # Si ya existe, se agrega la v_cant
    $_SESSION["carrito"][$indice]->caantidad++;
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->caantidad * $_SESSION["carrito"][$indice]->v_valor_prod;
}
header("Location: ../results/init.php");
