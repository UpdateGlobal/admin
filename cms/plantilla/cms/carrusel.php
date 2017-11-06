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
	$sqlEliminar = "SELECT cod_carrusel FROM carrusel ORDER BY orden";
	$sqlResultado = mysqli_query($enlaces,$sqlEliminar);
	$x = 0;
	while($filaElim = mysqli_fetch_array($sqlResultado)){
		$id_carrusel = $filaElim["cod_carrusel"];
		if ($_REQUEST["chk" . $id_carrusel] == "on") {
			$x++;
			if ($x == 1) {
					$sql = "DELETE FROM carrusel WHERE cod_carrusel=$id_carrusel";
				} else { 
					$sql = $sql . " OR cod_carrusel=$id_carrusel";
				}
		}
	}
	mysqli_free_result($sqlResultado);
	if ($x > 0) { 
		$rs = mysqli_query($enlaces,$sql);
	}
	header ("Location:carrusel.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <style>
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
			td:nth-of-type(1):before { content: "Imagen"; }
			td:nth-of-type(2):before { content: "Orden"; }
			td:nth-of-type(3):before { content: "Estado"; }
			td:nth-of-type(4):before { content: ""; }
			td:nth-of-type(5):before { content: ""; }
			td:nth-of-type(6):before { content: ""; }
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
				alert("Debes de seleccionar una Imagen.")
			}
			return
		}
		procedimiento = "document.fcms." + proceso + ".value = true"
		eval(procedimiento)
		document.fcms.submit()	
	}
	</script>
    <script src="js/visitante-alert.js"></script>
    <style>
        @import "media/css/demo_page.css";
        @import "media/css/demo_table.css";
        @import "media/css/TableTools.css";
    </style>
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
				<h1 class="page-title">P&aacute;gina de Inicio</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i> Carrusel
			</div>
			<div class="wrp clearfix">
            	<?php $page="carrusel"; include("includes/menu-inicio.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Lista de Carrusel</strong>
							</div>
						</div>
						<div class="widget-content">
                            <a class="btn btn-blue" href="<?php if($xVisitante=="No"){ ?>carrusel-nuevo.php<?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-plus" aria-hidden="true"></i> A&ntilde;adir nuevo</a>
                            <hr>
							<form name="fcms" method="post" action="">
                                <table class="text-center" width="100%" border="1" id="carrusel">
	                                <thead>
                                        <tr>
                                            <th width="65%" scope="col">Imagen
                                                <input type="hidden" name="proceso">
                                                <input type="hidden" name="eliminar" value="false">
                                            </th>
                                            <th width="10%" scope="col">Orden</th>
                                            <th width="10%" scope="col">Estado</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col"><a href="javascript:Procedimiento('eliminar','N');"><img src="images/borrar.png" width="18" height="25" alt="Borrar"></a></th>
                                        </tr>
                                    </thead>
                                    <?php
			                        $consultarCarrusel = "SELECT * FROM carrusel ORDER BY orden";
			                        $resultadoCarrusel = mysqli_query($enlaces,$consultarCarrusel) or die('Consulta fallida: ' . mysqli_error($enlaces));
			                        while($filaCar = mysqli_fetch_array($resultadoCarrusel)){
			                            $xCodigo		= $filaCar['cod_carrusel'];
			                            $xImagen		= $filaCar['imagen'];
			                            $xOrden			= $filaCar['orden'];
			                            $xEstado		= $filaCar['estado'];
			                            $num++;
				                    ?>              
                                    <tr>
                                        <td><img class="banner-int" src="images/carrusel/<?php echo $xImagen; ?>" /></td>
                                        <td><?php echo $xOrden; ?></td>
                                        <td><strong>[<?php echo $xEstado; ?>]</strong></td>
                                        <td>
                                        <a class="boton-eliminar <?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="No"){ ?>carrusel-delete.php?cod_carrusel=<?php echo $xCodigo; ?>&imagen=<?php $xImagen; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                        <td><a class="boton-editar" href="carrusel-edit.php?cod_carrusel=<?php echo $xCodigo; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a><td>
                                        <?php if($xVisitante=="No"){ ?>
                                        	<div class="custom-input">
		                                        <input type="checkbox" class="hidden-xs" id="chkbx-<?php echo $xCodigo; ?>" name="chk<?php echo $xCodigo; ?>" /><label for="chkbx-<?php echo $xCodigo; ?>"></label>
                                            </div>
                                        <?php } ?>
										</td>
                                    </tr>
                                    <?php
                                        }
                                        mysqli_free_result($resultadoCarrusel);
                                    ?>
                                </table>
                            </form>
						</div>
                    </div>
				</div>
			</div>
		</div>
		<?php include("includes/footer.php") ?>
		<script src="media/js/jquery.dataTables.js"></script>
		<script src="media/ZeroClipboard/ZeroClipboard.js"></script>
		<script src="media/js/TableTools.js"></script>
		<script>
		$(document).ready(function(){
			$("#carrusel").dataTable({
				"sDom": 'T<"nada">lftrip',
				"sPaginationType": "full_numbers"
			});
		});
		</script>
	</div>
</body>
</html>