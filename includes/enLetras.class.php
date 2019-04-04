
<?php
//error_reporting(E_ERROR);
class EnLetras
{
  var $Void = "";
  var $SP = " ";
  var $Dot = ".";
  var $Zero = "0";
  var $Neg = "Menos";
  
function ValorEnLetras($x, $Moneda ) 
{
    $s="";
    $Ent="";
    $Frc="";
    $Signo="";
        
    if(floatVal($x) < 0)
     $Signo = $this->Neg . " ";
    else
     $Signo = "";
    
    if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales
      $s = number_format($x,2,'.','');
    else
      $s = number_format($x,0,'.','');
      
    $Pto = strpos($s, $this->Dot);
        
    if ($Pto === false)
    {
      $Ent = $s;
      $Frc = $this->Void;
    }
    else
    {
      $Ent = substr($s, 0, $Pto );
      $Frc =  substr($s, $Pto+1);
    }

    if($Ent == $this->Zero || $Ent == $this->Void)
       $s = "cero ";
    elseif( strlen($Ent) > 7)
    {
       $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) . 
             "millones " . $this->SubValLetra(intval(substr($Ent,-6, 6)));
    }
    else
    {
      $s = $this->SubValLetra(intval($Ent));
    }

    if (substr($s,-9, 9) == "millones " || substr($s,-7, 7) == "millón ")
       $s = $s . "de ";

    $s = $s . $Moneda;

	/*
    if($Frc != $this->Void)
    {
       $s = $s . " Con " . $this->SubValLetra(intval($Frc)) . "Centavos";
       //$s = $s . " " . $Frc . "/100";
    }
	*/
	
	$ctvs = explode(".",$x);
	if($ctvs[1] == NULL || $ctvs[1] == 0|| $ctvs[1] == "") $centavos = "00/100";
	else $centavos = $ctvs[1]."/100";
    
	//return ($Signo . $s . " M.N.");
    return ($Signo . $s . " ".$centavos);
	
   
}


function SubValLetra($numero) 
{
    $Ptr="";
    $n=0;
    $i=0;
    $x ="";
    $Rtn ="";
    $Tem ="";

    $x = trim("$numero");
    $n = strlen($x);

    $Tem = $this->Void;
    $i = $n;
    
    while( $i > 0)
    {
       $Tem = $this->Parte(intval(substr($x, $n - $i, 1). 
                           str_repeat($this->Zero, $i - 1 )));
       If( $Tem != "cero" )
          $Rtn .= $Tem . $this->SP;
       $i = $i - 1;
    }

    
    //--------------------- GoSub FiltroMil ------------------------------
    $Rtn=str_ireplace(" mil mil", " un mil", $Rtn );
    while(1)
    {
       $Ptr = strpos($Rtn, "mil ");       
       If(!($Ptr===false))
       {
          If(! (strpos($Rtn, "mil ",$Ptr + 1) === false ))
            $this->ReplaceStringFrom($Rtn, "mil ", "", $Ptr);
          Else
           break;
       }
       else break;
    }

    //--------------------- GoSub FiltroCiento ------------------------------
    $Ptr = -1;
    do{
       $Ptr = strpos($Rtn, "cien ", $Ptr+1);
       if(!($Ptr===false))
       {
          $Tem = substr($Rtn, $Ptr + 5 ,1);
          if( $Tem == "m" || $Tem == $this->Void)
             ;
          else          
             $this->ReplaceStringFrom($Rtn, "cien", "ciento", $Ptr);
       }
    }while(!($Ptr === false));

    //--------------------- FiltroEspeciales ------------------------------
    $Rtn=str_ireplace("diez un", "once", $Rtn );
    $Rtn=str_ireplace("diez dos", "doce", $Rtn );
    $Rtn=str_ireplace("diez tres", "trece", $Rtn );
    $Rtn=str_ireplace("diez cuatro", "catorce", $Rtn );
    $Rtn=str_ireplace("diez cinco", "quince", $Rtn );
    $Rtn=str_ireplace("diez seis", "dieciseis", $Rtn );
    $Rtn=str_ireplace("diez siete", "diecisiete", $Rtn );
    $Rtn=str_ireplace("diez ocho", "dieciocho", $Rtn );
    $Rtn=str_ireplace("diez nueve", "diecinueve", $Rtn );
    $Rtn=str_ireplace("veinte un", "veintiun", $Rtn );
    $Rtn=str_ireplace("veinte dos", "veintidos", $Rtn );
    $Rtn=str_ireplace("veinte tres", "veintitres", $Rtn );
    $Rtn=str_ireplace("veinte cuatro", "veinticuatro", $Rtn );
    $Rtn=str_ireplace("veinte cinco", "veinticinco", $Rtn );
    $Rtn=str_ireplace("veinte seis", "veintiseís", $Rtn );
    $Rtn=str_ireplace("veinte siete", "Veintisiete", $Rtn );
    $Rtn=str_ireplace("veinte ocho", "veintiocho", $Rtn );
    $Rtn=str_ireplace("veinte nueve", "veintinueve", $Rtn );

    //--------------------- FiltroUn ------------------------------
    If(substr($Rtn,0,1) == "m") $Rtn = "un " . $Rtn;
    //--------------------- Adicionar Y ------------------------------
    for($i=65; $i<=88; $i++)
    {
      If($i != 77)
         $Rtn=str_ireplace("a " . Chr($i), "* y " . Chr($i), $Rtn);
    }
    $Rtn=str_ireplace("*", "a" , $Rtn);
    return($Rtn);
}


function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
{
  $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
}


function Parte($x)
{
    $Rtn='';
    $t='';
    $i='';
    Do
    {
      switch($x)
      {
         Case 0:  $t = "cero";break;
         Case 1:  $t = "un";break;
         Case 2:  $t = "dos";break;
         Case 3:  $t = "tres";break;
         Case 4:  $t = "cuatro";break;
         Case 5:  $t = "cinco";break;
         Case 6:  $t = "seis";break;
         Case 7:  $t = "siete";break;
         Case 8:  $t = "ocho";break;
         Case 9:  $t = "nueve";break;
         Case 10: $t = "diez";break;
         Case 20: $t = "veinte";break;
         Case 30: $t = "treinta";break;
         Case 40: $t = "cuarenta";break;
         Case 50: $t = "cincuenta";break;
         Case 60: $t = "sesenta";break;
         Case 70: $t = "setenta";break;
         Case 80: $t = "ochenta";break;
         Case 90: $t = "noventa";break;
         Case 100: $t = "cien";break;
         Case 200: $t = "doscientos";break;
         Case 300: $t = "trescientos";break;
         Case 400: $t = "cuatrocientos";break;
         Case 500: $t = "quinientos";break;
         Case 600: $t = "seiscientos";break;
         Case 700: $t = "setecientos";break;
         Case 800: $t = "ochocientos";break;
         Case 900: $t = "novecientos";break;
         Case 1000: $t = "mil";break;
         Case 1000000: $t = "millón";break;
      }

      If($t == $this->Void)
      {
        $i = $i + 1;
        $x = $x / 1000;
        If($x== 0) $i = 0;
      }
      else
         break;
           
    }while($i != 0);
   
    $Rtn = $t;
    Switch($i)
    {
       Case 0: $t = $this->Void;break;
       Case 1: $t = " mil";break;
       Case 2: $t = " millones";break;
       Case 3: $t = " billones";break;
    }
    return($Rtn . $t);
}

}

?>