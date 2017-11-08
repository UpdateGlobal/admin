<?php include "module/conexion.php"; ?>
<?php include "module/verificar.php"; ?>
<?php 
$cod_carrusel = $_REQUEST['cod_carrusel'];
$imagen = $_REQUEST['imagen'];
$eliminar = "DELETE FROM carrusel WHERE cod_carrusel='$cod_carrusel'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:carrusel.php");
?>