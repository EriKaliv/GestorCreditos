<?php namespace App\Models;

use CodeIgniter\Model;

class DesembolsosModel extends Model
{
  protected $table = 'desembolsos';
  protected $primaryKey = 'idDesembolso';
  
  protected $returnType = 'array';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['idCredito', 'idCaja', 'idDeudor', 'fecha', 'monto', 'estado'];

  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;

  function consultar()
  {
    $desembolsos = $this->table('desembolsos')
      ->select('desembolsos.*')
      ->join('deudores', 'deudores.idDeudor=desembolsos.idDeudor')
      ->select('nombres, apellidos, numeroId')
      ->findAll();

    return $desembolsos;
  }

  function buscar($datos)
  {
    if (isset($datos['estado'])) {
      $estados = $this->table('desembolsos')
        ->select('desembolsos.*')
        ->join('deudores', 'deudores.idDeudor=desembolsos.idDeudor')
        ->select('nombres, apellidos, numeroId')
        ->where('estado', $datos)
        ->findAll();
      return $estados;
    } elseif (isset($datos['idDeudor'])) {
      $deudor = $this->table('desembolsos')
        ->select('desembolsos.*')
        ->join('deudores', 'deudores.idDeudor=desembolsos.idDeudor')
        ->select('nombres, apellidos, numeroId')
        ->where('desembolsos.idDeudor', $datos)
        ->findAll();

      return $deudor;
    }
  }

  function crear($idCredito, $caja, $monto)
  {
    $creditoDesembolsado = $this->db
      ->table('creditos')
      ->select('idcreditos, idDeudor, estadoCredito')
      ->where('creditos.idcreditos', $idCredito)
      ->get()
      ->getResultArray();
    $creditoDesembolsado = $creditoDesembolsado[0];
    $caja = $this->db
      ->table('cajas')
      ->select('*')
      ->where('idCaja', $caja)
      ->get()
      ->getResultArray();
    $caja = $caja[0];
    $creditoDesembolsado = [
      'idCaja' => $caja['idCaja'],
      'idCredito' => $idCredito,
      'idDeudor' => $creditoDesembolsado['idDeudor'],
      'monto' => $monto,
      'fecha' => date('Y-m-d'),
      'estado' => 'Desembolsado',
    ];

    $this->insert($creditoDesembolsado);

    return $creditoDesembolsado;
  }
}
