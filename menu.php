<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<?php
include("head.php");
?>

<nav class="navbar navbar-expand-lg navbar-light bg-default ml-auto" style="box-shadow: 0 5px 15px rgb(0 0 0 / 8%); border-top: 4px solid var(--color-verde); background-color: white;">
  <button class="btn btn-default" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" style="margin-right: 15px; "><i class="fa-solid fa-bars"></i></button>
  <div class="navbar-brand" style="line-height: 12px; display: flex; gap: 10px;">
    <div class="logo"> <img src="dist/img/Logo.png" alt="" style="height: 90px;"></div>
    <div class="titulo" style="align-self: center;">
      <p style="font-weight: normal; font-size: 22px; color: #057445;">UNIVERSIDAD AUTÓNOMA DE BAJA CALIFORNIA</p>
      <p style="font-weight: normal; font-size: 18px; color: #3b3b3b;">Sistema de indicadores</p>
    </div>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">

      <?php
      require "database.php";
      $usuariolistqry = "SELECT * FROM usuarios where id_usuario = " . $datosUsuario['id_usuario'] . "";
      $usuariolistres = mysqli_query($con, $usuariolistqry);
      $row = mysqli_fetch_assoc($usuariolistres);
      ?>
      <?php
      if ($row['departamento_usuario'] != 'EG') {
      ?>
        <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Gestion">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="registrar.php">Gestión de Usuarios</a>
            <a class="dropdown-item" href="Permisos.php">Permisos</a>
          </div>
        </li>
      <?php } ?>
      <?php
      if ($row['departamento_usuario'] != '') {
      ?>
        <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ajustes">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php
            if ($row['departamento_usuario'] == 'Admin') {
            ?>
              <a class="dropdown-item" href="Areas.php">Áreas</a>
              <a class="dropdown-item" href="Indicadores.php">Indicadores</a>
              <a class="dropdown-item" href="etiquetas.php">Etiquetas</a>
              <hr class="dropdown-divider">
              <a class="dropdown-item" href="editus.php">Mi cuenta</a>
              <a class="dropdown-item" href=salir.php>Cerrar sesión</a>
            <?php } else if ($row['departamento_usuario'] == 'JA') { ?>
              <a class="dropdown-item" href="Indicadores.php">Indicadores</a>
              <hr class="dropdown-divider">
              <a class="dropdown-item" href="editus.php">Mi cuenta</a>
              <a class="dropdown-item" href=salir.php>Cerrar sesión</a>
            <?php } else if ($row['departamento_usuario'] == 'EG'){ ?>
              <a class="dropdown-item" href="editus.php">Mi cuenta</a>
              <a class="dropdown-item" href=salir.php>Cerrar sesión</a>
          </div>
        <?php } ?>
        </li>
      <?php } ?>
      <?php if ($row['departamento_usuario'] == 'Admin') {
        $qry = "SELECT COUNT(*) AS pendientes FROM indicadores WHERE estado_indicador = 'Pendiente'";
        $res = mysqli_query($con, $qry);
        $row = mysqli_fetch_assoc($res);
      } elseif ($row['departamento_usuario'] == 'JA') {
        $qry = "SELECT COUNT(*) AS pendientes FROM indicadores WHERE estado_indicador = 'Pendiente' AND area_id = '" . $datosUsuario['area_id'] . "'";
        $res = mysqli_query($con, $qry);
        $row = mysqli_fetch_assoc($res);
      }
      ?>
      <a class="btn btn-default position-relative text-secondary" href="Ayuda.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notificaciones">
        <i class="fa-regular fa-circle-question"></i>
      </a>
      <?php
      if ($datosUsuario['departamento_usuario'] == 'Admin') {
      ?>
        <a class="btn btn-default position-relative text-secondary" href="validaciones.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notificaciones">
          <i class="fa-regular fa-bell"></i>
          <?php if (!empty($row['pendientes'])) { ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              <?php echo $row['pendientes']; ?>
            </span>
        <?php }
        } ?>
        </a>

    </ul>
  </div>
</nav>



<div class="offcanvas offcanvas-start container-sm" style="background-color: var(--color-verde); color:white;" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h3 class="offcanvas-title" id="offcanvasScrollingLabel"> Menú </h3>
    <button type="button" class="btn-close btn-close-white text-reset " data-bs-dismiss="offcanvas" aria-label="Close" style="color: white;"></button>
  </div>
  <style>
    .offcanvas-body .accordion-button {
      background: var(--color-verde);
      color: white;
    }

    .offcanvas-body .accordion-button::after {
      filter: brightness(0) invert(100%);
      color: white;
    }

    .offcanvas-body .accordion-button:not(.collapsed) {
      background: var(--color-amarillo);
      color: white;
    }

    .offcanvas-body .accordion-button:not(.collapsed)::after {
      filter: brightness(0) invert(100%);
      color: white;
    }

    .offcanvas-body .accordion-body {
      background-color: var(--color-verde);
      color: white;
    }

    .offcanvas-body .accordion-body a {
      padding-top: 1vh;
      color: white;
      transition: all 0.25s ease-in-out;
    }

    .offcanvas-body .accordion-body a:hover {
      padding-top: 1vh;
      background-color: var(--color-amarillo);
      color: white;
    }
  </style>
  <div class="offcanvas-body">
    <div class="accordion accordion-flush" id="accordionFlushExample">
      <?php
      $url = basename($_SERVER['REQUEST_URI']);

      $indicadorqry = "SELECT indicador_id from indicadores where indicador_url='$url'";
      $indicadorres = mysqli_query($con, $indicadorqry);
      $indicadordata = mysqli_fetch_assoc($indicadorres);
      $indicador_id = $indicadordata['indicador_id'];
      $login_user = $datosUsuario['id_usuario'];

      $accessqry = "SELECT permiso_usuario FROM acceso_areas WHERE indicador_id='$indicador_id' AND id_usuario='$login_user'";
      $accessres = mysqli_query($con, $accessqry);
      $accessdta = mysqli_fetch_assoc($accessres);
      $permiso_usuario = $accessdta['permiso_usuario'];

      if ($datosUsuario['departamento_usuario'] == 'Admin') {
        $arealistqry = "SELECT * FROM areas where estado_area ='Activo'";
        $arealistres = mysqli_query($con, $arealistqry);
      } else {
        $arealistqry = "SELECT * FROM areas where estado_area ='Activo' AND area_id='" . $datosUsuario['area_id'] . "'";
        $arealistres = mysqli_query($con, $arealistqry);
      }
      $cmnc = 0;
      while ($arealistdata = mysqli_fetch_assoc($arealistres)) {
        $area_id = $arealistdata['area_id'];

        $areaaccessqry = "SELECT * from acceso_areas where area_id='$area_id' AND acceso_areas.permiso_usuario='True'";
        $areaaccessres = mysqli_query($con, $areaaccessqry);
        $areaaccessrow = mysqli_num_rows($areaaccessres);
        if ($areaaccessrow > 0); {
      ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="<?php echo $cmnc ?>">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#n<?php echo $cmnc ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                <span><i class="<?php echo $arealistdata['icono_area']; ?>"></i></span> <?php echo $arealistdata['nombre_area']; ?>
              </button>
            </h2>

            <div id="n<?php echo $cmnc ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo $cmnc ?>" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <div class="list-group" style="margin: 0;">
                  <?php
                  $indicadorlistqry = "SELECT * FROM indicadores 
                      inner join acceso_areas on acceso_areas.indicador_id=indicadores.indicador_id
                      where estado_indicador='Activo' AND indicadores.area_id='$area_id' AND indicador_visible='Yes' AND acceso_areas.permiso_usuario='True' AND acceso_areas.id_usuario='" . $datosUsuario['id_usuario'] . "' order by orden_indicador asc";
                  $indicadorlistres = mysqli_query($con, $indicadorlistqry);
                  while ($indicadorlistdata = mysqli_fetch_assoc($indicadorlistres)) { ?>
                    <a href="<?php echo $indicadorlistdata['indicador_url']; ?>" class="list-group-item-action border-bottom"><?php echo $indicadorlistdata['nombre_indicador']; ?></a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
      <?php }
        $cmnc++;
      } ?>
    </div>
  </div>
</div>