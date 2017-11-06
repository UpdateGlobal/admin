<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
$cod_servicio = $_REQUEST['cod_servicio'];
$eliminar = "DELETE FROM servicios WHERE cod_servicio='$cod_servicio'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:servicios.php");
?>