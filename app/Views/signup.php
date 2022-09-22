<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Gestor de Créditos</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" />
    <!-- Favicons -->
    <link rel="icon" href="<?php echo base_url('public/images/credito.png'); ?>" type="image/png" />
    <!-- Animate.css -->
    <link href="<?php echo base_url('public/vendors/animate.css/animate.css'); ?>" rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('public/build/css/custom.css'); ?>" rel="stylesheet" />
  </head>

  <body class="login">
    <!-- page content -->
    <main>
      <div class="login_wrapper">
          <section class="login_content">
            <form method="post" action="<?php echo base_url('/usuarios/insertar'); ?>">
              <h1 class="text-primary font-weight-bold">Créditos</h1>
              <img class="mb-4" src="<?php echo base_url('public/images/credito.png'); ?>" alt="" width="200" height="150" />
              <h1>Crea una Cuenta</h1>
              <div>
                <input type="text" class="form-control" placeholder="Nombre de Usuario"  required="" id="nombre" name="nombre" value="<?= set_value('nombre') ?>"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Contraseña"  required="" id="password" name="password" value="<?= set_value('password') ?>"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Repetir Contraseña"  required="" id="repassword" name="repassword" value="<?= set_value('repassword') ?>"/>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary" type="submit">Crear Cuenta</button>
              </div>
              <div class="clearfix"></div>
              <?php if(isset($validation)){ ?>
              <div class="alert alert-danger"><?php echo $validation->listErrors(); ?></div>
              <?php } ?>
              <div class="separator">
                <p class="change_link text-center">
                  <a href="<?php echo base_url(); ?>" class="to_register"> ¿Tienes una Cuenta? Ingresa </a>
                </p>
                <div class="clearfix"></div>
              </div>
            </form>
          </section>
      </div>
    </main>
    <!-- /page content -->
  </body>
</html>
