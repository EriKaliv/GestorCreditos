<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Administrar Proveedores</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="d-flex flex-column align-items-center">
              <form action="<?php echo base_url('empresas/buscar') ?>" method="post">
                <section class="d-flex justify-content-between buscar">
                  <a href="<?php echo base_url('empresas') ?>" class="btn btn-secondary fa fa-refresh fa-lg m-0" type="button" style="height: 38px; padding-top: 11px;"></a>
                  <select class="js-example-basic-single form-control" style="width: 190px;" data-style="btn-primary" name="empresa">
                      <option disabled selected>Selecciona un Proveedor</option>
                    <?php foreach ($selectEmpresas as $selectEmpresa) : ?>
                      <option value="<?= $selectEmpresa['idEmpresa'] ?>"><?= $selectEmpresa['nombre'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <button type="submit" class="btn btn-primary form-control w-auto">Buscar</button>
                </section>
              </form>
              <section class="d-flex mt-2">
                <a href="<?php echo base_url("empresas/nueva"); ?>" class="btn btn-primary">Nuevo Proveedor</a>
              </section>
            </section>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>N°. Documento</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($empresas as $empresa) { ?>
                <tr>
                  <td><?= $empresa['nombre']; ?></td>
                  <td><?= $empresa['numeroId']; ?></td>
                  <td>
                    <a href="<?= base_url('empresas/editar'). '/' . $empresa['idEmpresa']; ?>" class="btn btn-primary" style="width: auto;"><i class="fas fa-pencil-alt"></i><a href="<?= base_url('empresas/eliminar').'/'.$empresa['idEmpresa'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></a>
                  </td>
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
