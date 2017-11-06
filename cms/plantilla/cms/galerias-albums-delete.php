<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
$cod_foto = $_REQUEST['cod_foto'];
$cod_galeria = $_REQUEST['cod_galeria'];

$eliminar = "DELETE FROM galerias_fotos WHERE cod_foto='$cod_foto'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:galerias-albums-nuevo.php?cod_galeria=$cod_galeria");
?>