<?php include "modulos/conexion.php"; ?>
<?php include "modulos/verificar.php"; ?>
<?php include "modulos/clean.php"; ?>
<?php
$num = ""; 
if (isset($_REQUEST['eliminar'])) {
	$eliminar	= $_POST['eliminar'];
} else {
	$eliminar	= "";
}
if ($eliminar == "true") {
	$sqlEliminar = "SELECT cod_cliente FROM clientes ORDER BY cod_cliente ASC";
	$sqlResultado = mysqli_query($enlaces,$sqlEliminar) or die('Consulta fallida: ' . mysqli_error($enlaces));
	$x = 0;
	while($filaElim = mysqli_fetch_array($sqlResultado)){
		$id_cliente = $filaElim["cod_cliente"];
		if ($_REQUEST["chk" . $id_cliente] == "on") {
			$x++;
			if ($x == 1) {
				$sql = "DELETE FROM clientes WHERE cod_cliente=$id_cliente";
			} else { 
				$sql = $sql . " OR cod_cliente=$id_cliente";
			}
		}
	}
	mysqli_free_result($sqlResultado);
	if ($x > 0) { 
		$rs = mysqli_query($enlaces,$sql) or die('Consulta fallida: ' . mysqli_error($enlaces));
	}
	header ("Location:clientes.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/head.php") ?>
    <style>
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
			td:nth-of-type(1):before { content: "Nº"; }
			td:nth-of-type(2):before { content: "Nombres"; }
			td:nth-of-type(3):before { content: "Email"; }
			td:nth-of-type(4):before { content: "Sexo"; }
			td:nth-of-type(5):before { content: "Estado"; }
			td:nth-of-type(6):before { content: ""; }
			td:nth-of-type(7):before { content: ""; }
			td:nth-of-type(8):before { content: ""; }
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
				alert("Debes de seleccionar un cliente.")
			}
			return
		}
		procedimiento = "document.fcms." + proceso + ".value = true"
		eval(procedimiento)
		document.fcms.submit()
	}
	</script>
    <script src="js/visitante-alert.js"></script>
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
            	<h1 class="page-title">Clientes</h1>
			</div>
			<div class="breadcrumbs">
				<i class="fa fa-users"></i> Clientes
			</div>
			<div class="wrp clearfix">
                <div class="fluid">
					<div class="widget grid12">
						<div class="widget-header">
							<div class="widget-title">
								<i class="fa fa-th"></i> <strong>Lista de Clientes</strong>
							</div>
						</div>
						<div class="widget-content">
	                        	<a class="btn btn-blue" href="<?php if($xVisitante=="No"){ ?>clientes-nuevo.php<?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-plus" aria-hidden="true"></i> A&ntilde;adir Cliente</a>
                            <hr>
							<form name="fcms" method="post" action="">
                                <table class="text-center" width="100%" border="1">
                                	<thead>
                                        <tr>
                                            <th width="5%" scope="col">Nº</th>
                                            <th width="30%" scope="col">Nombres
                                                <input type="hidden" name="proceso">
                                                <input type="hidden" name="eliminar" value="false">
                                            </th>
                                            <th width="20%" scope="col">Email</th>
                                            <th width="20%" scope="col">Sexo</th>
                                            <th width="10%" scope="col">Estado</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col">&nbsp;</th>
                                            <th width="5%" scope="col"><a href="javascript:Procedimiento('eliminar','N');"><img src="images/borrar.png" width="18" height="25" alt="Borrar"></a></th>
                                        </tr>
                                    </thead>
                                    <?php
			                        $consultarClientes = "SELECT * FROM clientes";
			                        $resultadoClientes = mysqli_query($enlaces,$consultarClientes) or die('Consulta fallida: ' . mysqli_error($enlaces));
			                        while($filaCli = mysqli_fetch_array($resultadoClientes)){
			                            $xCodigo		= $filaCli['cod_cliente'];
										$xNombres		= utf8_encode($filaCli['nombres']);
			                            $xEmail			= $filaCli['email'];
			                            $xSexo			= $filaCli['sexo'];
			                            $xEstado		= $filaCli['estado'];
			                            $num++;
				                    ?>
                                    <tr>
                                        <td><?php echo $num; ?></td>
                                        <td><?php echo $xNombres; ?></td>
                                        <td><?php echo $xEmail; ?></td>
                                        <td><?php echo $xSexo; ?></td>
                                        <td><strong>[<?php echo $xEstado; ?>]</strong></td>
                                        <td><a class="boton-eliminar <?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="Si"){ ?>javascript:visitante();<?php }else{ ?>clientes-delete.php?cod_cliente=<?php echo $xCodigo; ?><?php } ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                        <td><a class="boton-editar <?php if($xVisitante=="Si"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="Si"){ ?>javascript:visitante();<?php }else{ ?>clientes-edit.php?cod_cliente=<?php echo $xCodigo; ?><?php } ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
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
                                        mysqli_free_result($resultadoClientes);
                                    ?>
                                </table>
                            </form>
						</div>
                    </div>
				</div>
			</div>
		</div>
		<?php include("includes/footer.php") ?>
	</div>
</body>
</html>