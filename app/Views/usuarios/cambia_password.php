<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
              <h2>Cambiar Contraseña</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('/usuarios/actualiza_password'); ?>" method="post" autocomplete="off">
              <div class="form-group">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <label>Contraseña</label>
                    <input type="text" class="form-control" id="password" name="password" value="<?= set_value('password') ?>" autofocus>
                    <?php if(isset($validation) && isset($validation->getErrors()['password'])){?>
                      <p class="text-danger mt-0">
                        <?= $validation->getErrors()['password']; ?>
                      </p>
                    <?php }else if(isset($validation) && isset($validation->getErrors('matches')['repassword'])){ ?>
                      <p class="text-danger mt-0">
                        <?= $validation->getErrors()['repassword']; ?>
                      </p>
                    <?php } ?>
                  </div>
                  <div class="col-12 col-sm-6">
                    <label>Repetir Contraseña</label>
                    <input type="text" class="form-control" id="repassword" name="repassword" value="<?= set_value('repassword') ?>" autofocus>
                      <?php if(isset($validation) && isset($validation->getErrors()['repassword'])): ?>
                        <p class="text-danger mt-0">
                          <?= $validation->getErrors()['repassword']; ?>
                        </p>
                      <?php endif ?>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Guardar</button>
              <?php if (isset($mensaje)) : ?>
                <div class="alert alert-success text-center">
                  <?= $mensaje; ?>
                </div>
              <?php endif ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->