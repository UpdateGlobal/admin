<?php include("modulos/conexion.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php"); ?>
	<script>
		function Validar(){
			document.fcms.action = "validar-usuarios.php"
			if(document.fcms.usuario.value == ""){
				alert("Debe ingresar su Usuario")
				document.fcms.usuario.focus()
				return
			}
			if(document.fcms.clave.value == ""){
				alert("Debe ingresar su Clave")
				document.fcms.clave.focus()
				return
			}
			document.fcms.proceso.value = "Iniciar"
			document.fcms.submit()
		}
	</script>
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
		<div class="header">
			<a href="index.php"><img src="images/meta/<?php echo $xLogo; ?>"></a>
		</div> <!-- /header -->
		<div class="breadcrumbs">
			<i class="fa fa-key"></i> Login
		</div>	
		<div class="widget-content">
			<form id="fcms-intro" name="fcms" method="post" action="">
                <input name="usuario" id="usuario" type="text" placeholder="Usuario">
                <input name="clave" id="clave" type="password" placeholder="Password">
                <button name="button" type="button" id="button" class="btn btn-blue pull-right" onClick="javascript:Validar()" /><i class="fa fa-key"></i> Iniciar Sesion</button>
                <span class="textocentro">
                    <input type="hidden" name="proceso" id="proceso" />
                </span>
            </form>
		</div>
	</div>
	<?php include("includes/footer.php"); ?>
</body>
</html>