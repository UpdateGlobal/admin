<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
$cod_link = $_REQUEST['cod_social'];
$eliminar = "DELETE FROM social WHERE cod_social='$cod_link'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:social.php");
?>