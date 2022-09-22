<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Generar Intereses</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('/creditos/generarInteres'); ?>" method="post" autocomplete="off">
              <div class="form-group">
                <div class="row justify-content-center">
                  <div class="col-md-4 col-sm-6 d-flex form-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text text-label rounded-0">Fecha del Interes</label>
                    </div>
                    <input
                      id="fecha"
                      name="fecha"
                      class="date-picker form-control"
                      style="width: 66%;"
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
                  <div class="col-md-4 col-sm-6 d-flex form-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text text-label rounded-0">Frecuencia</label>
                    </div>
                    <p class="form-control d-flex align-items-center w-100 text-label mb-0">
                      <small class="d-flex justify-content-around w-100">
                        Mensual:<input type="radio" class="flat" name="frecuencia" id="mensual" value="M" /> 
                        Quincenal:<input type="radio" class="flat" name="frecuencia" id="quincenal" value="Q" />
                      </small>
                    </p>
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
