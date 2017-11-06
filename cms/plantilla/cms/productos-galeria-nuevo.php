<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php
$cod_producto	= $_REQUEST['cod_producto'];
if (isset($_REQUEST['proceso'])) {
	$proceso	= $_POST['proceso'];
} else {
	$proceso 	= "";
}

$consultaFotos = "SELECT * FROM productos_galeria WHERE cod_producto='$cod_producto'";
$resultadoFotos = mysqli_query($enlaces, $consultaFotos);

$consultaNombre = "SELECT * FROM productos WHERE cod_producto='$cod_producto'";
$resultadoNombre = mysqli_query($enlaces,$consultaNombre);

if($proceso == "Registrar"){
	$cod_producto		= $_POST['cod_producto'];
	$imagen				= $_POST['imagen'];
	$insertarGaleria = "INSERT INTO productos_galeria(cod_producto, imagen)VALUE('$cod_producto', '$imagen')";
	$resultadoInsertar = mysqli_query($enlaces, $insertarGaleria);
	header("Location: productos-galeria-nuevo.php?cod_producto=$cod_producto?nom_producto=$nom_producto");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <script type="text/javascript" src="js/rutinas.js"></script>
	<script>
        function Validar(){
			if(document.fcms.imagen.value==""){
				alert("Debe subir una imagen");
				document.fcms.imagen.focus();
				return;	
			}
			
            document.fcms.action = "productos-galeria-nuevo.php";
            document.fcms.proceso.value="Registrar";
            document.fcms.submit();
        }
		function Imagen(codigo){
			url = "agregar-foto.php?id=" + codigo;
			AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
		}
    </script>
    <!-- Inicio Paginador Ajax jquery -->
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
                            <div class='alert alert-info' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
								<p><strong>Nota:</strong> A&ntilde;ada fotos al producto que seleccion&oacute;.</p>
			                </div>
                            <form name="fcms" method="post" action="">
	                            <div class="row">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                       	<label>Producto:</label>
                                    </div>
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                       	<?php
											while($filaNom = mysqli_fetch_array($resultadoNombre)){
												$xNomProduc = htmlspecialchars($filaNom['nom_producto']);
		                                   ?>
                                           <strong><?php echo $xNomProduc; ?></strong>
                                            <?php
                                            }
											?>
                                        </div>
									</div>
									<div class="separador-20"></div>
									<div class="row">
    	                            	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        	<label>Añadir imagen: *<br><span>(-px x -px)</span></label>
                                        </div>
										<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                            <input name="imagen" type="text" id="imagen" />
                                        </div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        	<button class="btn btn-red" type="button" name="boton2" onClick="javascript:Imagen('IGP');" /><i class="fa fa-save"></i> Examinar</button>
                                        </div>
                                    </div>
                                    <div class="separador-20"></div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        	<div class="btn-group">
                                            	<a href="productos-galeria.php" class="btn btn-pink"><i class="fa fa-times"></i> Cancelar</a>
                                                <button class="btn btn-turquoise" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-plus-circle"></i> A&ntilde;adir Foto</button>
											</div>
							                <input type="hidden" name="proceso">
					                        <input type="hidden" name="cod_producto" value="<?php echo $cod_producto; ?>">
					                        <input type="hidden" name="nom_producto" value="<?php echo $nom_producto; ?>">
                                        </div>
                                    </div>
								</form>
	                            <div class="separador-20"></div>
    	                        <p>Im&aacute;genes dentro de esta galer&iacute;a, <strong>haga clic en las im&aacute;genes para borrar/quitar.</strong></p>
								<div id="listagaleria">
									<ul>
										<?php
                    	                    while($filaFoto = mysqli_fetch_array($resultadoFotos)){
                        	                    $xCodigoGal = $filaFoto['cod_galeria_producto'];
                            	                $xCodProducto = $filaFoto['cod_producto'];
                                	            $xFoto = $filaFoto['imagen'];
                                    	?>
	                                    <li class="thumbnail">
    	                                	<a href="productos-galeria-delete.php?cod_galeria_producto=<?php echo $xCodigoGal; ?>&cod_producto=<?php echo $xCodProducto; ?>&imagen=<?php echo $xFoto; ?>"><img src="images/productos/galeria/<?php echo $xFoto; ?>" width="150" height="100"></a>
        	                            </li>
            	                        <?php
                	                        }
                    	                ?>
									</ul>
								</div>
							</div>
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