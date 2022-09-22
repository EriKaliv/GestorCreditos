<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Deudores</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="d-flex flex-column align-items-center">
              <form action="<?php echo base_url('deudores/buscar') ?>" method="post">
                <section class="d-flex justify-content-between buscar">
                  <a href="<?php echo base_url('deudores') ?>" class="btn btn-secondary fa fa-refresh fa-lg m-0" type="button" style="height: 38px; padding-top: 11px;"></a>
                  <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" name="estado">
                    <option disabled selected>Estado</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                  </select>
                  <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" data-style="btn-primary" name="deudor">
                    <option disabled selected>Busca un Nombre</option>
                  <?php foreach ($buscarDeudores as $buscarDeudor) : ?>
                    <option value="<?= $buscarDeudor['idDeudor'] ?>"><?= $buscarDeudor['nombres'] ?></option>
                  <?php endforeach; ?>
                  </select>
                  <button type="submit" class="btn btn-primary form-control w-auto mr-0">Buscar</button>
                </section>
              </form>
              <section class="d-flex align-items-center my-2 agregar-deudor">
                <form action="<?php echo base_url('deudores/crear') ?>" method="post">
                  <select class="js-example-basic-single form-control" tabindex="-1" name="idUsuario" id="idUsuario">
                    <option disabled selected>Busca un Usuario Registrado</option>
                  <?php foreach ($usuarios as $usuario) : ?>
                    <option value="<?= $usuario['idUsuario'] ?>"><?= $usuario['nombreUsuario'] ?></option>
                  <?php endforeach; ?>
                  </select>
                  <button type="submit" class="btn btn-primary ml-1 mb-0">Agregar Deudor</button>
                  <?php if(isset($mensaje)): ?>
                    <p class="text-danger ml-2"><?=$mensaje?></p>
                  <?php endif; ?>
                  <?php if(isset($validation['idUsuario'])): ?>
                    <p class="text-danger ml-2"><?=$validation['idUsuario']?></p>
                  <?php endif; ?>
                  
                </form>
              </section>
            </section>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Identificación</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($deudores as $deudor) { ?>
                <tr>
                  <td><?= $deudor['idDeudor']; ?></td>
                  <td><?= $deudor['nombres']; ?></td>
                  <td><?= $deudor['apellidos']; ?></td>
                  <td><?= $deudor['numeroId']; ?></td>

                  <!-- Color de los Botones de la Columna Estados -->
                  <?php
                    if ($deudor['estadoUsuario'] === 'Activo') {
                      $clase = 'btn btn-success';
                    } else if ($deudor['estadoUsuario'] === 'Inactivo' || $deudor['estadoUsuario'] === 'Eliminado') {
                      $clase = 'btn btn-danger';
                    }
                  ?>
                  <td><a href="<?= base_url('deudores/editar'). '/' . $deudor['idDeudor']; ?>" class="<?= $clase ?>" style="width:125px" id="idDeudor"><i class="fas fa-pencil-alt mr-2"></i><?= $deudor['estadoUsuario']; ?></a></td>
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
<!-- /page content -->
