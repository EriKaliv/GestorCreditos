<?php

namespace App\Controllers;
use App\Models\CreditosModel;
use App\Models\DesembolsosModel;
use App\Models\DeudoresModel;
use App\Models\Permisos_RolesModel;
use App\Models\Historial_CreditoModel;

class Creditos extends PermisosController
{
  protected $creditos, $desembolsos, $deudores, $permisosRoles, $tienePermisos, $historialCredito;

  protected $reglas;

  public function __construct()
  {
    $this->creditos = new CreditosModel();
    $this->desembolsos = new DesembolsosModel();
    $this->deudores = new DeudoresModel();
    $this->permisosRoles = new Permisos_RolesModel();
    $this->historialCredito = new Historial_CreditoModel();

    $this->session = session();

    $nombreDeudor = $this->deudores->consultarId($this->session->idUsuario);
    $this->tienePermisos = ['permiso' => $this->permiso(), 'nombreDeudor' => $nombreDeudor['nombres'].' '.$nombreDeudor['apellidos'], 'nombreUsuario' => $this->session->nombreUsuario, 'nombreRol' => $this->session->nombreRol];

    $this->reglas = [
      'cupo' => [
        'rules' => 'required|min_length[7]',
        'errors' => [
          'required' => 'El campo <span class="font-weight-bold">Valor del Crédito</span> es obligatorio.',
          'min_length' => 'El campo <span class="font-weight-bold">Valor del Crédito</span> debe tener almenos 6 numeros.'
        ],
      ],

      'frecuencia' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'El campo <span class="font-weight-bold">Frecuencia de Pago</span> es obligatorio.'
        ],
      ],

      'cuotas' => [
        'rules' => 'required|greater_than[0]',
        'errors' => [
          'required' => 'El campo <span class="font-weight-bold">Número de Pagos</span> es obligatorio.',
          'greater_than' => 'El campo <span class="font-weight-bold">Número de Pagos</span> debe ser mayor a 0.'
        ],
      ],
    ];
  }

  public function index()
  {
    if ($this->session->idRol >= 2) {
      $idUltimoCredito = $this->creditos->numeroCredito();
      $numeroCredito = intval($idUltimoCredito['idcreditos']) + 1;
      $creditos = $this->creditos->consultar();
      $deudores = $this->deudores->consultar();
      $BuscarDeudores = $this->deudores->consultar();
      $data = ['datos' => $creditos, 'deudores' => $deudores, 'BuscarDeudores' => $BuscarDeudores, 'numeroCredito' => $numeroCredito];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('creditos/creditos', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function buscar()
  {
    if ($this->session->idRol >= 2) {
      $estado = ['estado' => $this->request->getPost('estado')];
      $deudor = ['idDeudor' => $this->request->getPost('deudor')];

      if (isset($estado['estado'])) {
        $datos = $this->creditos->buscar($estado);
      } elseif (isset($deudor['idDeudor'])) {
        $datos = $this->creditos->buscar($deudor);
      }

      $deudores = $this->deudores->consultar();
      $BuscarDeudores = $this->deudores->consultar();
      $data = ['datos' => $datos, 'deudores' => $deudores, 'BuscarDeudores' => $BuscarDeudores];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('creditos/creditos', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function helperCreditos()
  {
    if($this->validate($this->reglas)){
    $tasa = $this->request->getPostGet('tasa');
    $cupo = $this->request->getPostGet('cupo');
    $frecuencia = $this->request->getPostGet('frecuencia');
    $cuotas = $this->request->getPostGet('cuotas');

    $valoresCredito = calculoCredito($tasa, $cupo, $cuotas, $frecuencia);

    $this->valoresCredito = json_encode($valoresCredito);
    }else{
      echo json_encode($this->validator->getErrors());
    }
  }

  public function nuevoCredito()
  {
    if ($this->session->idRol == 1) {
      $id = $this->session->idUsuario;
      $idDeudor = $this->deudores->consultarId($id);
    
      $idUltimoCredito = $this->creditos->numeroCredito();
      $numeroCredito = intval($idUltimoCredito['idcreditos']) + 1;

      $data = ['idDeudor' => $idDeudor, 'numeroCredito' => $numeroCredito];

      $vistas = view('plantillas/headerDeudores', $this->tienePermisos) . View('deudores/nuevoCredito', $data) . view('plantillas/footer');

      return $vistas; 
    } else {
      return redirect()->to(base_url());
    }
  }

  public function crear()
  {
    $datos = [
      'idDeudor' => $this->request->getPost('idDeudor'),
      'valorProyectar' => intval(str_replace(["$", "."], "", $this->request->getPost('valorProyectar'))),
      'tasa' => $this->request->getPost('tasa'),
      'cupo' => intval(str_replace(["$", "."], "", $this->request->getPost('cupo'))),
      'frecuencia' => $this->request->getPost('frecuencia'),
      'cuotas' => $this->request->getPost('cuotas'),
      'valorCuota' => intval(str_replace(["$", "."], "", $this->request->getPost('valorCuota'))),
      'estadoCredito' => 'En Solicitud',

      'transferencia' => intval(str_replace(["$", "."], "", $this->request->getPost('transferencia'))),
      'ivaTransferencia' => intval(str_replace(["$", "."], "", $this->request->getPost('ivaTransferencia'))),
      'cuatroxmil' => intval(str_replace(["$", "."], "", $this->request->getPost('cuatroxmil'))),
      'recaudo1' => intval(str_replace(["$", "."], "", $this->request->getPost('recaudo1'))),
      'ivaRecaudo1' => intval(str_replace(["$", "."], "", $this->request->getPost('ivaRecaudo1'))),
      'cobranza' => intval(str_replace(["$", "."], "", $this->request->getPost('cobranza'))),
      'ivaCobranza' => intval(str_replace(["$", "."], "", $this->request->getPost('ivaCobranza'))),
      'recaudo2' => intval(str_replace(["$", "."], "", $this->request->getPost('recaudo2'))),
      'ivaRecaudo2' => intval(str_replace(["$", "."], "", $this->request->getPost('ivaRecaudo2'))),
      'software' => intval(str_replace(["$", "."], "", $this->request->getPost('software'))),
    ];

    $id = $this->session->idRol;
    if($id === '1')
    {
      $infoCompleta = $this->deudores->infoCompleta($this->request->getPost('idDeudor'));

      if ($infoCompleta == 14)
      {
        if($this->validate($this->reglas)){
    
          $datos = $this->creditos->crear($datos);
          $saldo = $this->historialCredito->crearSaldo();
          echo json_encode('Crédito Solicitado');

        } else {
          echo json_encode($this->validator->getErrors());
        }
      }else if ($infoCompleta < 14){
        echo json_encode('infoIncompleta');
      }

    } else {

      if($this->validate($this->reglas))
      {
        $datos = $this->creditos->crear($datos);
        echo json_encode('Crédito Solicitado');

      } else {
        echo json_encode($this->validator->getErrors());
      }
    }
  
  }

  public function editar($id)
  {
    if ($this->session->idRol >= 2) {
      $credito = $this->creditos->editar($id);
      $historialCredito = $this->historialCredito->consultar($id);
      $data = ['credito' => $credito, 'historialCredito' => $historialCredito];

      $vistas = view('plantillas/header', $this->tienePermisos) . View('creditos/editar', $data) . view('plantillas/footer');
      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function actualizar()
  {
    $idCredito = $this->request->getPostGet('numeroCredito');
    $actualizar = [
      'estadoCredito' => $this->request->getPostGet('estado'),
    ];

    if ($actualizar['estadoCredito'] === 'Desembolsado') {
      $caja = $this->request->getPostGet('caja');
      $monto = $this->request->getPostGet('cupo');
      $this->creditos->actualizar($idCredito, $actualizar);
      $this->desembolsos->crear($idCredito, $caja, $monto);
      $this->historialCredito->crear($idCredito);

      return redirect()->to(base_url("creditos"));
    } else {
      $this->creditos->actualizar($idCredito, $actualizar);
      return redirect()->to(base_url("/creditos/editar/") . '/' . $idCredito);
    }
  }

  public function misCreditos()
  {
    if ($this->session->idRol == 1) {
      $id = $this->session->idUsuario;
      $idDeudor = $this->deudores->consultarId($id);
      $idDeudor = ['idDeudor' => $idDeudor['idDeudor']];
      $creditos = $this->creditos->buscar($idDeudor);

      $data = ['creditos' => $creditos];
      $vistas = view('plantillas/headerDeudores', $this->tienePermisos) . View('deudores/creditosDeudor', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function verCredito($id)
  {
    if ($this->session->idRol == 1) {
      $credito = $this->creditos->editar($id);
      $historialCredito = $this->historialCredito->consultar($id);
      $data = ['credito' => $credito, 'historialCredito' => $historialCredito];
      $vistas = view('plantillas/headerDeudores', $this->tienePermisos) . View('deudores/verCredito', $data) . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function ConsultarCajas()
  {
    $cajas = $this->creditos->ConsultarCajas();
    echo json_encode($cajas);
  }

  public function intereses()
  {
    if ($this->session->idRol >= 2) {
      $vistas = view('plantillas/header', $this->tienePermisos) . View('intereses/intereses') . view('plantillas/footer');

      return $vistas;
    } else {
      return redirect()->to(base_url());
    }
  }

  public function generarInteres()
  {
    if ($this->session->idRol >= 2) {
      $fecha = $this->request->getPostGet('fecha');
      $frecuencia = $this->request->getPostGet('frecuencia');
      $this->historialCredito->generarInteres($fecha, $frecuencia);

      return redirect()->to(base_url("creditos/intereses"));
    } else {
      return redirect()->to(base_url());
    }
  }
}
