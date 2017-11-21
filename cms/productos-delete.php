<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php 
$cod_producto = $_REQUEST['cod_producto'];
$eliminar = "DELETE FROM productos WHERE cod_producto='$cod_producto'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:productos.php");
?>