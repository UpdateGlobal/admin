<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php 
$cod_sub_categoria = $_REQUEST['cod_sub_categoria'];
$eliminar = "DELETE FROM productos_sub_categorias WHERE cod_sub_categoria='$cod_sub_categoria'";
$resultado = mysqli_query($enlaces, $eliminar);
header("Location:productos-subcategorias.php");
?>