<?php include("module/conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script>
      function Validar(){
        document.fcms.action = "validar-usuarios.php"
        if(document.fcms.usuario.value == ""){
          alert("Debe ingresar su Usuario")
          document.fcms.usuario.focus()
          return
        }
        if(document.fcms.clave.value == ""){
          alert("Debe ingresar su Clave")
          document.fcms.clave.focus()
          return
        }
        document.fcms.proceso.value = "Iniciar"
        document.fcms.submit()
      }
    </script>
  </head>
  <body class="min-h-fullscreen bg-img center-vh p-20" style="background-image: url(assets/img/bg/2.jpg);" data-overlay="7">

    <div class="card card-round card-shadowed px-50 py-30 w-400px mb-0" style="max-width: 100%">
      <h5 class="text-uppercase">Ingreso al Administrador</h5>
      <br>
      <form class="form-type-material" name="fcms" method="post" action="">
        <div class="form-group">
          <input type="text" name="usuario" class="form-control" id="usuario">
          <label for="username">Usuario</label>
        </div>

        <div class="form-group">
          <input type="password" name="clave" class="form-control" id="password">
          <label for="password">Clave</label>
        </div>

        <!-- <div class="form-group flexbox">
          <a class="text-muted hover-primary fs-13" href="forgot.php">¿Olvidó Password?</a>
        </div> -->

        <div class="form-group">
          <button class="btn btn-bold btn-block btn-primary" type="button" id="button" onClick="javascript:Validar()">Ingresar</button>
        </div>
        <span class="textocentro">
          <input type="hidden" name="proceso" id="proceso" />
        </span>
      </form>
    </div>
    <?php include("module/footer.php") ?>
  </body>
</html>