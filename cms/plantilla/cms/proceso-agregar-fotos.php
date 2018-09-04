<?php
$id = $_POST['id'];

$uploadname 	= $_FILES['imagen'] ['name'];
$uploadtempname	= $_FILES['imagen'] ['tmp_name'];

if($id=='IG'){
	$uploaddir = 'images/galerias/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}
// Imagen subir Fotos
if($id=='FO'){
	$uploaddir = 'images/galerias/fotos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}
// Subir Imagen Video
if($id=='IV'){
	$uploaddir = 'images/videos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Imagen Categoria productos
if($id=='IC'){
	$uploaddir = 'images/productos/categorias/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Imagen sub categoria productos
if($id=='ISC'){
	$uploaddir = 'images/productos/subcategoria/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen productos
if($id=='IP'){
	$uploaddir = 'images/productos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Ficha Técnica
if($id=='FT'){
	$uploaddir = 'archivos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Banner Grande
if($id=='BG'){
	$uploaddir = 'images/productos/bannerg/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Banner Chico
if($id=='BC'){
	$uploaddir = 'images/productos/bannerc/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Galeria de productos
if($id=='IGP'){
	$uploaddir = 'images/productos/galeria/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Facebook Logo
if($id=='LOGO'){
	$uploaddir = 'images/meta/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Facebook imagen 1
if($id=='FIA'){
	$uploaddir = 'images/meta/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Facebook imagen 2
if($id=='FIB'){
	$uploaddir = 'images/meta/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Facebook Icono
if($id=='ICO'){
	$uploaddir = 'images/meta/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen Nosotros
if($id=='NOS'){
	$uploaddir = 'images/nosotros/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen a Carrusel
if($id=='CAR'){
	$uploaddir = 'images/carrusel/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen a Banner
if($id=='BAN'){
	$uploaddir = 'images/banner/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen a Noticias
if($id=='NOT'){
	$uploaddir = 'images/noticias/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Subir Imagen Portafolio
if($id=='IPR'){
	$uploaddir = 'images/portafolio/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Imagen galería portafolio
if($id=='IGPOR'){
	$uploaddir = 'images/portafolio/galeria/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Imagenes galerías
if($id=='GAL'){
	$uploaddir = 'images/galerias/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Imagenes galerías
if($id=='IGGAL'){
	$uploaddir = 'images/galerias/fotos/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;";  
	}
}

// Imagenes servicios
if($id=='SER'){
	$uploaddir = 'images/servicios/'.$uploadname;
	if(move_uploaded_file($uploadtempname, $uploaddir)){
		$mensaje = "El archivo subi&oacute; correctamente";
	}else{
		$mensaje = "El archivo no se subi&oacute;"; 
	}
}

// Imagenes servicios
if($id=='SERGAL'){
	$uploaddir = 'images/servicios/fotos/'.$uploadname;
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
			if(valor=="NOS") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="CAR") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
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
			if(valor=="NOS") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
			}
			if(valor=="CAR") {
				opener.window.fcms.imagen.value = "<?php echo basename($_FILES['imagen']['name']); ?>";
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
		window.close();
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
        </div> <!-- /widget-header -->
        <div class="widget-content">
            <div id="cajafoto">
				<form action="" id="imagenes" class="imagenes" method="post" name="imagenes">
                	<div class="form-int">
                    	<div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    							<label>El archivo se subi&oacute; correctamente</label>
                                <div style="height:10px;"></div>
        						<input name="imagen" type="hidden" value="<?php echo basename($_FILES['imagen']['name']); ?>">
        						<input type="hidden" name="xid" value="<?php echo $id; ?>">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            	<button class="btn btn-red" type="button" name="boton" onClick="javascript:Cerrar();">Cerrar</button>
                           </div>
                       </div>
                   </div>
			    </form>
            </div>
        </div>
	</div>
</body>
</html>