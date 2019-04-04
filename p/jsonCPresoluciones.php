<?php

require_once 'database.php';
require 'libreriaP.php';
$db = new libreria();

$abstencion = 0;
$responsabilidad = 0;
$sancion = 0;
$sobresiomiento = 0;

$iniciados = 0;
$impugnados = 0;
$resolucionesNoti = 0;
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
        $data[] = array(
            'cp' => $r['cp'],
            'Abstención de sanción' => $r['abstencion'],
            'Existencia responsabilidad' => $r['responsabilidad'],
            'Sin sanción' => $r['sancion'],
            'Sobreseimiento' => $r['sobresiomiento'],
            'Resoluciones notificadas' => $r['resolucionesNoti']

        );
        $abstencion += $r['abstencion'];
        $responsabilidad += $r['responsabilidad'];
        $sancion += $r['sancion'];
        $sobresiomiento += $r['sobresiomiento'];

        $iniciados += $r['iniciados'];
        $impugnados += $r['impugnados'];
        $resolucionesNoti += $r['resolucionesNoti'];
        $responsabilidadRes += $r['responsabilidadRes'];
        $acuerdo += $r['acuerdo'];
        $asistencia += $r['asistencia'];
    }
    $data[] = array(
        'cp' => 'suma',
        'Abstención de sanción' => $abstencion,
        'Existencia responsabilidad' => $responsabilidad,
        'Sin sanción' => $sancion,
        'Sobreseimiento' => $sobresiomiento,
        'Resoluciones notificadas' => $resolucionesNoti

    );
}
echo json_encode($data);				   
Database::disconnect();
	
?>