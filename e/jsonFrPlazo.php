<?php

require_once 'database.php';
require 'libreria.php';
$db = new libreria();

$result = $db->getPFRRplazo();

$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {


        $difEmi = ($r['difEmiRes'] <= 90) ? "Si" : "No";
        $difNot = ($r['difNotRes'] <= 10) ? "Si" : "No";
        if ($r['detalle_edo_tramite'] == 26) {
            $error = date_create(date("Y-m-d",strtotime($r['cierre_instruccion']."+ 45 day")));
            $limite = $error->format('Y-m-d');
        }  else {
            $limite = $r['limite_emision_resolucion'];
        }
        
        $estado = str_replace("Resolución Notificada.","",$db->dameEstado($r['detalle_edo_tramite']));

        $data[] = array(
            'entidad' => mb_substr($r['entidad'],0,20),
            'num_accion' => $r['num_accion'],
            'num_procedimiento' => $r['num_procedimiento'],
            'direccion' => mb_substr($r['direccion'],0,30),
            'po' => $r['po'],		
            'limite_emision_resolucion' => $limite,
            'resolucion' => $r['resolucion'],
            'limite_cierre_instruccion' => $r['limite_cierre_instruccion'],
            'limite_notificacion_resolucion' => $r['limite_notificacion_resolucion'],
            'fecha_notificacion_resolucion' => $r['fecha_notificacion_resolucion'],
            'cierre_instruccion' => $r['cierre_instruccion'],

            'difEmiRes' => $r['difEmiRes'],
            'difEmi' => $difEmi,
           
            'difNotRes' => $r['difNotRes'],
            'difNot' => $difNot,


            'cp' => $r['cp'],		
            'subdirector' => $r['subdirector'],
            'abogado' => $r['abogado'],
            'estado' => $estado,
            'detalle_edo_tramite' => $r['detalle_edo_tramite'],

            'prescripcion' => $r['prescripcion'],
            'limite_cierre_instruccion' => $r['limite_cierre_instruccion'],
            'subnivel' => substr($r['subnivel'],0,3)

           );
           		
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>