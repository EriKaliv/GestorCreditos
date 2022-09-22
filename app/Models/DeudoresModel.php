<?php namespace App\Models;

use CodeIgniter\Model;

class DeudoresModel extends Model
{
  protected $table = 'deudores';
  protected $primaryKey = 'idDeudor';

  protected $returnType = 'array';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['idUsuario', 'nombres', 'apellidos', 'idTipoId', 'numeroId', 'idPais', 'idDepartamento', 'idCiudMuni', 'numeroCel', 'email', 'direccion', 'estado'];

  protected $useTimestamps = true;
  protected $createdField = 'fechaAlta_Deud';
  protected $updatedField = 'fechaEdit_Deud';
  protected $deletedField = 'deleted_at';

  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;

  function consultar()
  {
    $nombre = $this->table('deudores')
      ->select('*')
      ->join('usuarios', 'usuarios.idUsuario = deudores.idUsuario')
      ->findAll();

    return $nombre;
  }

  function consultarId($id)
  {
    $nombre = $this->table('deudores')
      ->select('deudores.idDeudor, deudores.nombres, deudores.apellidos')
      ->join('usuarios', 'usuarios.idUsuario = deudores.idUsuario')
      ->where('deudores.idUsuario', $id)
      ->first();
    return $nombre;
  }

  function numeroNuevoDeudor()
  {
    $idDeudor = $this->selectMax('idDeudor')->first();
    return $idDeudor;
  }

  function crear($id)
  {
    $this->insert($id);
  }

  function editar($id)
  {
    $prestatario = $this->table('deudores')
      ->select('*')
      ->join('usuarios', 'usuarios.idUsuario = deudores.idUsuario')
      ->where('deudores.idDeudor', $id)
      ->first();

    return $prestatario;
  }

  function actualizar($actualizarPre, $idDeudor)
  {
    $this->db
      ->table('deudores')
      ->where('idDeudor', $idDeudor)
      ->update($actualizarPre);
  }

  function infoCompleta($id)
  {
    $info = $this->where('idDeudor', $id)->findAll();
    $array=array_filter($info[0]);
    $count = count($array);
    return $count;
  }
}
