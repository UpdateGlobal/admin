<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
$cod_portafolio = $_REQUEST['cod_galeria'];
$eliminar = "DELETE FROM galerias WHERE cod_galeria='$cod_galeria'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:galerias.php");
?>