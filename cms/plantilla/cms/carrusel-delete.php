<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
$cod_carrusel = $_REQUEST['cod_carrusel'];
$eliminar = "DELETE FROM carrusel WHERE cod_carrusel='$cod_carrusel'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:carrusel.php");
?>