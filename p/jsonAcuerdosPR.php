<?php

require_once 'database.php';
require 'libreriaP.php';
$db = new libreria();
$presuntos = 0;

$abstencion = 0;
$responsabilidad = 0;
$sancion = 0;
$sobresiomiento = 0;
$resoluciones = 0;

$acuerdo = 0;
$iniciado = 0;
$acuerdoInicio = 0;


$noSolventado = 0;
$acuerdoArchivo = 0;
$devolucionExpediente = 0;
$solventacionPO = 0;

$dInicio = 0;
$dAudiencia = 0;
$dOpinion = 0;
$dElaboracion = 0;
$dActualizacion = 0;
$dEmision = 0;
$dAlegato = 0;
$resolcion = 0;
$rExistencia = 0;


$data = 'getPFRRresponsables';
$result = $db->$data();
$i = 1;
$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        if ($r['cp'] > '2012'){
        $data[] = array(
            'CP' => $r['cp'],
            'Proceso elaboración' => $r['acuerdo'],
            'Oficio Notificación' => $r['iniciado'],
            'Acuerdo Inicio' => $r['acuerdoInicio']
     

        );
    }
        $presuntos += $r['presuntos'];
        $abstencion += $r['abstencion'];
        $responsabilidad += $r['responsabilidad'];
        $sancion += $r['sancion'];
        $sobresiomiento += $r['sobresiomiento'];
        $resoluciones += ($r['abstencion']+$r['sobresiomiento']+$r['responsabilidad']+$r['sancion']);
        $noSolventado += $r['noSolventado'];
        $devolucionExpediente += $r['devolucionExpediente'];
        $solventacionPO += $r['solventacionPO'];
        $acuerdo += $r['acuerdo'];
        $iniciado += $r['iniciado'];
        $acuerdoInicio += $r['acuerdoInicio'];

        $dInicio += $r['dInicio'];
        $dAudiencia += $r['dAudiencia'];
        $dOpinion += $r['dOpinion'];
        $dElaboracion += $r['dElaboracion'];
        $dActualizacion += $r['dActualizacion'];
        $dEmision += $r['dEmision'];
        $dAlegato += $r['dAlegato'];
        $resolcion += $r['resolcion'];
        $rExistencia += $r['rExistencia'];
    }
    $data[] = array(
        'CP' => 'suma',
        'Proceso elaboración' => $acuerdo,
        'Oficio Notificación' => $iniciado,
        'Acuerdo Inicio' => $acuerdoInicio

    );
}
echo json_encode($data);				   
Database::disconnect();
	
?>