<?php include "cms/modulos/conexion.php"; ?>
<?php
$proceso = $_POST['proceso'];
if($proceso == "iniciar"){
	$email = $_POST['email'];
	$clave = $_POST['clave'];
	// crear consulta
	$consulta = "SELECT * FROM clientes WHERE email='$email' AND clave='$clave' AND estado='Activo'";
	$resultado = mysqli_query($enlaces, $consulta);
	while($fila=mysqli_fetch_array($resultado)){
		$xCodCliente = $fila['cod_cliente'];
		$xAlias = utf8_encode($fila['nombres']);
		$xEmail = $fila['email'];
	}
	$contador = mysqli_num_rows($resultado);
	mysqli_free_result($resultado);
	
	if($contador>0){
		session_start();
		$_SESSION['xCodCliente'] = $xCodCliente;
		$_SESSION['xAlias_c'] = $xAlias;
		$_SESSION['xEmail_c'] = $xEmail;
		header("Location:bienvenida-cliente.php");
	}else{
		header("Location:seguridad.php");
	}
}
?>