<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
$cod_foto = $_REQUEST['cod_foto'];
$cod_servicio = $_REQUEST['cod_servicio'];

$eliminar = "DELETE FROM servicios_fotos WHERE cod_foto='$cod_foto'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:servicios-fotos-nuevo.php?cod_servicio=$cod_servicio");
?>