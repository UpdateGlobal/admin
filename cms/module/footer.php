    <!-- Scripts -->
    <script src="assets/js/core.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <?php
        $consultarMet = 'SELECT * FROM metatags';
        $resultadoMet = mysqli_query($enlaces,$consultarMet) or die('Consulta fallida: ' . mysqli_error($enlaces));
        while($filaMet = mysqli_fetch_array($resultadoMet)){
            $xCodigo    = $filaMet['cod_meta'];
            $xTitulo    = $filaMet['titulo'];
            $xIco       = $filaMet['ico'];
    ?>
    <h4> <?php echo $xTitulo; ?> </h4>
<?php } ?>
