<?php 
$id = $_REQUEST['id'];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Foto</title>
<script src="assets/js/rutinas.js"></script>
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
<link href="assets/css/core.min.css" rel="stylesheet">
<link href="assets/css/app.min.css" rel="stylesheet">
<link href="assets/css/style.min.css" rel="stylesheet">
<link href="assets/css/custom.css" rel="stylesheet">
</head>
<body>
	<div class="card">
        <h4 class="card-title"><strong>Seleccionar Archivo</strong></h4>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data" name="imagenes">
            	<div class="row">
            		<div class="col-lg-12 col-xs-12 form-group">
						<input type="file" name="imagen" maxlength="100">
            			<input type="hidden" name="MAX_FILE_SIZE" value="25000000000">
			            <input type="hidden" name="id" value="<?php echo $id; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                    	<button class="btn btn-primary" type="button" name="boton" onClick="javascript:Validar();">Enviar</button>
                    </div>
               	</div>
            </form>
        </div>
    </div>
</body>
</html>