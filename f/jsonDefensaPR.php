<?php

require_once '../p/database.php';
require '../p/libreriaP.php';
$db = new libreria();

$result = $db-> getDefensaPR();

$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        switch ($r['et_impugnacion']){
            case 45:
                $estado = 'Resolución Impugnada';
                break;
            case 46:
                $estado = 'Existencia Responsabilidad';
                break;
            case 47:
                $estado = 'Resolución Inexistencia';
                break;
            case 48:
                $estado = 'Resolución Mixta';
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
            'et_impugnacion' => $r['et_impugnacion'],
            
            'estado' => $estado
        );
           		
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>