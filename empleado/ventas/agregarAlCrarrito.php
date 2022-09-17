<?php
if (!isset($_POST["codigo"])) {
    return;
}

$codigo = $_POST["codigo"];
include_once "../../servicios/conexion2.php";


$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id = ? LIMIT 1;");
$sentencia->execute([$codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
# Si no existe, salimos y lo indicamos
if (!$producto) {
    header("Location: ./crearventa.php?status=4");
    exit;
}
if ($producto->cantidad < 1) {
    header("Location: ./crearventa.php?status=5");
    exit;
}


session_start();
/*$cliente=$_SESSION['clie'];*/

# Buscar producto dentro del cartito
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if ($_SESSION["carrito"][$i]->id == $codigo) {
        $indice = $i;
        break;
    }
}
# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $producto->caantidad = 1;
    $producto->total = $producto->precio_venta;
    array_push($_SESSION["carrito"], $producto);
} else {
    $cantidadExistente = $_SESSION["carrito"][$indice]->caantidad;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + 1 > $producto->cantidad) {
        header("Location: ./crearventa.php?status=5");
        exit;
    }
    # Si ya existe, se agrega la cantidad
    $_SESSION["carrito"][$indice]->caantidad++;
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->caantidad * $_SESSION["carrito"][$indice]->precio_venta;
}
header("Location: ./crearventa.php");
