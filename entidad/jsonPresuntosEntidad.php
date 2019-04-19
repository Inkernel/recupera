<?php

require_once 'api/database.php';
require 'api/libreriaX.php';
$db = new libreria();

$result = $db->getPresuntosEntidad();

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
            'dependencia' => $r['dependencia'],
            'tipo' => $r['tipo'],
            'resarcido' => $r['resarcido'],
            'monto' => $r['monto'],
            'status' => $r['status']
        );
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>