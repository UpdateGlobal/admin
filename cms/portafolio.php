<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
$num = "";
if (isset($_REQUEST['eliminar'])) {
  $eliminar = $_POST['eliminar'];
} else {
  $eliminar = "";
}
if ($eliminar == "true") {
  $sqlEliminar = "SELECT cod_portafolio FROM portafolio ORDER BY orden";
  $sqlResultado = mysqli_query($enlaces,$sqlEliminar) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $x = 0;
  while($filaElim = mysqli_fetch_array($sqlResultado)){
    $id_portafolio = $filaElim["cod_portafolio"];
    if ($_REQUEST["chk" . $id_portafolio] == "on") {
      $x++;
      if ($x == 1) {
          $sql = "DELETE FROM portafolio WHERE cod_portafolio=$id_portafolio";
        } else { 
          $sql = $sql . " OR cod_portafolio=$id_portafolio";
        }
    }
  }
  mysqli_free_result($sqlResultado);
  if ($x > 0) { 
    $rs = mysqli_query($enlaces,$sql);
  }
  header ("Location:portafolio.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <style>
      @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px){
        td:nth-of-type(1):before { content: "Nombre"; }
        td:nth-of-type(2):before { content: "Categoría"; }
        td:nth-of-type(3):before { content: "Imagen"; }
        td:nth-of-type(4):before { content: "Tipo"; }
        td:nth-of-type(5):before { content: "Orden"; }
        td:nth-of-type(6):before { content: "Estado"; }
        td:nth-of-type(7):before { content: ""; }
        td:nth-of-type(8):before { content: ""; }
        td:nth-of-type(9):before { content: ""; }
      }
    </style>
    <script>
      function Procedimiento(proceso,seccion){
        document.fcms.proceso.value = "";
        estado = 0;
        for (i = 0; i < document.fcms.length; i++)
        if(document.fcms.elements[i].name.substring(0,3) == "chk"){
          if(document.fcms.elements[i].checked == true){
            estado = 1
          }
        }
        if (estado == 0) {
          if (seccion == "N"){
            alert("Debes de seleccionar un portafolio.")
          }
          return
        } 
        procedimiento = "document.fcms." + proceso + ".value = true"
        eval(procedimiento)
        document.fcms.submit()
      }
    </script>
    <script src="assets/js/visitante-alert.js"></script>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Lista de Trabajos</strong></h4>
              <div class="card-body">
                <a class="btn btn-info" href="<?php if($xVisitante=="0"){ ?>portafolio-nuevo.php<?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-plus"></i> A&ntilde;adir nuevo</a>
                <hr>
                <form name="fcms" method="post" action="">
                  <table class="table" data-provide="datatables">
                    <thead>
                      <tr>
                        <th width="20%" scope="col">Nombre
                          <input type="hidden" name="proceso">
                          <input type="hidden" name="eliminar" value="false">
                        </th>
                        <th width="14%" scope="col">Categor&iacute;a</th>
                        <th width="30%" scope="col">Imagen</th>
                        <th width="14%" scope="col">Tipo</th>
                        <th width="10%" scope="col">Orden</th>
                        <th width="12%" scope="col">Estado</th>
                        <th width="5%" scope="col">&nbsp;</th>
                        <th width="5%" scope="col">&nbsp;</th>
                        <th width="5%" scope="col"><a href="javascript:Procedimiento('eliminar','N');"><img src="assets/img/borrar.png" width="18" height="25" alt="Borrar"></a></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $consultarPor = "SELECT cp.cod_categoria, cp.categoria, p.* FROM portafolio_categorias as cp, portafolio as p WHERE p.cod_categoria=cp.cod_categoria ORDER BY orden";
                        $resultadoPor = mysqli_query($enlaces,$consultarPor) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaPor = mysqli_fetch_array($resultadoPor)){
                          $xCodigo    = $filaPor['cod_portafolio'];
                          $xCategoria = $filaPor['categoria'];
                          $xNomPorta  = $filaPor['nom_portafolio'];
                          $xImagen    = $filaPor['imagen'];
                          $xTipo      = $filaPor['type'];
                          $xOrden     = $filaPor['orden'];
                          $xEstado    = $filaPor['estado'];
                          $num++;
                      ?>
                      <tr>
                        <td><?php echo $xNomPorta; ?></td>
                        <td><?php echo $xCategoria; ?></td>
                        <td><img class="d-block b-1 border-light hover-shadow-2 p-1" src="assets/img/portafolio/<?php echo $xImagen; ?>" ></td>
                        <td><?php if($xTipo=="I"){echo "[<i class='fa fa-picture-o'></i> Imagen]";} if($xTipo=="V"){echo "[<i class='fa fa-video-camera'></i> Video]";} ?></td>
                        <td><?php echo $xOrden; ?></td>
                        <td><strong>
                          <?php if($xEstado=="1"){ echo "[Activo]"; }else{ echo "[Inactivo]";} ?>
                          </strong></td>
                        <td><a class="boton-eliminar <?php if($xVisitante=="1"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="0"){ ?>portafolio-delete.php?cod_portafolio=<?php echo $xCodigo; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        <td><a class="boton-editar" href="portafolio-edit.php?cod_portafolio=<?php echo $xCodigo; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                        <td>
                          <?php if($xVisitante=="0"){ ?>
                          <div class="hidden">
                            <label class="custom-control custom-control-lg custom-checkbox" for="chkbx-<?php echo $xCodigo; ?>">
                              <input type="checkbox" class="custom-control-input" id="chkbx-<?php echo $xCodigo; ?>" name="chk<?php echo $xCodigo; ?>" />
                              <span class="custom-control-indicator"></span>
                            </label>
                          </div>
                          <?php } ?>
                        </td>
                      </tr>
                      <?php
                        }
                        mysqli_free_result($resultadoPor);
                      ?>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include("module/footer_int.php"); ?>
    </main>
    <!-- END Main container -->
  </body>
</html>