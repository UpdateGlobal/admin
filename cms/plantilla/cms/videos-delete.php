<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
$cod_video = $_REQUEST['cod_video'];
$eliminar = "DELETE FROM videos WHERE cod_video='$cod_video'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:videos.php");
?>