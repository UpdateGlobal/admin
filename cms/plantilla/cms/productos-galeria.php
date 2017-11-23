<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php include "modulos/clean.php"; ?>
<?php $num = ""; ?>
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
				<i class="fa fa-cube"></i> Productos <i class="fa fa-caret-right"></i> Galer&iacute;a de Productos
			</div>
			<div class="wrp clearfix">
            	<?php $page = "galeria"; include("includes/menu-productos.php"); ?>
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
                            	<i class="fa fa-th"></i> <strong>Galer&iacute;a de Productos</strong>
							</div>
						</div>
						<div class="widget-content">
							<form name="fcms" method="post" action="">
                                <table class="text-center" width="100%" border="1" id="productos">
                                	<thead>
                                    	<tr>
                                        	<th width="5%" scope="col">Nº</th>
											<th width="20%" scope="col">Categoria</th>
											<th width="20%" scope="col">Sub Categoria</th>
											<th width="20%" scope="col">Producto</th>
                                            <th width="20%" scope="col">Imagen
												<input type="hidden" name="proceso">
												<input type="hidden" name="eliminar" value="false">
											</th>
											<th width="5%" scope="col"><a href="javascript:Procedimiento('eliminar','N');"><img src="images/borrar.png" width="18" height="25" alt="Borrar"></a></th>
										</tr>
									</thead>
                                    <?php
                                    	$consultarPro = "SELECT cp.cod_categoria, cp.categoria, scp.cod_sub_categoria, scp.subcategoria, p.* FROM productos_categorias as cp, productos_sub_categorias as scp, productos as p WHERE p.cod_categoria=cp.cod_categoria AND p.cod_sub_categoria=scp.cod_sub_categoria ORDER BY orden ASC";
				                        $resultadoPro = mysqli_query($enlaces, $consultarPro);
                				        while($filaPro = mysqli_fetch_array($resultadoPro)){
				                            $xCodigo		= $filaPro['cod_producto'];
											$xCategoria		= utf8_encode($filaPro['categoria']);
			                    	        $xSCategoria	= utf8_encode($filaPro['subcategoria']);
                				            $xProducto		= $filaPro['nom_producto'];
				                            $xImagen		= $filaPro['imagen'];
				                            $num++;
						                    //Número de fotos
											$consultaFoto = "SELECT * FROM productos_galeria WHERE cod_producto=$xCodigo";
											$resultadoFoto = mysqli_query($enlaces,$consultaFoto);
											$numfotos = mysqli_num_rows($resultadoFoto);
									?>
                                    <?php 
										if($xImagen!=""){
									?>
                                    <tr>
				                        <td><?php echo $num; ?></td>
				                        <td><?php echo $xCategoria; ?></td>
				                        <td><?php echo $xSCategoria; ?></td>
				                        <td><?php echo $xProducto; ?><br><i><?php echo $numfotos; ?> Fotos</i></td>
				                        <td><img class="banner-int" src="images/productos/<?php echo $xImagen; ?>" /></td>
                				        <td> <a class="boton-nuevo" href="<?php if($xVisitante=="No"){ ?>productos-galeria-nuevo.php?cod_producto=<?php echo $xCodigo; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-search"></i></a></td>
				                    </tr>
                                    <?php }else{ ?><?php } ?>
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