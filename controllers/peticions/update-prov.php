<?php
require_once("../../db/config.php"); //Incluir la conexion
session_start();

$prov = $_GET['prov'];
$n_name = $_POST['n_name'];
$v_phone = $_POST['v_phone'];
$n_address = $_POST['n_address'];
$n_mail = $_POST['n_mail'];

$actualizar = "UPDATE `gr002det_user` SET `n_name` = '$n_name', `v_phone` = '$v_phone', `n_address` = '$n_address', `n_mail` = '$n_mail'  WHERE `k_identi` = '$prov'";

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