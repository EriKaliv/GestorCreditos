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
        <div class="form login_form">
          <section class="login_content">
            <form method="post" action="<?php echo base_url('/usuarios/valida'); ?>">
              <h1 class="text-primary font-weight-bold">Créditos</h1>
              <img class="mb-4" src="<?php echo base_url('public/images/credito.png'); ?>" alt="" width="200" height="150" />
              <h1>Iniciar Sesión</h1>
              <div>
                <input type="text" class="form-control" placeholder="Nombre de Usuario" required="" id="usuario" name="usuario" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Contraseña" required="" id="password" name="password" />
              </div>
              <div class="mb-3">
                <button class="btn btn-primary" type="submit">Ingresar</button>
                <a href="<?php echo base_url('home/signup'); ?>" class="btn btn-primary" style="text-shadow: none; font-size: initial; text-decoration: none;">Registrarse</a>
              </div>

              <?php if(isset($ingresar)){ ?>
              <div class="alert alert-success"><?php echo $ingresar; ?></div>
              <?php }elseif(isset($existe)){ ?>
              <div class="alert alert-danger"><?php echo $existe; ?></div>
              <?php } ?>

              <?php if(isset($validation)){ ?>
              <div class="alert alert-danger"><?php echo $validation->listErrors(); ?></div>
              <?php } ?>

              <?php if(isset($error)){ ?>
              <div class="alert alert-danger">
                <?php echo $error; ?>
              </div>
              <?php } ?>
              
              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </main>
    <!-- /page content -->
  </body>
</html>
