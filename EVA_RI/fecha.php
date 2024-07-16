<?php 

		date_default_timezone_set('America/Guatemala');
		$dias= date("d");
		$mes= date("m");
		$annio = date("Y");

// //DESCOMENTAREA ESTO 

		if($mes==1 or $mes==3 or $mes==2){
			$annio=$annio;
		}
//ELIMINAR DESPUES DE SER UTILIZADO EN EL PERIODO 2-2016
		//$annio = $annio - 1;
		$siguiente = $annio + 1;
	//	if ($mes == 5 or $mes == 6 or $mes == 7 or $mes == 8 or $mes == 10){
		if ($mes == 3 or $mes == 6 or $mes == 7 or $mes == 8 or $mes == 5 ){
			$evaluacion = 1;
			$comp_eva = '1 - '.$annio;
//ELIMINAR EL MES 1 Y 2 PARA EL PERIODO 2-2016
		}elseif($mes == 10 or $mes == 11 or $mes == 12 ){
			$evaluacion = 2;
			$comp_eva = '2 - '.$annio;
			//$comp_eva = '2 - 2023';
		}elseif($mes == 1 or $mes == 2 or $mes == 3){
			$annio = $annio - 1;
			$evaluacion = 2;
			$comp_eva = '2 - '.$annio;			
		}



//COMENTAREA ESTA LINEA PORFAVOR
		 // $comp_eva = '2 - 2022';

?>