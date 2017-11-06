<?php
session_start();
$xCodCliente = $_SESSION['xCodCliente'];
$xAlias = $_SESSION['xAlias_c'];
$xEmail = $_SESSION['xEmail_c'];

if($xCodCliente==""){
	header ("Location:seguridad.php");
}
?>