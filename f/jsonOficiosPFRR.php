<?php

require_once '../includes/database.php';
require '../p/libreriaP.php';
$db = new libreria();

$result = $db->getOficiosPFRR();

$data = array();
if ($result == "{}") {
    $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {

        $data[] = array(
            'folio' => $r['folio'],		
            'fecha_oficio' => $r['fecha_oficio'],
            'num_accion' => $r['num_accion'],
            'destinatario' => $r['destinatario'],
            'dependencia' => $r['dependencia'],
            'tramite' => $r['tipo'],
            'oficio_referencia' => $r['oficio_referencia']
        );
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>