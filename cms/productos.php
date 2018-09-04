<?php include("module/conexion.php"); ?>
<?php include("module/verificar.php"); ?>
<?php
  if (isset($_REQUEST['eliminar'])) {
    $eliminar = $_POST['eliminar'];
  } else {
    $eliminar = "";
  }
  if ($eliminar == "true") {
    $sqlEliminar = "SELECT cod_producto FROM productos ORDER BY cod_producto";
    $sqlResultado = mysqli_query($enlaces, $sqlEliminar);
    $x = 0;
    while($filaElim = mysqli_fetch_array($sqlResultado)){
      $id_producto = $filaElim["cod_producto"];
      if ($_REQUEST["chk" . $id_producto] == "on") {
        $x++;
        if ($x == 1) {
            $sql = "DELETE FROM productos WHERE cod_producto=$id_producto";
          } else {
            $sql = $sql . " OR cod_producto=$id_producto";
          }
      }
    }
    mysqli_free_result($sqlResultado);
    if ($x > 0) { 
      $rs = mysqli_query($enlaces, $sql);
    }
    header ("Location: productos.php");
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php header ('Content-type: text/html; charset=utf-8'); include("module/head.php"); ?>
    <style>
      @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px)  {
        td:nth-of-type(1):before { content: "Categoria"; }
        td:nth-of-type(2):before { content: "Sub-categoria"; }
        td:nth-of-type(3):before { content: "Producto"; }
        td:nth-of-type(4):before { content: "Imagen"; }
        td:nth-of-type(5):before { content: "Adjuntos"; }
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
            alert("Debes de seleccionar un categoria.")
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
    <?php $menu="productos"; include("module/menu.php"); ?>
    <?php include("module/header.php"); ?>
    <!-- Main container -->
    <main>
      <header class="header bg-ui-general">
        <div class="header-info">
          <h1 class="header-title">
            <strong>Productos</strong>
            <small></small>
          </h1>
        </div>
        <?php $page="productos"; include("module/menu-productos.php"); ?>
      </header><!--/.header -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered">
              <h4 class="card-title"><strong>Lista de Productos</strong></h4>
              <div class="card-body">
                <a class="btn btn-info" href="<?php if($xVisitante=="0"){ ?>productos-nuevo.php<?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-plus"></i> A&ntilde;adir nuevo</a>
                <hr>
                <form name="fcms" method="post" action="">
                  <table class="table">
                    <thead>
                      <tr>
                        <th width="15%" scope="col">Categoria</th>
                        <th width="15%" scope="col">Sub Categoria</th>
                        <th width="20%" scope="col">Producto</th>
                        <th width="20%" scope="col">Imagen
                          <input type="hidden" name="proceso">
                          <input type="hidden" name="eliminar" value="false">
                        </th>
                        <th width="10%" scope="col">Adjuntos</th>
                        <th width="5%" scope="col">Estado</th>
                        <th width="5%" scope="col">&nbsp;</th>
                        <th width="5%" scope="col">&nbsp;</th>
                        <th width="5%" scope="col"><a href="javascript:Procedimiento('eliminar','N');"><img src="assets/img/borrar.png" width="18" height="25" alt="Borrar"></a></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $consultarPro = "SELECT cp.cod_categoria, cp.categoria, scp.cod_sub_categoria, scp.subcategoria, p.* FROM productos_categorias as cp, productos_sub_categorias as scp, productos as p WHERE p.cod_categoria=cp.cod_categoria AND p.cod_sub_categoria=scp.cod_sub_categoria ORDER BY categoria ASC";
                        $resultadoPro = mysqli_query($enlaces, $consultarPro);
                        while($filaPro = mysqli_fetch_array($resultadoPro)){
                          $xCodigo    = $filaPro['cod_producto'];
                          $xCategoria   = utf8_encode($filaPro['categoria']);
                          $xSCategoria  = utf8_encode($filaPro['subcategoria']);
                          $xProducto    = $filaPro['nom_producto'];
                          $xImagen    = $filaPro['imagen'];
                          $xFicha     = $filaPro['ficha_tecnica'];
                          $xVideo     = $filaPro['video'];
                          $xEstado     = $filaPro['estado'];
                      ?>
                      <tr>
                        <td><?php echo $xCategoria; ?></td>
                        <td><?php echo $xSCategoria; ?></td>
                        <td><?php echo $xProducto; ?></td>
                        <td><img class="d-block b-1 border-light hover-shadow-2 p-1 img-admin" src="assets/img/productos/<?php echo $xImagen; ?>" /></td>
                        <td><strong><?php if($xVideo!=""){echo "<i class='fa fa-video-camera'></i> ";} if($xFicha!=""){echo "<i class='fa fa-file-pdf-o'></i> ";} ?></strong></td>
                        <td><strong>
                          <?php if($xEstado=="1"){ echo "[Activo]"; }else{ echo "[Inactivo]"; } ?>
                          </strong></td>
                        <td><a class="boton-eliminar <?php if($xVisitante=="1"){ ?>boton-eliminar-bloqueado<?php } ?>" href="<?php if($xVisitante=="0"){ ?>productos-delete.php?cod_producto=<?php echo $xCodigo; ?><?php }else{ ?>javascript:visitante();<?php } ?>"><i class="fa fa-trash"></i></a></td>
                        <td><a class="boton-editar" href="productos-edit.php?cod_producto=<?php echo $xCodigo; ?>"><i class="fa fa-pencil-square"></i></a></td>
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
                        mysqli_free_result($resultadoPro);
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