	<?php
		$num = "";
		$numO = "";
		$consultarMet = 'SELECT * FROM metatags';
		$resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
		while($filaMet = mysqli_fetch_array($resultadoMet)){
			$xCodigo	= $filaMet['cod_meta'];
			$xTitulo	= $filaMet['title'];
			$xDes		= $filaMet['description'];
			$xKey		= $filaMet['keywords'];
			$xUrl		= $filaMet['url'];
			$xFace1		= $filaMet['face1'];
			$xFace2		= $filaMet['face2'];
			$xIco		= $filaMet['ico'];
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1;" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo $xTitulo; ?></title>
	<meta name="description" content="<?php echo $xDes; ?>" />
	<meta name="keywords" content="<?php echo $xKey; ?>" />
	<meta name="DC.title" content="<?php echo $xTitulo; ?>" />
	<meta name="DC.description" lang="es" content="<?php echo $xDes; ?>" />
	<meta name="geo.region" content="PE-LIM" />

	<meta property="og:title" content="<?php echo $xTitulo; ?>" />
	<meta property="og:type" content="company" />
	<meta property="og:description" content="<?php echo $xDes; ?>" />
	<meta property="og:url" content="<?php echo $xUrl; ?>" />
	<meta property="og:image" content="<?php echo $xUrl; ?>/cms/images/<?php echo $xFace1; ?>" />
	<meta property="og:image" content="<?php echo $xUrl; ?>/cms/images/<?php echo $xFace2; ?>" />
	<link rel="shortcut icon" href="cms/<?php echo $xIco; ?>" type="image/x-icon" />
	<?php 
		}
		mysqli_free_result($resultadoMet);
	?>
	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet"> 
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="css/estilo.css" rel="stylesheet">
    <script>
		function ValidarBusqueda(){
			document.buscar.action="resultados.php";
			if(document.buscar.buscador.value==""){
				alert("Debes ingresar datos para la búsqueda");
				document.buscar.buscador.focus();
				return;
			}
			document.buscar.submit();
		}
	</script>