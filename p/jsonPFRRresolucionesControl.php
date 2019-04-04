<?php

require_once 'database.php';
require 'libreriaP.php';
$db = new libreria();
$presuntos = 0;
$abstencion = 0;
$responsabilidad = 0;
$sancion = 0;
$sobresiomiento = 0;

$data = 'getPFRRcontrolResoluciones';
$result = $db->$data();
$i = 1;
$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {
        $data[] = array(
            'CP' => $r['cp'],
            'Abstención de sanción' => $r['abstencion'],
            'Con responsabilidad' => $r['responsabilidad'],
            'Sin sanción' => $r['sancion'],
            'Sobreseimiento' => $r['sobresiomiento'],
            'Resoluciones notificadas' => $r['presuntos']
        );
        $presuntos += $r['presuntos'];
        $abstencion += $r['abstencion'];
        $responsabilidad += $r['responsabilidad'];
        $sancion += $r['sancion'];
        $sobresiomiento += $r['sobresiomiento'];
    }
    $data[] = array(
        'CP' => 'suma',
        'Abstención de sanción' => $abstencion,
        'Con responsabilidad' => $responsabilidad,
        'Sin sanción' => $sancion,
        'Sobreseimiento' => $sobresiomiento,
        'Resoluciones notificadas' => $presuntos
    );
}
echo json_encode($data);				   
Database::disconnect();
	
?>