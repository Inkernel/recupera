<?php
	require_once('../includes/database.php');
	require '../e/libreria.php';
	$db = new libreria();

    $entidad = $_REQUEST["term"];

	$result = $db->getEstado('%'.$entidad.'%');

	$data = array();
	if ($result == "{}") {
		$data[] = 	 "No hay nada";
	} else {
		foreach ($result as $row => $r) {

			$data[] = array(
				'value' => $r['nombre_estado']
			);
		}
	}
	echo json_encode($data);				   
	Database::disconnect();
?>