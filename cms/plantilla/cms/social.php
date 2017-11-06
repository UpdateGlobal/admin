<?php include("modulos/conexion.php"); ?>
<?php include("modulos/verificar.php"); ?>
<?php
$num = "";
if (isset($_REQUEST['eliminar'])) {
	$eliminar 	= $_POST['eliminar'];
} else {
	$eliminar 	= "";
}
if ($eliminar == "true") {
	$sqlEliminar = "SELECT cod_social FROM social ORDER BY orden";
	$sqlResultado = mysqli_query($enlaces,$sqlEliminar) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$x = 0;
	while($filaElim = mysqli_fetch_array($sqlResultado)){
		$id_link = $filaElim["cod_social"];
		if ($_REQUEST["chk" . $id_link] == "on") {
			$x++;
			if ($x == 1) {
				$sql = "DELETE FROM social WHERE cod_social=$id_link";
			} else { 
				$sql = $sql . " OR cod_social=$id_link";
			}
		}
	}
	mysqli_free_result($sqlResultado);
	if ($x > 0) { 
		$rs = mysqli_query($enlaces,$sql) or die('Consulta fallida: ' . mysqli_error($enlaces));
	}
	header ("Location:social.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
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
					alert("Debes de seleccionar una red social.")
				}
				return
			}	
			procedimiento = "document.fcms." + proceso + ".value = true"
			eval(procedimiento)
			document.fcms.submit()
		}
	</script>
    <style>
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
			td:nth-of-type(1):before { content: "Social"; }
			td:nth-of-type(2):before { content: "Enlace"; }
			td:nth-of-type(3):before { content: "Orden"; }
			td:nth-of-type(4):before { content: "Estado"; }
			td:nth-of-type(5):before { content: ""; }
			td:nth-of-type(6):before { content: ""; }
			td:nth-of-type(7):before { content: ""; }

		}
	</style>
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
				<h1 class="page-title">Redes Sociales</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Redes Sociales
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Redes Sociales listadas</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<a class="btn btn-blue" href="<?php if($xVisitante=="No"){ ?>social-nuevo.php<?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-plus" aria-hidden="true"></i> A&ntilde;adir nuevo</a>
                            <hr>
							<form name="fcms" method="post" action="">
                                <table class="text-center" width="100%" border="1">
                                	<thead>
                                        <tr>
                                            <th width="30%" scope="col">Bot&oacute;n de Red social
                                                <input type="hidden" name="proceso">
                                                <input type="hidden" name="eliminar" value="false">
                                            </th>
                                            <th width="40%" scope="col">Enlace</th>
                                            <th width="10%" scope="col">Orden</th>
                                            <th width="5%" scope="col">Estado</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col"><a href="javascript:Procedimiento('eliminar','N');"><img src="images/borrar.png" width="18" height="25" alt="Borrar"></a></th>
                                        </tr>
                                    </thead>
                                    <?php
                       		 			$consultarSol = 'SELECT * FROM social ORDER BY orden';
										$resultadoSol = mysqli_query($enlaces,$consultarSol) or die('Consulta fallida: ' . mysqli_error($enlaces));
										while($filaSol = mysqli_fetch_array($resultadoSol)){
											$xCodigo		= $filaSol['cod_social'];
											$xType			= $filaSol['type'];
											$xLinks			= $filaSol['links'];
											$xOrden			= $filaSol['orden'];
											$xEstado		= $filaSol['estado'];
											$num++;
									?>
                                    <tr>
                                        <td><i class="fa <?php echo $xType; ?>" aria-hidden="true" style="font-size:20px;"></i> <?php echo $xType; ?></td>
                                        <td><a href="<?php echo $xLinks; ?>" target="_blank"><i class="fa fa-search" aria-hidden="true" style="font-size:20px;"></i> Ver enlace</a></td>
                                        <td><?php echo $xOrden; ?></td>
                                        <td><strong>[<?php echo $xEstado; ?>]</strong></td>
                                        <td><a class="boton-eliminar <?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="No"){ ?>social-delete.php?cod_social=<?php echo $xCodigo; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                        <td><a class="boton-editar" href="social-edit.php?cod_social=<?php echo $xCodigo; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                                        <td>
                                        	<?php if($xVisitante=="No"){ ?>
                                        	<div class="custom-input">
		                                        <input type="checkbox" class="hidden-xs" id="chkbx-<?php echo $xCodigo; ?>" name="chk<?php echo $xCodigo; ?>" /><label for="chkbx-<?php echo $xCodigo; ?>"></label>
                                            </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                        mysqli_free_result($resultadoSol);
                                    ?>
                                </table>
                            </form>
						</div>
                    </div>
				</div>
			</div>
		</div>
		<?php include("includes/footer.php") ?>
	</div>
</body>
</html>