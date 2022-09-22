<?php

namespace App\Controllers;

use App\Models\RolesModel;
use App\Models\PermisosModel;
use App\Models\Permisos_RolesModel;

class Roles extends PermisosController
{
  protected $roles, $permisos, $permisosRoles, $tienePermisos, $session;

  public function __construct()
  {
    $this->roles = new RolesModel();
    $this->permisos = new PermisosModel();
    $this->permisosRoles = new Permisos_RolesModel();

    $this->session = session();

    $this->tienePermisos = ['permiso' => $this->permiso(), 'nombreUsuario' => $this->session->nombreUsuario, 'nombreRol' => $this->session->nombreRol];

    $this->request = \Config\Services::request();
  }

  public function index()
  {
    if ($this->session->idRol >= 2) {
      $roles = $this->roles->consultar();
      $data = ['datos' => $roles];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('roles/roles', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function nuevo()
  {
    if ($this->session->idRol >= 2) {
      $vistas = view('plantillas/header', $this->tienePermisos) . View('roles/nuevo') . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function crear()
  {
    $rol = [
      'nombreRol' => $this->request->getPostGet('nombre'),
      'estado' => $this->request->getPostGet('estado'),
    ];

    $this->roles->crear($rol);
    return redirect()->to(base_url('roles'));
  }

  public function editar($id)
  {
    if ($this->session->idRol >= 2) {
      $rol = $this->roles->consultarId($id);
      $data = ['rol' => $rol];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('roles/editar', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function actualizar($id)
  {
    $actualizar = [
      'nombreRol' => $this->request->getPostGet('nombre'),
      'estadoRol' => $this->request->getPostGet('estado'),
    ];

    $this->roles->actualizar($id, $actualizar);

    return redirect()->to(base_url('roles/editar') . '/' . $id);
  }

  public function permisos()
  {
    if ($this->session->idRol >= 2) {
      $idRol = $this->request->getPostGet('idRol');
      $permisos = $this->permisos->consultar();
      $roles = $this->roles->consultarId($idRol);
      $permisosAsignados = $this->permisosRoles->consultarId($idRol);
      $permisosEncontrados = [];

      foreach ($permisosAsignados as $permisoAsignado) {
        $permisosEncontrados[$permisoAsignado['idPermiso']] = true;
      }

      $data = ['datos' => $roles, 'idRol' => $idRol, 'permisos' => $permisos, 'asignado' => $permisosEncontrados];

      return View('roles/permisos', $data);
    } else {
      return redirect()->to(base_url());
    }
  }

  public function guardarPermisos()
  {
    $idRol = $this->request->getPost('idRol');
    $permisos = $this->request->getPost('permisos');

    $this->permisosRoles->eliminar($idRol);

    if (isset($permisos)) {
      foreach ($permisos as $permiso) {
        $this->permisosRoles->save(['idRol' => $idRol, 'idPermiso' => $permiso]);
      }
    } else {
      $this->permisosRoles->eliminar($idRol);
    }

    return redirect()->to(base_url('/roles'));
  }
}
