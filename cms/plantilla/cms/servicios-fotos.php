<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php include "modulos/clean.php"; ?>
<?php
$num = ""; 
if (isset($_REQUEST['eliminar'])) {
	$eliminar = $_POST['eliminar'];
} else {
	$eliminar = "";
}

if ($eliminar == "true") {
	$sqlEliminar = "SELECT cod_servicio FROM servicios ORDER BY orden";
	$sqlResultado = mysqli_query($enlaces,$sqlEliminar) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$x = 0;
	while($filaElim = mysqli_fetch_array($sqlResultado)){
		$id_servicio = $filaElim["cod_servicio"];
		if ($_REQUEST["chk" . $id_servicio] == "on") {
			$x++;
			if ($x == 1) {
					$sql = "DELETE FROM servicios WHERE cod_servicio=$id_servicio";
				} else { 
					$sql = $sql . " OR cod_servicio=$id_servicio";
				}
			}
		}
		mysqli_free_result($sqlResultado);
	if ($x > 0) { 
		$rs = mysqli_query($enlaces,$sql);
	}
	header ("Location:servicios.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <style>
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
			td:nth-of-type(1):before { content: "Título"; }
			td:nth-of-type(2):before { content: "Imagen"; }
			td:nth-of-type(3):before { content: "Orden"; }
			td:nth-of-type(4):before { content: "Estado"; }
			td:nth-of-type(5):before { content: ""; }
			td:nth-of-type(6):before { content: ""; }
			td:nth-of-type(7):before { content: ""; }
		}
	</style>
	<style>
        @import "media/css/demo_page.css";
        @import "media/css/demo_table.css";
        @import "media/css/TableTools.css";
    </style>
    <script src="media/js/jquery.js"></script>
    <script src="media/js/jquery.dataTables.js"></script>
    <script src="media/ZeroClipboard/ZeroClipboard.js"></script>
    <script src="media/js/TableTools.js"></script>
    <script>
    $(document).ready(function(){
        $("#albums").dataTable({
            "sDom": 'T<"clear">lftrip',
            "sPaginationType": "full_numbers"
        });
    });
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
        <?php $page = "fotos"; include("includes/header.php") ?>
		<div id="content" class="clearfix">
	        <div class="header">
				<h1 class="page-title">Servicios</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-bars"></i> Servicios <i class="fa fa-caret-right"></i> Fotos
			</div>
			<div class="wrp clearfix">
            	<?php include("includes/menu-servicio.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Lista de Fotos</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<div class='alert alert-info' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<p><strong>Nota:</strong> Aqu&iacute; se a&ntilde;aden fotos adicionales para los servicios, con imagen destacada.</p>
			                </div>
							<form name="fcms" method="post" action="">
                            	<table class="text-center" width="100%" border="1" id="album">
                                	<thead>
                                    	<tr>
                                        	<th width="45%" scope="col">T&iacute;tulo</th>
                                            <th width="45%" scope="col">Imagen</th>
                                            <th width="5%" scope="col">Orden</th>
                                            <th width="5%" scope="col">&nbsp;</th>
										</tr>
									</thead>
									<?php	
                       		 			$consultarSer = "SELECT * FROM servicios ORDER BY orden";
										$resultadoSer = mysqli_query($enlaces,$consultarSer) or die('Consulta fallida: ' . mysqli_error($enlaces));
										while($filaSer = mysqli_fetch_array($resultadoSer)){
											$xCodigo		= $filaSer['cod_servicio'];
											$xNomSer		= mysqli_real_escape_string($enlaces, $filaSer['titulo']);
											$xImagen		= $filaSer['imagen'];
											$xOrden			= $filaSer['orden'];
											$xEstado		= $filaSer['estado'];
											$num++;
											//Número de fotos
											$consultaFoto = "SELECT * FROM servicios_fotos WHERE cod_servicio=$xCodigo";
											$resultadoFoto = mysqli_query($enlaces,$consultaFoto);
											$numfotos = mysqli_num_rows($resultadoFoto);
									?>
                                    <?php 
										if($xImagen!=""){
									?>
                                    <tr>
                                        <td><?php echo $xNomSer; ?><br><i><?php echo $numfotos; ?> Fotos</i></td>
                                        <td><img class="img-admin" src="images/servicios/<?php echo $xImagen; ?>" /></td>
                                        <td><?php echo $xOrden; ?></td>
                                        <td><a class="boton-nuevo <?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="Si"){ ?>javascript:visitante();<?php }else{ ?>servicios-fotos-nuevo.php?cod_servicio=<?php echo $xCodigo; ?>&titulo=<?php echo $xNomSer; ?><?php } ?>"><i class="fa fa-search"></i></a></td>
                                    </tr>
                                    <?php }else{ ?><?php } ?>
									<?php
                                        }
                                        mysqli_free_result($resultadoSer);
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