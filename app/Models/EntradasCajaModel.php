<?php namespace App\Models;

use CodeIgniter\Model;

class EntradasCajaModel extends Model
{
  protected $table = 'entradas_caja';
  protected $primaryKey = 'idEntradas';

  protected $returnType = 'array';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['idCaja', 'idcreditos', 'valor', 'fecha', 'estado'];

  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;

  function consultar()
  {
    $entradas = $this->select('entradas_caja.idEntradas, entradas_caja.idCaja, entradas_caja.idcreditos, entradas_caja.valor, entradas_caja.fecha, estado, c.idDeudor, deudores.nombres, deudores.apellidos, nombre, numeroId, tipoCuenta, numero')
      ->join('creditos c', 'c.idcreditos=entradas_caja.idcreditos')
      ->join('deudores', 'deudores.idDeudor=c.idDeudor')
      ->join('cajas', 'cajas.idCaja=entradas_caja.idCaja')
      ->get()->getResultArray();

    return $entradas;
  }

  function buscar($datos)
  {
    if (isset($datos['estado'])) {

      $entradas = $this->select('entradas_caja.idEntradas, entradas_caja.idCaja, entradas_caja.idcreditos, entradas_caja.valor, entradas_caja.fecha, estado, c.idDeudor, deudores.nombres, deudores.apellidos, nombre, numeroId, tipoCuenta, numero')
      ->join('creditos c', 'c.idcreditos=entradas_caja.idcreditos')
      ->join('deudores', 'deudores.idDeudor=c.idDeudor')
      ->join('cajas', 'cajas.idCaja=entradas_caja.idCaja')->where('estado', $datos)
      ->get()->getResultArray();

    return $entradas;
     
    } elseif (isset($datos['idDeudor'])) {

      $entradas = $this->select('entradas_caja.idEntradas, entradas_caja.idCaja, entradas_caja.idcreditos, entradas_caja.valor, entradas_caja.fecha, estado, c.idDeudor, deudores.nombres, deudores.apellidos, nombre, numeroId, tipoCuenta, numero')
      ->join('creditos c', 'c.idcreditos=entradas_caja.idcreditos')
      ->join('deudores', 'deudores.idDeudor=c.idDeudor')
      ->join('cajas', 'cajas.idCaja=entradas_caja.idCaja')->where('deudores.idDeudor', $datos)
      ->get()->getResultArray();

      return $entradas;
    }
  }
  
  function crear($datos)
  {
    $this->db->table('entradas_caja')->insert($datos);
  }

  function editar($id)
  {
    $entrada = $this->table('entradas_caja')
      ->select('idEntradas, idCaja, valor, fecha, entradas_caja.estado')
      ->join('creditos', 'creditos.idcreditos = entradas_caja.idcreditos')
      ->select('creditos.idcreditos, creditos.idDeudor')
      ->join('deudores', 'deudores.idDeudor = creditos.idDeudor')
      ->select('nombres, apellidos')
      ->where('idEntradas', $id)
      ->first();

    return $entrada;
  }

  function actualizar($idEntrada, $actualizar)
  {
    if ($actualizar['estado'] == 'Aprobado') {
      $this->db
        ->table('entradas_caja')
        ->where('idEntradas', $idEntrada)
        ->update($actualizar);

      $ultimosRegistros = $this->db
        ->table('historial_credito')
        ->select('idcreditos')
        ->where('idcreditos', $actualizar['idcreditos'])
        ->selectMax('idHistorial')
        ->get()
        ->getResultArray();

      $ultimoRegistro = $ultimosRegistros[0];

      $ultimoRegistro = $this->db
        ->table('historial_credito')
        ->select('idcreditos, idHistorial, interes, capital,  saldo')
        ->where('idHistorial', $ultimoRegistro['idHistorial'])
        ->get()
        ->getResultArray();

      $ultimoRegistro = $ultimoRegistro[0];
      $cargos = $ultimoRegistro['saldo'] - $ultimoRegistro['capital'];

      if ($cargos > intval($actualizar['valor'])):
        $pagoCargos = intval($actualizar['valor']);
        $intAcumulado = 0;
        $capital = $ultimoRegistro['capital'];
        $saldo = $ultimoRegistro['saldo'] - $pagoCargos;

        $datos = [
          [
            'idcreditos' => $ultimoRegistro['idcreditos'],
            'idEntradas' => $idEntrada,
            'fecha' => $actualizar['fecha'],
            'concepto' => 'Pago realizado a cargos',
            'valor' => $pagoCargos,
            'iva' => 0,
            'interes' => $intAcumulado,
            'capital' => $capital,
            'saldo' => $saldo,
          ],
        ];

        foreach ($datos as $dato):
          $this->db->table('historial_credito')->insert($dato);
        endforeach;

      elseif ($cargos < intval($actualizar['valor'])):
        $pagoCargos = $cargos;
        $intAcumulado = 0;
        $capital1 = $ultimoRegistro['capital'];
        $saldo1 = $ultimoRegistro['saldo'] - $pagoCargos;

        $pagoCapital = intval($actualizar['valor']) - $pagoCargos;
        $capital2 = $ultimoRegistro['capital'] - $pagoCapital;
        $saldo2 = $saldo1 - $pagoCapital;

        $datos = [
          [
            'idcreditos' => $ultimoRegistro['idcreditos'],
            'fecha' => $actualizar['fecha'],
            'concepto' => 'Pago realizado a cargos',
            'valor' => $pagoCargos,
            'iva' => 0,
            'interes' => $intAcumulado,
            'capital' => $capital1,
            'saldo' => $saldo1,
          ],

          [
            'idcreditos' => $ultimoRegistro['idcreditos'],
            'fecha' => $actualizar['fecha'],
            'concepto' => 'Pago realizado a capital',
            'valor' => $pagoCapital,
            'iva' => 0,
            'interes' => $intAcumulado,
            'capital' => $capital2,
            'saldo' => $saldo2,
          ],
        ];

        if($saldo2<=0){
          $estado = ['estadoCredito' => 'Cancelado'];
          $this->db->table('creditos')->where('idcreditos', $ultimoRegistro['idcreditos'])->update($estado);
        }

        foreach ($datos as $dato):
          $this->db->table('historial_credito')->insert($dato);
        endforeach;
        
      endif;
    } else {
      $this->db
        ->table('entradas_caja')
        ->where('idEntradas', $idEntrada)
        ->update($actualizar);
    }
  }
}
