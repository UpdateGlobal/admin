<?php 
session_start();
$xCodigo	= $_SESSION['xCodigo'];
$xAlias		= $_SESSION['xAlias'];
$xEmail		= $_SESSION['xEmail'];
$xUsuario	= $_SESSION['xUsuario'];
$xVisitante	= $_SESSION['xVisitante'];
if($xCodigo==""){
	header("Location:seguridad.php");
}
?>