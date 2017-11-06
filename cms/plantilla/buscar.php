<?php include "cms/modulos/conexion.php" ?>
<?php include "modulos/session-core.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
	<script>
		function ValidarBusqueda(){
			if(document.buscar.buscador.value==""){
				alert("Debes ingresar datos para la búsqueda");
				document.buscar.buscador.focus();
				return;
			}
			document.buscar.action="resultados.php";
			document.buscar.submit();
		}
	</script>
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
                    <li class="active"><strong>Buscar</strong></li>
                </ol>
            </div>
		</div>
	</div>    
    <div class="container">
		<div class="row">	
            <div class="col-lg-12">
                <h2 class="page-header">Buscador</h2>
            </div>
        </div>
		<div class="row">
			<form name="buscar" id="fbuscador">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<input class="form-control" type="text" name="buscador" onkeypress="if(event.keyCode==13){ValidarBusqueda();}" id="buscador" placeholder="Buscar Productos">
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
					<input class="btn btn-primary" name="bbusca" type="button" id="bbusca" value="BUSCAR" onclick="javascript:ValidarBusqueda();">
				</div>
			</form>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>