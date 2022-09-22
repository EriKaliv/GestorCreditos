<?php

namespace App\Controllers;

use App\Models\UsuariosModel;
use App\Models\DeudoresModel;
use App\Models\CreditosModel;
use App\Models\Permisos_RolesModel;
use App\Models\UbicacionModel;
use App\Models\RolesModel;
use App\Models\TipoidModel;
use App\Models\Historial_CreditoModel;

class Deudores extends PermisosController
{
  protected $usuarios, $tienePermisos, $deudores, $creditos, $permisosRoles, $session, $ubicacion, $roles, $tipoId, $historialCredito;

  protected $reglas, $reglasDeudor;

  public function __construct()
  {
    $this->usuarios = new UsuariosModel();
    $this->deudores = new DeudoresModel();
    $this->creditos = new CreditosModel();
    $this->permisosRoles = new Permisos_RolesModel();
    $this->ubicacion = new UbicacionModel();
    $this->roles = new RolesModel();
    $this->tipoId = new TipoidModel();
    $this->historialCredito = new Historial_CreditoModel();

    $this->session = session();

    $nombreDeudor = $this->deudores->consultarId($this->session->idUsuario);
    $this->tienePermisos = ['permiso' => $this->permiso(), 'nombreDeudor' => $nombreDeudor['nombres'] . ' ' . $nombreDeudor['apellidos'], 'nombreUsuario' => $this->session->nombreUsuario, 'nombreRol' => $this->session->nombreRol];

    $this->reglas = [
      'nombres' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Completa este campo.',
        ],
      ],
      'apellidos' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Completa este campo.',
        ],
      ],
      'idTipoId' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Completa este campo.',
        ],
      ],
      'numeroId' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Completa este campo.',
        ],
      ],
      'numeroCel' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Completa este campo.',
        ],
      ],
      'email' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Completa este campo.',
        ],
      ],
      'pais' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Completa este campo.',
        ],
      ],
      'depa' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Completa este campo.',
        ],
      ],
      'ciud' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Completa este campo.',
        ],
      ],
      'direccion' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Completa este campo.',
        ],
      ],
    ];

    $this->reglasDeudor = [
      'idUsuario' => [
        'rules' => 'is_unique[deudores.idUsuario]',
        'errors' => [
          'is_unique' => 'El usuario ya existe como deudor.',
        ],
      ],
    ];
  }

  public function index()
  {
    if ($this->session->idRol >= 2) {
      $usuarios = $this->usuarios->consultar();
      $deudores = $this->deudores->consultar();
      $buscarDeudores = $this->deudores->consultar();
      $data = ['deudores' => $deudores, 'usuarios' => $usuarios, 'buscarDeudores' => $buscarDeudores];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('deudores/deudores', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function buscar()
  {
    if ($this->session->idRol >= 2) {
      $estado = $this->request->getPost('estado');
      $deudor = $this->request->getPost('deudor');

      if (isset($estado)) {
        $deudor = $this->deudores
          ->join('usuarios', 'usuarios.idUsuario=deudores.idUsuario')
          ->where('estadoUsuario', $estado)
          ->findAll();
      } elseif (isset($deudor)) {
        $deudor = $this->deudores
          ->join('usuarios', 'usuarios.idUsuario=deudores.idUsuario')
          ->where('idDeudor', $deudor)
          ->findAll();
      }
      $usuarios = $this->usuarios->consultar();
      $buscarDeudores = $this->deudores->consultar();
      $data = ['deudores' => $deudor, 'usuarios' => $usuarios, 'buscarDeudores' => $buscarDeudores];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('deudores/deudores', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function crear()
  {
    if($this->validate($this->reglasDeudor)){
    $id = $this->request->getPost('idUsuario');
    $usuario = $this->usuarios->editar($id);

    if ($usuario['idRol'] == 1) {
      $idUsuario = [
        'idUsuario' => $id,
        'nombres' => $usuario['nombreUsuario'],
      ];

      $this->deudores->crear($idUsuario);
      return redirect()->to(base_url('/deudores'));

      } else {
        $mensaje = 'El Usuario no es Deudor.';
        $usuarios = $this->usuarios->consultar();
        $deudores = $this->deudores->consultar();
        $buscarDeudores = $this->deudores->consultar();
        $data = ['deudores' => $deudores, 'usuarios' => $usuarios, 'buscarDeudores' => $buscarDeudores, 'mensaje' => $mensaje];

        $vistas = view('plantillas/header', $this->tienePermisos) . View('deudores/deudores', $data) . view('plantillas/footer');

        return $vistas;
      }
    }else{
      $usuarios = $this->usuarios->consultar();
        $deudores = $this->deudores->consultar();
        $buscarDeudores = $this->deudores->consultar();
        $data = ['deudores' => $deudores, 'usuarios' => $usuarios, 'buscarDeudores' => $buscarDeudores, 'validation' => $this->validator->getErrors()];

        $vistas = view('plantillas/header', $this->tienePermisos) . View('deudores/deudores', $data) . view('plantillas/footer');

        return $vistas;
    }
  }

  public function editar($id)
  {
    if ($this->session->idRol >= 2) {
      $tipoIds = $this->tipoId->consultar();
      $deudor = $this->deudores->editar($id);
      $paises = $this->ubicacion->pais();
      $roles = $this->roles->consultar();

      $data = ['deudor' => $deudor, 'tipoIds' => $tipoIds, 'paises' => $paises, 'roles' => $roles];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('deudores/editar', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function actualizar()
  {
    $idUsuario = $this->session->idUsuario;
    $idDeudor = $this->deudores->consultarId($idUsuario);

    if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
      $actualizarPre = [
        'nombres' => $this->request->getPost('nombres'),
        'apellidos' => $this->request->getPost('apellidos'),
        'idTipoId' => $this->request->getPost('idTipoId'),
        'numeroId' => $this->request->getPost('numeroId'),
        'idPais' => $this->request->getPost('pais'),
        'idDepartamento' => $this->request->getPost('depa'),
        'idCiudMuni' => $this->request->getPost('ciud'),
        'numeroCel' => $this->request->getPost('numeroCel'),
        'email' => $this->request->getPost('email'),
        'direccion' => $this->request->getPost('direccion'),
      ];

      if (isset($idDeudor)) {
        $this->deudores->actualizar($actualizarPre, $idDeudor['idDeudor']);
        return redirect()->to(base_url('deudores/registroInfo'));
      } else {
        $idDeudor = current_url(true)->getSegment(4);
        $this->deudores->actualizar($actualizarPre, $idDeudor);
        return redirect()->to(base_url('deudores/editar') . '/' . $idDeudor);
      }
    } else {
      if (isset($idDeudor)) {
        $tipoId = $this->tipoId->consultar();
        $paises = $this->ubicacion->pais();
        $id = ['idUsuario' => $this->session->idUsuario];
        $deudor = $this->deudores->editar($idDeudor['idDeudor']);

        $data = ['tipoId' => $tipoId, 'paises' => $paises, 'deudor' => $deudor, 'validation' => $this->validator];

        $vistas = view('plantillas/headerDeudores', $this->tienePermisos) . View('deudores/infoPersonal', $data) . view('plantillas/footer');

        return $vistas;
      } else {
        $idDeudor = current_url(true)->getSegment(4);
        $tipoIds = $this->tipoId->consultar();
        $deudor = $this->deudores->consultarId($idDeudor);
        $paises = $this->ubicacion->pais();
        $roles = $this->roles->consultar();

        $data = ['deudor' => $deudor, 'tipoIds' => $tipoIds, 'paises' => $paises, 'roles' => $roles, 'validation' => $this->validator];

        $vistas = view('plantillas/header', $this->tienePermisos) . View('deudores/editar', $data) . view('plantillas/footer');

        return $vistas;
      }
    }
  }

  public function registroInfo()
  {
    if ($this->session->idRol == 1) {
      $tipoId = $this->tipoId->consultar();
      $paises = $this->ubicacion->pais();
      $idDeudor = $this->deudores->consultarId($this->session->idUsuario);
      $deudor = $this->deudores->editar($idDeudor['idDeudor']);

      $data = ['tipoId' => $tipoId, 'paises' => $paises, 'deudor' => $deudor];

      $vistas = view('plantillas/headerDeudores', $this->tienePermisos) . View('deudores/infoPersonal', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }
}
