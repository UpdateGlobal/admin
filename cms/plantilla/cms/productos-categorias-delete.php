<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
$cod_categoria = $_REQUEST['cod_categoria'];
$eliminar = "DELETE FROM productos_categorias WHERE cod_categoria='$cod_categoria'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:productos-categorias.php");
?>