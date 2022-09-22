<?php

namespace App\Models;
use CodeIgniter\Model;

class EmpresasModel extends Model
{
  protected $table = 'empresas';
  protected $primaryKey = 'idEmpresa';

  protected $returnType = 'array';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['idTipoId', 'numeroId', 'nombre', 'idPais', 'idDepartamento', 'idCiudMuni', 'direccion', 'telefono', 'email'];

  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;

  function consultar()
  {
    $empresas = $this->findAll();
    return $empresas;
  }

  function buscar($datos)
  {
    if (isset($datos['idEmpresa'])) {
      $empresa = $this->where('idEmpresa', $datos)->findAll();
      return $empresa;
    }
  }

  function crear($empresa)
  {
    $this->insert($empresa);
  }

  function editar($id)
  {
    $empresa = $this->where('idEmpresa', $id)->first();
    return $empresa;
  }

  function actualizar($actualizar, $idEmpresa)
  {
    $this->db
      ->table('empresas')
      ->where('idEmpresa', $idEmpresa)
      ->update($actualizar);
  }
}
