<?php

require_once '../p/database.php';
require '../p/libreriaP.php';
$db = new libreria();

$result = $db->getPFRRdesahogos();

$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        switch ($r['detalle_edo_tramite']){
            case 16:
                $estado = 'Notificado inicio';
                break;
            case 17:
                $estado = 'Desahogo audiencia';
                break;
            case 18:
                $estado = 'Desahogo pruebas';
                break;
            case 19:
                $estado = 'Opinion UAA';
                break;
            case 22:
                $estado = 'Elaboración resolución';
                break;
            case 28:
                $estado = 'Última actuación';
                break;
            case 29:
                $estado = 'Emision resolución';
                break;
            case 31:
                $estado = 'Periodo alegatos';
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
            'fecha_edo_tramite' => $r['fecha_edo_tramite'],
            'cierre_instruccion' => $r['cierre_instruccion'],
            'fecha_acuerdo_inicio' => $r['fecha_acuerdo_inicio'],
            'detalle_edo_tramite' => $r['detalle_edo_tramite'],
            
            'estado' => $estado
        );
           		
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>