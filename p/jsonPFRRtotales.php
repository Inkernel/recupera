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
$acuerdoInicio = 0;
$iniciados = 0;


$dInicio = 0;
$dAudiencia = 0;
$dPruebas = 0;
$dOpinion = 0;
$dElaboracion = 0;
$dActualizacion = 0;
$dEmision = 0;
$dAlegato = 0;
$desahogo = 0;


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
            'Iniciados' => $r['desahogo']+ $r['resolucionesNoti'],
            'En Proceso Desahogo' => $r['desahogo'],
            'Con Resolución' => $r['resolucionesNoti'],


            
            'Asistencia' => $r['asistencia'],
            'Solventación PO' => $r['solventacion'],

            'Acuerdo archivo' => $r['archivo'],
            'Devolución ET' => $r['devuelto'],
            'Acuerdo Inicio' => $r['acuerdoInicio']


        );
        $abstencion += $r['abstencion'];
        $responsabilidad += $r['responsabilidad'];
        $sancion += $r['sancion'];
        $sobresiomiento += $r['sobresiomiento'];
        $resolucionesNoti += $r['resolucionesNoti'];


        $acuerdo += $r['acuerdo'];
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



        
        $iniciados += $r['desahogo']+ $r['resolucionesNoti'];



        $asistencia += $r['asistencia'];
        $archivo += $r['archivo'];
        $devuelto += $r['devuelto'];
        $solventacion += $r['solventacion'];
        $expediente += $r['expediente'];



    }
    $data[] = array(
        'cp' => 'suma',
        'Iniciados' => $desahogo + $resolucionesNoti,
        'En Proceso Desahogo' => $desahogo,
        'Con Resolución' => $resolucionesNoti,




        'Asistencia' => $asistencia,
        'Solventación PO' => $solventacion,

        'Acuerdo archivo' => $archivo,
        'Devolución ET' => $devuelto,
        'Acuerdo Inicio' => $acuerdoInicio



    );
}
echo json_encode($data);				   
Database::disconnect();
	
?>