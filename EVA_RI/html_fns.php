<?php
	require_once('Clases/ClsConex.php');
	require_once('Clases/ClsPersonal.php');
	require_once('Clases/ClsOficinas.php');
	require_once('Clases/ClsIngreso.php');
	

	
		function cambia_fecha_mes($Fecha) { 
		if ($Fecha<>""){ 
		 $trozos=split("-",$Fecha);
			$dia = $trozos[2];
			$mes = $trozos[1];
			$annio = $trozos[0]; 
		  switch($mes){
				case 1:
					$mes="Enero";
				break;				    
				case 2:
					$mes="Febrero";
				break;
				case 3:
					$mes="Marzo";
				break;	
				case 4:
					$mes="Abril";
				break;	
				case 5:
					$mes="Mayo";
				break;	
				case 6:
					$mes="Junio";
				break;
				case 7:
					$mes="Julio";
				break;	
				case 8:
					$mes="Agosto";
				break;	
				case 9:
					$mes="Septiembre";
				break;	
				case 10:
					$mes="Octubre";
				break;	
				case 11:
					$mes="Noviembre";
				break;	
				case 12:
					$mes="Diciembre";
				break;		
			}
			$fecha1 = $dia." de ".$mes." de ".$annio; 
			return $fecha1;
		}
	}
	
	
	
	
	function Agrega_Ceros($num){
		$largo = strlen($num);
		switch($largo){
			case 1: $num = "00000$num"; break;
			case 2: $num = "0000$num"; break;
			case 3: $num = "000$num"; break;
			case 4: $num = "00$num"; break;
			case 5: $num = "0$num"; break;
			case 6: $num = "$num"; break;
		}
		return $num;
	}
	
	
	function cambia_fecha($Fecha) { 
	if ($Fecha<>""){ 
	   $trozos=split("-",$Fecha); 
	   return $trozos[2]."/".$trozos[1]."/".$trozos[0]; } 
	else 
	   {return $Fecha;} 
	} 
	
	function cambia_fecha1($Fecha) { 
	if ($Fecha<>""){ 
	   $trozos=split("/",$Fecha); 
	   return $trozos[2]."/".$trozos[1]."/".$trozos[0]; } 
	else 
	   {return $Fecha;} 
	} 
?>