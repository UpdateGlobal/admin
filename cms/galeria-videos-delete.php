<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php 
$cod_video = $_REQUEST['cod_video'];
$eliminar = "DELETE FROM videos WHERE cod_video='$cod_video'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:galeria-videos.php");
?>