<?php

require_once '../includes/database.php';
require '../p/libreriaP.php';
$db = new libreria();

$result = $db->getAccionResoluciones();

$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        switch ($r['detalle_edo_tramite']){
            case 23:
                $estado = 'Abstención de sanción';
                break;
            case 24:
                $estado = 'Con responsabilidad';
                break;
            case 25:
                $estado = 'Sin sanción';
                break;
            case 26:
                $estado = 'Sobreseimiento';
                break;
            default:
                $estado = 'Error';
        }

        $data[] = array(
            'cp' => $r['cp'],		
            'entidad' => mb_substr($r['entidad'],0,40),
            'num_accion' => $r['num_accion'],
            'num_procedimiento' => $r['num_procedimiento'],
            'monto' => number_format(floatval($r['monto'])),
            'resolucion' => $r['resolucion'],
            'notificacion' => $r['notificacion'],
            'nombre' => $r['nombre'],
            'responsabilidad' => $r['responsabilidad'],
            'estado' => $estado,

        );
           		
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>