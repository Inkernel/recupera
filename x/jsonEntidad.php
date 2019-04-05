<?php
session_start();
require_once '../includes/database.php';
require '../i/libreriaX.php';
$db = new libreria();

$entidad = '%'.$_REQUEST["xxx"].'%';
$entidad = '%'.$_SESSION['entidad'].'%';

$result = $db->getEntidad($entidad);
// echo $entidad."hola";
$data = array();
if ($result == "{}") {
    $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {

        if ($r['inicio_frr'] == "" or $r['inicio_frr'] == 0)
		{
			$monto = $r['monto_no_solventado'];
		} else {
			$monto = $r['inicio_frr'];
		}

        $data[] = array(
            'cp' => $r['cp'],		
            'entidad' => mb_substr($r['entidad'],0,40), 
            'num_accion' => $r['num_accion'],
            'fondo' => $db->dameFondo($r['num_accion']),
            'UAA' => $db->dameUAA($r['num_accion']),
            'po' => $r['po'],

            'monto' => number_format(floatval($monto),2),
            'inicio_frr' => number_format(floatval($r['inicio_frr'])),
            'monto_no_solventado' => number_format(floatval($r['monto_no_solventado']),2),
            'pdrcs' => $r['pdrcs'],
            'fecha_edo_tramite' => $r['fecha_edo_tramite'],
            'detalle_edo_tramite' => $r['detalle_edo_tramite'],
            'estado' => $db->dameEstado($r['detalle_edo_tramite'])
        );
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>