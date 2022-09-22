<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
              <h2>Mis créditos</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID Crédito</th>
                  <th>Identificación</th>
                  <th>Nombre</th>
                  <th>Deuda</th>
                  <th>Cuota</th>
                  <th>Frec.</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($creditos as $credito) { ?>
                <tr>
                  <td><?= $credito['idcreditos']; ?></td>
                  <td><?= $credito['numeroId']; ?></td>
                  <td><?= $credito['nombres']; ?>&nbsp;<?= $credito['apellidos']; ?></td>
                  <td><?= '$ '.number_format($credito['valorProyectar']); ?></td>
                  <td><?= '$ '.number_format($credito['valorCuota']); ?></td>
                  <td><?= $credito['frecuencia']; ?></td>

                  <!-- Color de los Botones de la Columna Estados -->
                  <?php
                    if ($credito['estadoCredito'] === 'Desembolsado') {
                      $clase = 'btn btn-success';
                    } else if ($credito['estadoCredito'] === 'Aprobado') {
                      $clase = 'btn btn-primary';
                    } else if ($credito['estadoCredito'] === 'En Solicitud') {
                      $clase = 'btn btn-warning';
                    }
                  ?>
                  
                  <td><a href="<?= base_url('creditos/verCredito'). '/' . $credito['idcreditos']; ?>" class="<?= $clase ?>" style="width:154px" data-toggle="tooltip" title="ver crédito"><i class="fa fa-eye mr-2"></i><?= $credito['estadoCredito']; ?></a></td>
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
