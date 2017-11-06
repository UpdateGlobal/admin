<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
$cod_galeria_producto = $_REQUEST['cod_galeria_producto'];
$cod_producto = $_REQUEST['cod_producto'];
$imagen = $_REQUEST['imagen'];

$eliminar = "DELETE FROM productos_galeria WHERE cod_galeria_producto='$cod_galeria_producto'";
unlink("images/productos/galeria/".$imagen);
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:productos-galeria-nuevo.php?cod_producto=$cod_producto");
?>