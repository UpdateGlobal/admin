<?php include("modulos/conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
	<meta http-equiv="refresh" content="3;URL=index.php">
</head>
<body>
	<div id="loading">
		<div>
			<div></div>
		    <div></div>
		    <div></div>
		</div>
	</div>
	<div id="content" class="c-login clearfix">
		<div class="header" style="height:auto;">
			<a href="index.php"><img src="images/meta/<?php echo $xLogo; ?>"></a>
		</div>
		<div class="breadcrumbs">
			<i class="fa fa-key"></i> Login
		</div>
        <div class="widget-content">
        	<form id="fcms-intro" name="fcms" method="post" action="">
		        <p>¡ LO SENTIMOS UD. NO ES UN USUARIO AUTORIZADO POR EL SISTEMA !</p>
	    	    <p>Intentelo de nuevo colocando su email y</p>
        		<p>clave correcto.</p>
			</form>
		</div>
	</div>
	<?php include("includes/footer.php"); ?>
</body>
</html>