<?php
require_once ('../xajax_core/xajax.inc.php');
include_once('html_fns_final.php');
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');
	
	
// <!--==============================================================================================================================================
// =======================FUNCION QUE LLAMA EL MODAL QUE NOTIFICA QUE LA DOTACION FUE ENTREGADA SATISFACTORIAMENTE===================================
// ==================================================================================================================================================-->
	function Alert_Entregado($valor){
		$respuesta = new xajaxResponse();
		
		$alert_certificar = html_alert_entregado($valor);
		if($valor = 1){
			$respuesta->assign("alert_modal","innerHTML",$alert_certificar);
		}else{
			$respuesta->assign("alert","innerHTML",$alert_certificar);
		}
		return $respuesta;
	} 
	
	
	function Alert_Cancelado($valor){
		$respuesta = new xajaxResponse();
		
		$alert_certificar = html_alert_cancelado($valor);
		if($valor = 1){
			$respuesta->assign("alert_modal","innerHTML",$alert_certificar);
		}else{
			$respuesta->assign("alert","innerHTML",$alert_certificar);
		}
		return $respuesta;
	} 
	
	
	function Eliminar_evaluacion($cod_eva){
		$respuesta = new xajaxResponse();
		$ClsIng = new ClsIngreso();
		if($cod_eva != ""){
			$sql.= $ClsIng->eliminar_evaluacion($cod_eva);
			$rs = $ClsIng->exec_sql($sql);
			// $respuesta->alert($rs);
			if($rs == 1){
				$respuesta->call('xajax_Alert_Eliminado', 1);
				$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
			}else{
				$respuesta->alert("OCURRIO UN ERROR, INTENTE MAS TARDE");
			}
		}else{
			$respuesta->alert("ERROR DE CONEXION");
		}
		return $respuesta;
	}
	
	
	function Alert_Eliminado($valor){
		$respuesta = new xajaxResponse();
		$alert_guardado = html_alert_eliminado($valor);
		if($valor = 1){
			$respuesta->assign("alert_modal","innerHTML",$alert_guardado);
		}else{
			$respuesta->assign("alert","innerHTML",$alert_guardado);
		}
		return $respuesta;
	}
	
	
// <!--==============================================================================================================================================
// ===================================================DECLARAMOS LAS FUNCIONES DE XAJAX==============================================================
// ==================================================================================================================================================-->
	$xajax->register(XAJAX_FUNCTION, "Alert_Entregado");
	$xajax->register(XAJAX_FUNCTION, "Alert_Cancelado");
	$xajax->register(XAJAX_FUNCTION, "Eliminar_evaluacion");
	$xajax->register(XAJAX_FUNCTION, "Alert_Eliminado");
 	$xajax->processRequest();
?>