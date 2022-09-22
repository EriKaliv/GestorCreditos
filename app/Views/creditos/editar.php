<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Información del Crédito</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <ul class="nav nav-tabs bar_tabs flex-nowrap p-0" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#detalle" role="tab" aria-controls="home" aria-selected="true">Detalle del Crédito</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#historial" role="tab" aria-controls="profile" aria-selected="false">Historial del Crédito</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="detalle" role="tabpanel" aria-labelledby="home-tab">
                <!-- Nuevo Crédito -->
                <form action="<?php echo base_url('/creditos/actualizar'); ?>" class="mt-4" method="post" autocomplete="off">
                  <div class="col-md-6 col-sm-6 d-flex form-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text text-label rounded-0">Crédito Número</label>
                    </div>
                    <input class="form-control w-100" readonly="readonly" id="numeroCredito" name="numeroCredito" value="<?= $credito['idcreditos'] ?>" />
                  </div>
                  <div class="col-md-6 col-sm-6 d-flex form-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text text-label rounded-0">Valor a Proyectar</label>
                    </div>
                    <input class="form-control w-100" readonly="readonly" id="valorProyectar" name="valorProyectar" value="<?= '$ '.number_format($credito['valorProyectar']) ?>" />
                  </div>
                  <div class="col-md-4 col-sm-6 d-flex form-group">
                    <div class="input-group-prepend" style="height: fit-content;">
                      <label class="input-group-text text-label rounded-0">Deudor</label>
                    </div>
                    <input class="form-control w-100" type="text" readonly="readonly" value="<?= $credito['nombres'].' '.$credito['apellidos'] ?>" />
                  </div>
                  <div class="col-md-4 col-sm-6 d-flex form-group">
                    <div class="input-group-prepend" style="height: fit-content;">
                      <label class="input-group-text text-label rounded-0">Tasa de Interés</label>
                    </div>
                    <input class="form-control w-100" type="number" step="0.01" id="tasa" name="tasa" value="<?= $credito['tasa'] ?>" />
                  </div>
                  <div class="col-md-4 col-sm-6 d-flex form-group">
                    <div class="input-group-prepend" style="height: fit-content;">
                      <label class="input-group-text text-label rounded-0">Valor del Crédito</label>
                    </div>
                    <input class="form-control w-100" id="cupo" name="cupo" value="<?= '$ '.number_format($credito['cupo'],0)  ?>" />
                    <div id="cupo"></div>
                  </div>
                  <div class="col-md-4 col-sm-6 d-flex form-group frecuencia">
                    <div class="input-group-prepend">
                      <label class="input-group-text text-label rounded-0 w-100">Frecuencia de Pago</label>
                    </div>
                    <p class="form-control d-flex align-items-center w-100 text-label mb-0">
                      <small class="d-flex justify-content-around w-100">
                        Mensual: <input type="radio" class="flat" name="frecuencia" id="mensual" value="M"<?php if($credito['frecuencia']=='M'){echo 'checked';} ?>/> Quincenal: <input type="radio" class="flat" name="frecuencia" id="quincenal" value="Q"<?php if($credito['frecuencia']=='Q'){echo 'checked';} ?>/>
                      </small>
                    </p>
                  </div>
                  <div class="col-md-4 col-sm-6 d-flex form-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text text-label rounded-0">Número de Pagos</label>
                    </div>
                    <input class="form-control w-100" id="cuotas" name="cuotas" value="<?= $credito['cuotas'] ?>" />
                    <div id="cuotas"></div>
                  </div>
                  <div class="col-md-4 col-sm-6 d-flex form-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text text-label rounded-0">Valor Cuotas</label>
                    </div>
                    <input class="form-control w-100" readonly="readonly" id="valorCuota" name="valorCuota" value="<?= '$ '.number_format($credito['valorCuota'],0) ?>" />
                  </div>
                  <div class="col-md-4 col-sm-6 d-flex form-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text text-label rounded-0">Estado</label>
                    </div>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="estado" id="estado">
                      <option disabled selected>Seleccione una Opción</option>
                      <option value="En Solicitud" <?php if('En Solicitud'==$credito['estadoCredito']){echo 'selected';} ?>>En Solicitud</option>
                      <option value="Desembolsado" <?php if('Desembolsado'==$credito['estadoCredito']){echo 'selected';} ?>>Desembolsado</option>
                      <option value="Rechazado" <?php if('Rechazado'==$credito['estadoCredito']){echo 'selected';} ?>>Rechazado</option>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-6 d-flex form-group" id="banco">
                    <!--Carga de Select con JavaScript-->
                  </div>
                  <div class="col-md-12 col-sm-12 d-flex justify-content-center form-group">
                    <a href="<?php echo base_url('/creditos'); ?>" class="btn btn-success">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </form>
                <!-- /Nuevo Crédito -->
                <div class="clearfix"></div>
                <!-- Detalles del Crédito -->
                <div class="x_title">
                  <h2>Detalles de Costos</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="col-md-4 col-sm-12 detalles">
                  <div class="x_panel tile fixed_height">
                    <div class="x_title">
                      <h2>Cobros Unicos</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row justify-content-md-center">
                        <h4 class="col-md-5 col-sm-5">Transferencia</h4>
                        <p class="col-md-5 col-sm-5 mb-0" id="transferencia"><?= '$ '.number_format($credito['transferencia'],0) ?></p>
                      </div>
                      <div class="row justify-content-md-center">
                        <h4 class="col-md-5 col-sm-5">IVA Transferencia</h4>
                        <p class="col-md-5 col-sm-5 mb-0" id="ivaTransf"><?= '$ '.number_format($credito['ivaTransferencia'],0) ?></p>
                      </div>
                      <div class="row justify-content-md-center">
                        <h4 class="col-md-5 col-sm-5">4 x 1.000</h4>
                        <p class="col-md-5 col-sm-5 mb-0" id="cuatroxmil"><?= '$ '.number_format($credito['cuatroxmil'],0) ?></p>
                      </div>
                      <div class="row justify-content-md-center">
                        <h4 class="col-md-5 col-sm-5">Recaudo 1</h4>
                        <p class="col-md-5 col-sm-5 mb-0" id="recaudo1"><?= '$ '.number_format($credito['recaudo1'],0) ?></p>
                      </div>
                      <div class="row justify-content-md-center">
                        <h4 class="col-md-5 col-sm-5">IVA Recaudo 1</h4>
                        <p class="col-md-5 col-sm-5 mb-0" id="ivaRecaudo1"><?= '$ '.number_format($credito['ivaRecaudo1'],0) ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12 detalles">
                  <div class="x_panel tile fixed_height">
                    <div class="x_title">
                      <h2>Cobros por Cuotas</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row justify-content-md-center">
                        <h4 class="col-md-5 col-sm-5">Cobranza</h4>
                        <p class="col-md-5 col-sm-5 mb-0" id="cobranza"><?= '$ '.number_format($credito['cobranza'],0) ?></p>
                      </div>
                      <div class="row justify-content-md-center">
                        <h4 class="col-md-5 col-sm-5">IVA Cobranza</h4>
                        <p class="col-md-5 col-sm-5 mb-0" id="ivaCobranza"><?= '$ '.number_format($credito['ivaCobranza'],0) ?></p>
                      </div>
                      <div class="row justify-content-md-center">
                        <h4 class="col-md-5 col-sm-5">Recaudo 2</h4>
                        <p class="col-md-5 col-sm-5 mb-0" id="recaudo2"><?= '$ '.number_format($credito['recaudo2'],0) ?></p>
                      </div>
                      <div class="row justify-content-md-center">
                        <h4 class="col-md-5 col-sm-5">IVA Recaudo 2</h4>
                        <p class="col-md-5 col-sm-5 mb-0" id="ivaRecaudo2"><?= '$ '.number_format($credito['ivaRecaudo2'],0) ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12 detalles">
                  <div class="x_panel tile fixed_height">
                    <div class="x_title">
                      <h2>Cobros Tiempo</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row justify-content-md-center">
                        <h4 class="col-md-5 col-sm-5">Software AS</h4>
                        <p class="col-md-5 col-sm-5 mb-0" id="software"><?= '$ '.number_format($credito['software'],0) ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Detalles del Crédito -->
              </div>
              <div class="tab-pane fade" id="historial" role="tabpanel" aria-labelledby="profile-tab">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Concepto</th>
                      <th>Valor</th>
                      <th>Iva</th>
                      <th>Saldo Interes</th>
                      <th>Capital</th>
                      <th>Saldo</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php foreach ($historialCredito as $dato) { ?>
                  <tr>
                    <td><?= $dato['fecha']; ?></td>
                    <td><?= $dato['concepto']; ?></td>
                    <td><?= '$ ' . number_format($dato['valor'], 0); ?></td>
                    <td><?= '$ ' . number_format($dato['iva'], 0); ?></td>
                    <td><?= '$ ' . number_format($dato['interes'], 0); ?></td>
                    <td><?= '$ ' . number_format($dato['capital'], 0); ?></td>
                    <td><?= '$ ' . number_format($dato['saldo'], 0); ?></td>
                  </tr>
                <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->
