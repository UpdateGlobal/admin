<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php 
$cod_contacto = $_REQUEST['cod_contacto'];
$eliminar = "DELETE FROM formulario WHERE cod_contacto='$cod_contacto'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:mensajes-delete.php");
?>