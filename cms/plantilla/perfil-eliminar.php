<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/session-core.php"; ?>
<?php 
$cod_cliente = $_REQUEST['cod_cliente'];
$xOrden = $_SESSION['IdOrden'];
$borrar = "DELETE FROM carrito WHERE cod_orden='$xOrden' AND cod_cliente='$cod_cliente'";
$resultado = mysqli_query($enlaces, $borrar);

$consultarEmail = "SELECT * FROM clientes WHERE cod_cliente='$cod_cliente'";
$ejecutarEmail = mysqli_query($enlaces,$consultarEmail) or die('Consulta fallida: ' . mysqli_error($enlaces));
$filaCli = mysqli_fetch_array($ejecutarEmail);
$cod_cliente		= $filaCli['cod_cliente'];
$nombres 			= $filaCli['nombres'];
$email				= $filaCli['email'];

/*---- Mensaje para el correo electronico ----*/
$emailDestino = $email;
$encabezado = "Cuenta Eliminada - Tienda Virtual";
$encabezada = "Se ha Eliminado un Usuario registrado";
$mensaje = "<p>Estimado ".$nombres." su cuenta se ha eliminado como solicit&oacute;, esperamos vuelva a registrarse en un futuro</p>";

$mensajea = "<p>Se eliminó a ".$nombres."(".$email.") de nuestra base de datos.</p>";

$consultarCot = 'SELECT * FROM contacto';
$resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
while($filaCot = mysqli_fetch_array($resultadoCot)){
	$xFormemail		= $filaCot['form_mail'];
}
$destino = $xFormemail;
$mailCabecera = 'MIME-Version: 1.0'."\r\n";
$mailCabecera.= 'Content-type:text/html; charset-iso-8859-1'."\r\n";
$mailCabecera.= "FROM: ".$xFormemail;
$mailCabecera.= "<".$xFormemail.">\r\n";
$mailCabecera.= "Reply-To: ".$xFormemail;
$mensajeEmail = $mensaje;
mail($emailDestino,$encabezado,$mensajeEmail,$mailCabecera);
		
mail($destino,$encabezada,$mensajea,$mailCabecera);

session_destroy();
$eliminar = "DELETE FROM clientes WHERE cod_cliente='$cod_cliente'";
$resultado = mysqli_query($enlaces,$eliminar);
header("Location:bye.php");
?>