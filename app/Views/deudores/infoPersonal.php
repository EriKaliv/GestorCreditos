<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
              <h2>Información Personal</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url('/deudores/actualizar'); ?>" id="formRegistro">
              <!-- Smart Wizard -->
              <div id="wizard_verticl" class="form_wizard wizard_verticle">
                <ul class="list-unstyled wizard_steps">
                  <li>
                    <a href="#step-11">
                      <span class="step_no">1</span>
                    </a>
                  </li>
                  <li>
                    <a href="#step-22">
                      <span class="step_no">2</span>
                    </a>
                  </li>
                </ul>
                        
                <div id="step-11">
                  <span class="section"><span class="fa fa-info mr-2"></span>Información Personal</span>
                    <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">Nombres</label>
                      <div class="col-md-6 col-sm-6">
                        <input type="text" id="nombres" name="nombres" required="required" class="form-control" value="<?php if(!isset($deudor['nombres'])){echo set_value('nombres');}else{echo $deudor['nombres'];} ?>">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      <?php if(isset($validation) && isset($validation->getErrors()['nombres'])): ?>
                        <div class="alert alert-danger mb-0 p-2">
                          <?= $validation->getErrors()['nombres']; ?>
                        </div>
                      <?php endif ?>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">Apellidos</label>
                      <div class="col-md-6 col-sm-6">
                        <input type="text" id="apellidos" name="apellidos" required="required" class="form-control"  value="<?php if(!isset($deudor['apellidos'])){echo set_value('apellidos');}else{echo $deudor['apellidos'];} ?>">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      <?php if(isset($validation) && isset($validation->getErrors()['apellidos'])): ?>
                        <div class="alert alert-danger mb-0 p-2">
                          <?= $validation->getErrors()['apellidos']; ?>
                        </div>
                      <?php endif ?>
                    </div>
                    <div class="form-group row">
                      <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tipo de Identificación</label>
                      <div class="col-md-6 col-sm-6">
                        <select class="js-example-basic-single form-control" tabindex="-1" style="width: 100%" name="idTipoId" id="idTipoId">
                            <option disabled selected>Elije una Opción</option>
                          <?php foreach($tipoId as $id): ?>
                            <option value="<?php echo $id['idTipoId'] ?>" <?php if(isset($deudor['idTipoId']) && $id['idTipoId']==$deudor['idTipoId']){echo 'selected';}else{ echo set_select('idTipoId', $id ['idTipoId'], False); }?>><?= $id['tipoId_nombre'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <?php if(isset($validation) && isset($validation->getErrors()['idTipoId'])): ?>
                        <div class="alert alert-danger mb-0 p-2">
                          <?= $validation->getErrors()['idTipoId']; ?>
                        </div>
                      <?php endif ?>
                    </div>
                    <div class="form-group row">
                      <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Número de Identificación</label>
                      <div class="col-md-6 col-sm-6">
                        <input id="numeroId" class="form-control " type="text" name="numeroId" value="<?php if(!isset($deudor['numeroId'])){echo set_value('numeroId');}else{echo $deudor['numeroId'];} ?>">
                        <span class="fa fa-id-card form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      <?php if(isset($validation) && isset($validation->getErrors()['numeroId'])): ?>
                        <div class="alert alert-danger mb-0 p-2">
                          <?= $validation->getErrors()['numeroId']; ?>
                        </div>
                      <?php endif ?>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3 label-align">Numero de celular</label>
                      <div class="col-md-6 col-sm-6">
                        <input id="numeroCel" name="numeroCel" class="date-picker form-control" required="required" type="text" value="<?php if(!isset($deudor['numeroCel'])){echo set_value('numeroCel');}else{echo $deudor['numeroCel'];} ?>">
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      <?php if(isset($validation) && isset($validation->getErrors()['numeroCel'])): ?>
                        <div class="alert alert-danger mb-0 p-2">
                          <?= $validation->getErrors()['numeroCel']; ?>
                        </div>
                      <?php endif ?>
                    </div>
                    <div class="form-group row mb-4">
                      <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                      <div class="col-md-6 col-sm-6">
                        <input id="email" name="email" class="form-control " type="text" name="middle-name" value="<?php if(!isset($deudor['email'])){echo set_value('email');}else{echo $deudor['email'];} ?>">
                        <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      <?php if(isset($validation) && isset($validation->getErrors()['email'])): ?>
                        <div class="alert alert-danger mb-0 p-2">
                          <?= $validation->getErrors()['email']; ?>
                        </div>
                      <?php endif ?>
                    </div>
                </div>
                <div id="step-22">
                  <span class="section"><span class="fas fa-globe-americas mr-2"></span>Ingrese su Ubicación</span>
                  <div class="form-group row">
                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">País</label>
                    <div class="col-md-6 col-sm-6">
                      <select class="js-example-basic-single form-control" tabindex="-1" style="width: 100%" name="pais" id="pais">
                            <option disabled selected>Elije una Opción</option>
                        <?php foreach($paises as $pais): ?>
                            <option value="<?php echo $pais['idPais'] ?>" <?php if(isset($deudor['idPais']) && $pais['idPais']==$deudor['idPais']){echo 'selected';}else{ echo set_select('pais', $pais ['idPais'], False); }?>><?= $pais['nombrePais'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <?php if(isset($validation) && isset($validation->getErrors()['pais'])): ?>
                      <div class="alert alert-danger mb-0 p-2">
                        <?= $validation->getErrors()['pais']; ?>
                      </div>
                    <?php endif ?>
                  </div>
                  <div class="form-group row">
                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Departamento</label>
                    <div class="col-md-6 col-sm-6" id="departamento">
                        
                      <!--Carga Departamentos con JS dependiendo del Pais-->
                        
                    </div>
                    <?php if(isset($validation) && isset($validation->getErrors()['depa'])): ?>
                      <div class="alert alert-danger mb-0 p-2">
                        <?= $validation->getErrors()['depa']; ?>
                      </div>
                    <?php endif ?>
                  </div>
                  <div class="form-group row">
                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Ciudad o Municipio</label>
                    <div class="col-md-6 col-sm-6" id="ciudad">
                        
                      <!--Carga Ciudades o Municipios con JS dependiendo del Departamento-->
                        
                    </div>
                    <?php if(isset($validation) && isset($validation->getErrors()['ciud'])): ?>
                      <div class="alert alert-danger mb-0 p-2">
                        <?= $validation->getErrors()['ciud']; ?>
                      </div>
                    <?php endif ?>
                  </div>
                  <div class="form-group row mb-4">
                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Dirección</label>
                    <div class="col-md-6 col-sm-6">
                      <input id="direccion" name="direccion" class="form-control " type="text" name="middle-name" value="<?= $deudor['direccion'] ?>">
                      <span class="fas fa-map-marker-alt form-control-feedback right" aria-hidden="true"></span>
                    </div>
                    <?php if(isset($validation) && isset($validation->getErrors()['direccion'])): ?>
                      <div class="alert alert-danger mb-0 p-2">
                        <?= $validation->getErrors()['direccion']; ?>
                      </div>
                    <?php endif ?>
                  </div>
                </div>
              </div>
              <!-- End SmartWizard Content -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->