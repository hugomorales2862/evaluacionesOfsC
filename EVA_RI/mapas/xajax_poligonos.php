<?php
date_default_timezone_set('America/Guatemala');
require_once('../xajax_core/xajax.inc.php');
include_once('../html_fns.php');
include_once('html_poligonos.php');
//instanciamos el objeto de la clase xajax
	$xajax = new xajax();
	$xajax->setCharEncoding('ISO-8859-1');


//FUNCION QUE RECIBE EL NUMERO DE POLIGONO PARA LUEGO ENVIARLO A UNA FUNCION EN HTML_POLIGONOS.PHP PARA QUE PINTE LOS VALORES EN UN DIV ESCONDIDO
	
	
	function poligono($poligono) {
		$respuesta = new xajaxResponse();
			$poligono = html_trae_poligono($poligono);
			$poligono = utf8_decode($poligono);
			$respuesta->assign("div_mapa", "innerHTML", "$poligono");
			$respuesta->script("initialize()");
			
		return $respuesta;
	}

	
	
	function Trae_Puntos($puntos,$contador) {
		$respuesta = new xajaxResponse();
		 $puntos = implode(",", $puntos); 
		 $puntos = trim($puntos); 
			$respuesta->alert($puntos);
			if ($contador != ""){
				$pinta_poligono = Pinta_coo($puntos);
				$pinta_poligonos = utf8_decode($pinta_poligono);
				$respuesta->assign("div_mapa1", "innerHTML", "$pinta_poligonos");
			}
		return $respuesta;
	}

//FUNCION QUE LEVANTA LOS MODAL DE BIENVENIDA CUANDO INGRESA A LA PAGINA
function modal_alert($valor){
	$respuesta = new xajaxResponse();
	
		if($valor==1){
			$alert1 = tabla_reporte_mision_alert($valor);
			$alert1 = utf8_decode($alert1);
			$respuesta->assign("alert1", "innerHTML", "$alert1");
		}elseif($valor==2){
			$alert1 = tabla_reporte_mision_alert($valor);
			$alert1 = utf8_decode($alert1);
			$respuesta->assign("alert2", "innerHTML", "$alert1");
		}elseif($valor==3){
			$alert1 = tabla_reporte_mision_alert($valor);
			$alert1 = utf8_decode($alert1);
			$respuesta->assign("alert3", "innerHTML", "$alert1");
		}
		//$respuesta->script("$('#alert').modal('show')");
		
	return $respuesta;
}

//REGISTRO DE TODAS LAS FUNCIONES XAJAX
$xajax->registerFunction("poligono");
$xajax->registerFunction("Trae_Puntos");
$xajax->registerFunction("modal_alert");
$xajax->processRequest();
?>