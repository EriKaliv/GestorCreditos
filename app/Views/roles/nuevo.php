<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Editar Rol</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('/roles/crear')?>" method="post" autocomplete="off">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" autofocus />
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <label class="w-100">Estado</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="estado" style="width: 100%;">
                      <option disabled selected>Seleccione una Opción</option>
                      <option>Activo</option>
                      <option>Inactivo</option>
                    </select>
                  </div>
                </div>
              </div>
              <a href="<?php echo base_url('/roles'); ?>" class="btn btn-success">Regresar</a>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->
