<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gestor de Créditos</title>

    <!-- Favicons -->
    <link rel="icon" href="<?php echo base_url('public/images/credito.png'); ?>" type="image/png" />
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <!-- bootstrap-daterangepicker -->
    <link rel="stylesheet" href="<?php echo base_url('public/vendors/bootstrap-daterangepicker/daterangepicker.css'); ?>">
    <!-- bootstrap-datetimepicker -->
    <link rel="stylesheet" href="<?php echo base_url('public/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('public/vendors/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/vendors/fontawesome-free-5.15.4-web/css/all.min.css'); ?>">
    <!-- NProgress -->
    <link rel="stylesheet" href="<?php echo base_url('public/vendors/nprogress/nprogress.css'); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('public/vendors/iCheck/skins/flat/green.css'); ?>">
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css'); ?>">
    <!-- Select2 -->
    <link href="<?php echo base_url('public/vendors/select2/dist/css/select2.css'); ?>" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="<?php echo site_url('public/css/estilos.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/build/css/custom.css'); ?>">
</head>

<body class="nav-md" style="background: #016EDA;">
  <div class="container body">
    <div class="main_container">
      <nav class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;" id="nav">
            <a href="<?php echo base_url(); ?>" class="site_title"><img src="<?php echo base_url('public/images/credito.png'); ?>" alt=""><span Style="margin: 5px; font-weight: bold; color: #FFFFFF !important;">Gestor de Créditos</span></a>
          </div>
          <div class="clearfix"></div>
          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?php echo base_url('public/images/user.png'); ?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <h2><?php echo $nombreUsuario ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3><?php echo $nombreRol; ?></h3>
              <ul class="nav side-menu">
                <?php if(isset($permiso['Usuarios'])){ ?>
                  <li><a><i class="fas fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('/usuarios'); ?>">Usuarios Web</a></li>
                      <li><a href="<?php echo base_url("/deudores"); ?>">Deudores</a></li>
                    </ul>
                  </li>
                <?php } ?>
                <?php if(isset($permiso['Contabilidad'])){ ?>
                  <li><a><i class="fas fa-calculator"></i>Contabilidad <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('SalidasCaja'); ?>">Entrada Gastos</a></li>
                      <li><a href="<?php echo base_url('EntradasCaja'); ?>">Entrada Cajas</a></li>
                      <li><a href="<?php echo base_url('Desembolsos'); ?>">Desembolsos</a></li>
                    </ul>
                  </li>
                <?php } ?>
                <?php if(isset($permiso['Créditos'])){ ?>
                  <li><a><i class="fas fa-file-invoice-dollar"></i> Creditos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url("/creditos"); ?>">Info Créditos</a></li>
                    </ul>
                  </li>
                <?php } ?>
                <?php if(isset($permiso['Administración'])){ ?>
                  <li><a><i class="fas fa-tools"></i>Administración <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url("/empresas"); ?>">Proveedores</a></li>
                      <li><a href="<?php echo base_url('/roles'); ?>">Roles</a></li>
                      <li><a href="<?php echo base_url('/creditos/intereses'); ?>">Intereses</a></li>
                    </ul>
                  </li>
                <?php } ?>
                </ul>
            </div>
          </div>
          <!-- /sidebar menu -->
          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true" style="color: #172D44;"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true" style="color: #172D44;"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true" style="color: #172D44;"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="<?php echo base_url('/usuarios/salir'); ?>">
              <span class="glyphicon glyphicon-off" aria-hidden="true" style="color: #172D44;"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </nav>

    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
          <ul class=" navbar-right">
            <li class="nav-item dropdown open" style="padding-left: 15px;">
              <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo base_url('public/images/user.png'); ?>" alt=""><?php echo $nombreUsuario?>
              </a>
              <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="javascript:;"> Profile</a>
                <a class="dropdown-item" href="<?php echo base_url('/usuarios/cambia_password'); ?>"> Cambiar Contraseña</a>
                <a class="dropdown-item" href="javascript:;">Help</a>
                <a class="dropdown-item" href="<?php echo base_url('/usuarios/salir'); ?>"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation -->