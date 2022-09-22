<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Nueva Salida de Cajas</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('salidasCaja/crearSalida'); ?>" method="post" autocomplete="off">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label>Fecha</label>
                    <input
                      id="fecha"
                      name="fecha"
                      class="date-picker form-control"
                      placeholder="dd-mm-yyyy"
                      type="date"
                      required="required"
                      onfocus="this.type='date'"
                      onmouseover="this.type='date'"
                      onclick="this.type='date'"
                      onblur="this.type='text'"
                      onmouseout="timeFunctionLong(this)"
                    />
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Caja</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="caja">
                      <option disabled selected>Elije una Opción</option>
                    <?php foreach ($cajas as $caja) : ?>
                      <option value="<?= $caja['idCaja'] ?>"><?= $caja['nombre'] .' '. $caja['tipoCuenta'] .' '. $caja['numero'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Valor</label>
                    <input type="text" class="form-control" id="valor" name="valor" value="<?php echo set_value('repassword'); ?>" autofocus />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <label>Descripción</label>
                    <input type="text" class="form-control" id="valor" name="descripcion" />
                  </div>
                  <div class="col-md-2 col-sm-2">
                    <label>Tipo de Salida</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="tipoSalida">
                      <option disabled selected>Elije una Opción</option>
                    <?php foreach ($tipoSalidas as $tipoSalida) : ?>
                      <option value="<?= $tipoSalida['idTipoSalida'] ?>"><?= $tipoSalida['nombreSalida'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Actor</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="actor" style="width: 390px;">
                      <option disabled selected>Elije una Opción</option>
                    <?php foreach ($empresas as $empresa) : ?>
                      <option value="<?= $empresa['idEmpresa'] ?>"><?= $empresa['nombre'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <a href="<?php echo base_url('/SalidasCaja'); ?>" class="btn btn-success">Regresar</a>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->
