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
	$sqlEliminar = "SELECT cod_categoria FROM productos_categorias ORDER BY orden";
	$sqlResultado = mysqli_query($enlaces,$sqlEliminar);
	$x = 0;
	while($filaElim = mysqli_fetch_array($sqlResultado)){
		$id_categoria = $filaElim["cod_categoria"];
		if ($_REQUEST["chk" . $id_categoria] == "on") {
			$x++;
			if ($x == 1) {
					$sql = "DELETE FROM productos_categorias WHERE cod_categoria=$id_categoria";
				} else { 
					$sql = $sql . " OR cod_categoria=$id_categoria";
				}
		}
	}
	mysqli_free_result($sqlResultado);
	if ($x > 0) { 
		$rs = mysqli_query($enlaces,$sql);
	}
	header ("Location:productos-categorias.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <style>
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
			td:nth-of-type(1):before { content: "Categoría"; }
			td:nth-of-type(2):before { content: "Imagen"; }
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
				alert("Debes de seleccionar un categoria.")
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
				<h1 class="page-title">Productos</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-cube"></i> Productos <i class="fa fa-caret-right"></i> Categor&iacute;as
			</div>
			<div class="wrp clearfix">
            	<?php $page = "categorias"; include("includes/menu-productos.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
                            	<i class="fa fa-th"></i> <strong>Lista de Categor&iacute;a</strong>
							</div>
						</div>
						<div class="widget-content">
							<a class="btn btn-blue" href="<?php if($xVisitante=="No"){ ?>productos-categorias-nuevo.php<?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-plus" aria-hidden="true"></i> A&ntilde;adir nuevo</a>
                            <hr>
							<form name="fcms" method="post" action="">
                                <table class="text-center" width="100%" border="1" id="categoria">
                                	<thead>
                                        <tr>
                                            <th width="30%" scope="col">Categor&iacute;a
                                                <input type="hidden" name="proceso">
                                                <input type="hidden" name="eliminar" value="false">
                                            </th>
                                            <th width="30%" scope="col">Imagen</th>
                                            <th width="20%" scope="col">Orden</th>
                                            <th width="5%" scope="col">Estado</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col"><a href="javascript:Procedimiento('eliminar','N');"><img src="images/borrar.png" width="18" height="25" alt="Borrar"></a></th>
                                        </tr>
                                    </thead>
                                    <?php
			                        $consultarCategoria = "SELECT * FROM productos_categorias ORDER BY orden";
			                        $resultadoCategoria = mysqli_query($enlaces,$consultarCategoria) or die('Consulta fallida: ' . mysqli_error($enlaces));
			                        while($filaCat = mysqli_fetch_array($resultadoCategoria)){
			                            $xCodigo		= $filaCat['cod_categoria'];
			                            $xCategoria		= utf8_encode($filaCat['categoria']);
			                            $xImagen		= $filaCat['imagen'];
			                            $xOrden			= $filaCat['orden'];
			                            $xEstado		= $filaCat['estado'];
			                            $num++;
				                    ?>              
                                    <tr>
                                        <td><?php echo $xCategoria; ?></td>
                                        <td><img class="banner-int" src="images/productos/categorias/<?php echo $xImagen; ?>" /></td>
                                        <td><?php echo $xOrden; ?></td>
                                        <td><?php if($xCodigo!="1"){?><strong>[<?php echo $xEstado; ?>]</strong><?php }?></td>
                                        <td><?php if($xCodigo!="1"){?><a class="boton-eliminar <?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="No"){ ?>productos-categorias-delete.php?cod_categoria=<?php echo $xCodigo; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-trash"></i></a><?php }?></td>
                                        <td><a class="boton-editar" href="productos-categorias-edit.php?cod_categoria=<?php echo $xCodigo; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                                        <td>
                                        	<?php if($xVisitante=="No"){?>
                                        	<div class="custom-input">
		                                        <?php if($xCodigo!="1"){?><input type="checkbox" class="hidden-xs" id="chkbx-<?php echo $xCodigo; ?>" name="chk<?php echo $xCodigo; ?>" /><label for="chkbx-<?php echo $xCodigo; ?>"></label><?php }?>
                                            </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                        mysqli_free_result($resultadoCategoria);
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
                $("#categoria").dataTable({
                    "sDom": 'T<"nada">lftrip',
                    "sPaginationType": "full_numbers"
                });
            });
        </script>
	</div>
</body>
</html>