<?php include "module/conexion.php"; ?>
<?php include "module/verificar.php"; ?>
<?php 
$cod_banner = $_REQUEST['cod_banner'];
$eliminarimagen = "SELECT imagen FROM banners WHERE cod_banner='$cod_banner'";
$resultadoborrar = mysqli_query($enlaces,$eliminarimagen);
$filaImg = mysqli_fetch_array($resultadoborrar);
 	$xImagen   = $filaImg['imagen'];
	unlink("assets/img/banner/".$xImagen);

$eliminar = "DELETE FROM banners WHERE cod_banner='$cod_banner'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:banners.php");
?>