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
	$sqlEliminar = "SELECT cod_noticia FROM noticias ORDER BY fecha";
	$sqlResultado = mysqli_query($enlaces,$sqlEliminar);
	$x = 0;
	while($filaElim = mysqli_fetch_array($sqlResultado)){
		$id_noticia = $filaElim["cod_noticia"];
		if ($_REQUEST["chk" . $id_noticia] == "on") {
			$x++;
			if ($x == 1) {
					$sql = "DELETE FROM noticias WHERE cod_noticia=$id_noticia";
				} else { 
					$sql = $sql . " OR cod_noticia=$id_noticia";
				}
		}
	}
	mysqli_free_result($sqlResultado);
	if ($x > 0) { 
		$rs = mysqli_query($enlaces,$sql);
	}
	header ("Location:noticias.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <style>
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
			td:nth-of-type(1):before { content: "Imagen"; }
			td:nth-of-type(2):before { content: "Título"; }
			td:nth-of-type(3):before { content: "Orden"; }
			td:nth-of-type(4):before { content: "Estado"; }
			td:nth-of-type(5):before { content: ""; }
			td:nth-of-type(6):before { content: ""; }
			td:nth-of-type(7):before { content: ""; }
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
				alert("Debes de seleccionar un noticia.")
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
				<h1 class="page-title">Noticias</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-object-group"></i> Noticias
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Lista de Noticias</strong>
							</div>
						</div>
						<div class="widget-content">
                        	<a class="btn btn-blue" href="<?php if($xVisitante=="No"){ ?>noticias-nuevo.php<?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-plus" aria-hidden="true"></i> A&ntilde;adir nuevo</a>
                            <hr>
							<form name="fcms" method="post" action="">
                                <table class="text-center" width="100%" border="1" id="noticias">
                                	<thead>
                                        <tr>
                                            <th width="35%" scope="col">Imagen
                                                <input type="hidden" name="proceso">
                                                <input type="hidden" name="eliminar" value="false">
                                            </th>
                                            <th width="20%" scope="col">T&iacute;tulo</th>
                                            <th width="20%" scope="col">Fecha</th>
                                            <th width="10%" scope="col">Estado</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col"><a href="javascript:Procedimiento('eliminar','N');"><img src="images/borrar.png" width="18" height="25" alt="Borrar"></a></th>
                                        </tr>
                                    </thead>
                                    <?php
			                        $consultarNoticias = "SELECT * FROM noticias ORDER BY fecha";
			                        $resultadoNoticias = mysqli_query($enlaces,$consultarNoticias) or die('Consulta fallida: ' . mysqli_error($enlaces));
			                        while($filaNot = mysqli_fetch_array($resultadoNoticias)){
			                            $xCodigo		= $filaNot['cod_noticia'];
										$xTitulo		= $filaNot['titulo'];
			                            $xImagen		= $filaNot['imagen'];
			                            $xFecha			= $filaNot['fecha'];
			                            $xEstado		= $filaNot['estado'];
			                            $num++;
				                    ?>              
                                    <tr>
                                        <td><?php if($xImagen!=""){?><img class="noticia-int" src="images/noticias/<?php echo $xImagen; ?>" /><?php }else{ ?> <?php } ?></td>
                                        <td><?php echo $xTitulo; ?></td>
                                        <td><?php echo $xFecha; ?></td>
                                        <td><strong>[<?php echo $xEstado; ?>]</strong></td>
                                        <td><a class="boton-eliminar <?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="No"){ ?>noticias-delete.php?cod_noticia=<?php echo $xCodigo; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                        <td><a class="boton-editar" href="noticias-edit.php?cod_noticia=<?php echo $xCodigo; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
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
                                        mysqli_free_result($resultadoNoticias);
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
			$("#noticias").dataTable({
				"sDom": 'T<"nada">lftrip',
				"sPaginationType": "full_numbers"
			});
		});
		</script>
	</div>
</body>
</html>