<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Nueva Empresa</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form action="<?php echo base_url('Empresas/crear'); ?>" method="post" autocomplete="off">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" />
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label class="w-100">Tipo Documento</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" name="idTipoId" style="width: 100%;">
                        <option disabled selected>Elije una Opción</option>
                      <?php foreach ($tipoId as $id) : ?>
                        <option value="<?= $id['idTipoId'] ?>"><?= $id['tipoId_nombre']?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label>N°. Identificación</label>
                    <input type="text" class="form-control" id="numeroId" name="numeroId" value="<?php echo set_value('repassword'); ?>" autofocus />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-4 col-sm-4">
                    <label>País</label>
                    <select class="js-example-basic-single form-control" tabindex="-1" style="width: 100%;" name="pais" id="pais">
                        <option disabled selected>Elije una Opción</option>
                      <?php foreach($paises as $pais): ?>
                        <option value="<?= $pais['idPais'] ?>"><?= $pais['nombrePais'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-4 col-sm-4">
                    <label>Departamento</label>
                    <div id="departamento">
                      <!--Carga Departamentos con JS dependiendo del Pais-->
                    </div>
                  </div>
                  <div class="col-4 col-sm-4">
                    <label>Ciudad</label>
                    <div id="ciudad">
                      <!--Carga Ciudades con JS Departamentos del Pais-->
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label>Dirección</label>
                    <input type="text" class="form-control" name="direccion" />
                  </div>

                  <div class="col-md-4 col-sm-4">
                    <label>N°. Teléfono</label>
                    <input type="text" class="form-control" name="telefono" />
                  </div>

                  <div class="col-md-4 col-sm-4">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" />
                  </div>
                </div>
              </div>
              <a href="<?php echo base_url('/Empresas'); ?>" class="btn btn-success">Regresar</a>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->
