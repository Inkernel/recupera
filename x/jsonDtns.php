<?php

require_once '../includes/database.php';
require '../i/libreriaX.php';
$db = new libreria();

$result = $db->getDTNS();

$data = array();
if ($result == "{}") {
    $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {

        $data[] = array(
            'num_accion' => $r['num_accion'],		
            'entidad' => $r['entidad'],		
            'nombre' => $r['nombre'],
            'cargo' => $r['cargo'],
            'fondo' => $db->dameFondo($r['num_accion']),
            'cp' => $r['cp'],
            'estado' => $db->dameEstado($r['detalle_edo_tramite']),
            'monto_no_solventado' => number_format(floatval($r['monto_no_solventado']),2),
            'status' => $r['status']
        );
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>

