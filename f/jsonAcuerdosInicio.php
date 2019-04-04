<?php

require_once '../includes/database.php';
require '../p/libreriaP.php';
$db = new libreria();

$result = $db->getAcuerdosInicio();

$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        switch ($r['detalle_edo_tramite']){
            case 15:
                $estado = 'En proceso';
                break;
            case 30:
                $estado = 'Iniciado';
                break;
            default:
                $estado = 'Error';
        }

        $data[] = array(
            'cp' => $r['cp'],		
            'entidad' => mb_substr($r['entidad'],0,40), 
            'num_accion' => $r['num_accion'],
            'num_procedimiento' => $r['num_procedimiento'],
            'nombre' => $r['nombre'],
            'fecha_acuerdo_inicio' => $r['fecha_acuerdo_inicio'],
            'subnivel' => substr($r['subnivel'],0,3),
            'usuario' => $r['usuario'],
            'estado' => $estado,
            'detalle_edo_tramite' => $r['detalle_edo_tramite']
        );
           		
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>