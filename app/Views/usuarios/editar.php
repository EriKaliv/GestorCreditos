<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Editar Usuario</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('/usuarios/actualizar'); ?>" method="post" autocomplete="off">
              <input type="hidden" name="idUsuario" value="<?php echo $datos['idUsuario']; ?>" />
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos['nombreUsuario']; ?>" autofocus />
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <label>Rol</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="idRol">
                        <option disabled selected>Seleccione una Opción</option>
                      <?php foreach ($roles as $rol) : ?>
                        <option value="<?= $rol['idRol'] ?>" <?php if($rol['idRol']==$datos['idRol']){echo 'selected';} ?>><?= $rol['nombreRol'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <label>Estado</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="estado">
                      <option disabled selected>Seleccione una Opción</option>
                      <option value="Activo" <?php if('Activo'==$datos['estadoUsuario']){echo 'selected';} ?>>Activo</option>
                      <option value="Inactivo" <?php if('Inactivo'==$datos['estadoUsuario']){echo 'selected';} ?>>Inactivo</option>
                    </select>
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
