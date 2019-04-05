<?php

require_once '../includes/database.php';
require '../i/libreriaX.php';
$db = new libreria();

$result = $db->getJuiciosNew();
$data = array();
if ($result == "{}") {
    $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {

        $data[] = array(
            'num_accion' => $r['accion'],		
            'entidad' => $r['entidad'],		
            'cp' => $r['cp'],
            'cont' => $r['cont'],
            'nombre' => $r['actor'],
            'cargo' => $r['cargo'],
            'estado' => $r['resultado'],
            'juicionulidad' => $r['juicionulidad'],
            'monto_no_solventado' => number_format(floatval($r['monto_no_solventado']),2)
        );
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>



