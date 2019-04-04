<?php

require_once '../includes/database.php';
require '../p/libreriaP.php';
$db = new libreria();

$result = $db->getPFRRacuerdos();

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
            'domicilio' => $r['domicilio'],
            'dependencia' => $r['dependencia'],
            'fecha_acuerdo_inicio' => $r['fecha_acuerdo_inicio'],
            'estado' => $estado
        );
           		
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>