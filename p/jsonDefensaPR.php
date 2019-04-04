<?php

require_once 'database.php';
require 'libreriaP.php';
$db = new libreria();

$actores = 0;
$impugnada = 0;
$existencia = 0;
$inexistencia = 0;
$mixta = 0;


$data = 'getPFRRdefensaPR';
$result = $db->$data();
$i = 1;
$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        $data[] = array(
            'cp' => $r['cp'],
            'Presuntos' => $r['actores'],

            'Resolución impugnada' => $r['impugnada'],
            'Existencia responsabilidad' => $r['existencia'],
            'Inexistencia responsabilidad' => $r['inexistencia'],
            'Resolución Mixta' => $r['mixta']
            
        );
        $actores += $r['actores'];
        $impugnada += $r['impugnada'];
        $existencia += $r['existencia'];
        $inexistencia += $r['inexistencia'];
        $mixta += $r['mixta'];
    }
    $data[] = array(
        'cp' => 'suma',
        'Presuntos' => $actores,

        'Resolución impugnada' => $impugnada,
        'Existencia responsabilidad' => $existencia,
        'Inexistencia responsabilidad' => $inexistencia,
        'Resolución Mixta' => $mixta
    );
}
echo json_encode($data);				   
Database::disconnect();
	
?>