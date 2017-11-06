<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
$cod_noticia = $_REQUEST['cod_noticia'];
$eliminar = "DELETE FROM noticias WHERE cod_noticia='$cod_noticia'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:noticias.php");
?>