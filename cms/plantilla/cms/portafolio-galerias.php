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
	$sqlEliminar = "SELECT cod_portafolio FROM portafolio ORDER BY orden";
	$sqlResultado = mysqli_query($enlaces,$sqlEliminar) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$x = 0;
	while($filaElim = mysqli_fetch_array($sqlResultado)){
		$id_portafolio = $filaElim["cod_portafolio"];
		if ($_REQUEST["chk" . $id_portafolio] == "on") {
			$x++;
			if ($x == 1) {
					$sql = "DELETE FROM portafolio WHERE cod_portafolio=$id_portafolio";
				} else { 
					$sql = $sql . " OR cod_portafolio=$id_portafolio";
				}
			}
		}
		mysqli_free_result($sqlResultado);
	if ($x > 0) { 
		$rs = mysqli_query($enlaces,$sql);
	}
	header ("Location:portafolio.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <style>
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
			td:nth-of-type(1):before { content: "Trabajo"; }
			td:nth-of-type(2):before { content: "Categoria"; }
			td:nth-of-type(3):before { content: "Imagen"; }
			td:nth-of-type(4):before { content: "Orden"; }
			td:nth-of-type(5):before { content: ""; }
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
				<h1 class="page-title">Portafolio</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Portafolio <i class="fa fa-caret-right"></i> Galerías
			</div>
			<div class="wrp clearfix">
            	<?php $page = "fotos"; include("includes/menu-portafolio.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Lista de Galerías</strong>
							</div>
						</div> <!-- /widget-header -->
						<div class="widget-content">
                        	<div class='alert alert-info' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<p><strong>Nota:</strong> Las galerías son para los trabajos que tengan más de una imagen, en esta sección solo se editan las fotos de los trabajos ya publicados.</p>
			                </div>
							<form name="fcms" method="post" action="">
                            	<table class="text-center" width="100%" border="1" id="portafolio">
                                	<thead>
                                    	<tr>
                                        	<th width="20%" scope="col">Trabajo</th>
                                            <th width="20%" scope="col">Categoria</th>
                                            <th width="40%" scope="col">Imagen</th>
                                            <th width="5%" scope="col">Orden</th>
                                            <th width="5%" scope="col">&nbsp;</th>
										</tr>
									</thead>
									<?php
                                        $consultarPor = "SELECT cp.cod_categoria, cp.categoria, p.* FROM portafolio_categorias as cp, portafolio as p WHERE p.cod_categoria=cp.cod_categoria AND p.type='I' ORDER BY p.orden";
                                        $resultadoPor = mysqli_query($enlaces,$consultarPor);
                                        while($filaPor = mysqli_fetch_array($resultadoPor)){
                                            $xCodigo		= $filaPor['cod_portafolio'];
                                            $xCategoria		= utf8_encode($filaPor['categoria']);
                                            $xPortafolio	= utf8_encode($filaPor['nom_portafolio']);
                                            $xImagen		= $filaPor['imagen'];
                                            $xOrden			= $filaPor['orden'];
                                            $num++;
                                    		//Número de fotos
											$consultaFoto = "SELECT * FROM portafolio_galerias WHERE cod_portafolio=$xCodigo";
											$resultadoFoto = mysqli_query($enlaces,$consultaFoto);
											$numfotos = mysqli_num_rows($resultadoFoto);
									?>
                                    <?php 
										if($xImagen!=""){
									?>
                                    <tr>
                                        <td><?php echo $xPortafolio; ?><br><i><?php echo $numfotos; ?> Fotos</i></td>
                                        <td><?php echo $xCategoria; ?></td>
                                        <td><img class="img-admin" src="images/portafolio/<?php echo $xImagen; ?>" /></td>
                                        <td><?php echo $xOrden; ?></td>
                                        <td><a class="boton-nuevo <?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="Si"){ ?>javascript:visitante();<?php }else{ ?>portafolio-galerias-nuevo.php?cod_portafolio=<?php echo $xCodigo; ?>&nom_portafolio=<?php echo $xPortafolio; ?><?php } ?>"><i class="fa fa-search"></i></a></td>
                                    </tr>
                                    <?php }else{ ?><?php } ?>
									<?php
                                        }
                                        mysqli_free_result($resultadoPor);
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
        		$("#portafolio").dataTable({
            		"sDom": 'T<"nada">lftrip',
            		"sPaginationType": "full_numbers"
        		});
    		});
    	</script>
	</div> <!-- /wrapper -->
</body>
</html>