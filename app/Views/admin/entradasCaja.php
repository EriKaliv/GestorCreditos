<!-- page content -->
<main class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Entradas de Caja</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <section class="d-flex flex-column align-items-center">
              <form action="<?php echo base_url('entradasCaja/buscar') ?>" method="post">
                <section class="d-flex justify-content-between buscar">
                  <a href="<?php echo base_url('entradasCaja') ?>" class="btn btn-secondary fa fa-refresh fa-lg m-0" type="button" style="height: 38px; padding-top: 11px;"></a>
                  <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" name="estado">
                    <option disabled selected>Estado</option>
                    <option value="Registrado ">Registrado</option>
                    <option value="Aprobado ">Aprobado</option>
                  </select>
                  <select class="js-example-basic-single form-control" style="width: 150px;" tabindex="-1" data-style="btn-primary" name="deudor">
                      <option disabled selected>Busca un Nombre</option>
                    <?php foreach ($deudores as $deudor) : ?>
                      <option value="<?= $deudor['idDeudor'] ?>"><?= $deudor['nombres'].' '.$deudor['apellidos'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <button type="submit" class="btn btn-primary form-control w-auto mr-0">Buscar</button>
                </section>
              </form>
              <section class="d-flex my-2">
                <a href="<?php echo base_url("/EntradasCaja/nuevaEntrada"); ?>" class="btn btn-primary">Nueva Entrada</a>
              </section>
            </section>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID Crédito</th>
                  <th>Deudor</th>
                  <th>N° Identificación</th>
                  <th>Caja</th>
                  <th>Fecha Entrada</th>
                  <th>Valor Entrada</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($datos ?: [] as $dato) { ?>
                <tr>
                  <td><?= $dato['idcreditos']; ?></td>
                  <td><?= $dato['nombres'] .' '.$dato['apellidos']; ?></td>
                  <td><?= $dato['numeroId'] ; ?></td>
                  <td><?= $dato['nombre'] .' '. $dato['tipoCuenta']; ?></td>
                  <td><?= $dato['fecha']; ?></td>
                  <td><?= '$ '.number_format($dato['valor']); ?></td>

                  <!-- Color de los Botones de la Columna Estados -->
                  <?php
                    if ($dato['estado'] === 'Aprobado') {
                      $clase = 'btn btn-success';
                    } else if ($dato['estado'] === 'Registrado') {
                      $clase = 'btn btn-primary';
                    }
                  ?>

                <?php if($dato['estado']==='Aprobado'){ ?>
                  <td><a href="#" data-toggle="modal" class="<?= $clase ?>" data-target="#exampleModal" style="width:128px"><?= $dato['estado']; ?></a></td>
                <?php }else{ ?>
                  <td><a href="<?= base_url('EntradasCaja/editar'). '/' . $dato['idEntradas']; ?>" class="<?= $clase ?>" style="width:128px"><i class="fas fa-pencil-alt mr-2"></i><?= $dato['estado']; ?></a></td>
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
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Entrada de Caja No Modificable</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          Esta entrada ya ha sido Aprobada y no puede ser modificada.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /Modal -->
</main>
<!-- /page content -->
