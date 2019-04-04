<?php
    require_once '../includes/database.php';
    require '../i/libreriaX.php';
    $db = new libreria();

    $entidad = '%'.$_REQUEST["entidad"].'%';

    $result = $db->putAccionesXirregularidad($entidad);

    $data = array();
    if ($result == "{}") {
        $data[] = "Fallo".$entidad;
    } else {
        foreach ($result as $row => $r) {
            $data[] = array(
                'accion' => $r['num_accion']
            );
        }
    

    }
    echo json_encode($data);				   
    Database::disconnect();
	
?>

