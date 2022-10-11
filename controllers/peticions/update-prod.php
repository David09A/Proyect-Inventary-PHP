<?php
require_once("../../db/config.php"); //Incluir la conexion
session_start();

    $prod = $_GET['prod'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $proveedor  = $_POST['proveedor'];

    $actualizar = "UPDATE `pr005m_prod` SET `n_name_prod` = '$nombre', `n_desc_prod` = '$descripcion', `n_brand` = '$marca', `v_cant` = '$cantidad', `v_valor_prod` = '$precio', `k_prov_prod` = '$proveedor' WHERE `k_refprod` = '$prod'";

    $resultado = mysqli_query($con, $actualizar);
    if (!$resultado) {
?>
        <?php
        include("../results/update/mod_prod.php");
        ?>
        <center>
            <h1>No se pudo actualizar</h1>
        </center>
    <?php
    } else {
        header("location: ./../results/get/list_prod.php");
    }



    $k_identi = $_GET['prov'];
    $n_name = $_POST['n_name'];
    $v_phone = $_POST['v_phone'];
    $n_address = $_POST['n_address'];
    $n_mail = $_POST['n_mail'];;

    $actualizar = "UPDATE `gr002det_user` SET `n_name` = '$n_name', `v_phone` = '$v_phone', `n_address` = '$n_address', `n_mail` = '$n_mail'  WHERE `k_identi` = '$k_identi'";

    $resultado = mysqli_query($con, $actualizar);
    if (!$resultado) {
    ?>
        <?php
        include("../results/update/mod_prov.php");
        ?>
        <center>
            <h1>No se pudo actualizar</h1>
        </center>
<?php
    } else {
        header("location: ./../results/get/list_prov.php");
    }

?>