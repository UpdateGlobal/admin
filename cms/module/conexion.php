<?php 
$enlaces = mysqli_connect('localhost', 'root', '') or die('No se pudo conectar: ' . mysqli_error($enlaces));
mysqli_select_db($enlaces,'update_administrador') or die('No se pudo seleccionar la base de datos');

/*$enlaces = mysqli_connect('localhost', 'raul1989_crimdth', ';GKyV4flL%T8') or die('No se pudo conectar: ' . mysqli_error($enlaces));
mysqli_select_db($enlaces,'raul1989_crimson') or die('No se pudo seleccionar la base de datos');*/

?>