<?php

namespace App\Controllers;
use App\Models\UbicacionModel;
use App\Models\DeudoresModel;
use App\Models\EmpresasModel;

class Ubicacion extends PermisosController
{
  protected $ubicacion, $deudores, $empresas;

  public function __construct()
  {
    $this->ubicacion = new UbicacionModel();
    $this->deudores = new DeudoresModel();
    $this->empresas = new EmpresasModel();
  }

  public function departamento()
  {
    $idPais = $this->request->getPostGet('idPais');
    $departamento = $this->ubicacion->departamento($idPais);
    echo json_encode($departamento);
  }

  public function depaDeudor()
  {
    $idUsuario = $this->deudores->consultarId($this->session->idUsuario);
    $idDeudor = $this->request->getPostGet('idDeudor');

    if (isset($idUsuario['idDeudor'])) {
      $depaDeudor = $this->deudores->editar($idUsuario['idDeudor']);
      echo json_encode($depaDeudor['idDepartamento']);
    } elseif (isset($idDeudor)) {
      $depaDeudor = $this->deudores->editar($idDeudor);
      echo json_encode($depaDeudor['idDepartamento']);
    }
  }

  public function depaEmpresa()
  {
    $idEmpresa = $this->request->getPostGet('idEmpresa');

    $depaEmpresa = $this->empresas->editar($idEmpresa);
    echo json_encode($depaEmpresa['idDepartamento']);
  }

  public function ciudadMunicipio()
  {
    $idCiudad = $this->request->getPostGet('idDepartamento');
    $ciudad = $this->ubicacion->ciudadMunicipio($idCiudad);
    echo json_encode($ciudad);
  }

  public function ciudadDeudor()
  {
    $idDeudor = $this->deudores->consultarId($this->session->idUsuario);
    $idUsuario = ['idUsuario' => $this->session->idUsuario];
    $id = $this->request->getPostGet('idDeudor');

    if (isset($id)) {
      $depaDeudor = $this->deudores->editar($id);
      echo json_encode($depaDeudor);
    } elseif (isset($idUsuario)) {
      $depaDeudor = $this->deudores->editar($idDeudor['idDeudor']);
      echo json_encode($depaDeudor);
    }
  }

  public function ciudadEmpresa()
  {
    $idEmpresa = $this->request->getPostGet('idEmpresa');

    $depaEmpresa = $this->empresas->editar($idEmpresa);
    echo json_encode($depaEmpresa);
  }
}
