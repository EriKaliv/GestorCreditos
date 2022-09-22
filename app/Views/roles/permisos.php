<!-- Modal 
<div class="modal" tabindex="-1" role="dialog" id="modalPermisos">-->
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">
          Administrar Permisos del Rol
          <?php echo $datos['nombreRol']; ?>
        </h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="container" id="container">
        <div class="modal-body" id="modal-body">
          <div class="">
            <?php echo form_open(base_url('/roles/guardarPermisos'), 'id="formPermisos"');?>

            <input type="hidden" name="idRol" id="idRol" value="<?= $idRol ?>" />
            <ul class="to_do">
              <?php if($idRol == '1'): ?>
              <li>
                <p>
                  <input type="checkbox" class="flat" name="permisos[]" id="permisos" value="<?= $permisos[0]['idPermiso'] ?>" <?php if (isset($asignado[$permisos[0]['idPermiso']])) {echo 'checked';} ?>> <?= $permisos[0]['nombrePermiso'] ?>
                </p>
              </li>
              <li>
                <p>
                  <input type="checkbox" class="flat" name="permisos[]" id="permisos" value="<?= $permisos[1]['idPermiso'] ?>" <?php if (isset($asignado[$permisos[1]['idPermiso']])) {echo 'checked';} ?>> <?= $permisos[1]['nombrePermiso'] ?>
                </p>
              </li>
              <li>
                <p>
                  <input type="checkbox" class="flat" name="permisos[]" id="permisos" value="<?= $permisos[2]['idPermiso'] ?>" <?php if (isset($asignado[$permisos[2]['idPermiso']])) {echo 'checked';} ?>> <?= $permisos[2]['nombrePermiso'] ?>
                </p>
              </li>
              <?php endif ?>
              <?php if($idRol >= '2'): ?>
              <li>
                <p>
                  <input type="checkbox" class="flat" name="permisos[]" id="permisos" value="<?= $permisos[3]['idPermiso'] ?>" <?php if (isset($asignado[$permisos[3]['idPermiso']])) {echo 'checked';} ?>> <?= $permisos[3]['nombrePermiso'] ?>
                </p>
              </li>
              <li>
                <p>
                  <input type="checkbox" class="flat" name="permisos[]" id="permisos" value="<?= $permisos[4]['idPermiso'] ?>" <?php if (isset($asignado[$permisos[4]['idPermiso']])) {echo 'checked';} ?>> <?= $permisos[4]['nombrePermiso'] ?>
                </p>
              </li>
              <li>
                <p>
                  <input type="checkbox" class="flat" name="permisos[]" id="permisos" value="<?= $permisos[5]['idPermiso'] ?>" <?php if (isset($asignado[$permisos[5]['idPermiso']])) {echo 'checked';} ?>> <?= $permisos[5]['nombrePermiso'] ?>
                </p>
              </li>
              <li>
                <p>
                  <?php if($idRol == '2'): ?>
                  <input type="checkbox" class="flat" name="permisos[]" id="permisos" disabled="disabled" value="<?= $permisos[6]['idPermiso'] ?>" <?php if (isset($asignado[$permisos[6]['idPermiso']])) {echo 'checked';} ?>> <?= $permisos[6]['nombrePermiso'] ?>
                  <?php elseif($idRol >= '2'): ?>
                  <input type="checkbox" class="flat" name="permisos[]" id="permisos" value="<?= $permisos[6]['idPermiso'] ?>" <?php if (isset($asignado[$permisos[6]['idPermiso']])) {echo 'checked';} ?>> <?= $permisos[6]['nombrePermiso'] ?>
                  <?php endif ?>
                </p>
              </li>
              <?php endif ?>
            </ul>
          </div>
        </div>
        <!--body php-->
      </div>
      <!--container-->
      <div class="modal-footer">
        <?php echo form_button('', 'Cerrar', 'class="btn btn-secondary", data-dismiss="modal"') ?>
        <?php echo form_submit('guardarPermisos', 'Guardar', 'class="btn btn-primary", form="formPermisos", id="guardarPermisos"') ?>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- /Modal -->

<script>
// iCheck
$(document).ready(function () {
  if ($("input.flat")[0]) {
    $(document).ready(function () {
      $("input.flat").iCheck({
        checkboxClass: "icheckbox_flat-green",
        radioClass: "iradio_flat-green",
      });
    });
  }
});
// /iCheck
</script>
