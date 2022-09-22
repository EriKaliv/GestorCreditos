<?php

namespace App\Models;
use CodeIgniter\Model;

class RolesModel extends Model
{
  protected $table = 'roles';
  protected $primaryKey = 'idRol';

  protected $useAutoIncrement = true;

  protected $returnType = 'array';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['nombreRol', 'estadoRol'];

  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;

  function consultar()
  {
    $rol = $this->findAll();
    return $rol;
  }

  function consultarId($id)
  {
    $idRol = $this->where('idRol', $id)->first();
    return $idRol;
  }

  function crear($rol)
  {
    $this->insert($rol);
  }

  function actualizar($id, $actualizar)
  {
    $this->db
      ->table('roles')
      ->where('idRol', $id)
      ->update($actualizar);
  }
}
