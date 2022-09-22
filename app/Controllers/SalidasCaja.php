<?php

namespace App\Controllers;

use App\Models\SalidasCajaModel;
use App\Models\CreditosModel;
use App\Models\Permisos_RolesModel;

class SalidasCaja extends PermisosController
{
  protected $salidasCaja, $creditos, $permisosRoles, $session, $tienePermisos;

  public function __construct()
  {
    $this->salidasCaja = new SalidasCajaModel();
    $this->creditos = new CreditosModel();
    $this->permisosRoles = new Permisos_RolesModel();

    $this->session = session();
    $this->tienePermisos = ['permiso' => $this->permiso(), 'nombreUsuario' => $this->session->nombreUsuario, 'nombreRol' => $this->session->nombreRol];
  }

  public function index()
  {
    if ($this->session->idRol >= 2) {
      $salidasCaja = $this->salidasCaja->consultar();
      $empresas = $this->salidasCaja->empresas();
      $data = ['datos' => $salidasCaja, 'empresas' => $empresas];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('admin/salidasCaja', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function buscar()
  {
    $estado = ['estado' => $this->request->getPost('estado')];
    $actor = ['idEmpresa' => $this->request->getPost('actor')];

    if (isset($estado['estado'])) {
      $datos = $this->salidasCaja->buscar($estado);
    } elseif (isset($actor['idEmpresa'])) {
      $datos = $this->salidasCaja->buscar($actor);
    }
    $empresas = $this->salidasCaja->empresas();
    $data = ['datos' => $datos, 'empresas' => $empresas];

    $vistas = view('plantillas/header', $this->tienePermisos) . View('admin/salidasCaja', $data) . view('plantillas/footer');

    return $vistas;
  }

  public function nuevaSalida()
  {
    if ($this->session->idRol >= 2) {
      $cajas = $this->creditos->ConsultarCajas();
      $tipoSalidas = $this->salidasCaja->tipoSalida();
      $empresas = $this->salidasCaja->empresas();

      $data = ['cajas' => $cajas, 'tipoSalidas' => $tipoSalidas, 'empresas' => $empresas];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('admin/nuevaSalida', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function crearSalida()
  {
    $datos = [
      'idCaja' => $this->request->getPostGet('caja'),
      'idEmpresa' => $this->request->getPostGet('actor'),
      'idTipoSalida' => $this->request->getPostGet('tipoSalida'),
      'fecha' => $this->request->getPostGet('fecha'),
      'descripcion' => $this->request->getPostGet('descripcion'),
      'valor' => $this->request->getPostGet('valor'),
      'estado' => 'Registrado',
    ];

    $this->salidasCaja->crear($datos);
    return redirect()->to(base_url('SalidasCaja'));
  }

  public function editar($id)
  {
    if ($this->session->idRol >= 2) {
      $salida = $this->salidasCaja->editar($id);
      $cajas = $this->creditos->ConsultarCajas();
      $tipoSalidas = $this->salidasCaja->tipoSalidas();
      $empresas = $this->salidasCaja->empresas();
      $data = ['salida' => $salida, 'cajas' => $cajas, 'tipoSalidas' => $tipoSalidas, 'empresas' => $empresas];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('admin/editarSalidaCaja', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function actualizar($idSalida)
  {
    $actualizar = [
      'idCaja' => $this->request->getPost('caja'),
      'idEmpresa' => $this->request->getPostGet('actor'),
      'idTipoSalida' => $this->request->getPostGet('tipoSalida'),
      'valor' => $this->request->getPost('valor'),
      'fecha' => $this->request->getPost('fecha'),
      'descripcion' => $this->request->getPostGet('descripcion'),
      'estado' => $this->request->getPost('estado'),
    ];

    $a = $this->salidasCaja->actualizar($idSalida, $actualizar);

    return redirect()->to(base_url('salidasCaja/editar') . '/' . $idSalida);
  }

  public function eliminar($idSalida)
  {
    $this->salidasCaja->where('idSalidasCaja', $idSalida)->delete();

    return redirect()->to(base_url('salidasCaja'));
  }
}
