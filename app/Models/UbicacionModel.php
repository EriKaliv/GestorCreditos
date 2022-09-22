<?php

namespace App\Models;
use CodeIgniter\Model;

class UbicacionModel extends Model
{
  public function pais()
  {
    $paises = $this->db
      ->table("ubicacion_pais")
      ->select('*')
      ->get()
      ->getResultArray();

    return $paises;
  }

  public function departamento($idPais)
  {
    $departamentos = $this->db
      ->table("ubicacion_departamento")
      ->getWhere(['idPais' => $idPais])
      ->getResultArray();

    return $departamentos;
  }

  public function ciudadMunicipio($ciudMuni)
  {
    $ciudades = $this->db
      ->table("ubicacion_ciudmuni")
      ->getWhere(['idDepartamento' => $ciudMuni])
      ->getResultArray();

    return $ciudades;
  }
}
