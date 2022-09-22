<?php

namespace App\Controllers;

use App\Models\UsuariosModel;
use App\Models\RolesModel;
use App\Models\DeudoresModel;
use App\Models\Permisos_RolesModel;

class Usuarios extends PermisosController
{
  protected $usuarios, $deudores, $permisosRoles, $tienePermisos, $session;
  protected $reglasLogin, $reglasNuevo, $reglasRegistro, $reglasPassword;

  public function __construct()
  {
    $this->usuarios = new UsuariosModel();
    $this->RolesModel = new RolesModel();
    $this->deudores = new DeudoresModel();
    $this->permisosRoles = new Permisos_RolesModel();

    $this->session = session();

    $nombreDeudor = $this->deudores->consultarId($this->session->idUsuario);
    $this->tienePermisos = ['permiso' => $this->permiso(), 'nombreDeudor' => $nombreDeudor['nombres'] . ' ' . $nombreDeudor['apellidos'], 'nombreUsuario' => $this->session->nombreUsuario, 'nombreRol' => $this->session->nombreRol];

    $this->request = \Config\Services::request();

    $this->reglasLogin = [
      'usuario' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'El Campo {field} es Obligatorio.',
        ],
      ],
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'El Campo {field} es Obligatorio.',
        ],
      ],
    ];

    $this->reglasNuevo = [
      'nombre' => [
        'rules' => 'required|is_unique[usuarios.nombreUsuario]',
        'errors' => [
          'required' => 'Este campo es obligatorio.',
          'is_unique' => 'Nombre de usuario ya existe.',
        ],
      ],
      'idRol' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Este campo es obligatorio.',
        ],
      ],
      'estado' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Este campo es obligatorio.',
        ],
      ],
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Este Campo es Obligatorio.',
        ],
      ],
      'repassword' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => 'Este Campo es Obligatorio.',
          'matches' => 'Las Contraseñas No Coinciden.',
        ],
      ],
    ];

    $this->reglasRegistro = [
      'nombre' => [
        'rules' => 'required|is_unique[usuarios.nombreUsuario]',
        'errors' => [
          'required' => 'El campo Nombre de Usuario es obligatorio.',
          'is_unique' => 'Nombre de usuario ya existe.',
        ],
      ],
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'El Campo Contraseña es Obligatorio.',
        ],
      ],
      'repassword' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => 'El Campo Repetir Contraseña es Obligatorio.',
          'matches' => 'Las Contraseñas No Coinciden.',
        ],
      ],
    ];

    $this->reglasPassword = [
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'El Campo Contraseña es Obligatorio.',
        ],
      ],
      'repassword' => [
        'rules' => 'required|matches[password]',
        'errors' => [
          'required' => 'El Campo Repetir Contraseña es Obligatorio.',
          'matches' => 'Las Contraseñas No Coinciden.',
        ],
      ],
    ];
  }

  public function index()
  {
    if ($this->session->idRol >= 2) {
      $usuarios = $this->usuarios->consultar();
      $buscarUsuarios = $this->usuarios->consultar();
      $data = ['datos' => $usuarios, 'buscarUsuarios' => $buscarUsuarios];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('usuarios/usuarios', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function buscar()
  {
    if ($this->session->idRol >= 2) {
      $estado = $this->request->getPost('estado');
      $usuario = $this->request->getPost('idUsuario');
      if (isset($estado)) {
        $usuarios = $this->usuarios
          ->where('estadoUsuario', $estado)
          ->join('roles', 'roles.idRol=usuarios.idRol')
          ->findAll();
      } elseif (isset($usuario)) {
        $usuarios = $this->usuarios
          ->where('idUsuario', $usuario)
          ->join('roles', 'roles.idRol=usuarios.idRol')
          ->findAll();
      }

      $buscarUsuarios = $this->usuarios->consultar();
      $data = ['datos' => $usuarios, 'buscarUsuarios' => $buscarUsuarios];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('usuarios/usuarios', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function nuevo()
  {
    if ($this->session->idRol >= 2) {
      $rolUsuario = $this->RolesModel->consultar();
      $data = ['datos' => $rolUsuario];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('usuarios/nuevo', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function insertar()
  {
    $idUsuario = $this->usuarios->numeroNuevoUsuario();
    $idUsuario = intval($idUsuario['idUsuario']) + 1;
    $estado = $this->request->getPost('estado');
    $rol = $this->request->getPost('idRol');

    if (!isset($this->session->idRol)) {
      if ($this->validate($this->reglasRegistro)) {
        $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $guardarUsuario = [
          'idUsuario' => $idUsuario,
          'nombreUsuario' => $this->request->getPost('nombre'),
          'password' => $hash,
          'idRol' => 1,
          'estadoUsuario' => 'Activo',
        ];
        $guardarDeudor = [
          'idUsuario' => $idUsuario,
          'nombres' => $this->request->getPost('nombre'),
        ];
        $this->usuarios->guardar($guardarUsuario);
        $this->deudores->crear($guardarDeudor);

        $data['ingresar'] = 'Cuenta Registrada, Ingresar';
        return view('login', $data);
      } else {
        $data = ['validation' => $this->validator];
        return view('signup', $data);
      }
    } elseif (isset($this->session->idRol) >= 2) {
      if ($this->validate($this->reglasNuevo)) {
        $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $guardar = [
          'idUsuario' => $idUsuario + 1,
          'nombreUsuario' => $this->request->getPost('nombre'),
          'password' => $hash,
          'idRol' => $rol,
          'estadoUsuario' => $estado,
        ];

        $this->usuarios->guardar($guardar);
        return redirect()->to(base_url('/usuarios'));
      } else {
        $rolUsuario = $this->RolesModel->consultar();
        $data = ['datos' => $rolUsuario, 'validation' => $this->validator];

        $vistas = view('plantillas/header', $this->tienePermisos) . View('usuarios/nuevo', $data) . view('plantillas/footer');

        return $vistas;
      }
    }
  }

  public function editar($id)
  {
    if ($this->session->idRol >= 2) {
      $usuario = $this->usuarios->editar($id);
      $rolUsuario = $this->RolesModel->consultar();
      $data = ['datos' => $usuario, 'roles' => $rolUsuario];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('usuarios/editar', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function actualizar()
  {
    $idUsuario = ['idUsuario' => $this->request->getPost('idUsuario')];

    $actualizar = [
      'nombreUsuario' => $this->request->getPost('nombre'),
      'idRol' => $this->request->getPost('idRol'),
      'estadoUsuario' => $this->request->getPost('estado'),
    ];

    $this->usuarios->actualizar($actualizar, $idUsuario);
    return redirect()->to(base_url('/usuarios'));
  }

  public function eliminar($id)
  {
    if ($this->session->idRol >= 2) {
      $this->usuarios->update($id, ['estadoUsuario' => 'Eliminado']);
      return redirect()->to(base_url('/usuarios'));
    } else {
      return redirect()->to(base_url());
    }
  }

  public function reingresar($id)
  {
    if ($this->session->idRol >= 2) {
      $this->usuarios->update($id, ['estadoUsuario' => 'Inactivo']);
      return redirect()->to(base_url('/usuarios'));
    } else {
      return redirect()->to(base_url());
    }
  }

  public function valida()
  {
    if ($this->request->getMethod() == "post" && $this->validate($this->reglasLogin)) {
      $usuario = $this->request->getPost('usuario');
      $password = $this->request->getPost('password');
      $datoUsuario = $this->usuarios->login($usuario);

      if ($datoUsuario != null) {
        if (password_verify($password, $datoUsuario['password'])) {
          $this->session->set($datoUsuario);

          if ($this->session->estadoUsuario === 'Activo' && $this->session->nombreRol === 'Deudor') {
            return redirect()->to(base_url('deudores/registroInfo'));
          } elseif ($this->session->estadoUsuario === 'Inactivo' && $this->session->nombreRol === 'Deudor') {
            $data['error'] = 'Usuario Inactivo';
            return view('login', $data);
          }elseif ($this->session->estadoUsuario === 'Eliminado' && $this->session->nombreRol === 'Deudor') {
            $data['error'] = 'Usuario Eliminado';
            return view('login', $data);
          } elseif ($this->session->estadoRol === 'Inactivo' && $this->session->nombreRol === 'Deudor') {
            $data['error'] = 'Créditos Fuera de Servicio';
            return view('login', $data);
          } elseif ($this->session->estadoUsuario === 'Activo' && $this->session->nombreRol === 'Admin') {
            return redirect()->to(base_url('usuarios'));
          } elseif ($this->session->estadoUsuario === 'Inactivo' && $this->session->nombreRol === 'Admin') {
            $data['error'] = 'No Tiene Permiso para Acceder como Administrador';
            return view('login', $data);
          }
        } else {
          $data['error'] = 'Contraseña Incorrecta';
          return view('login', $data);
        }
      } else {
        $data['error'] = 'El Usuario No Existe';
        return view('login', $data);
      }
    } else {
      $data = ['validation' => $this->validator];
      return view('login', $data);
    }
  }

  public function salir()
  {
    $session = session();
    $session->destroy();
    return redirect()->to(base_url());
  }

  public function cambia_password()
  {
    if ($this->session->idRol >= 2) {
      $vistas = view('plantillas/header', $this->tienePermisos) . View('usuarios/cambia_password') . view('plantillas/footer');

      return $vistas;
    } elseif ($this->session->idRol == 1) {
      $vistas = view('plantillas/headerDeudores', $this->tienePermisos) . View('usuarios/cambia_password') . view('plantillas/footer');
      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function actualiza_password()
  {
    if ($this->request->getMethod() == "post" && $this->validate($this->reglasPassword)) {
      $session = session();
      $idUsuario = $session->idUsuario;

      $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

      $this->usuarios->update($idUsuario, ['password' => $hash]);

      $session = session();
      $usuario = $this->usuarios->where('idUsuario', $session->idUsuario)->first();
      $rolUsuario = $this->RolesModel->consultar();
      $data = ['datos' => $rolUsuario, 'usuario' => $usuario, 'mensaje' => 'Contraseña Actualizada.'];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('usuarios/cambia_password', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      $usuario = $this->usuarios->where('idUsuario', $this->session->idUsuario)->first();
      $data = ['usuario' => $usuario, 'validation' => $this->validator];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('usuarios/cambia_password', $data) . view('plantillas/footer');

      return $vistas;
    }
  }

  public function eliminados()
  {
    if ($this->session->idRol >= 2) {
      $usuarios = $this->usuarios->eliminados();
      $data = ['datos' => $usuarios];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('usuarios/eliminados', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function buscarEliminados()
  {
    $usuario = $this->request->getPost('usuarios');
    $buscarEliminados = $this->usuarios->where('idUsuario', $usuario)->findAll();

    $data = ['datos' => $buscarEliminados];

    $vistas = view('plantillas/header', $this->tienePermisos) . View('usuarios/eliminados', $data) . view('plantillas/footer');

    return $vistas;
  }
}
