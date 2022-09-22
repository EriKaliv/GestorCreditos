<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Administrar Roles</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="d-flex justify-content-center">
              <a href="<?php echo base_url("/roles/nuevo"); ?>" class="btn btn-primary">Agregar Rol</a>
            </div>
          </div>
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Permisos</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($datos as $dato) { ?>
              <tr>
                <td><?= $dato['idRol']; ?></td>
                <td><?= $dato['nombreRol']; ?></td>
                <td>
                  <a href="<?= base_url('roles/permisos') . '/' . $dato['idRol']; ?>" class="btn btn-primary" data-toggle="modal" data-target="#modalPermisos" onclick="permisosRol(<?= $dato['idRol']; ?>)">
                    <i class="fas fa-user-check"></i>
                  </a>
                </td>
                <!-- Color de los Botones de la Columna Estados -->
                <?php
                  if ($dato['estadoRol'] === 'Activo') {
                    $clase = 'btn btn-success';
                  } else if ($dato['estadoRol'] === 'Inactivo') {
                    $clase = 'btn btn-danger';
                  }
                ?>
                <td>
                  <a href="<?= base_url('roles/editar') . '/' . $dato['idRol']; ?>" class="<?= $clase ?>" style="width: 125px;">
                    <i class="fas fa-pencil-alt mr-2"></i>
                    <?= $dato['estadoRol']; ?>
                  </a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->

<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" id="modalPermisos"></div>
