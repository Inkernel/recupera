<?php

require_once 'database.php';
require 'libreriaP.php';
$db = new libreria();

$procedimientos = 0;
$impugnada = 0;
$existencia = 0;
$inexistencia = 0;
$mixta = 0;


$data = 'getPFRRdefensaProcedimiento';
$result = $db->$data();
$i = 1;
$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        $data[] = array(
            'cp' => $r['cp'],
            'Procedimientos' => $r['procedimientos'],

            'Resolución impugnada' => $r['impugnada'],
            'Existencia responsabilidad' => $r['existencia'],
            'Inexistencia responsabilidad' => $r['inexistencia'],
            'Resolución Mixta' => $r['mixta']
            
        );
        $procedimientos += $r['procedimientos'];
        $impugnada += $r['impugnada'];
        $existencia += $r['existencia'];
        $inexistencia += $r['inexistencia'];
        $mixta += $r['mixta'];
    }
    $data[] = array(
        'cp' => 'suma',
        'Procedimientos' => $procedimientos,

        'Resolución impugnada' => $impugnada,
        'Existencia responsabilidad' => $existencia,
        'Inexistencia responsabilidad' => $inexistencia,
        'Resolución Mixta' => $mixta
    );
}
echo json_encode($data);				   
Database::disconnect();
	
?>