<?php

require_once '../includes/database.php';
require '../i/libreriaX.php';
$db = new libreria();

$result = $db->getRR();
$data = array();
if ($result == "{}") {
    $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        $data[] = array(
            'num_accion' => $r['num_accion'],
            'entidad' => $r['entidad'],		
            'cp' => $r['cp'],
            'cont' => $r['cont'],
            'actor' => $r['actor'],
            'recurso_reconsideracion' => $r['recurso_reconsideracion'],
            'monto_no_solventado' => number_format(floatval($r['monto_no_solventado'])),
            'detalle_edo_tramite' => $db->dameEstado($r['detalle_edo_tramite']),
            'entidadA' => $r['entidadA']	
	
        );
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>

