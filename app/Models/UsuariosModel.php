<?php

namespace App\Models;
use CodeIgniter\Model;

class UsuariosModel extends Model
{
  protected $table = 'usuarios';
  protected $primaryKey = 'idUsuario';

  protected $returnType = 'array';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['nombreUsuario', 'password', 'idRol', 'estadoUsuario'];

  protected $validationRules = [];
  protected $validationMessages = [];
  protected $skipValidation = false;

  function consultar()
  {
    $nombre = $this->table('usuarios')
      ->select('idUsuario, nombreUsuario, nombreRol, usuarios.estadoUsuario')
      ->where('usuarios.estadoUsuario', 'Activo')
      ->orWhere('usuarios.estadoUsuario', 'Inactivo')
      ->join('roles', 'roles.idRol = usuarios.idRol')
      ->findAll();

    return $nombre;
  }

  function existeUsuario($nomUsuario)
  {
    $usuario = $this->select('nombreUsuario')
      ->where('nombreUsuario', $nomUsuario)
      ->first();

    return $usuario;
  }

  function numeroNuevoUsuario()
  {
    $idUsuario = $this->selectMax('idUsuario')->first();
    return $idUsuario;
  }

  function guardar($guardar)
  {
    $this->insert($guardar);
  }

  function editar($id)
  {
    $usuario = $this->table('usuarios')
      ->select('*')
      ->join('roles', 'roles.idRol = usuarios.idRol')
      ->where('idUsuario', $id)
      ->first();
    return $usuario;
  }

  function actualizar($actualizar, $idUsuario)
  {
    $this->db
      ->table('usuarios')
      ->where('idUsuario', $idUsuario)
      ->update($actualizar);
  }

  function login($usuario)
  {
    $datoUsuario = $this->table('usuarios')
      ->select('*')
      ->join('roles', 'roles.idRol = usuarios.idRol')
      ->where('nombreUsuario', $usuario)
      ->first();
    return $datoUsuario;
  }

  function eliminados()
  {
    $nombre = $this->where('estadoUsuario', 'Eliminado')->findAll();
    return $nombre;
  }
}
