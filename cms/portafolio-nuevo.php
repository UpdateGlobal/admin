<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$mensaje = "";
$cod_categoria = "";
if (isset($_POST['proceso'])) {
  $proceso  = $_POST['proceso'];
} else {
  $proceso  = "";
}

if($proceso == "Registrar"){
  $cod_categoria   = $_POST['cod_categoria'];
  $nom_portafolio  = mysqli_real_escape_string($enlaces, $_POST['nom_portafolio']);
  $descripcion     = mysqli_real_escape_string($enlaces, $_POST['descripcion']);
  $type            = $_POST['type'];
  $video           = $_POST['video'];
  $imagen          = $_POST['imagen'];
  if(isset($_POST['orden'])){$orden = $_POST['orden'];}else{$orden = 0;}
  if(isset($_POST['estado'])){$estado = $_POST['estado'];}else{$estado = 0;}
  
  $validarPortafolio = "SELECT * FROM portafolio WHERE nom_portafolio='$nom_portafolio'";
  $ejecutarValidar = mysqli_query($enlaces,$validarPortafolio) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $numreg = mysqli_num_rows($ejecutarValidar);
  
  $insertarPortafolio = "INSERT INTO portafolio (cod_categoria, nom_portafolio, descripcion, type, video, imagen, orden, estado) VALUE ('$cod_categoria', '$nom_portafolio', '$descripcion', '$type', '$video', '$imagen', '$orden', '$estado')";
  $resultadoInsertar = mysqli_query($enlaces,$insertarPortafolio) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $mensaje = "<div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Nota:</strong> El trabajo se registr&oacute; con exitosamente. <a href='portafolio.php'>Ir a Portafolio</a>
          </div>";
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <script type="text/javascript" src="assets/js/rutinas.js"></script>
    <script>
      function Validar(){
      if(document.fcms.nom_portafolio.value==""){
        alert("Debe escribir un título");
        document.fcms.nom_portafolio.focus();
        return; 
      }
      if(document.fcms.imagen.value==""){
        alert("Debe subir una imagen");
        document.fcms.imagen.focus();
        return; 
      }
      
      document.fcms.action = "portafolio-nuevo.php";
      document.fcms.proceso.value="Registrar";
      document.fcms.submit();
    }
    
    function Imagen(codigo){
      url = "agregar-foto.php?id=" + codigo;
      AbrirCentro(url,'Agregar', 475, 180, 'no', 'no');
    }
    function soloNumeros(e){ 
      var key = window.Event ? e.which : e.keyCode 
      return ((key >= 48 && key <= 57) || (key==8)) 
    }
    </script>
  </head>
  <body>
    <!-- Preloader -->
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>
    <?php $menu="portafolio"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Portafolio</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="portafolio"; include("module/menu-portafolio.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="card">
          <h4 class="card-title"><strong>Registrar Trabajo</strong></h4>
          <form class="fcms" name="fcms" method="post" action="" data-provide="validation" data-disable="false">
            <div class="card-body">
              <?php if(isset($mensaje)){ echo $mensaje; } else {}; ?>
              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="nom_portafolio">Título:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="nom_portafolio" type="text" id="nom_portafolio" required>
                  <div class="invalid-feedback"></div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="categoria">Categor&iacute;a:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <select class="form-control" id="categoria" name="cod_categoria">
                    <?php 
                      if($cod_categoria == ""){
                        $consultaCat = "SELECT * FROM portafolio_categorias WHERE estado='1'";
                        $resultaCat = mysqli_query($enlaces,$consultaCat) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaCat = mysqli_fetch_array($resultaCat)){
                          $xcodCat = $filaCat['cod_categoria'];
                          $xnomCat = $filaCat['categoria'];
                          echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                        }
                        }else{
                          $consultaCat = "SELECT * FROM portafolio_categorias WHERE cod_categoria='$cod_categoria'";
                          $resultaCat = mysqli_query($enlaces,$consultaCat) or die('Consulta fallida: ' . mysqli_error($enlaces));
                          while($filaCat = mysqli_fetch_array($resultaCat)){
                            $xcodCat = $filaCat['cod_categoria'];
                            $xnomCat = $filaCat['categoria'];
                            echo '<option value='.$xcodCat.' selected="selected">'.$xnomCat.'</option>';
                          }
                          $consultaCat = "SELECT * FROM portafolio_categorias WHERE cod_categoria!='$cod_categoria'";
                          $resultaCat = mysqli_query($enlaces,$consultaCat) or die('Consulta fallida: ' . mysqli_error($enlaces));
                          while($filaCat = mysqli_fetch_array($resultaCat)){
                            $xcodCat = $filaCat['cod_categoria'];
                            $xnomCat = $filaCat['categoria'];
                            echo '<option value='.$xcodCat.'>'.$xnomCat.'</option>';
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="descripcion">Descripci&oacute;n:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <textarea data-provide="summernote" id="descripcion" name="descripcion" data-min-height="150"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="tipo">Tipo:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="type" value="I" checked>
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"> Imagen</span>
                  </label>
                  <label class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" name="type" value="V">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description"> Vídeo</span>
                  </label>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="video">Vídeo:</label><br>
                  <small>(Enlace)</small>
                </div>
                <div class="col-8 col-lg-10">
                  <input class="form-control" name="video" type="text" id="video">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label require" for="imagen">Imagen:</label><br>
                  <small>(-px x -px)</small>
                </div>
                <div class="col-4 col-lg-8">
                  <input class="form-control" id="imagen" name="imagen" type="text" required>
                  <div class="invalid-feedback"></div>
                </div>
                <div class="col-4 col-lg-2">
                  <button class="btn btn-info" type="button" name="boton2" onClick="javascript:Imagen('IPR');" /><i class="fa fa-save"></i> Examinar</button>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="orden">Orden:</label>
                </div>
                <div class="col-2 col-lg-1">
                  <input class="form-control" name="orden" type="text" id="orden" onKeyPress="return soloNumeros(event)" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-4 col-lg-2">
                  <label class="col-form-label" for="estado">Estado:</label>
                </div>
                <div class="col-8 col-lg-10">
                  <input type="checkbox" name="estado" data-size="small" data-provide="switchery" value="1" checked>
                </div>
              </div>

            </div>

            <footer class="card-footer">
              <a href="portafolio.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancelar</a>
              <button class="btn btn-bold btn-primary" type="button" name="boton" onClick="javascript:Validar();" /><i class="fa fa-chevron-circle-right"></i> Registrar Trabajo</button>
              <input type="hidden" name="proceso">
            </footer>

          </form>
        </div>
      </div><!--/.main-content -->
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>