<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php 
$cod_orden = $_REQUEST['cod_orden'];
$eliminar = "DELETE FROM pedidos WHERE cod_orden='$cod_orden'";
$resultado = mysqli_query($enlaces,$eliminar);
$eliminard = "DELETE FROM pedidodetalle WHERE cod_orden='$cod_orden'";
$resultadod = mysqli_query($enlaces,$eliminard);
header("Location:productos-pedidos.php");
?>