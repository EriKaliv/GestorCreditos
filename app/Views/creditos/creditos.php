<!-- Nuevos Creditos -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="x_content">
        <div class="collapse shadow" id="collapseExample">
          <div class="col-md-12 col-sm-12 card card-body">
            <div id="formCredito">
              <!-- Nuevo Crédito -->
              <div id="solicitado"></div>
                <div class="col-md-6 col-sm-6 d-flex form-group">
                  <div class="input-group-prepend">
                    <label class="input-group-text text-label rounded-0">Crédito Número</label>
                  </div>
                  <input class="form-control w-100" readonly="readonly" value="<?php echo $numeroCredito; ?>" />
                </div>
                <div class="col-md-6 col-sm-6 d-flex form-group">
                  <div class="input-group-prepend">
                    <label class="input-group-text text-label rounded-0">Valor a Proyectar</label>
                  </div>
                  <input class="form-control w-100" readonly="readonly" id="valorProyectar" name="valorProyectar" />
                </div>
              <div class="col-md-4 col-sm-6 form-group">
                <select class="js-example-basic-single form-control" tabindex="-1" style="width: 100%;" data-style="btn-primary" name="idDeudor" id="idDeudor">
                  <option disabled selected>Selecciona un Deudor</option>
                <?php foreach ($deudores as $deudor) : ?>
                  <option value="<?= $deudor['idDeudor'] ?>"><?= $deudor['nombres'].' '.$deudor['apellidos'] ?></option>
                <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-4 col-sm-6 d-flex form-group">
                <div class="input-group-prepend" style="height: fit-content;">
                  <label class="input-group-text text-label rounded-0">Tasa de Interés</label>
                </div>
                <input class="form-control w-100" type="number" step="0.01" readonly="readonly" id="tasa" name="tasa" value="33.25"/>
              </div>
              <div class="col-md-4 col-sm-6 d-flex form-group">
                <div class="input-group-prepend" style="height: fit-content;">
                  <label class="input-group-text text-label rounded-0">Valor del Crédito</label>
                </div>
                <input class="form-control w-100" id="cupo" name="cupo" />
                <div id="cupo"></div>
              </div>
              <div id="deudor" style="position: relative; left: 10px;"></div>
              <div class="col-md-4 col-sm-6 d-flex form-group frecuencia">
                <div class="input-group-prepend">
                  <label class="input-group-text text-label rounded-0 w-100">Frecuencia de Pago</label>
                </div>
                <p class="form-control d-flex align-items-center w-100 text-label mb-0">
                  <small class="d-flex justify-content-around w-100">
                    Mensual:
                    <input type="radio" class="flat" name="frecuencia" id="mensual" value="M" /> Quincenal:
                    <input type="radio" class="flat" name="frecuencia" id="quincenal" value="Q" />
                  </small>
                </p>
              </div>
              <div class="col-md-4 col-sm-6 d-flex form-group">
                <div class="input-group-prepend">
                  <label class="input-group-text text-label rounded-0">Número de Pagos</label>
                </div>
                <input class="form-control w-100" id="cuotas" name="cuotas" />
                <div id="cuotas"></div>
              </div>
              <div class="col-md-4 col-sm-6 d-flex form-group">
                <div class="input-group-prepend">
                  <label class="input-group-text text-label rounded-0">Valor Cuotas</label>
                </div>
                <input class="form-control w-100" readonly="readonly" id="valorCuota" name="valorCuota" />
              </div>
              <div class="col-md-12 d-flex flex-column justify-content-center align-items-center" id="errores"></div>
              <div class="d-flex justify-content-center w-100">
                <a href="<?php echo base_url('creditos') ?>" class="btn btn-secondary fa fa-refresh fa-lg h-auto w-auto mb-0" type="button" style="padding-top: 12px;"></a>
                <button class="btn btn-success" style="margin-bottom: 0;" type="button" id="calcular">Calcular Crédito</button>
              </div>
              <div class="d-flex justify-content-center w-100 my-2">
                <button class="btn btn-secondary" style="margin-bottom: 0;" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Cerrar</button>
                <button class="btn btn-primary" style="margin-bottom: 0;" type="submit" id="guardarCredito">Solicitar</button>
              </div>
              <div class="col-md-12 d-flex flex-column justify-content-center align-items-center" id="errorSolicitar"></div>
              <div class="clearfix"></div>
              <!-- Detalles del Crédito -->
              <div class="x_title">
                <h2>Detalles de Costos</h2>
                <div class="clearfix"></div>
              </div>
              <div class="col-md-4 col-sm-12 detalles">
                <div class="x_panel fixed_height">
                  <div class="x_title">
                    <h2>Cobros Unicos</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row justify-content-md-center">
                      <h4 class="col-md-5 col-sm-5">Transferencia</h4>
                      <p class="col-md-5 col-sm-5 mb-0" id="transferencia"></p>
                    </div>
                    <div class="row justify-content-md-center">
                      <h4 class="col-md-5 col-sm-5">IVA Transferencia</h4>
                      <p class="col-md-5 col-sm-5 mb-0" id="ivaTransf"></p>
                    </div>
                    <div class="row justify-content-md-center">
                      <h4 class="col-md-5 col-sm-5">4 x 1.000</h4>
                      <p class="col-md-5 col-sm-5 mb-0" id="cuatroxmil"></p>
                    </div>
                    <div class="row justify-content-md-center">
                      <h4 class="col-md-5 col-sm-5">Recaudo 1</h4>
                      <p class="col-md-5 col-sm-5 mb-0" id="recaudo1"></p>
                    </div>
                    <div class="row justify-content-md-center">
                      <h4 class="col-md-5 col-sm-5">IVA Recaudo 1</h4>
                      <p class="col-md-5 col-sm-5 mb-0" id="ivaRecaudo1"></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 detalles">
                <div class="x_panel fixed_height">
                  <div class="x_title">
                    <h2>Cobros por Cuotas</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row justify-content-md-center">
                      <h4 class="col-md-5 col-sm-5">Cobranza</h4>
                      <p class="col-md-5 col-sm-5 mb-0" id="cobranza"></p>
                    </div>
                    <div class="row justify-content-md-center">
                      <h4 class="col-md-5 col-sm-5">IVA Cobranza</h4>
                      <p class="col-md-5 col-sm-5 mb-0" id="ivaCobranza"></p>
                    </div>
                    <div class="row justify-content-md-center">
                      <h4 class="col-md-5 col-sm-5">Recaudo 2</h4>
                      <p class="col-md-5 col-sm-5 mb-0" id="recaudo2"></p>
                    </div>
                    <div class="row justify-content-md-center">
                      <h4 class="col-md-5 col-sm-5">IVA Recaudo 2</h4>
                      <p class="col-md-5 col-sm-5 mb-0" id="ivaRecaudo2"></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 detalles">
                <div class="x_panel fixed_height">
                  <div class="x_title">
                    <h2>Cobros Tiempo</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row justify-content-md-center">
                      <h4 class="col-md-5 col-sm-5">Software AS</h4>
                      <p class="col-md-5 col-sm-5 mb-0" id="software"></p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Detalles del Crédito -->
            </div>
          </div>
        </div>
      </div>
      <!-- /Nuevo Credito  -->
      <!-- Infromacion Creditos -->
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title" style="margin-bottom: 0px; text-align: right;">
            <h2>Iformación Créditos</h2>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              Nuevo Crédito
            </button>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="d-flex flex-column align-items-center mt-2">
              <form action="<?php echo base_url('creditos/buscar') ?>" method="post">
                <section class="d-flex justify-content-between buscar">
                  <a href="<?php echo base_url('creditos') ?>" class="btn btn-secondary fa fa-refresh fa-lg m-0" type="button" style="height: 38px; padding-top: 11px;"></a>
                  <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" name="estado">
                    <option disabled selected>Estado</option>
                    <option value="En Solicitud">En Solicitud</option>
                    <option value="Aprobado ">Aprobado</option>
                    <option value="Desembolsado ">Desembolsado</option>
                  </select>
                  <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" data-style="btn-primary" name="deudor">
                    <option disabled selected>Busca un Deudor</option>
                  <?php foreach ($BuscarDeudores as $BuscarDeudor) : ?>
                    <option value="<?= $BuscarDeudor['idDeudor'] ?>"><?= $BuscarDeudor['nombres'].' '.$BuscarDeudor['apellidos'] ?></option>
                  <?php endforeach; ?>
                  </select>
                  <button type="submit" class="btn btn-primary form-control w-auto mr-0">Buscar</button>
                </section>
              </form>
            </section>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID Crédito</th>
                  <th>Identificación</th>
                  <th>Nombre</th>
                  <th>Deuda</th>
                  <th>Cuota</th>
                  <th>Frec.</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($datos as $dato) { ?>
                <tr>
                    <td><?= $dato['idcreditos']; ?></td>
                    <td><?= $dato['numeroId']; ?></td>
                    <td><?= $dato['nombres']; ?>&nbsp;<?= $dato['apellidos']; ?></td>
                    <td><?= '$ '.number_format($dato['valorProyectar']) ; ?></td>
                    <td><?= '$ '.number_format($dato['valorCuota']); ?></td>
                    <td><?= $dato['frecuencia']; ?></td>
                    <!-- Color de los Botones de la Columna Estados -->
                    <?php
                    if ($dato['estadoCredito'] === 'Desembolsado') {
                        $clase = 'btn btn-primary';
                    } else if ($dato['estadoCredito'] === 'Aprobado') {
                        $clase = 'btn btn-primary';
                    } else if ($dato['estadoCredito'] === 'En Solicitud') {
                        $clase = 'btn btn-warning';
                    } else if ($dato['estadoCredito'] === 'Cancelado') {
                      $clase = 'btn btn-success';
                  }
                    ?>
                    <td><a href="<?= base_url('creditos/editar'). '/' . $dato['idcreditos']; ?>" class="<?= $clase ?>" style="width:154px"><i class="fas fa-pencil-alt mr-2"></i><?= $dato['estadoCredito']; ?></a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /Infromacion Creditos  -->
