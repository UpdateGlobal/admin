<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/verificar-ingreso-cliente.php"; ?>
<?php
session_start();
$comentarios=$_POST['comentarios'];

/*---- Productos para pedidos en linea ------*/
$varOrden 	= $_SESSION['IdOrden'];
$varCliente = $_SESSION['IdCliente'];

$carrito = "SELECT * FROM productos as p, carrito as c WHERE c.cod_orden='$varOrden' AND c.cod_cliente='$varCliente' AND p.cod_producto=c.cod_producto";
$resultado = mysqli_query($enlaces, $carrito);
$total_filas=mysqli_num_rows($resultado);

/*---- Datos del cliente -----*/
$clientes = "SELECT * FROM clientes WHERE cod_cliente='$xCodCliente'";
$resultCli = mysqli_query($enlaces, $clientes);
$filaCli = mysqli_fetch_array($resultCli);


/*---- Mensaje para el correo electronico ----*/
$mensaje = '
		    <table width="100%" border=1 cellpadding=0 cellspacing=0 align=center>
			<tr>
			  <th width="5%" scope=col>N&deg;</th>
			  <th width="45%" scope=col>PRODUCTO</th>
			  <th width="10%" scope=col>CANT.</th>
			  <th width="20%" scope=col>PRECIO</th>
			  <th width="20%" scope=col>TOTAL</th>
			</tr>';
			while($fila=mysqli_fetch_array($resultado)){
				$num++;
				$xNombre 	= utf8_decode($fila['nom_producto']);
				$xCantidad 	= $fila['cantidad'];
				if($fila['precio_oferta']!=0){
					$pmostrar = $fila['precio_oferta'];
				}else{
					$pmostrar = $fila['precio_normal'];
				}
				$subtotal = ($xCantidad*$pmostrar);
				$total = number_format(($total+$subtotal),2);

				
$mensaje.= '
			<tr>
				<td>'.$num.'</td>
       		    <td>'.$xNombre.'</td>
       		    <td>'.$xCantidad.'</td>
       		    <td>$.'.number_format($pmostrar,2).'</td>
       		    <td>$.'.number_format($subtotal,2).'</td>
   		     </tr>';
			 }
			$igv = number_format(($total/10),2);
			$neto = number_format(($total+$igv),2);
			 
$mensaje.= '
			</table>
			
			<table width="100%" border=0 align=center cellpadding=0 cellspacing=0>
   		    <tr>
   		      <td width="80%">&nbsp;</td>
   		      <td width="10%"><strong>Monto Bruto : </strong><br /></td>
   		      <td width="10%">$.'.number_format($total,2).'</td>
	        </tr>
   		    <tr>
   		      <td>&nbsp;</td>
   		      <td><strong>+ IGV(10%) : </strong><br /></td>
   		      <td>$.'.number_format($igv,2).'</td>
	        </tr>
   		    <tr>
   		      <td>&nbsp;</td>
   		      <td><strong>Neto a Pagar : </strong><br /></td>
   		      <td>$.'.number_format(($neto),2).'</td>
	        </tr>
 		    </table>
			
			<h1>Datos del Cliente</h1>
   		  	<table width="100%" border=0 align=center cellpadding=0 cellspacing=0>
   		    <tr>
   		      <td width="20%"><strong>Nombres :</strong></td>
   		      <td width="80%">'.$filaCli['nombres'].'</td>
	        </tr>
   		    <tr>
   		      <td width="20%"><strong>Direcci&oacute;n :</strong></td>
   		      <td width="80%">'.$filaCli['direccion'].'</td>
	        </tr>
   		    <tr>
   		      <td><strong>Tel&eacute;fono :</strong></td>
   		      <td>'.$filaCli['telefono'].'</td>
	        </tr>
   		    <tr>
   		      <td><strong>Email :</strong></td>
   		      <td>'.$filaCli['email'].'</td>
	        </tr>
   		    <tr>
   		      <td><strong>Empresa :</strong></td>
   		      <td>'.$filaCli['empresa'].'</td>
	        </tr>
   		    <tr>
   		      <td><strong>Fecha Nacimiento :</strong></td>
   		      <td>'.$filaCli['fecha_nacimiento'].'</td>
	        </tr>
   		    <tr>
   		      <td><strong>Sexo :</strong></td>
   		      <td>'.$filaCli['sexo'].'</td>
	        </tr>
   		    <tr>
   		      <td><strong>Comentarios :</strong></td>
   		      <td>'.$comentarios.'</td>
	        </tr>
 		    </table>';
			
$fecha = date("Y-m-d h:i:s A");
$xCliente = $_SESSION['IdCliente'];
$xOrden = $_SESSION['IdOrden'];	

/*---- Agregando datos a la tabla pedidos ----*/
$pedidos = "INSERT INTO pedidos (cod_orden, cod_cliente, fechapedido, observaciones, bruto, igv, total)VALUE('$xOrden', '$xCliente', '$fecha', '$comentarios', '$total', '$igv', '$neto')";
$resultadoPed=mysqli_query($enlaces, $pedidos);

/*---- Agregando datos a la tabla pedidos detalles ----*/		
$varOrden 	= $_SESSION['IdOrden'];
$varCliente = $_SESSION['IdCliente'];

$carrito = "SELECT * FROM productos as p, carrito as c WHERE c.cod_orden='$varOrden' AND c.cod_cliente='$varCliente' AND p.cod_producto=c.cod_producto";
$resultado = mysqli_query($enlaces, $carrito);
$total_filas=mysqli_num_rows($resultado);
$filaCar=mysqli_fetch_array($resultado);
do{
	$xProducto = $filaCar['cod_producto'];
	if($filaCar['precio_oferta']!=0){
		$pmostrar = $filaCar['precio_oferta'];
	}else{
		$pmostrar = $filaCar['precio_normal'];
	}
	$xCantidad = $filaCar['cantidad'];
	
	//proceso grabar a detalle pedidos
	$pedidoDetalle="INSERT INTO pedidodetalle(cod_orden, cod_producto, precio, cantidad)VALUE('$xOrden', '$xProducto', '$pmostrar', '$xCantidad')";
	$resultadoDet=mysqli_query($enlaces, $pedidoDetalle);
	
}while($filaCar=mysqli_fetch_array($resultado));

/*----- Borrar contenido de la tabla carrito ----*/
$borrarCarrito="DELETE FROM carrito WHERE cod_orden='$xOrden' AND cod_cliente='$xCliente'";
$resulBorrar=mysqli_query($enlaces, $borrarCarrito);
$_SESSION['IdOrden']="";
unset($_SESSION['IdOrden']);

/*----- Codigo enviar pedidos al correo ---*/

$consultarCot = 'SELECT * FROM contacto';
$resultadoCot = mysqli_query($enlaces,$consultarCot) or die('Consulta fallida: ' . mysqli_error($enlaces));
while($filaCot = mysqli_fetch_array($resultadoCot)){
	$xCartemail		= $filaCot['cart_mail'];
}
$destino = $xCartemail;
$cabecera = "Orden de pedido:".$xOrden;
$mailCabecera = 'MIME-Version: 1.0'."\r\n";
$mailCabecera.= 'Content-type:text/html; charset-iso-8859-1'."\r\n";
$mailCabecera.= "FROM: ".$filaCli['email'];
$mailCabecera.= "<".$filaCli['email'].">\r\n";
$mailCabecera.= "Reply-To: ".$filaCli['email'];
$mensajeEmail = $mensaje;
mail($destino,$cabecera,$mensajeEmail,$mailCabecera);

header("Location:confirmacion.php");		
?>