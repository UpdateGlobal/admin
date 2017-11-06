<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php 
session_start();
session_destroy();
header("Location:index.php");
?>