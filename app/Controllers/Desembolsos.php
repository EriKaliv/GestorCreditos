<?php

namespace App\Controllers;

use App\Models\DesembolsosModel;
use App\Models\Permisos_RolesModel;

class Desembolsos extends PermisosController
{
  protected $desembolsos, $creditos, $permisosRoles, $session, $tienePermisos;

  public function __construct()
  {
    $this->desembolsos = new DesembolsosModel();
    $this->permisosRoles = new Permisos_RolesModel();

    $this->session = session();
    $this->tienePermisos = ['permiso' => $this->permiso(), 'nombreUsuario' => $this->session->nombreUsuario, 'nombreRol' => $this->session->nombreRol];
  }

  public function index()
  {
    if ($this->session->idRol >= 2) {
      $desembolsos = $this->desembolsos->consultar();
      $data = ['desembolsos' => $desembolsos];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('admin/desembolsos', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function buscar()
  {
    if ($this->session->idRol >= 2) {
      $estado = ['estado' => $this->request->getPost('estado')];
      $deudor = ['idDeudor' => $this->request->getPost('deudor')];

      if (isset($estado['estado'])) {
        $datos = $this->desembolsos->buscar($estado);
      } elseif (isset($deudor['idDeudor'])) {
        $datos = $this->desembolsos->buscar($deudor);
      }

      $data = ['desembolsos' => $datos];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('admin/desembolsos', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }
}
