<?php
	require_once('../includes/database.php');
	require 'libreria.php';
	$db = new libreria();

    $nombre = $_REQUEST["term"];
    $accion = $_REQUEST["accion"];

	$result = $db->getActores('%'.$nombre.'%', $accion);

	$data = array();
	if ($result == "{}") {
		$data[] = 	 "No hay nada";
	} else {
		foreach ($result as $row => $r) {

			$data[] = array(
				'value' => $r['nombre'],
				'cont' => $r['cont']
			);
		}
	}
	echo json_encode($data);				   
	Database::disconnect();
?>

