<?php 
$id = $_REQUEST['id'];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Foto</title>
<script src="js/rutinas.js"></script>
<script>
function Validar() {
	document.imagenes.action = "proceso-agregar-fotos.php"
	if (document.imagenes.imagen.value=="") {
		alert('Ingrese la ruta de la imagen que va a subir')
		document.imagenes.imagen.focus()
		return
	} else {
		actual = document.imagenes.imagen.value;
		total = actual.length;
		tipo = actual.substr(total-3,total)
		if ((tipo !="jpg") && (tipo !="JPG") && (tipo !="pdf") && (tipo !="PDF") && (tipo !="ico") && (tipo !="ICO") && (tipo !="png") && (tipo !="PNG")) {
		alert("Debe de seleccionar Archivo de tipo JPG, PDF, PNG o ICO")
		return
	}

	division = actual.split("\\");
	posicion = division.length - 1;
	Imagen = division[posicion];
	if(Espacio(Imagen)){ 
		alert("El archivo no puede contener espacios en blanco.")
		document.imagenes.imagen.focus();
		return
	}		
	if(Caracteres(Imagen)){ 
		alert("El archivo no puede contener caracteres como: Ñ, ñ,{},[] tildes.")
		document.imagenes.imagen.focus();
		return
	}
		xTotal = Imagen.length;
		xImagen = Imagen.substr(0,xTotal-4)
		if(Puntos(xImagen)){ 
			alert("El archivo no puede contener caracteres como: .")
			document.imagenes.imagen.focus();
			return
		}
	}
	document.imagenes.submit()
}
</script>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="widget grid12" style="margin-top:0px;">
        <div class="widget-header">
            <div class="widget-title">
                <i class="fa fa-th"></i> Seleccionar archivo
            </div>
        </div>
        <div class="widget-content">
            <div id="cajafoto">
                <form action="" method="post" enctype="multipart/form-data" name="imagenes">
                	<div class="form-int">
                    	<div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            	<input type="file" name="imagen" maxlength="100">
            			        <input type="hidden" name="MAX_FILE_SIZE" value="25000000000">
			                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    		</div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            	<button class="btn btn-red" type="button" name="boton" onClick="javascript:Validar();">Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>