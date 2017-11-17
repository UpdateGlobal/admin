<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
$cod_galeria = $_REQUEST['cod_galeria'];
$eliminar = "DELETE FROM galeria WHERE cod_galeria='$cod_galeria'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:galeria.php");
?>