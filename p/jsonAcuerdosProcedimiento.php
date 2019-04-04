<?php

require_once 'database.php';
require 'libreriaP.php';
$db = new libreria();

$abstencion = 0;
$responsabilidad = 0;
$sancion = 0;
$sobresiomiento = 0;
$resolucionesNoti = 0;

$acuerdo = 0;
$iniciado = 0;
$acuerdoInicio = 0;

$iniciados = 0;
$impugnados = 0;
$responsabilidadRes = 0;
$acuerdo = 0;
$asistencia = 0;

$data = 'getPFRRcontrol';
$result = $db->$data();
$i = 1;
$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        if ($r['cp'] > '2012'){
            $data[] = array(
            'cp' => $r['cp'],
            'Proceso elaboración' => $r['acuerdo'],
            'Oficio Notificación' => $r['iniciado'],
            'Acuerdo Inicio' => $r['acuerdoInicio']

        );
        }
        $abstencion += $r['abstencion'];
        $responsabilidad += $r['responsabilidad'];
        $sancion += $r['sancion'];
        $sobresiomiento += $r['sobresiomiento'];

        $acuerdo += $r['acuerdo'];
        $iniciado += $r['iniciado'];
        $acuerdoInicio += $r['acuerdoInicio'];
        
        $iniciados += $r['iniciados'];

        $impugnados += $r['impugnados'];
        $resolucionesNoti += $r['resolucionesNoti'];
        $responsabilidadRes += $r['responsabilidadRes'];
        $asistencia += $r['asistencia'];
    }
    $data[] = array(
        'cp' => 'suma',

        'Proceso elaboración' =>  $acuerdo,
        'Oficio Notificación' => $iniciado,
        'Acuerdo Inicio' => $acuerdoInicio

    );
}
echo json_encode($data);				   
Database::disconnect();
	
?>