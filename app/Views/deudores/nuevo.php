<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Agregar Prestatario</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('/usuarios/insertar'); ?>" method="post" autocomplete="off">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <label>Nombre de Usuario</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value('nombreUsuario') ?>" autofocus />
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <label>Rol</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="idRol">
                      <option disabled selected>Elije una Opción</option>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <label>Estado</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="estado">
                      <option disabled selected>Elije una Opción</option>
                      <option value="Activo">Activo</option>
                      <option value="Inactivo">Inactivo</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <label>Contraseña</label>
                    <input type="text" class="form-control" id="password" name="password" value="<?php echo set_value('password') ?>" />
                  </div>
                  <div class="col-12 col-sm-6">
                    <label>Repite Contraseña</label>
                    <input type="text" class="form-control" id="repassword" name="repassword" value="<?php echo set_value('repassword') ?>" autofocus />
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
