<?php namespace App\Models;

use CodeIgniter\Model;

class SalidasCajaModel extends Model
{
  protected $table = 'salidas_caja';
  protected $primaryKey = 'idSalidasCaja';

  protected $returnType = 'array';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['idCaja', 'tipoSalida', 'fecha', 'descripcion', 'actor', 'valor', 'estado'];

  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;

  function consultar()
  {
    $salidas = $this->join('cajas', 'cajas.idCaja=salidas_caja.idCaja')
      ->join('empresas', 'empresas.idEmpresa=salidas_caja.idEmpresa')
      ->join('tipo_salida', 'tipo_salida.idTipoSalida=salidas_caja.idTipoSalida')
      ->findAll();

    return $salidas;
  }

  function buscar($datos)
  {
    if (isset($datos['estado'])) {
      $estados = $this->join('cajas', 'cajas.idCaja=salidas_caja.idCaja')
        ->join('empresas', 'empresas.idEmpresa=salidas_caja.idEmpresa')
        ->join('tipo_salida', 'tipo_salida.idTipoSalida=salidas_caja.idTipoSalida')
        ->where('estado', $datos)
        ->get()
        ->getResultArray();

      return $estados;
    } elseif (isset($datos['idEmpresa'])) {
      $empresa = $this->join('cajas', 'cajas.idCaja=salidas_caja.idCaja')
        ->join('empresas', 'empresas.idEmpresa=salidas_caja.idEmpresa')
        ->join('tipo_salida', 'tipo_salida.idTipoSalida=salidas_caja.idTipoSalida')
        ->where('salidas_caja.idEmpresa', $datos)
        ->get()
        ->getResultArray();

      return $empresa;
    }
  }

  function tipoSalida()
  {
    $tipoSalida = $this->db
      ->table('tipo_salida')
      ->select('*')
      ->get()
      ->getResultArray();
    return $tipoSalida;
  }

  function empresas()
  {
    $empresas = $this->db
      ->table('empresas')
      ->select('*')
      ->get()
      ->getResultArray();

    return $empresas;
  }

  function crear($datos)
  {
    $this->db->table('salidas_caja')->insert($datos);
  }

  function tipoSalidas()
  {
    $tipoSalidas = $this->db
      ->table('tipo_salida')
      ->select('*')
      ->get()
      ->getResultArray();

    return $tipoSalidas;
  }

  function editar($id)
  {
    $salida = $this->join('cajas', 'cajas.idCaja=salidas_caja.idCaja')
      ->join('empresas', 'empresas.idEmpresa=salidas_caja.idEmpresa')
      ->join('tipo_salida', 'tipo_salida.idTipoSalida=salidas_caja.idTipoSalida')
      ->where('idSalidasCaja', $id)
      ->first();

    return $salida;
  }

  function actualizar($idSalida, $actualizar)
  {
    $this->db
      ->table('salidas_caja')
      ->where('idSalidasCaja', $idSalida)
      ->update($actualizar);
  }
}
