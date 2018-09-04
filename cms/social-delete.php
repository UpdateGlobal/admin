<?php include "module/conexion.php"; ?>
<?php include "module/verificar.php"; ?>
<?php 
	$cod_link = $_REQUEST['cod_social'];
	$eliminar = "DELETE FROM social WHERE cod_social='$cod_link'";
	$resultado = mysqli_query($enlaces,$eliminar);
	header("Location:sociales.php");
?>