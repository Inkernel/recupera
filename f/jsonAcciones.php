<?php

require_once '../includes/database.php';
require '../p/libreriaP.php';
$db = new libreria();

$result = $db->getAcciones();

$data = array();
if ($result == "{}") {
    $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        switch ($r['detalle_edo_tramite']){
            case 11:
                $estado = 'Revisión';
                break;
            default:
                $estado = 'Error';
        }

        $data[] = array(
            'cp' => $r['cp'],		
            'entidad' => mb_substr($r['entidad'],0,40), 
            'num_accion' => $r['num_accion'],
            'auditoria' => $r['auditoria'],
            'subnivel' => substr($r['subnivel'],0,3),
            'num_procedimiento' => $r['num_procedimiento'],
            'fecha_edo_tramite' => $r['fecha_edo_tramite'],
            'detalle_edo_tramite' => $r['detalle_edo_tramite'],
            'estado' => $r['detalle_estado']
        );
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>