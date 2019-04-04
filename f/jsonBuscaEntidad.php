<?php
    require_once '../includes/database.php';
    require '../p/libreriaP.php';
    $db = new libreria();

    $entidad = '%'.'Estado de México'.'%';
    $entidad = '%'.$_REQUEST["entidad"].'%';
    $suma = 0;

    $result = $db->getAccionesXentidad($entidad);

    $data = array();
    if ($result == "{}") {
        $data[] = "Fallo".$entidad;
    } else {
        foreach ($result as $row => $r) {
            $data[] = array(
                'accion' => $r['num_accion']
            );
            $suma++;
        }
        $data[] = array(
            'suma' => $suma
        );
    

    }
    echo json_encode($data);				   
    Database::disconnect();
	
?>

