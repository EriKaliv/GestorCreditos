<?php
/*
| -------------------------------------------------------------------
| Suma el estado de los creditos cobrados y los actores para mostrarlos 
| en una grafica
| -------------------------------------------------------------------
*/

function estados($estados)
{
  $sumeEstados = array_count_values(array_column($estados, 'estado'));
  echo json_encode($sumeEstados);
}

function actores($estadoActores)
{
  $sumeActores = array_count_values(array_column($estadoActores, 'estadoActor'));
  echo json_encode($sumeActores);
}

/*
| -------------------------------------------------------------------
| Calcula el interes mensual y quincenal con la formula pago de Excel
| en formula matematica es =(A1*(1+A1)^B1)*C1/(((1+A1)^B1)-1)
| -------------------------------------------------------------------
*/

function calculoCredito($tasa, $cupo, $cuotas, $frecuencia)
{
  //Cobros Unicos
  $transferencia = 5000;
  $ivaTransf = ($transferencia * 19) / 100;
  $cuatroPorMil = ($cupo * 4) / 1000;

  //Cobros por Cuotas
  $cobranza = $cuotas * 500;
  $ivaCobranza = ($cobranza * 19) / 100;
  $recaudo2 = $cuotas * 900;
  $ivaRecaudo2 = ($recaudo2 * 19) / 100;

  $tasa = $tasa / 100;

  //Calcula la tasa mensual o quincenal
  if ($frecuencia == 'M') {
    //Cobros Tiempo
    $software = $cuotas * 2 * 325;

    //Interes Mensual
    $interes = 1 + $tasa;
    $frecuencia = 1 / 12;
    $intFrecuencia = pow($interes, $frecuencia) - 1;
  } elseif ($frecuencia == 'Q') {
    //Cobros Tiempo
    $software = $cuotas * 325;

    //Interes Quincenal
    $interes = 1 + $tasa;
    $frecuencia = 1 / 24;
    $intFrecuencia = pow($interes, $frecuencia) - 1;
  }

  //Cobros Unicos
  $recuado1 = (($cupo + $transferencia + $ivaTransf + $cuatroPorMil + $cobranza + $ivaCobranza + $recaudo2 + $software) * 2.99) / 100;
  $ivaRecaudo1 = ($recuado1 * 19) / 100;

  $valorProyectar = $cupo + $transferencia + $ivaTransf + $cuatroPorMil + $recuado1 + $ivaRecaudo1 + $cobranza + $ivaCobranza + $recaudo2 + $ivaRecaudo2 + $software;

  //Aplicacion de la formula pago
  $tasa = 1 + $intFrecuencia;
  $tasaCuotas = pow($tasa, $cuotas);
  $tasaCuotas2 = $tasaCuotas - 1;
  $cupoCuotas = $valorProyectar / $tasaCuotas2;
  $intTasa = $intFrecuencia * $tasaCuotas;
  //monto de la cuota
  $cuota = $intTasa * $cupoCuotas;
  $cuota = number_format($cuota, 0, ',', '.');

  $credito = [];
  $credito['proyeccion'] = number_format($valorProyectar, 0, ',', '.');
  $credito['cupo'] = number_format($cupo, 0, ',', '.');
  $credito['cuota'] = $cuota;

  //Cobros Unicos
  $credito['transfer'] = number_format($transferencia, 0, ',', '.');
  $credito['ivaTransf'] = number_format($ivaTransf, 0, ',', '.');
  $credito['cuatroxmil'] = number_format($cuatroPorMil, 0, ',', '.');
  $credito['recaudo1'] = number_format($recuado1, 0, ',', '.');
  $credito['ivaRecaudo1'] = number_format($ivaRecaudo1, 0, ',', '.');

  //Cobros por Cuotas
  $credito['cobranza'] = number_format($cobranza, 0, ',', '.');
  $credito['ivaCobranza'] = number_format($ivaCobranza, 0, ',', '.');
  $credito['recaudo2'] = number_format($recaudo2, 0, ',', '.');
  $credito['ivaRecaudo2'] = number_format($ivaRecaudo2, 0, ',', '.');

  //Cobros Tiempo
  $credito['software'] = number_format($software, 0, ',', '.');

  echo json_encode($credito);
}

?>
