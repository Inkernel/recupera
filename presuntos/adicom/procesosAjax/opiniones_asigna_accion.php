<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Content-Type: text/html;charset=utf-8");

require_once("../includes/clases.php");
require_once("../includes/funciones.php");
$conexion = new conexion;
$conexion->conectar();
//-------------------------- DESINFECTAR VARIABLES -----------------------------
//------------------------------------------------------------------------------

$accion= valorSeguro($_POST['accion']);
$direccion= valorSeguro($_POST['direccion']);
$aboPart=valorSeguro($_POST['abogado']);
$usuario =valorSeguro($_POST['usuario']);

$aboPart = explode("|",$aboPart);
$abogado = $aboPart[0];
$subnivel= $aboPart[1];

$sbnPart = explode(".",$subnivel);
$dirAbo = $sbnPart[0];

$sql1 = $conexion->update("UPDATE opiniones SET direccion = '".$dirAbo."', abogado = '".$abogado."',subnivel='".$subnivel."' WHERE num_accion = '".$accion."' ",false); 
//$sql3 = $conexion->update("UPDATE pfrr SET abogado = '".$abogado."',subnivel='".$subnivel."' WHERE num_accion = '".$accion."' ",false); 
//-------------------------- modifica movimiento ------------------------------
if($sql1) echo "ok";
else echo "fail";
