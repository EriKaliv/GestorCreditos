<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Desembolsos</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content d-flex justify-content-center">
            <form action="<?php echo base_url('desembolsos/buscar') ?>" method="post">
              <section class="d-flex justify-content-between buscar">
                <a href="<?php echo base_url('desembolsos') ?>" class="btn btn-secondary fa fa-refresh fa-lg m-0" type="button" style="height: 38px; padding-top: 11px;"></a>
                <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" name="estado">
                  <option disabled selected>Estado</option>
                  <option value="Registrado ">Registrado</option>
                  <option value="Aprobado ">Aprobado</option>
                  <option value="Rechazado ">Rechazado</option>
                </select>
                <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" data-style="btn-primary" name="deudor">
                  <option disabled selected>Busca un Deudor</option>
                  <?php foreach ($desembolsos as $desembolso) : ?>
                  <option value="<?= $desembolso['idDeudor'] ?>"><?= $desembolso['nombres'].' '.$desembolso['apellidos'] ?></option>
                  <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary form-control w-auto mr-0">Buscar</button>
              </section>
            </form>
          </div>
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 85px;">ID Desembolso</th>
                <th>ID Crédito</th>
                <th>Fecha</th>
                <th>Deudor</th>
                <th>Identificación</th>
                <th>Valor</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($desembolsos ?: [] as $desembolso) { ?>
              <tr>
                <td><?= $desembolso['idDesembolso'] ?></td>
                <td><?= $desembolso['idCredito'] ?></td>
                <td><?= $desembolso['fecha']; ?></td>
                <td><?= $desembolso['nombres'].' '.$desembolso['apellidos']; ?></td>
                <td><?= $desembolso['numeroId']; ?></td>
                <td><?= '$ '.number_format($desembolso['monto']); ?></td>
                <td><?= $desembolso['estado']; ?></td>
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
