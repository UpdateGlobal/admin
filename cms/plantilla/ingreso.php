<?php include "cms/modulos/conexion.php"; ?>
<?php include "modulos/session-core.php"; ?>
<!doctype html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
	<script>
		function Validar(){
			document.ftienda.action="validar.php";
			if(document.ftienda.email.value==""){
				alert("Debes ingresar tu email");
				document.ftienda.email.focus();
				return;
			}
			if(document.ftienda.clave.value==""){
				alert("Debes ingresar tu clave");
				document.ftienda.clave.focus();
				return;
			}
			document.ftienda.proceso.value="iniciar";
			document.ftienda.submit();
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
                <h1 class="page-header">Ingresar como cliente</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="active"><strong>Ingreso</strong></li>
                </ol>
            </div>
		</div>
	</div>
    <div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="page-header">Formulario de Ingreso</h2>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<article>
					<form id="ftienda" name="ftienda" method="post" action="">
                    	<p><strong>Acceso restringido solo para clientes registrados</strong></p>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                		        <h4>Ingrese sus credenciales</h4>
		                        <input type="text" name="email" id="email" class="form-control" placeholder="Ingrese Email" />
                                <div class="clearfix" style="height:10px;"></div>
								<input type="password" name="clave" id="clave" class="form-control" placeholder="Ingrese Clave" />
                                <div class="clearfix" style="height:10px;"></div>
                		        <input type="button" name="boton1" value="Ingresar" class="btn btn-primary" onClick="javascript:Validar();" />
                                <div class="clearfix" style="height:10px;"></div>
                                <input type="hidden" name="proceso" id="proceso" />
                                <p>Si aun no eres un cliente haz <a href="registrar.php" class="clicaqui">CLIC AQU&Iacute;</a> y registrare en forma gratuita</p>
							</div>
						</div>
              	  	</form>
				</article>
            </div>
        </div>
		<div class="clearfix" style="height:10px;"></div>
        <hr>
        <?php include("includes/footer.php"); ?>
    </div>
</body>
</html>