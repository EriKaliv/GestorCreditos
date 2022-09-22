<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Usuarios Eliminados</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="d-flex flex-column align-items-center">
              <form action="<?php echo base_url('usuarios/buscarEliminados') ?>" method="post">
                <section class="d-flex justify-content-between" style="width: 308px;">
                  <a href="<?php echo base_url('usuarios/eliminados') ?>" class="btn btn-secondary fa fa-refresh fa-lg m-0" type="button" style="height: 38px; padding-top: 11px;"></a>
                  <select class="js-example-basic-single form-control" tabindex="-1" style="width: 170px;" data-style="btn-primary" name="usuarios">
                    <option disabled selected>Selecciona un Nombre</option>
                    <?php foreach ($datos as $dato) : ?>
                    <option value="<?= $dato['idUsuario'] ?>"><?= $dato['nombreUsuario'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <button type="submit" class="btn btn-primary form-control w-auto">Buscar</button>
                </section>
              </form>
              <a href="<?php echo base_url("/usuarios"); ?>" class="btn btn-success mt-2">Regresar a Usuarios</a>
            </section>
          </div>
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Reingresar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($datos as $dato): ?>
              <tr>
                <td><?= $dato['idUsuario']; ?></td>
                <td><?= $dato['nombreUsuario']; ?></td>
                <td>
                  <a href="<?= base_url('usuarios/reingresar') . '/' . $dato['idUsuario']; ?>" style="width: 107px;" class="btn btn-info"><i class="fas fa-arrow-alt-circle-up"></i></a>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->
