<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Editar Deudor</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('/deudores/actualizar').'/'.$deudor['idDeudor']; ?>" method="post" autocomplete="off">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label class="w-100">Tipo de Identidad</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="idTipoId" style="width: 100%;">
                      <option disabled selected>Seleccione una Opción</option>
                    <?php foreach ($tipoIds as $tipoId) : ?>
                      <option value="<?= $tipoId['idTipoId'] ?>" <?php if($tipoId['idTipoId']==$deudor['idTipoId']){echo 'selected';} ?>><?= $tipoId['tipoId_nombre']?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>No. Documento</label>
                    <input type="text" class="form-control" name="numeroId" value="<?php echo $deudor['numeroId']; ?>" />
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label class="w-100">Rol</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="idRol" style="width: 100%;" disabled>
                      <option disabled selected>Seleccione una Opción</option>
                    <?php foreach($roles as $rol): ?>
                      <option value="<?= $rol['idRol'] ?>" <?php if($rol['idRol'] == $deudor['idRol']){echo 'selected';} ?>><?= $rol['nombreRol'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label>Pais</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" style="width: 100%;" name="pais" id="pais">
                      <option disabled selected>Elije una Opción</option>
                    <?php foreach($paises as $pais): ?>
                      <option value="<?= $pais['idPais'] ?>"<?php if($pais['idPais']==$deudor['idPais']){echo 'selected';} ?>><?= $pais['nombrePais'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Departamento</label>
                    <div id="departamento"></div>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Ciudad</label>
                    <div id="ciudad"></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombres" value="<?= $deudor['nombres'] ?>" />
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" value="<?= $deudor['apellidos'] ?>" />
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="<?= $deudor['email'] ?>" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label>Direccion</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $deudor['direccion'] ?>" />
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>Celular</label>
                    <input type="text" class="form-control" name="numeroCel" value="<?= $deudor['numeroCel'] ?>" />
                  </div>
                </div>
              </div>
              <a href="<?php echo base_url('/deudores'); ?>" class="btn btn-success">Regresar</a>
              <button type="submit" class="btn btn-primary">Guardar</button>
              <?php if(isset($validation)){ ?>
              <div class="alert alert-danger"><?php echo $validation->listErrors(); ?></div>
              <?php } ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->
