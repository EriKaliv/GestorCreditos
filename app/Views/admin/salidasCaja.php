<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Salidas de Caja</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="d-flex flex-column align-items-center">
              <form action="<?php echo base_url('salidasCaja/buscar') ?>" method="post">
                <section class="d-flex justify-content-between buscar">
                  <a href="<?php echo base_url('salidasCaja') ?>" class="btn btn-secondary fa fa-refresh fa-lg m-0" type="button" style="height: 38px; padding-top: 11px;"></a>
                  <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" name="estado">
                    <option disabled selected>Estado</option>
                    <option value="Registrado ">Registrado</option>
                    <option value="Aprobado ">Aprobado</option>
                  </select>
                  <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" data-style="btn-primary" name="actor">
                    <option disabled selected>Busca un Actor</option>
                  <?php foreach ($empresas as $empresa) : ?>
                    <option value="<?= $empresa['idEmpresa'] ?>"><?= $empresa['nombre'] ?></option>
                  <?php endforeach; ?>
                  </select>
                  <button type="submit" class="btn btn-primary form-control w-auto mr-0">Buscar</button>
                </section>
              </form>
              <section class="d-flex my-2">
                <a href="<?php echo base_url('salidasCaja/nuevaSalida') ?>" class="btn btn-primary">Nueva Salida</a>
              </section>
            </section>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID Salida</th>
                  <th>Tipo de Salida</th>
                  <th>Fecha</th>
                  <th>Actor</th>
                  <th>Valor</th>
                  <th>Estado</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($datos ?: [] as $dato) : ?>
                <tr>
                  <td><?= $dato['idSalidasCaja'] ?></td>
                  <td><?= $dato['nombreSalida'] ?></td>
                  <td><?= $dato['fecha']; ?></td>
                  <td><?= $dato['nombre']; ?></td>
                  <td><?= number_format($dato['valor']); ?></td>
                  <td><?= $dato['estado']; ?></td>
                  <td><a href="<?= base_url('SalidasCaja/editar'). '/' . $dato['idSalidasCaja']; ?>" class="btn btn-primary" style="width:auto" data-toggle="tooltip" data-original-title="Editar"><i class="fas fa-pencil-alt"></i></a><a href="<?= base_url('salidasCaja/eliminar') . '/' . $dato['idSalidasCaja']; ?>" class="btn btn-danger" data-toggle="tooltip" data-original-title="Eliminar"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
              <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- /page content -->
