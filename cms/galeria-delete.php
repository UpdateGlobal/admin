<?php include ("module/conexion.php"); ?>
<?php include ("module/verificar.php"); ?>
<?php 
$cod_galeria = $_REQUEST['cod_galeria'];
$eliminar = "DELETE FROM galerias WHERE cod_galeria='$cod_galeria'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:galeria.php");
?>