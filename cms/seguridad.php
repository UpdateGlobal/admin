<?php include("module/conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php header ('Content-type: text/html; charset=utf-8'); include("module/head.php"); ?>
    <meta http-equiv="refresh" content="3;URL=index.php">
  </head>

  <body class="min-h-fullscreen bg-img center-vh p-20" style="background-image: url(assets/img/bg/2.jpg);" data-overlay="7">

    <div class="card card-round card-shadowed px-50 py-30 w-400px mb-0" style="max-width: 100%">
      <h5 class="text-uppercase">Sign in</h5>
      <br>
      <p><strong>¡LO SENTIMOS UD. NO ES UN USUARIO AUTORIZADO POR EL SISTEMA!</strong></p>
	  <p>Intentelo de nuevo colocando su email y clave correcto.</p>
    </div>

    <?php include("module/footer.php") ?>

  </body>
</html>