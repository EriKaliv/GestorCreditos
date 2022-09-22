<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
              <h2>Editar Entrada de Cajas</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('entradasCaja/actualizar') . '/' . $entrada['idEntradas']; ?>" method="post" autocomplete="off">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                      <label>Fecha</label>
                      <input id="fecha" name="fecha" value="<?php echo $entrada[
                        'fecha'
                      ]; ?>"class="date-picker form-control"  placeholder="dd-mm-yyyy" type="date" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Caja</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="caja">
                        <option disabled selected>Elije una Opción</option>
                      <?php foreach ($cajas as $caja): ?>
                        <option value="<?= $caja['idCaja'] ?>" <?php if ($caja['idCaja'] == $entrada['idCaja']) {echo 'selected';} ?>><?= $caja['nombre'] . ' ' .$caja['tipoCuenta'] . ' ' . $caja['numero'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                    <div class="col-md-4 col-sm-4">
                        <label>Valor</label>
                        <input type="text" class="form-control" id="valor" name="valor" value="<?php echo $entrada['valor']; ?>" autofocus>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-5 col-sm-5">
                    <label>Credito</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="credito">
                        <option disabled selected>Elije una Opción</option>
                      <?php foreach ($creditos as $credito): ?>
                        <option value="<?= $credito['idcreditos'] ?>" <?php if ($credito['idcreditos'] == $entrada['idcreditos']) {echo 'selected';} ?>><?= $credito['nombres'] . ' ' . $credito['apellidos'] . ' ' . 'Crédito N°' . $credito['idcreditos'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-4 col-sm-4">
                      <label>Hacer Anotación</label>
                      <input type="text" class="form-control"  value="<?php echo set_value('repassword'); ?>" autofocus>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <label>Estado</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="estado">
                      <option disabled selected>Seleccione una Opción</option>
                      <option value="Registrado" <?php if ('Registrado' == $entrada['estado']) {echo 'selected';} ?>>Registrado</option>
                      <option value="Aprobado" <?php if ('Aprobado' == $entrada['estado']) {echo 'selected';} ?>>Aprobado</option>
                    </select>
                  </div>                         
                </div>
              </div>
                <a href="<?php echo base_url('/entradasCaja'); ?>" class="btn btn-success">Regresar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->