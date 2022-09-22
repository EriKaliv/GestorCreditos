<?php

namespace App\Models;
use CodeIgniter\Model;

class Historial_CreditoModel extends Model
{
  protected $table = 'historial_credito';
  protected $primaryKey = 'idHistorial';

  protected $returnType = 'array';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['idcreditos', 'idEntradas', 'fecha', 'concepto', 'valor', 'iva', 'interes', 'capital', 'saldo'];

  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;

  function consultar($idCredito)
  {
    $historial = $this->where('idcreditos', $idCredito)->findAll();
    return $historial;
  }

  function crear($idCredito)
  {
    $credito = $this->db
      ->table('creditos')
      ->select('*')
      ->join('deudores', 'deudores.idDeudor = creditos.idDeudor')
      ->where('creditos.idcreditos', $idCredito)
      ->get()
      ->getResultArray();

    $credito = $credito[0];
    $valorCobrosUnicos = $credito['transferencia'] + $credito['cuatroxmil'];

    $datos = [
      [
        'idcreditos' => $credito['idcreditos'],
        'fecha' => date('Y-m-d'),
        'concepto' => 'Desembolso Capital',
        'valor' => $credito['cupo'],
        'iva' => 0,
        'interes' => 0,
        'capital' => $credito['cupo'],
        'saldo' => $credito['cupo'],
      ],

      [
        'idcreditos' => $credito['idcreditos'],
        'fecha' => date('Y-m-d'),
        'concepto' => 'Transferencia',
        'valor' => $credito['transferencia'],
        'iva' => $credito['ivaTransferencia'],
        'interes' => 0,
        'capital' => $credito['cupo'],
        'saldo' => $credito['cupo'] + $credito['transferencia'] + $credito['ivaTransferencia'],
      ],

      [
        'idcreditos' => $credito['idcreditos'],
        'fecha' => date('Y-m-d'),
        'concepto' => 'Cuatro x Mil',
        'valor' => $credito['cuatroxmil'],
        'iva' => 0,
        'interes' => 0,
        'capital' => $credito['cupo'],
        'saldo' => $credito['cupo'] + $credito['transferencia'] + $credito['ivaTransferencia'] + $credito['cuatroxmil'],
      ],

      [
        'idcreditos' => $credito['idcreditos'],
        'fecha' => date('Y-m-d'),
        'concepto' => 'Recaudo 1',
        'valor' => $credito['recaudo1'],
        'iva' => $credito['ivaRecaudo1'],
        'interes' => 0,
        'capital' => $credito['cupo'],
        'saldo' => $credito['cupo'] + $credito['transferencia'] + $credito['ivaTransferencia'] + $credito['cuatroxmil'] + $credito['recaudo1'] + $credito['ivaRecaudo1'],
      ],

      [
        'idcreditos' => $credito['idcreditos'],
        'fecha' => date('Y-m-d'),
        'concepto' => 'Cobranza',
        'valor' => $credito['cobranza'],
        'iva' => $credito['ivaCobranza'],
        'interes' => 0,
        'capital' => $credito['cupo'],
        'saldo' => $credito['cupo'] + $credito['transferencia'] + $credito['ivaTransferencia'] + $credito['cuatroxmil'] + $credito['recaudo1'] + $credito['ivaRecaudo1'] + $credito['cobranza'] + $credito['ivaCobranza'],
      ],

      [
        'idcreditos' => $credito['idcreditos'],
        'fecha' => date('Y-m-d'),
        'concepto' => 'Recaudo 2',
        'valor' => $credito['recaudo2'],
        'iva' => $credito['ivaRecaudo2'],
        'interes' => 0,
        'capital' => $credito['cupo'],
        'saldo' =>
          $credito['cupo'] +
          $credito['transferencia'] +
          $credito['ivaTransferencia'] +
          $credito['cuatroxmil'] +
          $credito['recaudo1'] +
          $credito['ivaRecaudo1'] +
          $credito['cobranza'] +
          $credito['ivaCobranza'] +
          $credito['recaudo2'] +
          $credito['ivaRecaudo2'],
      ],

      [
        'idcreditos' => $credito['idcreditos'],
        'fecha' => date('Y-m-d'),
        'concepto' => 'Software',
        'valor' => $credito['software'],
        'iva' => 0,
        'interes' => 0,
        'capital' => $credito['cupo'],
        'saldo' =>
          $credito['cupo'] +
          $credito['transferencia'] +
          $credito['ivaTransferencia'] +
          $credito['cuatroxmil'] +
          $credito['recaudo1'] +
          $credito['ivaRecaudo1'] +
          $credito['cobranza'] +
          $credito['ivaCobranza'] +
          $credito['recaudo2'] +
          $credito['ivaRecaudo2'] +
          $credito['software'],
      ],
    ];

    foreach ($datos as $dato):
      $this->db->table('historial_credito')->insert($dato);
    endforeach;

    return $datos;
  }

  function generarInteres($fecha, $frecuencia)
  {
    $historiales = $this->db
      ->table('historial_credito')
      ->select('idcreditos')
      ->selectMax('idHistorial')
      ->groupBy("idcreditos")
      ->get();

    foreach ($historiales->getResult() as $historial) {
      $saldos = $this->select('idHistorial, interes, capital, saldo')
        ->where('idHistorial', $historial->idHistorial)
        ->get()
        ->getResultArray();

      $tasas = $this->db
        ->table('creditos')
        ->select('tasa, frecuencia')
        ->where('idcreditos', $historial->idcreditos)
        ->get()
        ->getResultArray();

      foreach ($saldos as $saldo) {
        $capital = intval($saldo['capital']);
        $intAcumulado = intval($saldo['interes']);
        $saldo = intval($saldo['saldo']);
      }

      foreach ($tasas as $tasa => $valor) {
        $tasa = intval($valor['tasa']) / 100;
        $tasa = 1 + $tasa;
        $mensual = 1 / 12;
        $quincenal = 1 / 24;

        if (($frecuencia === 'M') & ($valor['frecuencia'] === 'M')) {
          $interes = pow($tasa, $mensual) - 1;
          $interes = $interes * $saldo;
          $saldo = $interes + $saldo;
          $intAcumulado = $intAcumulado + $interes;

          $datos = [
            [
              'idcreditos' => $historial->idcreditos,
              'fecha' => $fecha,
              'concepto' => 'Interes Corriente',
              'valor' => $interes,
              'iva' => 0,
              'interes' => $intAcumulado,
              'capital' => $capital,
              'saldo' => $saldo,
            ],
          ];

          foreach ($datos as $dato):
            $this->db->table('historial_credito')->insert($dato);
          endforeach;

        } elseif (($frecuencia === 'Q') & ($valor['frecuencia'] === 'Q')) {
          $interes = pow($tasa, $quincenal) - 1;
          $interes = $interes * $saldo;
          $saldo = $interes + $saldo;
          $intAcumulado = $intAcumulado + $interes;

          $datos = [
            [
              'idcreditos' => $historial->idcreditos,
              'fecha' => $fecha,
              'concepto' => 'Interes Corriente',
              'valor' => $interes,
              'iva' => 0,
              'interes' => $intAcumulado,
              'capital' => $capital,
              'saldo' => $saldo,
            ],
          ];

          foreach ($datos as $dato):
            $this->db->table('historial_credito')->insert($dato);
          endforeach;
        }
      }
    }
  }
}
