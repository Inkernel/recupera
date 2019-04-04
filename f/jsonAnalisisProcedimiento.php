<?php

require_once '../includes/database.php';
require '../p/libreriaP.php';
$db = new libreria();

$result = $db->getAnalisisAccion();

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
            'direccion' => $r['direccion'],
            'presuntos' => $r['presuntos'],
            'fecha_edo_tramite' => $r['fecha_edo_tramite'],
            'estado' => $estado
        );
           		
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>