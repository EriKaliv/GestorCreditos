<?php

namespace App\Models;

use CodeIgniter\Model;

class CreditosModel extends Model
{
  protected $table = 'creditos';
  protected $primaryKey = 'idcreditos';

  // protected $useAutoIncrement = true;

  protected $returnType = 'array';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'idDeudor',
    'valorProyectar',
    'tasa',
    'cupo',
    'frecuencia',
    'cuotas',
    'valorCuota',
    'estadoCredito',
    'transferencia',
    'ivaTransferencia',
    'cuatroxmil',
    'recaudo1',
    'ivaRecaudo1',
    'cobranza',
    'ivaCobranza',
    'recaudo2',
    'ivaRecuado2',
    'software'
  ];

  protected $useTimestamps = true;
  protected $createdField = 'fechaAlta_Cr';
  //protected $updatedField  = 'fechaEdit_Cr';
  protected $deletedField = 'deleted_at';

  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;

  function consultar()
  {
    $creditos = $this->table('creditos')
      ->select('*')
      ->join('deudores', 'deudores.idDeudor = creditos.idDeudor')
      ->findAll();
    return $creditos;
  }

  function consultarDesembolsados(){
    $creditos = $this->table('creditos')
      ->select('*')
      ->join('deudores', 'deudores.idDeudor = creditos.idDeudor')
      ->where('estadoCredito', 'Desembolsado')
      ->findAll();
    return $creditos;
  }

  function buscar($datos)
  {
    if (isset($datos['estado'])) {
      $creditos = $this->table('creditos')
        ->select('*')
        ->where('estadoCredito', $datos)
        ->join('deudores', 'deudores.idDeudor = creditos.idDeudor')
        ->findAll();
      return $creditos;
    } elseif (isset($datos['idDeudor'])) {
      $creditos = $this->table('creditos')
        ->select('*')
        ->where('creditos.idDeudor', $datos)
        ->join('deudores', 'deudores.idDeudor = creditos.idDeudor')
        ->findAll();
      return $creditos;
    }
  }

  function numeroCredito()
  {
    $ultimoId = $this->selectMax('idcreditos')->first();
    return $ultimoId;
  }

  function crear($datos)
  {
    $this->db->table('creditos')->insert($datos);
  }

  function editar($id)
  {
    $credito = $this->table('creditos')
      ->select('*')
      ->join('deudores', 'deudores.idDeudor = creditos.idDeudor')
      ->where('creditos.idcreditos', $id)
      ->first();
    return $credito;
  }

  function actualizar($idCredito, $actualizar)
  {
    $this->db
      ->table('creditos')
      ->where('idcreditos', $idCredito)
      ->update($actualizar);
  }

  function ConsultarCajas()
  {
    $cajas = $this->db
      ->table('cajas')
      ->select('*')
      ->get()
      ->getResultArray();
    return $cajas;
  }
}
