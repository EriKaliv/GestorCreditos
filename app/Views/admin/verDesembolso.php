<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ver Salida de Cajas</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('salidasCaja/actualizar'). '/' . $salida['idSalidas']; ?>" method="post" autocomplete="off">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label>Fecha</label>
                    <input id="fecha" name="fecha" value="<?php echo $salida['fecha']; ?>" class="date-picker form-control" placeholder="dd-mm-yyyy" type="date" disabled />
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Caja</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="caja" disabled>
                      <option disabled selected>Elije una Opción</option>
                    <?php foreach ($cajas as $caja) : ?>
                      <option value="<?= $caja['idCaja'] ?>" <?php if($caja['idCaja']==$salida['idCaja']){echo 'selected';} ?>><?= $caja['nombre'] .' '. $caja['tipoCuenta'] .' '. $caja['numero'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Valor</label>
                    <input type="text" class="form-control" id="valor" name="valor" value="<?php echo $salida['monto'];?>" disabled />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label>Descripción</label>
                    <input type="text" class="form-control" id="valor" name="valor" value="<?php echo $salida['descripcion'];?>" disabled />
                  </div>
                  <div class="col-md-2 col-sm-2">
                    <label>Tipo de Salida</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="estado" disabled>
                      <option disabled selected>Seleccione una Opción</option>
                      <option value="Desembolso" <?php if('Desembolso'==$salida['tipoSalida']){echo 'selected';} ?>>Desembolso</option>
                      <option value="Gasto" <?php if('Gasto'==$salida['tipoSalida']){echo 'selected';} ?>>Gasto</option>
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-2">
                    <label>Estado</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="estado" disabled>
                      <option disabled selected>Seleccione una Opción</option>
                      <option value="Registrado" <?php if('Registrado'==$salida['estado']){echo 'selected';} ?>>Registrado</option>
                      <option value="Aprobado" <?php if('Aprobado'==$salida['estado']){echo 'selected';} ?>>Aprobado</option>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Actor</label>
                    <input type="text" class="form-control" id="valor" name="valor" value="<?php echo $salida['actor'];?>" disabled />
                  </div>
                </div>
              </div>
              <a href="<?php echo base_url('/salidasCaja'); ?>" class="btn btn-success">Regresar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->
