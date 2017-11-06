<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$num = "";
if (isset($_REQUEST['eliminar'])) {
	$eliminar	= $_POST['eliminar'];
} else {
	$eliminar	= "";
}
if ($eliminar == "true") {
	$sqlEliminar = "SELECT cod_usuario FROM usuarios ORDER BY cod_usuario ASC";
	$sqlResultado = mysqli_query($enlaces,$sqlEliminar) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$x = 0;
	while($filaElim = mysqli_fetch_array($sqlResultado)){
		$id_usuario = $filaElim["cod_usuario"];
		if ($_REQUEST["chk" . $id_usuario] == "on") {
			$x++;
			if ($x == 1) {
				$sql = "DELETE FROM usuarios WHERE cod_usuario=$id_usuario";
			} else { 
				$sql = $sql . " OR cod_usuario=$id_usuario";
			}
		}
	}
	mysqli_free_result($sqlResultado);
	if ($x > 0) { 
		$rs = mysqli_query($enlaces,$sql) or die('Consulta fallida: ' . mysqli_error($enlaces));
	}
	header ("Location:usuarios.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <style>
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
			td:nth-of-type(1):before { content: "Nº"; }
			td:nth-of-type(2):before { content: "Nombres"; }
			td:nth-of-type(3):before { content: "Email"; }
			td:nth-of-type(4):before { content: "Usuario"; }
			td:nth-of-type(5):before { content: "Estado"; }
			td:nth-of-type(6):before { content: ""; }
			td:nth-of-type(7):before { content: ""; }
			td:nth-of-type(8):before { content: ""; }
		}
	</style>
    <script>
		function Procedimiento(proceso,seccion){
			document.fcms.proceso.value = "";
			estado = 0;
			for (i = 0; i < document.fcms.length; i++)
			if(document.fcms.elements[i].name.substring(0,3) == "chk"){
				if(document.fcms.elements[i].checked == true){
					estado = 1
				}
			}
			if (estado == 0) {
				if (seccion == "N"){
					alert("Debes de seleccionar un usuario.")
				}
				return
			}
			procedimiento = "document.fcms." + proceso + ".value = true"
			eval(procedimiento)
			document.fcms.submit()	
		}
	</script>
    <script src="js/visitante-alert.js"></script>
</head>
<body>
	<div id="loading">
		<div>
			<div></div>
		    <div></div>
		    <div></div>
		</div>
	</div>
	<div id="wrapper">
        <?php include("includes/header.php") ?>
		<div id="content" class="clearfix">
	        <div class="header">
				<h1 class="page-title">Usuarios</h1>
			</div> <!-- /header -->
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i> Usuarios
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Lista de Usuarios</strong>
							</div>
						</div> <!-- /widget-header -->
						<div class="widget-content">
                        	<div class="alert alert-info alert-dismissible" role="alert">
                            	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                Usuarios son los administradores o el personal de la empresa que podr&aacute; acceder a la web con un correo y contrase&ntilde;a.
							</div>
	                        <a class="btn btn-blue" href="<?php if($xVisitante=="No"){ ?>usuario-nuevo.php<?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-plus" aria-hidden="true"></i> Añadir nuevo</a>
                            <hr>
                        	<form name="fcms" method="post" action="">
								<table class="text-center" width="100%" border="1">
	                                <thead>
                                        <tr>
                                            <th width="5%" scope="col">N&deg;</th>
                                            <th width="25%" scope="col">Nombres</th>
                                            <th width="30%" scope="col">Email</th>
                                            <th width="20%" scope="col">Usuario
                                                <input type="hidden" name="proceso">
                                                <input type="hidden" name="eliminar" value="false">
                                            </th>
                                            <th width="5%" scope="col">Estado</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col">
                                                <a href="javascript:Procedimiento('eliminar','N');"><img src="images/borrar.png" width="18" height="25" alt="Borrar"></a>
                                            </th>
                                        </tr>
                                    </thead>
									<?php
                                    	$consultarUsuarios = "SELECT * FROM usuarios ORDER BY cod_usuario ASC";
										$resultadoUsuarios = mysqli_query($enlaces,$consultarUsuarios) or die('Consulta fallida: ' . mysqli_error($enlaces));
										while($filaUsuarios = mysqli_fetch_array($resultadoUsuarios)){
											$xCodigo		= $filaUsuarios['cod_usuario'];
											$xNombres		= utf8_encode($filaUsuarios['nombres']);
											$xEmail			= $filaUsuarios['email'];
											$xUsuario		= $filaUsuarios['usuario'];
											$xEstado		= $filaUsuarios['estado'];
											$num++;
									?>
                                    <tr>
                                    	<td><?php echo $num; ?></td>
                                        <td><?php echo $xNombres; ?></td>
                                        <td><?php echo $xEmail; ?></td>
                                        <td><?php echo $xUsuario; ?></td>
                                        <td><?php if($xCodigo!="0"){?><strong>[<?php echo $xEstado; ?>]</strong><?php }?></td>
                                        <td><?php if($xCodigo!="0"){?><a class="boton-eliminar <?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="No"){ ?>usuario-delete.php?cod_usuario=<?php echo $xCodigo; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-trash" aria-hidden="true"></i></a><?php }?></td>
                                        <td><?php if($xCodigo!="0"){?><a class="boton-editar" href="usuario-edit.php?cod_usuario=<?php echo $xCodigo; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a><?php }?></td>
                                        <td>
	                                        <?php if($xVisitante=="No"){ ?>
                                        	<div class="custom-input">
                                                <?php if($xCodigo!="0"){?><input class="hidden-xs" type="checkbox" id="chkbx-<?php echo $xCodigo; ?>" name="chk<?php echo $xCodigo; ?>" /><label for="chkbx-<?php echo $xCodigo; ?>"></label><?php } ?>
											</div>
                                            <?php } ?>
										</td>
									</tr>
									<?php
										}
										mysqli_free_result($resultadoUsuarios);
									?>
								</table>
							</form>
						</div>
                    </div>
				</div>
			</div> <!-- /wrp -->
		</div> <!-- /content -->
		<?php include("includes/footer.php") ?>
	</div> <!-- /wrapper -->
</body>
</html>