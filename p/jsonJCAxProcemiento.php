<?php

require_once 'database.php';
require 'libreriaP.php';
$db = new libreria();


$result = $db->getJuiciosxProcedimiento();
$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
    $j = 0;
    $a = 0;
    $rrf = 0;
    $rrfF = 0;
    $rrfD = 0;
    $rrfT = 0;
    $aF = 0;
    $aD = 0;
    $aT = 0;
    $jcaF = 0;
    $jcaD = 0;
    $jcaT = 0;
    $apunta = "inicio";
	foreach ($result as $row => $r) {
        if ($r['procedimiento'] != $apunta) {
            if ($aF>0 || $rrfF>0){
                $resultado = 'favorable';
            } else {
                if ($jcaF>0 && $aD == 0 && $rrfD ==0) {
                    $resultado = 'favorable';
                } else {
                    if ($j == $jcaD && $a == 0 && $rrf == 0){
                        $resultado  = 'desfavorable';
                    } else {
                        $resultado = 'trámite';
                    }
                }
            } 
            if ($apunta != "inicio"){
            $data[] = array(
                'resultado' => $resultado,
                'procedimiento' => $apunta,
                'j' => $j,
                'rrf' => $rrf,
                'rrfF' => $rrfF,
                'rrfD' => $rrfD,
                'rrfT' => $rrfT,
                'a' => $a,
                'aF' => $aF,
                'aD' => $aD,
                'aT' => $aT,
                'jcaD' => $jcaD,
                'jcaT' => $jcaT,
                'jcaF' => $jcaF);
            }
            $apunta = $r['procedimiento'];
            $j = 0;
            $a = 0;
            $rrf = 0;
            $rrfF = 0;
            $rrfD = 0;
            $rrfT = 0;
            $aF = 0;
            $aD = 0;
            $aT = 0;
            $jcaF = 0;
            $jcaD = 0;
            $jcaT = 0;
        }
        if ( $r['resultado'] == 'favorable') {
            $jcaF++;
            $j++;
        }
        if ( $r['resultado'] == 'desfavorable') {
            $jcaD++;
            $j++;
        } 
        if ( $r['resultado'] == 'trámite') {
            $jcaT++;
            $j++;
        } 
        if ( $r['toca_amparo'] == 'si') {
            $a++;
            if ( $r['ad_status'] == 'favorable') {
                $aF++;
            } 
            if ( $r['ad_status'] == 'desfavorable') {
                $aD++;
            } 
            if ( $r['ad_status'] == 'trámite') {
                $aT++;
            } 
        } 
        if ( $r['toca_en_revision'] == 'si') {
            $rrf++;
            if ( $r['rf_status'] == 'favorable') {
                $rrfF++;
            } 
            if ( $r['rf_status'] == 'desfavorable') {
                $rrfD++;
            } 
            if ( $r['rf_status'] == 'trámite') {
                $rrfT++;
            } 
        } 
    }
    $data[] = array(
        'resultado' => $resultado,
        'procedimiento' => $apunta,
        'j' => $j,
        'rrf' => $rrf,
        'rrfF' => $rrfF,
        'rrfD' => $rrfD,
        'rrfT' => $rrfT,
        'a' => $a,
        'aF' => $aF,
        'aD' => $aD,
        'aT' => $aT,
        'jcaD' => $jcaD,
        'jcaT' => $jcaT,
        'jcaF' => $jcaF);
}
echo json_encode($data);				   
Database::disconnect();
	
?>