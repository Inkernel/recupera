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

$dInicio = 0;
$dAudiencia = 0;
$dPruebas = 0;
$dOpinion = 0;
$dElaboracion = 0;
$dActualizacion = 0;
$dEmision = 0;
$dAlegato = 0;
$desahogo = 0;


$iniciados = 0;
$revision = 0;
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
            'Procedimientos' => $r['desahogo'],

            'Notificado inicio' => $r['dInicio'],
            'Desahogo audiencia' => $r['dAudiencia'],
            'Desahogo pruebas' => $r['dPruebas'],
            'Opinion UAA' => $r['dOpinion'],
            'Elaboración resolución' => $r['dElaboracion'],
            'Última actuación' => $r['dActualizacion'],
            'Emision resolución' => $r['dEmision'],
            'Periodo alegatos' => $r['dAlegato']
            
        );
        $abstencion += $r['abstencion'];
        $responsabilidad += $r['responsabilidad'];
        $sancion += $r['sancion'];
        $sobresiomiento += $r['sobresiomiento'];
        $resolucionesNoti += $r['resolucionesNoti'];


        $acuerdo += $r['acuerdo'];
        $iniciado += $r['iniciado'];
        $acuerdoInicio += $r['acuerdoInicio'];

        $dInicio += $r['dInicio'];
        $dAudiencia += $r['dAudiencia'];
        $dPruebas += $r['dPruebas'];
        $dOpinion += $r['dOpinion'];
        $dElaboracion += $r['dElaboracion'];
        $dActualizacion += $r['dActualizacion'];
        $dEmision += $r['dEmision'];
        $dAlegato += $r['dAlegato'];
        $desahogo += $r['desahogo'];



        
        $iniciados += $r['iniciados'];

        $revision += $r['revision'];
        $responsabilidadRes += $r['responsabilidadRes'];
        $asistencia += $r['asistencia'];
    }
    $data[] = array(
        'cp' => 'suma',
        'Procedimientos' => $desahogo,

        'Notificado inicio' => $dInicio,
        'Desahogo audiencia' => $dAudiencia,
        'Desahogo pruebas' => $dPruebas,
        'Opinion UAA' => $dOpinion,
        'Elaboración resolución' => $dElaboracion,
        'Última actuación' => $dActualizacion,
        'Emision resolución' => $dEmision,
        'Periodo alegatos' => $dAlegato
    );
}
echo json_encode($data);				   
Database::disconnect();
	
?>