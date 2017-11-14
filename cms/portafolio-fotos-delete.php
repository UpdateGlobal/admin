<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php 
$cod_galeria_portafolio = $_REQUEST['cod_galeria_portafolio'];
$cod_portafolio = $_REQUEST['cod_portafolio'];

$eliminar = "DELETE FROM portafolio_galerias WHERE cod_galeria_portafolio='$cod_galeria_portafolio'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:portafolio-fotos-nuevo.php?cod_portafolio=$cod_portafolio");
?>