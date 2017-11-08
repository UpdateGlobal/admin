<?php include "module/conexion.php"; ?>
<?php include "module/verificar.php"; ?>
<?php 
$cod_banner = $_REQUEST['cod_banner'];
$imagen = $_REQUEST['imagen'];
$eliminar = "DELETE FROM banners WHERE cod_banner='$cod_banner'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:banners.php");
?>