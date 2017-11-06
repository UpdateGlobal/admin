<?php include "module/conexion.php"; ?>
<?php include "module/verificar.php"; ?>
<?php 
session_start();
session_destroy();
header("Location:index.php");
?>