<?php include "module/conexion.php"; ?>
<?php include "module/verificar.php"; ?>
<?php 
$cod_cliente = $_REQUEST['cod_cliente'];
$eliminar = "DELETE FROM clientes WHERE cod_cliente='$cod_cliente'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:clientes.php");
?>