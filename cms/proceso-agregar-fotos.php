<?php
$id = $_POST['id'];

$uploadname 	= $_FILES['imagen'] ['name'];
$uploadtempname	= $_FILES['imagen'] ['tmp_name'];

if($id=='IG'){
	$uploaddir = 'assets/img/galerias/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}
// Imagen subir Fotos
if($id=='FO'){
	$uploaddir = 'assets/img/galerias/fotos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";
	}
}
// Subir Imagen Video
if($id=='IV'){
	$uploaddir = 'assets/img/videos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";
	}
}

// Imagen Categoria productos
if($id=='IC'){
	$uploaddir = 'assets/img/productos/categorias/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Imagen sub categoria productos
if($id=='ISC'){
	$uploaddir = 'assets/img/productos/subcategoria/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen productos
if($id=='IP'){
	$uploaddir = 'assets/img/productos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Ficha Técnica
if($id=='FT'){
	$uploaddir = 'assets/archivos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Banner Grande
if($id=='BG'){
	$uploaddir = 'assets/img/productos/bannerg/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Banner Chico
if($id=='BC'){
	$uploaddir = 'assets/img/productos/bannerc/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Galeria de productos
if($id=='IGP'){
	$uploaddir = 'assets/img/productos/galeria/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Facebook Logo
if($id=='LOGO'){
	$uploaddir = 'assets/img/meta/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Facebook imagen 1
if($id=='FIA'){
	$uploaddir = 'assets/img/meta/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Facebook imagen 2
if($id=='FIB'){
	$uploaddir = 'assets/img/meta/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Facebook Icono
if($id=='ICO'){
	$uploaddir = 'assets/img/meta/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Avatar
if($id=='USU'){
	$uploaddir = 'assets/img/avatar/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen Nosotros
if($id=='NOS'){
	$uploaddir = 'assets/img/nosotros/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen a Carrusel
if($id=='CAR'){
	$uploaddir = 'assets/img/carrusel/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen a Banner
if($id=='BAN'){
	$uploaddir = 'assets/img/banner/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen a Noticias
if($id=='NOT'){
	$uploaddir = 'assets/img/noticias/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen Portafolio
if($id=='IPR'){
	$uploaddir = 'assets/img/portafolio/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";
	}
}

// Imagen galería portafolio
if($id=='IGPOR'){
	$uploaddir = 'assets/img/portafolio/fotos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";
	}
}

// Imagenes galerías
if($id=='GAL'){
	$uploaddir = 'assets/img/galerias/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";
	}
}

// Imagenes galerías
if($id=='IGGAL'){
	$uploaddir = 'assets/img/galerias/fotos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";
	}
}

// Imagenes servicios
if($id=='SER'){
	$uploaddir = 'assets/img/servicios/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;"; 
	}
}

// Imagenes servicios
if($id=='SERGAL'){
	$uploaddir = 'assets/img/servicios/fotos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;"; 
	}
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Proceso Agregar Fotos</title>
<script>
	function Cerrar(){
		valor = document.imagenes.xid.value;
		tNavegador = navigator.appName;
		/* --- Validar formulario para internet explorer ---*/
		if(tNavegador=="Microsoft Internet Explorer"){
			if(valor=="IG") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="FO") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IV") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IC") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="ISC") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IP") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="FT") {
				opener.window.fcms.ficha_tecnica.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="BG") {
				opener.window.fcms.banner_grande.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="BC") {
				opener.window.fcms.banner_chico.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IGP") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="LOGO") {
				opener.window.fcms.logo.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="FIA") {
				opener.window.fcms.face1.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="FIB") {
				opener.window.fcms.face2.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="ICO") {
				opener.window.fcms.ico.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="USU") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="NOS") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="CAR") {
				opener.window.fcms.img_contenido.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="BAN") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="NOT") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IPR") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IGPOR") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="GAL") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IGGAL") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="SER") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="SERGAL") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
		}
		/* --- Validar formulario para chrone, firefox, opera, safari ---*/
		if(tNavegador=="Netscape"){
			if(valor=="IG") {
				window.opener.document.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="FO") {
				window.opener.document.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IV") {
				window.opener.document.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IC") {
				window.opener.document.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="ISC") {
				window.opener.document.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IP") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="FT") {
				window.opener.fcms.ficha_tecnica.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="BG") {
				window.opener.fcms.banner_grande.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="BC") {
				window.opener.fcms.banner_chico.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IGP") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="LOGO") {
				window.opener.fcms.logo.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="FIA") {
				window.opener.fcms.face1.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="FIB") {
				window.opener.fcms.face2.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="ICO") {
				window.opener.fcms.ico.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="USU") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="NOS") {
				window.opener.fcms.img_contenido.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="CAR") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="BAN") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="NOT") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IPR") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IGPOR") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="GAL") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="IGGAL") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="SER") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="SERGAL") {
				window.opener.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
		}
		window.close();
	}
</script>
<link href="assets/css/core.min.css" rel="stylesheet">
<link href="assets/css/app.min.css" rel="stylesheet">
<link href="assets/css/style.min.css" rel="stylesheet">
<link href="assets/css/custom.css" rel="stylesheet">
</head>
<body>
	<div class="card" style="margin-bottom:0px;">
        <h4 class="card-title"><strong>Seleccionar Archivo</strong></h4>
        <div class="card-body">
        	<form action="" id="imagenes" class="imagenes" method="post" name="imagenes">
	        	<div class="row">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    				<label>El archivo se subi&oacute; correctamente</label>
	                    <div style="height:10px;"></div>
	        			<input name="imagen" type="hidden" value="<?php echo basename($_FILES['imagen']['name']); ?>">
	        			<input type="hidden" name="xid" value="<?php echo $id; ?>">
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                	<button class="btn btn-red" type="button" name="boton" onClick="javascript:Cerrar();">Cerrar</button>
	                </div>
	            </div>
	        </form>
        </div>
	</div>
</body>
</html>