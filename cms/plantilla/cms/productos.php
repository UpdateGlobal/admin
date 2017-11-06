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
	$sqlEliminar = "SELECT cod_producto FROM productos ORDER BY cod_producto";
	$sqlResultado = mysqli_query($enlaces, $sqlEliminar);
	$x = 0;
	while($filaElim = mysqli_fetch_array($sqlResultado)){
		$id_producto = $filaElim["cod_producto"];
		if ($_REQUEST["chk" . $id_producto] == "on") {
			$x++;
			if ($x == 1) {
					$sql = "DELETE FROM productos WHERE cod_producto=$id_producto";
				} else { 
					$sql = $sql . " OR cod_producto=$id_producto";
				}
		}
	}
	mysqli_free_result($sqlResultado);
	if ($x > 0) { 
		$rs = mysqli_query($enlaces, $sql);
	}
	header ("Location: productos.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <style>
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
			td:nth-of-type(1):before { content: "Nº"; }
			td:nth-of-type(2):before { content: "Categoria"; }
			td:nth-of-type(3):before { content: "Sub-categoria"; }
			td:nth-of-type(4):before { content: "Producto"; }
			td:nth-of-type(5):before { content: "Imagen"; }
			td:nth-of-type(6):before { content: "Adjuntos"; }
			td:nth-of-type(7):before { content: ""; }
			td:nth-of-type(8):before { content: ""; }
			td:nth-of-type(9):before { content: ""; }
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
				<i class="fa fa-cube"></i> Productos
			</div>
			<div class="wrp clearfix">
            	<?php $page = "productos"; include("includes/menu-productos.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
                            	<i class="fa fa-th"></i> <strong>Lista de Productos</strong>
							</div>
						</div>
						<div class="widget-content">
							<a class="btn btn-blue" href="<?php if($xVisitante=="No"){ ?>productos-nuevo.php<?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-plus" aria-hidden="true"></i> A&ntilde;adir nuevo</a>
                            <hr>
							<form name="fcms" method="post" action="">
                                <table class="text-center" width="100%" border="1" id="productos">
                                	<thead>
                                    	<tr>
                                        	<th width="5%" scope="col">Nº</th>
											<th width="15%" scope="col">Categoria</th>
											<th width="15%" scope="col">Sub Categoria</th>
											<th width="20%" scope="col">Producto</th>
                                            <th width="20%" scope="col">Imagen
												<input type="hidden" name="proceso">
												<input type="hidden" name="eliminar" value="false">
											</th>
                                            <th width="10%" scope="col">Adjuntos</th>
											<th width="5%" scope="col">&nbsp;</th>
											<th width="5%" scope="col">&nbsp;</th>
											<th width="5%" scope="col"><a href="javascript:Procedimiento('eliminar','N');"><img src="images/borrar.png" width="18" height="25" alt="Borrar"></a></th>
										</tr>
									</thead>
                                    <?php
				                        $consultarPro = "SELECT cp.cod_categoria, cp.categoria, scp.cod_sub_categoria, scp.subcategoria, p.* FROM productos_categorias as cp, productos_sub_categorias as scp, productos as p WHERE p.cod_categoria=cp.cod_categoria AND p.cod_sub_categoria=scp.cod_sub_categoria ORDER BY cp.categoria ASC";
			    	                    $resultadoPro = mysqli_query($enlaces, $consultarPro);
			        	                while($filaPro = mysqli_fetch_array($resultadoPro)){
			            	                $xCodigo		= $filaPro['cod_producto'];
			                	            $xCategoria		= utf8_encode($filaPro['categoria']);
			                    	        $xSCategoria	= utf8_encode($filaPro['subcategoria']);
			                        	    $xProducto		= $filaPro['nom_producto'];
			                            	$xImagen		= $filaPro['imagen'];
											$xFicha			= $filaPro['ficha_tecnica'];
											$xVideo			= $filaPro['video'];
	                			            $num++;
				                    ?>
                                    <tr>
				                        <td><?php echo $num; ?></td>
				                        <td><?php echo $xCategoria; ?></td>
				                        <td><?php echo $xSCategoria; ?></td>
				                        <td><?php echo $xProducto; ?></td>
				                        <td><img class="banner-int" src="images/productos/<?php echo $xImagen; ?>" /></td>
				                        <td><strong><?php if($xVideo!=""){echo "<i class='fa fa-video-camera'></i> ";} if($xFicha!=""){echo "<i class='fa fa-file-pdf-o'></i> ";} ?></strong></td>
				                        <td><a class="boton-eliminar <?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="No"){ ?>productos-delete.php?cod_producto=<?php echo $xCodigo; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-trash"></i></a></td>
                				        <td><a class="boton-editar" href="productos-edit.php?cod_producto=<?php echo $xCodigo; ?>"><i class="fa fa-pencil-square"></i></a></td>
				                        <td>
	                                        <?php if($xVisitante=="No"){ ?>
	                                        <div class="custom-input">
                                                <input class="hidden-xs" type="checkbox" id="chkbx-<?php echo $xCodigo; ?>" name="chk<?php echo $xCodigo; ?>" /><label for="chkbx-<?php echo $xCodigo; ?>"></label>
											</div>
                                            <?php } ?>
                                        </td>
                				    </tr>
				                    <?php
										}
										mysqli_free_result($resultadoPro);
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
                $("#productos").dataTable({
                    "sDom": 'T<"nada">lftrip',
                    "sPaginationType": "full_numbers"
                });
            });
        </script>
	</div>
</body>
</html>