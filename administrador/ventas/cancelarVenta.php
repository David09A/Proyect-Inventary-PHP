<?php

session_start();

unset($_SESSION["clie"]);
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];

header("Location: ./crearventa.php?status=2");
?>