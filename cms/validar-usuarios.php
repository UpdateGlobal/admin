<?php include "module/conexion.php"; ?>
<?php
//Recepcionamos el campo proceso
$proceso = $_POST['proceso'];

if($proceso=="Iniciar"){
	$usuario 	= $_POST['usuario'];
	$clave 		= $_POST['clave'];
	
	//Realizamos la consulta
	$consultaUsuario = "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave' AND estado='1'";
	$resultadoUsuario = mysqli_query($enlaces,$consultaUsuario) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$filaUsuario = mysqli_fetch_array($resultadoUsuario);
	$xCodigo 		= $filaUsuario['cod_usuario'];
	$xAlias 		= $filaUsuario['nombres'];
	$xEmail 		= $filaUsuario['email'];
	$xUsuario 		= $filaUsuario['usuario'];
	$xVisitante		= $filaUsuario['visitante'];
	
	//Verificamos si por lo menos encontro una coincidencia para generar
	//Las variables de sesion
	$numUsuarios = mysqli_num_rows($resultadoUsuario);
	if($numUsuarios>=1){
		//generamos las variables globales de sesion
		session_start();
		$_SESSION['xCodigo'] 	= $xCodigo;
		$_SESSION['xAlias']		= $xAlias;
		$_SESSION['xEmail']		= $xEmail;
		$_SESSION['xUsuario']	= $xUsuario;
		$_SESSION['xVisitante']	= $xVisitante;
		
		header ("Location: general.php");
	}else{
		header ("Location: seguridad.php");
	}
}

?>