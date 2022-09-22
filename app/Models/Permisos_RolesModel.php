<?php

namespace App\Models;

use CodeIgniter\Model;

class Permisos_RolesModel extends Model
{
  protected $table = 'permisos_roles';
  //protected $primaryKey = 'idPermiso_Rol';

  protected $returnType = 'array';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['idPermiso', 'idRol'];

  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;

  function consultar()
  {
    $nombre = $this->findAll();
    return $nombre;
  }

  function consultarId($idRol)
  {
    $idRol = $this->where('idRol', $idRol)->findAll();
    return $idRol;
  }

  function eliminar($idRol)
  {
    $idRol = $this->where('idRol', $idRol)->delete();
  }

  function verificarPermisos($idRol)
  {
    $this->select('nombrePermiso')->join('permisos', 'permisos_roles.idPermiso = permisos.idPermiso');
    $existe = $this->where(['idRol' => $idRol])->findAll();
    return $existe;
  }
}
