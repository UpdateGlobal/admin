	<?php
		$consultarMet = 'SELECT * FROM metatags';
		$resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
		while($filaMet = mysqli_fetch_array($resultadoMet)){
			$xCodigo	= $filaMet['cod_meta'];
			$xIco		= $filaMet['ico'];
			$xLogo		= $filaMet['logo'];
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ra&uacute;l Administrador</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="apple-touch-icon" sizes="144x144" href="images/meta/<?php echo $xIco ?>" />
	<link rel="apple-touch-icon" sizes="114x114" href="images/meta/<?php echo $xIco ?>" />
	<link rel="apple-touch-icon" sizes="72x72" href="images/meta/<?php echo $xIco ?>" />
	<link rel="apple-touch-icon" sizes="57x57" href="images/meta/<?php echo $xIco ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="images/meta/<?php echo $xIco ?>" />
	<!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="css/toastr.css">
	<link href="css/style.css" rel="stylesheet" type="text/css" />
    
	<link href="css/estilo.css" rel="stylesheet" type="text/css" />
	<link href="css/table-respo.css" rel="stylesheet" type="text/css" />
	<link href="css/raul-custom.css" rel="stylesheet" type="text/css" />
	<?php 
		}
		mysqli_free_result($resultadoMet);
	?>