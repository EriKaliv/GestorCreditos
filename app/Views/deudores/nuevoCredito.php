<!-- Nuevos Creditos -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Nuevo Crédito</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <input type="hidden" name="idDeudor" id="idDeudor" value="<?php echo $idDeudor['idDeudor']; ?>" />
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
              <div class="col-md-4 col-sm-6 d-flex form-group">
                <div class="input-group-prepend">
                  <label class="input-group-text text-label rounded-0">Tasa de Interés</label>
                </div>
                <input class="form-control w-100" type="number" step="0.01" readonly="readonly" id="tasa" name="tasa" value="33.25"/>
              </div>
              <div class="col-md-4 col-sm-6 d-flex form-group">
                <div class="input-group-prepend">
                  <label class="input-group-text text-label rounded-0">Valor del Crédito</label>
                </div>
                <input class="form-control w-100" id="cupo" name="cupo" />
              </div>
              <div class="col-md-4 col-sm-6 d-flex form-group frecuencia">
                <div class="input-group-prepend">
                  <label class="input-group-text text-label rounded-0 w-100">Frecuencia de Pago</label>
                </div>
                <p class="form-control d-flex align-items-center w-100 text-label mb-0">
                  <small class="d-flex justify-content-around w-100">
                    Mensual:
                    <input type="radio" class="flat" id="mensual" value="M" name="frecuencia"/> Quincenal:
                    <input type="radio" class="flat" id="quincenal" value="Q" name="frecuencia"/>
                  </small>
                </p>
              </div>
              <div class="col-md-6 col-sm-6 d-flex form-group">
                <div class="input-group-prepend">
                  <label class="input-group-text text-label rounded-0">Número de Pagos</label>
                </div>
                <input class="form-control w-100" , id="cuotas" name="cuotas" />
              </div>
              <div class="col-md-6 col-sm-6 d-flex form-group">
                <div class="input-group-prepend">
                  <label class="input-group-text text-label rounded-0">Valor Cuotas</label>
                </div>
                <input class="form-control w-100" readonly="readonly" id="valorCuota" name="valorCuota" />
              </div>
              <div class="col-md-12 d-flex flex-column justify-content-center align-items-center" id="errores"></div>
              <div class="d-flex justify-content-center w-100">
                <a href="<?php echo base_url('/creditos/nuevoCredito') ?>" class="btn btn-secondary fa fa-refresh fa-lg h-auto w-auto mb-0" type="button" style="padding-top: 12px;"></a>
                <button class="btn btn-success" style="margin-bottom: 0;" type="submit" id="calcular">Calcular Crédito</button>
              </div>
              <div class="d-flex justify-content-center w-100 my-3">
                <button class="btn btn-secondary" style="margin-bottom: 0;" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Cerrar</button>
                <button class="btn btn-primary" style="margin-bottom: 0;" type="submit" id="guardarCredito">Solicitar</button>
              </div>
              <div class="col-md-12 d-flex flex-column justify-content-center align-items-center" id="errorSolicitar"></div>
              <div class="clearfix"></div>
              <!-- Detalles del Crédito -->
              <div class="x_title mt-3">
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
                <div class="x_panel fixed_height sm-height">
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
      <!-- /Nuevo Credito  -->
    </div>
  </div>

  <div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Completa tu Información Personal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="my-2">Para poder solicitar un crédito debes completar toda tu Información Personal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a href="<?= base_url("/deudores/registroInfo") ?>"  class="btn btn-primary">Completar Información</a>
      </div>
    </div>
  </div>
</div>
</main>
