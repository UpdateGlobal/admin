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
  $sqlEliminar = "SELECT cod_usuario FROM usuarios ORDER BY cod_usuario ASC";
  $sqlResultado = mysqli_query($enlaces,$sqlEliminar) or die('Consulta fallida: ' . mysqli_error($enlaces));
  $x = 0;
  while($filaElim = mysqli_fetch_array($sqlResultado)){
    $id_usuario = $filaElim["cod_usuario"];
    if ($_REQUEST["chk" . $id_usuario] == "on") {
      $x++;
      if ($x == 1) {
        $sql = "DELETE FROM usuarios WHERE cod_usuario=$id_usuario";
      } else { 
        $sql = $sql . " OR cod_usuario=$id_usuario";
      }
    }
  }
  mysqli_free_result($sqlResultado);
  if ($x > 0) { 
    $rs = mysqli_query($enlaces,$sql) or die('Consulta fallida: ' . mysqli_error($enlaces));
  }
  header ("Location:usuarios.php");
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php  include("module/head.php"); ?>
    <style>
      @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
        td:nth-of-type(1):before { content: "Nº"; }
        td:nth-of-type(2):before { content: "Nombres"; }
        td:nth-of-type(3):before { content: "Email"; }
        td:nth-of-type(4):before { content: "Usuario"; }
        td:nth-of-type(5):before { content: "Estado"; }
        td:nth-of-type(6):before { content: ""; }
        td:nth-of-type(7):before { content: ""; }
        td:nth-of-type(8):before { content: ""; }
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
            alert("Debes de seleccionar un usuario.")
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
    <?php $menu=""; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Usuarios</strong>
            <small></small>
          </h1>
        </div>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Lista de Usuarios</strong></h4>
              <div class="card-body">
                <div class="alert alert-info alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  Usuarios son los administradores o el personal de la empresa que podr&aacute; acceder a la web con un correo y contrase&ntilde;a.
                </div>
                <a class="btn btn-info" href="<?php if($xVisitante=="0"){ ?>usuario-nuevo.php<?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-plus"></i> A&ntilde;adir nuevo</a>
                <hr>
                <form name="fcms" method="post" action="">
                  <table class="table" width="100%">
                    <thead>
                      <tr>
                        <th width="5%" scope="col">N&deg;
                          <input type="hidden" name="proceso">
                          <input type="hidden" name="eliminar" value="false">
                        </th>
                        <th width="25%" scope="col">Nombres</th>
                        <th width="25%" scope="col">Email</th>
                        <th width="20%" scope="col">Usuario</th>
                        <th width="15%" scope="col">Estado</th>
                        <th width="5%" scope="col"></th>
                        <th width="5%" scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $consultarUsuarios = "SELECT * FROM usuarios ORDER BY cod_usuario ASC";
                        $resultadoUsuarios = mysqli_query($enlaces,$consultarUsuarios) or die('Consulta fallida: ' . mysqli_error($enlaces));
                        while($filaUsuarios = mysqli_fetch_array($resultadoUsuarios)){
                          $xCod    = $filaUsuarios['cod_usuario'];
                          $xNombres   = $filaUsuarios['nombres'];
                          $xEmail     = $filaUsuarios['email'];
                          $xUsuario   = $filaUsuarios['usuario'];
                          $xEstado    = $filaUsuarios['estado'];
                          $num++;
                      ?>
                      <tr>
                        <td><?php echo $num; ?></td>
                        <td><?php echo $xNombres; ?></td>
                        <td><?php echo $xEmail; ?></td>
                        <td><?php echo $xUsuario; ?></td>
                        <td><?php if($xCod!=="0"){?><strong><?php if($xEstado=="1"){ echo "[Activo]"; }else{ echo "[Inactivo]";} ?></strong><?php }else{ echo "<strong>[<i class='fa fa-star'></i> Webmaster]</strong>"; }?></td>
                        <td><?php 
                        if($xCod!=="0"){ ?>
                          <a class="boton-eliminar <?php if($xVisitante=="1"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="0"){ ?>usuario-delete.php?cod_usuario=<?php echo $xCod; ?><?php }else{ ?>javascript:visitante();<?php } ?>">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                          </a><?php } ?>
                        </td>
                        <td><?php if($xCod!="0"){?><a class="boton-editar" href="usuario-edit.php?cod_usuario=<?php echo $xCod; ?>"><i class="fa fa-pencil-square"></i></a><?php }?></td>
                      </tr>
                      <?php
                        }
                        mysqli_free_result($resultadoUsuarios);
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