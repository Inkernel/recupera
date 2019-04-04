<?php

require_once 'database.php';
require 'libreriaP.php';
$db = new libreria();
$resultado = 'suma';
$juicios = 0;
$falta = 0;
$ceros = 0;
$Reporte = 0;
$a2018 = 0;
$Ene = 0;
$Feb = 0;
$Mar = 0;
$Abr = 0;
$May = 0;
$Jun = 0;
$Jul = 0;
$Ago = 0;
$Sep = 0;
$Oct = 0;
$Nov = 0;
$Dic = 0;
$a2019 = 0;


$result = $db->getJCAcontrol04();
$i = 1;
$data = array();
if ($result == "{}") {
     $data[] = 	 "No hay nada";
} else {
	foreach ($result as $row => $r) {

        $data[] = array(
            'resultado' => $r['rf_status'],
            'juicios' => $r['recursos'],
            'falta' => $r['falta'] + $r['ceros'],
            'Reporte' => $r['Reporte'],
            'a2018' => $r['2018'],
            'Ene' => $r['Ene'],
            'Feb' => $r['Feb'],
            'Mar' => $r['Mar'],
            'Abr' => $r['Abr'],
            'May' => $r['May'],
            'Jun' => $r['Jun'],
            'Jul' => $r['Jul'],
            'Ago' => $r['Ago'],
            'Sep' => $r['Sep'],
            'Oct' => $r['Oct'],
            'Nov' => $r['Nov'],
            'Dic' => $r['Dic'],
            'a2019' => $r['2019']);

            $juicios += $r['recursos'];
            $falta += $r['falta'] + $r['ceros'];
            $Reporte += $r['Reporte'];
            $a2018 += $r['2018'];
            $Ene += $r['Ene'];
            $Feb += $r['Feb'];
            $Mar += $r['Mar'];
            $Abr += $r['Abr'];
            $May += $r['May'];
            $Jun += $r['Jun'];
            $Jul += $r['Jul'];
            $Ago += $r['Ago'];
            $Sep += $r['Sep'];
            $Oct += $r['Oct'];
            $Nov += $r['Nov'];
            $Dic += $r['Dic'];
            $a2019 += $r['2019'];
    }
    $data[] = array(
        'resultado' => 'suma',
        'juicios' => $juicios,
        'falta' => $falta,
        'Reporte' => $Reporte,
        'a2018' => $a2018,
        'Ene' => $Ene,
        'Feb' => $Feb,
        'Mar' => $Mar,
        'Abr' => $Abr,
        'May' => $May,
        'Jun' => $Jun,
        'Jul' => $Jul,
        'Ago' => $Ago,
        'Sep' => $Sep,
        'Oct' => $Oct,
        'Nov' => $Nov,
        'Dic' => $Dic,
        'a2019' => $a2019);
}
echo json_encode($data);				   
Database::disconnect();
	
?>