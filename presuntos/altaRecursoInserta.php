<?php
	require_once("../includes/funciones.php");
	require_once('../includes/database.php');

	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$estado = "trámite";

$accion = $_POST['accion'];
$procedimiento = $_POST['procedimiento'];

$actor = $_POST['actor'];
$recurso = $_POST['recurso'];
$dir = $_POST['dir'];
$fechanot = fechaMysql($_POST['fechanot']);
$sub = $_POST['sub'];

$cont = $_POST['cont'];


try { 
	$sql = "INSERT INTO actores_recurso (fecha_recurso,  dir, accion, procedimiento, estado, sub,  ai, actor,  cont)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$q = $pdo->prepare($sql);
	$q->execute(array($fechanot, $dir, $accion, $procedimiento, $estado, $sub, $recurso, $actor,  $cont));

	$mensaje = $fechanot . "Amparo Indirecto dado de alta";
	echo($mensaje);
	return;
} catch( PDOExecption $e ) { 
	return "Error!: " . $e->getMessage() . "</br>"; 
}
	echo "hola"
?>