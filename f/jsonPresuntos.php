<?php
require_once '../e/database.php';
require '../e/libreria.php';
$db = new libreria();

$result = $db->getPresuntos();
$i = 1;
$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {

        $data[] = array(
            'cont' => floatval($r['cont']),
            'accion' => $r['num_accion'],
            'procedimiento' => $r['num_procedimiento'],
            'nombre' => $r['nombre'],
            'cargo' => $r['cargo'],
            'dependencia' => $r['dependencia'],
            'monto' => number_format(floatval($r['monto'])),
            'domicilio' => $r['domicilio'],
            'tipo_notificacion' => $r['tipo_notificacion'],
            'fecha_notificacion_oficio_citatorio' => $r['fecha_notificacion_oficio_citatorio'],
            'fecha_audiencia' => $r['fecha_audiencia'],
            'R' => $r['responsabilidad']);
	}
}
echo json_encode($data);				   
Database::disconnect();
	
?>