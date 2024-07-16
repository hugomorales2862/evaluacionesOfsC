<?php
include_once('html_fns_rep.php');
require ('../xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');  // debe llevar esta linea de codigo para 
$xajax->configure('decodeUTF8Input',true);  // para corregir

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



	function Buscar_Vacios($dep,$periodo){
		$respuesta = new xajaxResponse();
		$ClsPer = new ClsPersonal();
			$contenido = tabla_fi_aprobados($dep,$periodo);
			$respuesta->assign("resultado","innerHTML",$contenido);
		return $respuesta;
	}
	
	function Buscar1($periodo){
		$respuesta = new xajaxResponse();
		$ClsPer = new ClsPersonal();
			$contenido = tabla_fin_comte($periodo);
			$respuesta->assign("resultado","innerHTML",$contenido);
		return $respuesta;
	}

	function Buscar_catalogo($catalogo,$periodo){
		$respuesta = new xajaxResponse();
		$ClsPer = new ClsPersonal();
			$contenido = tabla_catalogo($catalogo,$periodo);
			$respuesta->assign("resultado","innerHTML",$contenido);
		return $respuesta;
	}	
	
	function Buscar_aprobar($catalogo, $dep, $periodo){
		$respuesta = new xajaxResponse();
		// $respuesta->alert($catalogo);
			$contenido = tabla_aprobar($catalogo, $dep, $periodo);
			$respuesta->assign("resultado","innerHTML",$contenido);
		return $respuesta;
	}

	function aprobados($catalogo, $dep, $periodo){
		$respuesta = new xajaxResponse();
		// $respuesta->alert($catalogo);
			$contenido = tabla_aprobados($catalogo, $dep, $periodo);
			$respuesta->assign("resultado","innerHTML",$contenido);
		return $respuesta;
	}
	
	function Certificar($cod_eva,$sit){
		$respuesta = new xajaxResponse();
		$ClsIng = new ClsIngreso();
		if($cod_eva != ""){
			$sql.= $ClsIng->certificar_evaluacion($cod_eva,$sit);
			$rs = $ClsIng->exec_sql($sql);
			// $respuesta->alert($cod_eva);
			// $respuesta->alert($sit);
			if($rs == 1){
				$respuesta->call('xajax_Alert_certificado', 1);
				$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
			}else{
				$respuesta->alert("OCURRIO UN ERROR, INTENTE MAS TARDE");
			}
		}else{
			$respuesta->alert("ERROR DE CONEXION");
		}
		return $respuesta;
	}
	
	
	function Alert_certificado($valor){
		$respuesta = new xajaxResponse();
		$alert_guardado = html_alert_certificado($valor);
		if($valor = 1){
			$respuesta->assign("alert_modal","innerHTML",$alert_guardado);
		}else{
			$respuesta->assign("alert","innerHTML",$alert_guardado);
		}
		return $respuesta;
	}


		//////generacion de reporte por categoria////////////////////GHV
	function Buscar_cate($periodo,$cate){
		$respuesta = new xajaxResponse();
		$ClsPer = new ClsPersonal();
			$contenido = tabla_cate($periodo,$cate);
			$respuesta->assign("resultado","innerHTML",$contenido);
		return $respuesta;
	}

	function est_fuerza($grad,$depi,$sexo,$clase){
		$respuesta = new xajaxResponse();
		$ClsPer = new ClsPersonal();
			$contenido = tabla_est_fuerza($grad,$depi,$sexo,$clase);
			$respuesta->assign("resul","innerHTML",$contenido);
		return $respuesta;
	}
	function tot_est(){
		$respuesta = new xajaxResponse();
		$ClsPer = new ClsPersonal();
			$contenido = tabla_tot_est();
			$respuesta->assign("resul","innerHTML",$contenido);
		return $respuesta;
	}

	function buscar_info(){
		$respuesta = new xajaxResponse();
		$ClsPer = new ClsPersonal();
			$contenido = tabla_info();
			$respuesta->assign("resul","innerHTML",$contenido);
		return $respuesta;
	}

	function calcular_subtotales($alumnos_h,$alumnos_m,$reservistas_h,$reservistas_m,$contrato_h,$contrato_m){
		$respuesta = new xajaxResponse();
		$ClsPer = new ClsPersonal();

		$respuesta->alert('entra_xajax');
		$total_alumnos = $alumnos_h + $alumnos_m;
		$total_reservistas = $reservistas_h + $reservistas_m;
		$total_contrato = $contrato_h + $contrato_m;

		$total_hombres = $alumnos_h + $reservistas_h + $contrato_h;
		$total_mujeres = $alumnos_m + $reservistas_m + $contrato_m;
		$total_todo = $total_hombres + $total_mujeres;

		$respuesta->assign("alum_total","innerHTML",$total_alumnos);
		$respuesta->assign("reser_total","innerHTML",$total_reservistas);
		$respuesta->assign("contrat_total","innerHTML",$total_contrato);

		$respuesta->assign("dest_hombres","innerHTML",$total_hombres);
		$respuesta->assign("dest_mujeres","innerHTML",$total_mujeres);

		$respuesta->assign("dest_total","innerHTML",$total_todo);

		return $respuesta;
	}



	function guardar_alumnos($dep,$alumnos,$alumnas){
		$respuesta = new xajaxResponse();
		$ClsPersonal = new ClsPersonal();

		//$respuesta->alert($alumnos);
		//$respuesta->alert($alumnas);
		//$respuesta->alert($dep);
	

		$fecha =  $ClsPersonal->obtener_fecha();

		//$respuesta->alert($fecha);
		
		$sql =  $ClsPersonal->guardar_alumnos($fecha,$dep,$alumnos,$alumnas);
		//$respuesta->alert($sql);
		$rs = $ClsPersonal->exec_sql($sql);
		

		if($rs == 1){

			$respuesta->alert("REGISTRO GUARDADO SATISFACTORIAMENTE");
				
			}else{
				$respuesta->alert("EXISTE UN ERROR EN SU REGISTRO");
			}

		
		return $respuesta;
	}


	function guardar_reservistas($dep,$reservistah,$reservistam){
		$respuesta = new xajaxResponse();
		$ClsIngreso = new ClsIngreso();

		//$respuesta->alert($alumnos);
		//$respuesta->alert($alumnas);
		//$respuesta->alert($dep);
	

		$fecha =  $ClsIngreso->obtener_fecha();

		//$respuesta->alert($fecha);
		
		$sql =  $ClsIngreso->guardar_reservistas($fecha,$dep,$reservistah,$reservistam);
		//$respuesta->alert($sql);
		$rs = $ClsIngreso->exec_sql($sql);
		

		if($rs == 1){

			$respuesta->alert("REGISTRO GUARDADO SATISFACTORIAMENTE");
				
			}else{
				$respuesta->alert("EXISTE UN ERROR EN SU REGISTRO");
			}

		
		return $respuesta;
	}



	function guardar_contrato($dep,$contratoh,$contratom){
		$respuesta = new xajaxResponse();
		$ClsIngreso = new ClsIngreso();

		//$respuesta->alert($alumnos);
		//$respuesta->alert($alumnas);
		//$respuesta->alert($dep);
	

		$fecha =  $ClsIngreso->obtener_fecha();

		//$respuesta->alert($fecha);
		
		$sql =  $ClsIngreso->guardar_contrato($fecha,$dep,$contratoh,$contratom);
		//$respuesta->alert($sql);
		$rs = $ClsIngreso->exec_sql($sql);
		

		if($rs == 1){

			$respuesta->alert("REGISTRO GUARDADO SATISFACTORIAMENTE");
				
			}else{
				$respuesta->alert("SUS DATOS FUERON INGRESADOS");
			}

		
		return $respuesta;
	}


	
	
	
	////////////////////////////////////////////////////////////////
	$xajax->register(XAJAX_FUNCTION, "guardar_contrato");
	$xajax->register(XAJAX_FUNCTION, "guardar_reservistas");
	$xajax->register(XAJAX_FUNCTION, "guardar_alumnos");
	$xajax->register(XAJAX_FUNCTION, "calcular_subtotales");
	$xajax->register(XAJAX_FUNCTION, "Buscar1");
	$xajax->register(XAJAX_FUNCTION, "Buscar_Vacios");
	$xajax->register(XAJAX_FUNCTION, "Buscar_aprobar");
	$xajax->register(XAJAX_FUNCTION, "aprobados");
	$xajax->register(XAJAX_FUNCTION, "Buscar_aprobar12016");
	$xajax->register(XAJAX_FUNCTION, "Certificar");
	$xajax->register(XAJAX_FUNCTION, "Alert_certificado");
	$xajax->register(XAJAX_FUNCTION, "Buscar_catalogo");
	$xajax->register(XAJAX_FUNCTION, "Eliminar_evaluacion"); 
	$xajax->register(XAJAX_FUNCTION, "Buscar_cate");  
	$xajax->register(XAJAX_FUNCTION, "est_fuerza");  
	$xajax->register(XAJAX_FUNCTION, "tot_est");  
	$xajax->register(XAJAX_FUNCTION, "buscar_info");
	$xajax->processRequest();
	
?>