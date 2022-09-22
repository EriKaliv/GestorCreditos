<?php
namespace App\Controllers;

use App\Models\EmpresasModel;
use App\Models\Permisos_RolesModel;
use App\Models\UbicacionModel;
use App\Models\TipoidModel;

class Empresas extends PermisosController
{
  protected $empresas, $permisosRoles, $tienePermisos, $session, $ubicacion, $tipoId;

  public function __construct()
  {
    $this->empresas = new EmpresasModel();
    $this->permisosRoles = new Permisos_RolesModel();
    $this->ubicacion = new UbicacionModel();
    $this->tipoId = new TipoidModel();

    $this->session = session();
    $this->tienePermisos = ['permiso' => $this->permiso(), 'nombreUsuario' => $this->session->nombreUsuario, 'nombreRol' => $this->session->nombreRol];
  }

  public function index()
  {
    if ($this->session->idRol >= 2) {
      $empresas = $this->empresas->consultar();
      $selectEmpresas = $this->empresas->consultar();
      $data = ['empresas' => $empresas, 'selectEmpresas' => $selectEmpresas];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('empresas/empresas', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function buscar()
  {
    if ($this->session->idRol >= 2) {
      $empresa = ['idEmpresa' => $this->request->getPost('empresa')];

      if (isset($empresa['idEmpresa'])) {
        $empresas = $this->empresas->buscar($empresa);
      }

      $selectEmpresas = $this->empresas->consultar();

      $data = ['empresas' => $empresas, 'selectEmpresas' => $selectEmpresas];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('empresas/empresas', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function nueva()
  {
    if ($this->session->idRol >= 2) {
      $tipoId = $this->tipoId->consultar();
      $paises = $this->ubicacion->pais();
      $data = ['tipoId' => $tipoId, 'paises' => $paises];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('empresas/nuevaEmpresa', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function crear()
  {
    $empresa = [
      'idTipoId' => $this->request->getPost('idTipoId'),
      'numeroId' => $this->request->getPost('numeroId'),
      'nombre' => $this->request->getPost('nombre'),
      'idPais' => $this->request->getPost('pais'),
      'idDepartamento' => $this->request->getPost('depa'),
      'idCiudMuni' => $this->request->getPost('ciud'),
      'direccion' => $this->request->getPost('direccion'),
      'telefono' => $this->request->getPost('telefono'),
      'email' => $this->request->getPost('email'),
    ];

    $this->empresas->crear($empresa);

    return redirect()->to(base_url('/empresas/nueva'));
  }

  public function editar($id)
  {
    if ($this->session->idRol >= 2) {
      $empresa = $this->empresas->editar($id);
      $tipoId = $this->tipoId->consultar();
      $paises = $this->ubicacion->pais();

      $data = ['tipoId' => $tipoId, 'paises' => $paises, 'empresa' => $empresa];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('empresas/editar', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function actualizar()
  {
    $idEmpresa = current_url(true)->getSegment(4);
    $actualizar = [
      'idTipoId' => $this->request->getPost('idTipoId'),
      'numeroId' => $this->request->getPost('numeroId'),
      'nombre' => $this->request->getPost('nombre'),
      'idPais' => $this->request->getPost('pais'),
      'idDepartamento' => $this->request->getPost('depa'),
      'idCiudMuni' => $this->request->getPost('ciud'),
      'direccion' => $this->request->getPost('direccion'),
      'telefono' => $this->request->getPost('telefono'),
      'email' => $this->request->getPost('email'),
    ];

    $this->empresas->actualizar($actualizar, $idEmpresa);

    return redirect()->to(base_url('empresas/editar') . '/' . $idEmpresa);
  }

  public function eliminar($id)
  {
    $this->empresas->where('idEmpresa', $id)->delete();
  }
}
