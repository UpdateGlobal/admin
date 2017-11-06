<?php
$result = mysqli_query($enlaces,"SELECT logo FROM metatags") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/meta/".$row['logo'];
}

$result = mysqli_query($enlaces,"SELECT face1 FROM metatags") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/meta/".$row['face1'];
}

$result = mysqli_query($enlaces,"SELECT face2 FROM metatags") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/meta/".$row['face2'];
}

$result = mysqli_query($enlaces,"SELECT ico FROM metatags") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/meta/".$row['ico'];
}

$directory = "images/meta/";
$Meta = glob($directory."*.");
foreach($Meta as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM banners") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/banner/".$row['imagen'];
}

$directory = "images/banner/";
$Banners = glob($directory."*.");
foreach($Banners as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM carrusel") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/carrusel/".$row['imagen'];
}

$directory = "images/carrusel/";
$Carrusel = glob($directory."*.");
foreach($Carrusel as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT img_contenido FROM contenidos") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/nosotros/".$row['img_contenido'];
}

$directory = "images/nosotros/";
$Nosotros = glob($directory."*.");
foreach($Nosotros as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM galerias") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/galerias/".$row['imagen'];
}

$directory = "images/galerias/";
$Galerias = glob($directory."*.");
foreach($Galerias as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM galerias_fotos") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/galerias/fotos/".$row['imagen'];
}

$directory = "images/galerias/fotos/";
$GeleriasFotos = glob($directory."*.");
foreach($GeleriasFotos as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM noticias") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/noticias/".$row['imagen'];
}

$directory = "images/noticias/";
$Noticias = glob($directory."*.");
foreach($Noticias as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM portafolio") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/portafolio/".$row['imagen'];
}

$directory = "images/portafolio/";
$Portafolio = glob($directory."*.");
foreach($Portafolio as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM portafolio_galerias") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/portafolio/galeria/".$row['imagen'];
}

$directory = "images/portafolio/galeria/";
$PortafolioGaleria = glob($directory."*.");
foreach($PortafolioGaleria as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM productos") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/productos/".$row['imagen'];
}

$directory = "images/productos/";
$Productos = glob($directory."*.");
foreach($Productos as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT banner_grande FROM productos") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/productos/bannerg/".$row['banner_grande'];
}

$directory = "images/productos/bannerg/";
$BannerG = glob($directory."*.");
foreach($BannerG as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT banner_chico FROM productos") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/productos/bannerc/".$row['banner_chico'];
}

$directory = "images/productos/bannerc/";
$BannerC = glob($directory."*.");
foreach($BannerC as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM productos_categorias") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/productos/categorias/".$row['imagen'];
}

$directory = "images/productos/categorias/";
$ProductosCategorias = glob($directory."*.");
foreach($ProductosCategorias as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM productos_sub_categorias") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/productos/subcategoria/".$row['imagen'];
}

$directory = "images/productos/subcategoria/";
$ProductosSubcategoria = glob($directory."*.");
foreach($ProductosSubcategoria as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT ficha_tecnica FROM productos") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "archivos/".$row['ficha_tecnica'];
}

$directory = "archivos/";
$Archivos = glob($directory."*.");
foreach($Archivos as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM productos_galeria") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/productos/galeria/".$row['imagen'];
}

$directory = "images/productos/galeria/";
$ProductosGaleria = glob($directory."*.");
foreach($ProductosGaleria as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM servicios") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/servicios/".$row['imagen'];
}

$directory = "images/servicios/";
$Servicios = glob($directory."*.");
foreach($Servicios as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM servicios_fotos") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/servicios/fotos/".$row['imagen'];
}

$directory = "images/servicios/fotos/";
$ServiciosFotos = glob($directory."*.");
foreach($ServiciosFotos as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

$result = mysqli_query($enlaces,"SELECT imagen FROM videos") or die('Consulta fallida: ' . mysqli_error($enlaces));
while($row = mysqli_fetch_assoc($result)) {
   $do_not_delete[] = "images/videos/".$row['imagen'];
}

$directory = "images/videos/";
$Videos = glob($directory."*.");
foreach($Videos as $filename) {
    if (!in_array($filename, $do_not_delete)){
		unlink($filename);
	}
}

?>