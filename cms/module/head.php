    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
        $consultarMet = 'SELECT * FROM metatags';
        $resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
        while($filaMet = mysqli_fetch_array($resultadoMet)){
            $xCodigo    = $filaMet['cod_meta'];
            $xTitulo    = $filaMet['titulo'];
            $xIco       = $filaMet['ico'];
    ?>
    <title>Login | <?php echo $xTitulo; ?></title>
	<!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">
    <!-- Styles -->
    <link href="assets/css/core.min.css" rel="stylesheet">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/style.min.css" rel="stylesheet">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/<?php echo $xIco ?>">
    <link rel="icon" href="assets/img/<?php echo $xIco ?>">
    <?php 
        }
        mysqli_free_result($resultadoMet);
    ?>