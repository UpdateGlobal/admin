<?php include "cms/modulos/conexion.php" ?>
<?php include "modulos/session-core.php"; ?>
<?php 
$buscador = utf8_encode($_REQUEST['buscador']);
$parametros = "&buscador=$buscador";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>

</head>
<body>
	<div class="menu">
		<div class="container">
			<?php include("includes/header.php"); ?>
        </div>
	</div>
    <div class="container">
	    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Buscar</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active"><strong>B&uacute;squeda</strong></li>
                </ol>
            </div>
		</div>
	</div>    
    <div class="container">
		<div class="row">	
            <div class="col-lg-12">
                <h2 class="page-header">Resultado</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12">
				<?php
					//configuracion de paginador
					$buscarpro = "SELECT * FROM productos WHERE (nom_producto LIKE '%$buscador%' OR descripcion LIKE '%$buscador%') AND estado='Activo'";
					$resultadobus = mysqli_query($enlaces, $buscarpro);
					$total_registros = mysqli_num_rows($resultadobus);
					$registros_por_paginas = 16;
					$total_paginas = ceil($total_registros/$registros_por_paginas);
					$pagina = intval($_GET['p']);
					if($pagina<1 or $pagina>$total_paginas){
						$pagina=1;
					}
					$posicion = ($pagina-1)*$registros_por_paginas;
					$limite = "LIMIT $posicion, $registros_por_paginas";
					//fin configuracion paginador

					$buscarpro="SELECT * FROM productos WHERE (nom_producto LIKE '%$buscador%' OR descripcion LIKE '%$buscador%') AND estado='Activo' $limite";
					$resultadobus=mysqli_query($enlaces, $buscarpro);
					while($filabus=mysqli_fetch_array($resultadobus)){
						$xCodp=$filabus['cod_producto'];
						$xCodsc=$filabus['cod_sub_categoria'];
						$xCodc=$filabus['cod_categoria'];
						$xImgp=$filabus['imagen'];
						$xNomp=substr(utf8_decode($filabus['nom_producto']),0,20);
						if($filabus['precio_oferta']>=1){
							$pmostrar = number_format($filabus['precio_oferta'], 2);
						}else{
							$pmostrar = number_format($filabus['precio_normal'], 2);
						}
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="thumbnail">
						<a href="producto-detalle.php?cod_categoria=<?php echo $xCodc; ?>&cod_sub_categoria=<?php echo $xCodsc; ?>&cod_producto=<?php echo $xCodp; ?>"><img class="img-responsive" src="cms/images/productos/<?php echo $xImgp; ?>" /></a>
						<div class="caption">
							<h4><a href="producto-detalle.php?cod_categoria=<?php echo $xCodc; ?>&cod_sub_categoria=<?php echo $xCodsc; ?>&cod_producto=<?php echo $xCodp; ?>"><?php echo $xNomp; ?></a></h4>
							<button href="producto-detalle.php?cod_categoria=<?php echo $xCodc; ?>&cod_sub_categoria=<?php echo $xCodsc; ?>&cod_producto=<?php echo $xCodp; ?>" class="btn btn-default" type="button">Ver m&aacute;s</button> <h4 class="pull-right">$ <?php echo $pmostrar; ?></h4>
						</div>
					</div>
				</div>
				<?php 
					}
				?>    
				<div class="limpiar"></div>
             </div>
             <?php 
				$paginas_mostrar=10;
				if ($total_paginas>1){
					echo "<div class='row text-center'>
							<div class='col-lg-12'>
								<ul class='pagination'>";
					if($pagina>1){
						echo "<li><a href='?p=1$parametros'>Inicio</a></li>";
						echo "<li><a href='?p=".($pagina-1).$parametros."'>&laquo;</a></li>";
					}
					for($i=$pagina; $i<=$total_paginas && $i<=($pagina+$paginas_mostrar); $i++){
						if($i==$pagina){
							echo "<li class='active'><a><strong>$i</strong></a></li>";
						}else{
							echo "<li><a href='?p=$i$parametros'>$i</a></li>";
						}
					}
					if(($pagina+$paginas_mostrar)<$total_paginas){
						echo "<li>...</li>";
					}
					if($pagina<$total_paginas){
						echo "<li><a href='?p=".($pagina+1).$parametros."'>&raquo;</a></li> ";
						echo "<li><a href='?p=$total_paginas.$parametros'>Fin</a></li>";
					}
					echo "</ul>
						</div>
					</div>
				<hr>";
				}
			 ?>
            </div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>