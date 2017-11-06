<?php
session_start();

// Capturar las variables que vienen del detalle de productos
$varProducto = $_POST['cod_producto'];
$varCatProducto = $_POST['cod_categoria'];
$varSCatProducto = $_POST['cod_sub_categoria'];
$varCantidad = $_POST['cantidad'];

// recepcionar la variable de sesion del cliente
$varCliente = $_SESSION['IdCliente'];

if($varCliente==""){
	//creamos una variable de sesion para el producto
	$_SESSION['IdProducto']=$varProducto;
	$_SESSION['IdCategoria']=$varCatProducto;
	$_SESSION['IdSCategoria']=$varSCatProducto;
	header("Location: ingreso.php");
}else{
	//Iguala a nada y destruye la variable de sesion
	$_SESSION['IdProducto']="";
	unset($_SESSION['IdProducto']);
	//Enviamos el proceso a verificar carrito
	header("Location:verifica-carrito.php?cod_producto=$varProducto&cantidad=$varCantidad");
}

?>