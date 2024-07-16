<?php
include_once('html_fns_my.php');
require ('../xajax_core/xajax.inc.php');
date_default_timezone_set('America/Guatemala'); 
//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');  // debe llevar esta linea de codigo para 
$xajax->configure('decodeUTF8Input',true);  // para corregir 


function Trae_Datos_Catalogo_inmediato($cat){
		$respuesta = new xajaxResponse();
		$ClsPer = new ClsPersonal();
		// $respuesta->alert($cat);
		$result = $ClsPer->get_personal_usuario($cat);

		if(is_array($result)){
			
			$cont = 0;
			foreach($result as $row){
				$codigo_grado2 = $row["GRA_CODIGO"];
				$nombre = $row["PER_NOM1"].' '.$row["PER_NOM2"].', '.$row["PER_APE1"].' '.$row["PER_APE2"];
				$empleo = $row["PER_DESC_EMPLEO"];	// asigno la información en la variable
				$grado = $row["GRA_DESC_CT"];	// asigno la información en la variable
				$arma = $row["ARM_DESC_CT"];	// asigno la información en la variable
				$codigo_arma2 = $row["ARM_CODIGO"];	// asigno la información en la variable
				$t_puesto_inmediato = $row['T_PUESTO'];
				$cont++;
			}
			$dependencia1 = $_SESSION['dep_cod']; 
			// SE AGREGO ESTA VALIDACIÓN POR LA REESTRUCTURACIÓN DE BRIGADAS, POR EL TIEMPO EN LA TABLA TIEMPOS
			// ESTAS PERSONAS NO PODIAN EVALUAR, POR LO QUE SE CÁLCULO EL TIEMPO CON BASE AL PUESTO ANTERIOR
			// if($dependencia1 == '2665' || $dependencia1 == '2660' || $dependencia1 == '2810' || $dependencia1 == '2815' || $dependencia1 == '2680'|| $dependencia1 == '2685'|| $dependencia1 == '2640' || $dependencia1 == '2960' ){
			// 	// echo "hola";
			// 	$tiempoQuery = $ClsPer->calculoTiempoDpue($cat)[0]['PUE_FEC_NOMB']; 
			// 	$fecha1 = new DateTime($tiempoQuery);
			// 	// var_dump($fecha1);
			// 	$fechaActual = new DateTime();
			// 	$diferencia = $fecha1->diff($fechaActual);
			// 	// echo json_encode($diferencia);
			// 	$years = str_pad($diferencia->y, 2, "0", STR_PAD_LEFT);
			// 	$months = str_pad($diferencia->m, 2, "0", STR_PAD_LEFT);
			// 	$days = str_pad($diferencia->d, 2, "0", STR_PAD_LEFT);
		
			// 	// echo json_encode($t_pue);
			// 	// echo json_encode($months);
			// 	// echo json_encode($days);
		
			// 	$t_puesto_inmediato = ($years != '00' ? $years : '') . $months . ($days != '00' ? $days : '');
			// }
			if ($codigo_grado2 == 46 || $codigo_grado2 == 59 || $codigo_grado2 == 65 || $codigo_grado2 == 73 || $codigo_grado2 == 81 || $codigo_grado2 == 88 || $codigo_grado2 == 92 || $codigo_grado2 == 93 || $codigo_grado2 == 96 || $codigo_grado2 == 97 || $codigo_grado2 == 99 || $codigo_grado2 == 40){
				$nombre1 = $nombre;
			}else{
				$nombre1 = $nombre;
			}
				
			
			$t_puesto_inmediato = tiempo($t_puesto_inmediato);
			$t_puesto_inmediato = utf8_decode($t_puesto_inmediato);
			if($cont == 1){ // si el contador viene igual a 1 le coloco los valores a los campos
				$respuesta->assign("nombre_inmediato","value",$nombre1);	// le asigno el contenido a respuesta para insertarlo en el elemento
				$respuesta->assign("empleo2","value",$empleo);	// le asigno el contenido a respuesta para insertarlo en el elemento
				$respuesta->assign("tiempo2","value",$t_puesto_inmediato);	// le asigno el contenido a respuesta para insertarlo en el elemento
				$respuesta->assign("codigo_grado2","value",$codigo_grado2);	// le asigno el contenido a respuesta para insertarlo en el elemento
				$respuesta->assign("codigo_arma2","value",$codigo_arma2);	// le asigno el contenido a respuesta para insertarlo en el elemento
				
				// SE MANDA A LLAMAR LA FUNCION PARA QUE COLOQUE LOS DATOS EN LOS CAMPOS SI YA EXISTE COMO USUARIO
				// $respuesta->script("xajax_Coloca_Info($cat)");
			}
		}else{
			$respuesta->alert("Catalogo invalido");	// si no trae datos levanto una alerta.
			$respuesta->assign("per_nombre","value",'');	// le asigno el contenido a respuesta para insertarlo en el elemento
		}
		return $respuesta;
	}
	
	
	function Trae_Datos_Catalogo_comte($cat){
		$respuesta = new xajaxResponse();
		$ClsPer = new ClsPersonal();
		// $respuesta->alert($cat);
		$result = $ClsPer->get_personal_usuario($cat);

		if(is_array($result)){
			
			$cont = 0;
			foreach($result as $row){
				$codigo_grado3 = $row["GRA_CODIGO"];
				$nombre = $row["PER_NOM1"].' '.$row["PER_NOM2"].', '.$row["PER_APE1"].' '.$row["PER_APE2"];
				$empleo = $row["PER_DESC_EMPLEO"];	// asigno la información en la variable
				$grado = $row["GRA_DESC_CT"];	// asigno la información en la variable
				$arma = $row["ARM_DESC_CT"];	// asigno la información en la variable
				$codigo_arma3 = $row["ARM_CODIGO"];	// asigno la información en la variable
				$t_puesto_inmediato = $row['T_PUESTO'];
				$cont++;
			}
			$dependencia1 = $_SESSION['dep_cod']; 
			// SE AGREGO ESTA VALIDACIÓN POR LA REESTRUCTURACIÓN DE BRIGADAS, POR EL TIEMPO EN LA TABLA TIEMPOS
			// ESTAS PERSONAS NO PODIAN EVALUAR, POR LO QUE SE CÁLCULO EL TIEMPO CON BASE AL PUESTO ANTERIOR
			if($dependencia1 == '2665' || $dependencia1 == '2660' || $dependencia1 == '2810' || $dependencia1 == '2815' || $dependencia1 == '2680'|| $dependencia1 == '2685'|| $dependencia1 == '2640' || $dependencia1 == '2960' ){
				// echo "hola";
				$tiempoQuery = $ClsPer->calculoTiempoDpue($cat)[0]['PUE_FEC_NOMB']; 
				$fecha1 = new DateTime($tiempoQuery);
				// var_dump($fecha1);
				$fechaActual = new DateTime();
				$diferencia = $fecha1->diff($fechaActual);
				// echo json_encode($diferencia);
				$years = str_pad($diferencia->y, 2, "0", STR_PAD_LEFT);
				$months = str_pad($diferencia->m, 2, "0", STR_PAD_LEFT);
				$days = str_pad($diferencia->d, 2, "0", STR_PAD_LEFT);
		
				// echo json_encode($t_pue);
				// echo json_encode($months);
				// echo json_encode($days);
		
				$t_puesto_inmediato = ($years != '00' ? $years : '') . ( $months != '00' ? $months : '' ) . ($days != '00' ? $days : '');
			}
			if ($codigo_grado3 == 46 || $codigo_grado3 == 59 || $codigo_grado3 == 65 || $codigo_grado3 == 73 || $codigo_grado3 == 81 || $codigo_grado3 == 88 || $codigo_grado3 == 92 || $codigo_grado3 == 93 || $codigo_grado3 == 96 || $codigo_grado3 == 97 || $codigo_grado3 == 99 || $codigo_grado3 == 40){
				$nombre1 = $nombre;
			}else{
				$nombre1 = $nombre;
			}
			
			$t_puesto_inmediato = tiempo($t_puesto_inmediato);
			$t_puesto_inmediato = utf8_decode($t_puesto_inmediato);
			if($cont == 1){ // si el contador viene igual a 1 le coloco los valores a los campos
				$respuesta->assign("nombre_comte","value",$nombre1);	// le asigno el contenido a respuesta para insertarlo en el elemento
				$respuesta->assign("empleo3","value",$empleo);	// le asigno el contenido a respuesta para insertarlo en el elemento
				$respuesta->assign("tiempo3","value",$t_puesto_inmediato);	// le asigno el contenido a respuesta para insertarlo en el elemento
				$respuesta->assign("codigo_grado3","value",$codigo_grado3);	// le asigno el contenido a respuesta para insertarlo en el elemento
				$respuesta->assign("codigo_arma3","value",$codigo_arma3);	// le asigno el contenido a respuesta para insertarlo en el elemento
				
				// SE MANDA A LLAMAR LA FUNCION PARA QUE COLOQUE LOS DATOS EN LOS CAMPOS SI YA EXISTE COMO USUARIO
				// $respuesta->script("xajax_Coloca_Info($cat)");
			}
		}else{
			$respuesta->alert("Catalogo invalido");	// si no trae datos levanto una alerta.
			$respuesta->assign("per_nombre","value",'');	// le asigno el contenido a respuesta para insertarlo en el elemento
		}
		return $respuesta;
	}
	
	function Grabar_evaluacion($evaluacion,$linea,$destino,$autoevaluado,$inmediato,$eva_final,$codigo_arma1,$codigo_grado1,$empleo1,$tiempo1,$codigo_arma2,$codigo_grado2,$empleo2,$tiempo2,$codigo_arma3,$codigo_grado3,$empleo3,$tiempo3,
	$puesto_ant,$dep,$renglon,$obs_inmediato,$obs_final,$tipo_evaluacion,$preguntas,$usuario,$obs){
		$respuesta = new xajaxResponse();
		$ClsIng = new ClsIngreso();
		$max = $ClsIng->trae_max_eva();
		$max++;
		$puesto_ant = trim($puesto_ant);
		$empleo1 = trim($empleo1);
		$empleo2 = trim($empleo2);
		$empleo3 = trim($empleo3);
		$empleo3 = trim($empleo3);
		date_default_timezone_set('America/Guatemala');
		$dias= date("d");
		$mes= date("m");
		$annio = date("Y");
		$fecha = $annio."/".$mes."/".$dias;
		$sql = $ClsIng->insert_evaluacion($max,$evaluacion,$linea,$destino,$autoevaluado,$inmediato,$eva_final,$codigo_arma1,$codigo_grado1,$empleo1,$tiempo1,$codigo_arma2,$codigo_grado2,$empleo2,$tiempo2,$codigo_arma3,$codigo_grado3,$empleo3,$tiempo3,$puesto_ant,$dep,$renglon,$obs_inmediato,$obs_final,$tipo_evaluacion,$obs);
		
			for($i = 1; $i <= 20; $i++){
				$preg = $preguntas[$i];
				if($i <= 5){
					$sql.= $ClsIng->inserta_notas(1,$max,$i,$preg,$tipo_evaluacion,$fecha,$usuario);
				}else if($i >5 and  $i <= 10){
					$sql.= $ClsIng->inserta_notas(2,$max,$i,$preg,$tipo_evaluacion,$fecha,$usuario);
				}else if($i >10 and  $i <= 15){
					$sql.= $ClsIng->inserta_notas(3,$max,$i,$preg,$tipo_evaluacion,$fecha,$usuario);
				}else if($i >15 and  $i <= 20){
					$sql.= $ClsIng->inserta_notas(4,$max,$i,$preg,$tipo_evaluacion,$fecha,$usuario);
				}		
			}
		
		$rs = $ClsIng->exec_sql($sql);
			if($rs == 1){
				$respuesta->call('xajax_Alert_Entregado', 1);
				$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
			}else{
				$respuesta->alert("ERROR DE CONEXION");
			}
		// $respuesta->alert($rs);
		return $respuesta;
	}
	
	
	function Alert_Entregado($valor){
		$respuesta = new xajaxResponse();
		
		$alert_certificar = html_alert_entregado($valor);
		if($valor != ""){
			$respuesta->assign("alert_modal","innerHTML",$alert_certificar);
		}else{
			$respuesta->assign("alert","innerHTML",$alert_certificar);
		}
		return $respuesta;
	} 
	
	
	function Grabar_borrador($evaluacion,$linea,$destino,$autoevaluado,$inmediato,$eva_final,$codigo_arma1,$codigo_grado1,$empleo1,$tiempo1,$codigo_arma2,$codigo_grado2,$empleo2,$tiempo2,$codigo_arma3,$codigo_grado3,$empleo3,$tiempo3,
	$puesto_ant,$dep,$renglon,$tipo_evaluacion){
		$respuesta = new xajaxResponse();
		$ClsIng = new ClsIngreso();
		$ClsPer = new ClsPersonal();
		$max = $ClsIng->trae_max_eva();
		$max++;
		$puesto_ant = trim($puesto_ant);
		$empleo1 = trim($empleo1);
		$empleo2 = trim($empleo2);
		$empleo3 = trim($empleo3);
		$empleo3 = trim($empleo3);
		date_default_timezone_set('America/Guatemala');
		$dias= date("d");
		$mes= date("m");
		$annio = date("Y");
		$fecha = $annio."/".$mes."/".$dias;
		$obs_inmediato = '';
		$obs_final = '';
		$obs = '';
		$total_sol = $ClsPer->comprueba_auto($autoevaluado,$evaluacion,1);
		if($total_sol > 0){
			$respuesta->alert("ESTE CATALOGO YA TIENE UNA EVALUACION EN PROCESO");
		}else{
			$sql = $ClsIng->insert_evaluacion($max,$evaluacion,$linea,$destino,$autoevaluado,$inmediato,$eva_final,$codigo_arma1,$codigo_grado1,$empleo1,$tiempo1,$codigo_arma2,$codigo_grado2,$empleo2,$tiempo2,$codigo_arma3,$codigo_grado3,$empleo3,$tiempo3,$puesto_ant,$dep,$renglon,$obs_inmediato,$obs_final,$tipo_evaluacion,$obs);

			$rs = $ClsIng->exec_sql($sql);
				if($rs == 1){
					$respuesta->call('xajax_Alert_Entregado', 2);
					$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
				}else{
					$respuesta->alert("ERROR DE CONEXION");
				}
		}
		// $respuesta->alert($sql);
		return $respuesta;
	}
	
	
	function Grabar_evaluacion1($cod_eva,$tipo_evaluacion,$preguntas,$usuario,$obs_inmediato,$obs_final,$obs,$autoevaluado){
		$respuesta = new xajaxResponse();
		$ClsIng = new ClsIngreso();
		date_default_timezone_set('America/Guatemala');
		$dias= date("d");
		$mes= date("m");
		$annio = date("Y");
		$fecha = $annio."/".$mes."/".$dias;
		$total_eva = $ClsIng->verifica_notas1($cod_eva,1,$autoevaluado);
		if($total_eva == 0){
		$sql = $ClsIng->update_evaluacion($cod_eva,$tipo_evaluacion,$obs_inmediato,$obs_final,$obs);
			for($i = 1; $i <= 20; $i++){
				$preg = $preguntas[$i];
				if($i <= 5){
					$sql.= $ClsIng->inserta_notas(1,$cod_eva,$i,$preg,1,$fecha,$usuario);
				}else if($i >5 and  $i <= 10){
					$sql.= $ClsIng->inserta_notas(2,$cod_eva,$i,$preg,1,$fecha,$usuario);
				}else if($i >10 and  $i <= 15){
					$sql.= $ClsIng->inserta_notas(3,$cod_eva,$i,$preg,1,$fecha,$usuario);
				}else if($i >15 and  $i <= 20){
					$sql.= $ClsIng->inserta_notas(4,$cod_eva,$i,$preg,1,$fecha,$usuario);
				}		
			}
		}else{
			$respuesta->alert("ESTA EVALUACION YA TIENE NOTAS INGRESADAS EN EL SISTEMA");
		}
		$rs = $ClsIng->exec_sql($sql);
		// $respuesta->alert($rs);
			if($rs == 1){
				$respuesta->call('xajax_Alert_Entregado', $tipo_evaluacion);
				$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
			}else{
				$respuesta->alert("ERROR DE CONEXION");
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
	
	$xajax->register(XAJAX_FUNCTION, "Trae_Datos_Catalogo_inmediato");
	$xajax->register(XAJAX_FUNCTION, "Trae_Datos_Catalogo_comte");
	$xajax->register(XAJAX_FUNCTION, "Grabar_evaluacion");
	$xajax->register(XAJAX_FUNCTION, "Alert_Entregado");
	$xajax->register(XAJAX_FUNCTION, "Grabar_borrador");
	$xajax->register(XAJAX_FUNCTION, "Grabar_evaluacion1");
	$xajax->register(XAJAX_FUNCTION, "Eliminar_evaluacion");
	$xajax->register(XAJAX_FUNCTION, "Alert_Eliminado");
	$xajax->processRequest();
	
?>