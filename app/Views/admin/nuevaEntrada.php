<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Nueva Entrada de Cajas</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('/entradasCaja/crearEntrada'); ?>" method="post" autocomplete="off">
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
                    <input type="text" class="form-control" id="valor" name="valor" value="<?php echo set_value('repassword'); ?>" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <label>Credito</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="credito">
                        <option disabled selected>Elije una Opción</option>
                      <?php foreach ($creditos as $credito) : ?>
                        <option value="<?= $credito['idcreditos'] ?>"><?= $credito['nombres'] .' '. $credito['apellidos'] .' '.'Crédito N°'. $credito['idcreditos'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-12 col-sm-6">
                    <label>Hacer Anotación</label>
                    <input type="text" class="form-control" id="repassword" name="repassword" value="<?php echo set_value('repassword'); ?>" />
                  </div>
                </div>
              </div>
              <a href="<?php echo base_url('/EntradasCaja'); ?>" class="btn btn-success">Regresar</a>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->
