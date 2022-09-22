<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Editar Salida de Cajas</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('salidasCaja/actualizar'). '/' . $salida['idSalidasCaja']; ?>" method="post" autocomplete="off">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label>Fecha</label>
                    <input
                      id="fecha"
                      name="fecha"
                      value="<?php echo $salida['fecha']; ?>"
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
                        <option value="<?= $caja['idCaja'] ?>" <?php if($caja['idCaja']==$salida['idCaja']){echo 'selected';} ?>><?= $caja['nombre'] .' '. $caja['tipoCuenta'] .' '. $caja['numero'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Valor</label>
                    <input type="number" class="form-control" id="valor" name="valor" value="<?php echo $salida['valor'];?>" autofocus />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label>Descripción</label>
                    <input type="text" class="form-control" id="valor" name="descripcion" value="<?php echo $salida['descripcion'];?>" autofocus />
                  </div>
                  <div class="col-md-2 col-sm-2">
                    <label>Tipo de Salida</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="tipoSalida">
                      <option disabled selected>Seleccione una Opción</option>
                      <?php foreach($tipoSalidas as $tipoSalida): ?>
                        <option value="<?= $tipoSalida['idTipoSalida'] ?>" <?php if($tipoSalida['idTipoSalida']==$salida['idTipoSalida']){echo 'selected';} ?>><?= $tipoSalida['nombreSalida'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="col-md-2 col-sm-2">
                    <label>Estado</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="estado">
                      <option disabled selected>Seleccione una Opción</option>
                      <option value="Registrado" <?php if('Registrado'==$salida['estado']){echo 'selected';} ?>>Registrado</option>
                      <option value="Aprobado" <?php if('Aprobado'==$salida['estado']){echo 'selected';} ?>>Aprobado</option>
                    </select>
                  </div>

                  <div class="col-md-4 col-sm-4">
                    <label>Actor</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="actor" style="width: 390px;">
                      <option disabled selected>Seleccione una Opción</option>
                      <?php foreach($empresas as $empresa): ?>
                        <option value="<?= $empresa['idEmpresa'] ?>" <?php if($empresa['idEmpresa']==$salida['idEmpresa']){echo 'selected';} ?>><?= $empresa['nombre'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>

              <a href="<?php echo base_url('/salidasCaja'); ?>" class="btn btn-success">Regresar</a>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->
