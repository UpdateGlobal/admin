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
	$sqlEliminar = "SELECT cod_galeria FROM galerias ORDER BY orden";
	$sqlResultado = mysqli_query($enlaces,$sqlEliminar) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$x = 0;
	while($filaElim = mysqli_fetch_array($sqlResultado)){
		$id_galeria = $filaElim["cod_galeria"];
		if ($_REQUEST["chk" . $id_galeria] == "on") {
			$x++;
			if ($x == 1) {
					$sql = "DELETE FROM galerias WHERE cod_galeria=$id_galeria";
				} else { 
					$sql = $sql . " OR cod_galeria=$id_galeria";
				}
			}
		}
		mysqli_free_result($sqlResultado);
	if ($x > 0) { 
		$rs = mysqli_query($enlaces,$sql);
	}
	header ("Location:galerias.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <style>
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
			td:nth-of-type(1):before { content: "Album"; }
			td:nth-of-type(2):before { content: "Imagen"; }
			td:nth-of-type(3):before { content: "Orden"; }
			td:nth-of-type(4):before { content: ""; }
		}
	</style>
	<style>
        @import "media/css/demo_page.css";
        @import "media/css/demo_table.css";
        @import "media/css/TableTools.css";
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
				<h1 class="page-title">Galer&iacute;as</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-object-group"></i> Galer&iacute;as <i class="fa fa-caret-right"></i> Fotos
			</div>
			<div class="wrp clearfix">
            	<?php $page = "galerias"; include("includes/menu-galeria.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Lista de Albums</strong>
							</div>
						</div> <!-- /widget-header -->
						<div class="widget-content">
                        	<div class='alert alert-info' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<p><strong>Nota:</strong> Aqu&iacute; se a&ntilde;aden las fotos para los albums de las galer&iacute;as</p>
			                </div>
							<form name="fcms" method="post" action="">
                            	<table class="text-center" width="100%" border="1" id="album">
                                	<thead>
                                    	<tr>
                                        	<th width="45%" scope="col">Album</th>
                                            <th width="45%" scope="col">Imagen</th>
                                            <th width="5%" scope="col">Orden</th>
                                            <th width="5%" scope="col">&nbsp;</th>
										</tr>
									</thead>
									<?php
                       		 			$consultarGal = "SELECT * FROM galerias ORDER BY orden";
										$resultadoGal = mysqli_query($enlaces,$consultarGal) or die('Consulta fallida: ' . mysqli_error($enlaces));
										while($filaGal = mysqli_fetch_array($resultadoGal)){
											$xCodigo		= $filaGal['cod_galeria'];
											$xNomGal		= utf8_encode($filaGal['titulo']);
											$xImagen		= $filaGal['imagen'];
											$xOrden			= $filaGal['orden'];
											$xEstado		= $filaGal['estado'];
											$num++;
											//Número de fotos
											$consultaFoto = "SELECT * FROM galerias_fotos WHERE cod_galeria=$xCodigo";
											$resultadoFoto = mysqli_query($enlaces,$consultaFoto);
											$numfotos = mysqli_num_rows($resultadoFoto);
									?>
                                    <tr>
                                        <td><?php echo $xNomGal; ?><br><i><?php echo $numfotos; ?> Fotos</i></td>
                                        <td><img src="images/galerias/<?php echo $xImagen; ?>" width="148" height="98" /></td>
                                        <td><?php echo $xOrden; ?></td>
                                        <td><a class="boton-nuevo<?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="No"){ ?>galerias-albums-nuevo.php?cod_galeria=<?php echo $xCodigo; ?>&titulo=<?php echo $xNomGal; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-search"></i></a></td>
                                    </tr>
                                    
									<?php
                                        }
                                        mysqli_free_result($resultadoGal);
                                    ?>
								</table>
							</form>
						</div>
                    </div>
				</div>
			</div> <!-- /wrp -->
		</div> <!-- /content -->
		<?php include("includes/footer.php") ?>
		<script src="media/js/jquery.js"></script>
		<script src="media/js/jquery.dataTables.js"></script>
        <script src="media/ZeroClipboard/ZeroClipboard.js"></script>
        <script src="media/js/TableTools.js"></script>
        <script>
        $(document).ready(function(){
            $("#album").dataTable({
                "sDom": 'T<"nada">lftrip',
                "sPaginationType": "full_numbers"
            });
        });
        </script>
	</div> <!-- /wrapper -->
</body>
</html>