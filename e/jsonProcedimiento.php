<?php
	require_once('../includes/database.php');
	require 'libreria.php';
	$db = new libreria();

	$procedimiento = $_REQUEST["term"];
	$result = $db->getProcedimientos('%'.$procedimiento.'%');

	$data = array();
	if ($result == "{}") {
		$data[] = 	 "No hay nada";
	} else {
		foreach ($result as $row => $r) {

			$data[] = array(
				'value' => $r['num_procedimiento'],
				"accion"=>$r["num_accion"], 
				"entidad"=>$r["entidad"]
			);
		}
	}
	echo json_encode($data);				   
	Database::disconnect();
?>

