<?php
// include_once('html_fns_eva.php');
require ('../xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');  // debe llevar esta linea de codigo para 
$xajax->configure('decodeUTF8Input',true);  // para corregir 

	function Certificar($cod_eva,$sit){
		$respuesta = new xajaxResponse();
		$ClsIng = new ClsIngreso();
		// if($cod_eva != ""){
			// $sql.= $ClsIng->certificar_evaluacion($cod_eva,$sit);
			// $rs = $ClsIng->exec_sql($sql);
			// if($rs == 1){
				// $respuesta->alert("APROBADO SATISFACTORIAMENTE");
				// $respuesta->("<script> close() </script>");
			// }else{
				// $respuesta->alert("OCURRIO UN ERROR, INTENTE MAS TARDE");
			// }
		// }else{
			$respuesta->alert("ERROR DE CONEXION");
		// }
		return $respuesta;
	}
	
	
	$xajax->register(XAJAX_FUNCTION, "Certificar");
	$xajax->register(XAJAX_FUNCTION, "Alert_certificado");
	$xajax->processRequest();
	
?>