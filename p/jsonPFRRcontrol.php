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


$acciones = 0;
$acuerdo = 0;

$asistencia = 0;
$archivo = 0;
$devuelto = 0;
$solventacion = 0;
$expediente = 0;


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
            'Acciones' => $r['acciones'],
            'Abstención de sanción' => $r['abstencion'],
            'Existencia responsabilidad' => $r['responsabilidad'],
            'Sin sanción' => $r['sancion'],
            'Sobreseimiento' => $r['sobresiomiento'],
            'Resoluciones notificadas' => $r['resolucionesNoti'],

            'Proceso elaboración' => $r['acuerdo'],
            'Oficio Notificación' => $r['iniciado'],
            'Acuerdo Inicio' => $r['acuerdoInicio'],

            'Notificado inicio' => $r['dInicio'],
            'Desahogo audiencia' => $r['dAudiencia'],
            'Desahogo pruebas' => $r['dPruebas'],
            'Opinion UAA' => $r['dOpinion'],
            'Elaboración resolución' => $r['dElaboracion'],
            'Última actuación' => $r['dActualizacion'],
            'Emision resolución' => $r['dEmision'],
            'Periodo alegatos' => $r['dAlegato'],
            'Desahogo Procedimiento' => $r['desahogo'],
            
            'Asistencia' => $r['asistencia'],
            'Acuerdo archivo' => $r['archivo'],
            'Devolución ET' => $r['devuelto'],
            'Solventación PO' => $r['solventacion'],
            'Dictamen Técnico' => $r['expediente']

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



        
        $acciones += $r['acciones'];


        $asistencia += $r['asistencia'];
        $archivo += $r['archivo'];
        $devuelto += $r['devuelto'];
        $solventacion += $r['solventacion'];
        $expediente += $r['expediente'];



    }
    $data[] = array(
        'cp' => 'suma',
        'Acciones' => $acciones,
        'Abstención de sanción' => $abstencion,
        'Existencia responsabilidad' => $responsabilidad,
        'Sin sanción' => $sancion,
        'Sobreseimiento' => $sobresiomiento,
        'Resoluciones notificadas' => $resolucionesNoti,

        'Proceso elaboración' =>  $acuerdo,
        'Oficio Notificación' => $iniciado,
        'Acuerdo Inicio' => $acuerdoInicio,

        'Notificado inicio' => $dInicio,
        'Desahogo audiencia' => $dAudiencia,
        'Desahogo pruebas' => $dPruebas,
        'Opinion UAA' => $dOpinion,
        'Elaboración resolución' => $dElaboracion,
        'Última actuación' => $dActualizacion,
        'Emision resolución' => $dEmision,
        'Periodo alegatos' => $dAlegato,
        'Desahogo Procedimiento' => $desahogo,


        'Asistencia' => $asistencia,
        'Acuerdo archivo' => $archivo,
        'Devolución ET' => $devuelto,
        'Solventación PO' => $solventacion,
        'Dictamen Técnico' => $expediente


    );
}
echo json_encode($data);				   
Database::disconnect();
	
?>