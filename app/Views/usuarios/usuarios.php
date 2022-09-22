<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
              <h2>Administrar Usuarios</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="d-flex flex-column align-items-center">
              <form action="<?php echo base_url('usuarios/buscar') ?>" method="post">
                <section class="d-flex justify-content-between buscar">
                  <a href="<?php echo base_url('usuarios') ?>" class="btn btn-secondary fa fa-refresh fa-lg m-0" type="button" style="height: 38px; padding-top: 11px;"></a>
                  <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" name="estado">
                    <option disabled selected>Estado</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                  </select>
                  <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" name="idUsuario">
                      <option disabled selected>Busca un Nombre</option>
                    <?php foreach ($buscarUsuarios as $buscarUsuario): ?>
                      <option value="<?= $buscarUsuario['idUsuario'] ?>"><?= $buscarUsuario['nombreUsuario'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <button type="submit" class="btn btn-primary form-control w-auto mr-0">Buscar</button>
                </section>
              </form> 
              <section class="d-flex my-2">
                  <a href="<?php echo base_url("/usuarios/nuevo"); ?>" class="btn btn-primary">Agregar Usuario</a>
                  <a href="<?php echo base_url("/usuarios/eliminados"); ?>" class="btn btn-danger">Ver Eliminados</a>
              </section>
            </section>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Rol</th>
                  <th>Estado</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($datos as $dato) { ?>
                    <tr>
                      <td><?= $dato['idUsuario']; ?></td>
                      <td><?= $dato['nombreUsuario']; ?></td>
                      <td><?= $dato['nombreRol']; ?></td>

                      <!-- Color de los Botones de la Columna Estados -->
                      <?php
                      if ($dato['estadoUsuario'] === 'Activo') {
                        $clase = 'btn btn-success';
                      } else if ($dato['estadoUsuario'] === 'Inactivo') {
                        $clase = 'btn btn-danger';
                      }
                      ?>

                      <?php if($dato['idUsuario'] === '1'){ ?>
                        <td><a href="#" data-toggle="tooltip" data-original-title="Este Usuario no puede ser editado" class="btn btn-secondary" style="width:107px"><?= $dato['estadoUsuario']; ?></a></td>
                      <td><a href="#" data-toggle="tooltip" data-original-title="Este Usuario no puede ser eliminado" class="btn btn-secondary"><i class="fas fa-trash-alt"></i></a></td>
                      <?php }else{ ?>
                        <td><a href="<?= base_url('usuarios/editar'). '/' . $dato['idUsuario']; ?>" class="<?= $clase ?>" style="width:107px"><i class="fas fa-pencil-alt mr-2"></i><?= $dato['estadoUsuario']; ?></a></td>
                        <td><a href="<?= base_url('usuarios/eliminar') . '/' . $dato['idUsuario']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                        <?php } ?>
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


