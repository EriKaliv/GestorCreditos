<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
              <h2>Agregar Usuario</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('/usuarios/insertar'); ?>" method="post" autocomplete="off">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value('nombre'); ?>" autofocus>
                    <?php if(isset($validation) && isset($validation->getErrors()['nombre'])): ?>
                      <p class="text-danger mt-0">
                        <?= $validation->getErrors()['nombre']; ?>
                      </p>
                    <?php endif ?>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <label>Rol</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="idRol">
                        <option disabled selected>Elije una Opción</option>
                      <?php foreach ($datos as $dato) : ?>
                        <option value="<?= $dato['idRol'] ?>" <?php echo set_select('idRol', $dato['idRol'], FALSE)?>><?= $dato['nombreRol'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?php if(isset($validation) && isset($validation->getErrors()['idRol'])): ?>
                      <p class="text-danger mt-0">
                        <?= $validation->getErrors()['idRol']; ?>
                      </p>
                    <?php endif ?>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <label>Estado</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="estado">
                      <option disabled selected>Elije una Opción</option>
                      <option value="Activo" <?php echo set_select('estado', 'Activo', FALSE)?>>Activo</option>
                      <option value="Inactivo" <?php echo set_select('estado', 'Inactivo', FALSE)?>>Inactivo</option>
                    </select>
                    <?php if(isset($validation) && isset($validation->getErrors()['estado'])): ?>
                      <p class="text-danger mt-0">
                        <?= $validation->getErrors()['estado']; ?>
                      </p>
                    <?php endif ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <label>Contraseña</label>
                    <input type="text" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>">
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
                    <label>Repite Contraseña</label>
                    <input type="text" class="form-control" id="repassword" name="repassword" value="<?php echo set_value('repassword'); ?>">
                    <?php if(isset($validation) && isset($validation->getErrors()['repassword'])): ?>
                      <p class="text-danger mt-0">
                        <?= $validation->getErrors()['repassword']; ?>
                      </p>
                    <?php endif ?>
                  </div>
                </div>
              </div>
                <a href="<?php echo base_url('/usuarios'); ?>" class="btn btn-success">Regresar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->