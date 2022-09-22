<?php

namespace App\Controllers;

use App\Models\EntradasCajaModel;
use App\Models\DeudoresModel;
use App\Models\CreditosModel;
use App\Models\Permisos_RolesModel;

class EntradasCaja extends PermisosController
{
  protected $entradasCaja, $deudores, $creditos, $permisosRoles, $session, $tienePermisos;

  public function __construct()
  {
    $this->entradasCaja = new EntradasCajaModel();
    $this->deudores = new DeudoresModel();
    $this->creditos = new CreditosModel();
    $this->permisosRoles = new Permisos_RolesModel();

    $this->session = session();
    $this->tienePermisos = ['permiso' => $this->permiso(), 'nombreUsuario' => $this->session->nombreUsuario, 'nombreRol' => $this->session->nombreRol];
  }

  public function index()
  {
    if ($this->session->idRol >= 2) {
      $entradasCaja = $this->entradasCaja->consultar();
      $deudores = $this->entradasCaja->consultar();
      $data = ['datos' => $entradasCaja, 'deudores' => $deudores];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('admin/entradasCaja', $data) . view('plantillas/footer');

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
        $datos = $this->entradasCaja->buscar($estado);
      } elseif (isset($deudor['idDeudor'])) {
        $datos = $this->entradasCaja->buscar($deudor);
      }

      $deudores = $this->entradasCaja->consultar();
      $data = ['datos' => $datos, 'deudores' => $deudores];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('admin/entradasCaja', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function nuevaEntrada()
  {
    if ($this->session->idRol >= 2) {
      $cajas = $this->creditos->ConsultarCajas();
      $creditos = $this->creditos->consultarDesembolsados();
      $data = ['cajas' => $cajas, 'creditos' => $creditos];
      $vistas = view('plantillas/header', $this->tienePermisos) . View('admin/nuevaEntrada', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function crearEntrada()
  {
    $datos = [
      'idCaja' => $this->request->getPostGet('caja'),
      'idcreditos' => $this->request->getPostGet('credito'),
      'valor' => $this->request->getPostGet('valor'),
      'fecha' => $this->request->getPostGet('fecha'),
      'estado' => 'Registrado',
    ];

    $this->entradasCaja->crear($datos);
    return redirect()->to(base_url('entradasCaja'));
  }

  public function editar($id)
  {
    if ($this->session->idRol >= 2) {
      $entrada = $this->entradasCaja->editar($id);
      $cajas = $this->creditos->ConsultarCajas();
      $creditos = $this->creditos->consultarDesembolsados();
      $data = ['entrada' => $entrada, 'cajas' => $cajas, 'creditos' => $creditos];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('admin/editarEntradaCaja', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function actualizar($idEntrada)
  {
    $actualizar = [
      'idCaja' => $this->request->getPost('caja'),
      'idcreditos' => $this->request->getPost('credito'),
      'valor' => $this->request->getPost('valor'),
      'fecha' => $this->request->getPost('fecha'),
      'estado' => $this->request->getPost('estado'),
    ];

    $this->entradasCaja->actualizar($idEntrada, $actualizar);
    return redirect()->to(base_url('entradasCaja'));
  }
}
