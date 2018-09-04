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
  $sqlEliminar = "SELECT cod_contacto FROM formulario ORDER BY fecha_ingreso";
  $sqlResultado = mysqli_query($enlaces,$sqlEliminar) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $x = 0;
  while($filaElim = mysqli_fetch_array($sqlResultado)){
    $id_contacto = $filaElim["cod_contacto"];
    if ($_REQUEST["chk" . $id_contacto] == "on"){
      $x++;
      if ($x == 1) {
          $sql = "DELETE FROM formulario WHERE cod_contacto=$id_contacto";
        } else {
          $sql = $sql . " OR cod_contacto=$id_contacto";
        }
    }
  }
  mysqli_free_result($sqlResultado);
  if ($x > 0) {
    $rs = mysqli_query($enlaces,$sql);
  }
  header ("Location:mensajes.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("module/head.php"); ?>
    <style>
      @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px){
        td:nth-of-type(1):before { content: "Nombres"; }
        td:nth-of-type(2):before { content: "De:"; }
        td:nth-of-type(3):before { content: "Teléfono"; }
        td:nth-of-type(4):before { content: "Fecha"; }
        td:nth-of-type(5):before { content: ""; }
        td:nth-of-type(6):before { content: ""; }
        td:nth-of-type(7):before { content: ""; }
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
            alert("Debes de seleccionar un mensaje.")
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
    <?php $menu="contacto"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Contacto</strong>
            <small>Listado de mensajes recibidos por el formulario de su empresa</small>
          </h1>
        </div>
        <?php $page="mensajes"; include("module/menu-contacto.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Lista de Mensajes</strong></h4>
              <div class="card-body">
                <form name="fcms" method="post" action="">
                  <table class="table" data-provide="datatables">
                    <thead>
                      <tr>
                        <th width="40%" scope="col">Nombres
                          <input type="hidden" name="proceso">
                          <input type="hidden" name="eliminar" value="false">
                        </th>
                        <th width="20%" scope="col">De:</th>
                        <th width="20%" scope="col">Teléfono</th>
                        <th width="10%" scope="col">Fecha</th>
                        <th width="5%" scope="col">&nbsp;</th>
                        <th width="5%" scope="col"><a href="javascript:Procedimiento('eliminar','N');"><img src="assets/img/borrar.png" width="18" height="25" alt="Borrar"></a></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $consultarContacto = "SELECT * FROM formulario ORDER BY fecha_ingreso";
                        $resultadoContacto = mysqli_query($enlaces,$consultarContacto) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaCon = mysqli_fetch_array($resultadoContacto)){
                          $xCodigo    = $filaCon['cod_contacto'];
                          $xNombres   = $filaCon['nombres'];
                          $xEmail     = $filaCon['email'];
                          $xTelefono  = $filaCon['telefono'];
                          $xFecha     = $filaCon['fecha_ingreso'];
                          $num++;
                      ?>
                      <tr>
                        <td><?php echo $xNombres; ?></td>
                        <td><?php echo $xEmail; ?></td>
                        <td><?php echo $xTelefono; ?></td>
                        <td><?php echo $xFecha; ?></td>
                        <td><a class="boton-editar" href="mensajes-edit.php?cod_contacto=<?php echo $xCodigo; ?>"><i class="fa fa-search" aria-hidden="true"></i></a></td>
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
                        mysqli_free_result($resultadoContacto);
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