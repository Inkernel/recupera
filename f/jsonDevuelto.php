<?php

require_once '../includes/database.php';
require '../p/libreriaP.php';
$db = new libreria();

$result = $db->getDevueltoAccion();
$tipo = 'asistencia';

$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        $data[] = array(
            'cp' => $r['cp'],		
            'entidad' => mb_substr($r['entidad'],0,40), 
            'num_accion' => $r['num_accion'],
            'auditoria' => $r['auditoria'],
            'subnivel' => substr($r['subnivel'],0,3),
            'fecha_IR' => $r['fecha_IR'],
            'cinco' => date("Y-m-d",strtotime($r['fecha_IR']."+ 5 year 1 day")),
            'uaa' => $db->dameUAA($r['num_accion']),
            'devolucion' => $db->dameOficioAcuse( $tipo, $r['detalle_edo_tramite'], $r['num_accion']),
            'direccion' => $r['direccion'],
            'monto_no_solventado' => number_format(floatval($r['monto_no_solventado'])),

            'presuntos' => $r['presuntos'],
            'fecha_edo_tramite' => $r['fecha_edo_tramite'],
            'detalle_edo_tramite' => $r['detalle_edo_tramite'],
            'estado' => $db->dameEstado($r['detalle_edo_tramite'])
        );
           		
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>