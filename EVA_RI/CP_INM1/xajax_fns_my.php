<?php
include_once('html_fns_my.php');
require ('../xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');  // debe llevar esta linea de codigo para 
$xajax->configure('decodeUTF8Input',true);  // para corregir 

	
	function Grabar_evaluacion($cod_eva,$tipo_evaluacion,$preguntas,$usuario,$obs_inmediato,$obs_final,$obs,$autoevaluado){
		$respuesta = new xajaxResponse();
		$ClsIng = new ClsIngreso();
		date_default_timezone_set('America/Guatemala');
		$dias= date("d");
		$mes= date("m");
		$annio = date("Y");
		$fecha = $annio."/".$mes."/".$dias;
		if($tipo_evaluacion==18){
			$total_eva = $ClsIng->verifica_notas1($cod_eva,2,$autoevaluado);
		}else{
			$total_eva = $ClsIng->verifica_notas1($cod_eva,2,$autoevaluado);
		}
		//$respuesta->alert($total_eva);
		//return $respuesta;

		if($total_eva > 0){
			$respuesta->alert("ESTA EVALUACION YA TIENE NOTAS INGRESADAS EN EL SISTEMA");
			return $respuesta;
		}

		$sql = $ClsIng->update_evaluacion($cod_eva,$tipo_evaluacion,$obs_inmediato,$obs_final,$obs);
			if($tipo_evaluacion == 5){
				for($i = 1; $i <= 20; $i++){
					$preg = $preguntas[$i];
					if($i <= 5){
						$sql.= $ClsIng->inserta_notas(1,$cod_eva,$i,$preg,2,$fecha,$usuario);
					}else if($i >5 and  $i <= 10){
						$sql.= $ClsIng->inserta_notas(2,$cod_eva,$i,$preg,2,$fecha,$usuario);
					}else if($i >10 and  $i <= 15){
						$sql.= $ClsIng->inserta_notas(3,$cod_eva,$i,$preg,2,$fecha,$usuario);
					}else if($i >15 and  $i <= 20){
						$sql.= $ClsIng->inserta_notas(4,$cod_eva,$i,$preg,2,$fecha,$usuario);
					}		
				}
			}else if($tipo_evaluacion == 6 or $tipo_evaluacion == 13){
				for($i = 1; $i <= 20; $i++){
					$preg = $preguntas[$i];
					if($i <= 5){
						$sql.= $ClsIng->inserta_notas(1,$cod_eva,$i,$preg,3,$fecha,$usuario);
					}else if($i >5 and  $i <= 10){
						$sql.= $ClsIng->inserta_notas(2,$cod_eva,$i,$preg,3,$fecha,$usuario);
					}else if($i >10 and  $i <= 15){
						$sql.= $ClsIng->inserta_notas(3,$cod_eva,$i,$preg,3,$fecha,$usuario);
					}else if($i >15 and  $i <= 20){
						$sql.= $ClsIng->inserta_notas(4,$cod_eva,$i,$preg,3,$fecha,$usuario);
					}		
				}
			}else if($tipo_evaluacion == 18){
				for($i = 1; $i <= 20; $i++){
					$preg = $preguntas[$i];
					if($i <= 5){
						$sql.= $ClsIng->inserta_notas(1,$cod_eva,$i,$preg,2,$fecha,$usuario);
					}else if($i >5 and  $i <= 10){
						$sql.= $ClsIng->inserta_notas(2,$cod_eva,$i,$preg,2,$fecha,$usuario);
					}else if($i >10 and  $i <= 15){
						$sql.= $ClsIng->inserta_notas(3,$cod_eva,$i,$preg,2,$fecha,$usuario);
					}else if($i >15 and  $i <= 20){
						$sql.= $ClsIng->inserta_notas(4,$cod_eva,$i,$preg,2,$fecha,$usuario);
					}		
				}
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
	
	
	function Alert_Entregado($tipo_evaluacion){
		$respuesta = new xajaxResponse();
		
		$alert_certificar = html_alert_entregado($tipo_evaluacion);
		if($tipo_evaluacion != ""){
			$respuesta->assign("alert_modal","innerHTML",$alert_certificar);
		}else{
			$respuesta->assign("alert","innerHTML",$alert_certificar);
		}
		return $respuesta;
	} 
	
	
	function Trae_Datos_Catalogo_inmediato($cat){
		$respuesta = new xajaxResponse();
		$ClsPer = new ClsPersonal();
		// $respuesta->alert($cat);
		$result = $ClsPer->get_personal_usuario($cat);

		if(is_array($result)){
			
			$cont = 0;
			foreach($result as $row){
				$codigo_grado2 = $row["GRA_CODIGO"];
				$nombre = $row["PER_APE1"].' '.$row["PER_APE2"].', '.$row["PER_NOM1"].' '.$row["PER_NOM2"];
				$empleo = $row["PER_DESC_EMPLEO"];	// asigno la información en la variable
				$grado = $row["GRA_DESC_CT"];	// asigno la información en la variable
				$arma = $row["ARM_DESC_CT"];	// asigno la información en la variable
				$codigo_arma2 = $row["ARM_CODIGO"];	// asigno la información en la variable
				$t_puesto_inmediato = $row['T_PUESTO'];
				$cont++;
			}
			if ($codigo_grado2 == 46 || $codigo_grado2 == 59 || $codigo_grado2 == 65 || $codigo_grado2 == 73 || $codigo_grado2 == 81 || $codigo_grado2 == 88 || $codigo_grado2 == 92 || $codigo_grado2 == 93 || $codigo_grado2 == 96 || $codigo_grado2 == 97 || $codigo_grado2 == 99 || $codigo_grado2 == 40){
				$nombre1 = $grado.' '.$nombre;
			}else{
				$nombre1 = $grado.' DE '.$arma.' '.$nombre;
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
				$nombre = $row["PER_APE1"].' '.$row["PER_APE2"].', '.$row["PER_NOM1"].' '.$row["PER_NOM2"];
				$empleo = $row["PER_DESC_EMPLEO"];	// asigno la información en la variable
				$grado = $row["GRA_DESC_CT"];	// asigno la información en la variable
				$arma = $row["ARM_DESC_CT"];	// asigno la información en la variable
				$codigo_arma3 = $row["ARM_CODIGO"];	// asigno la información en la variable
				$t_puesto_inmediato = $row['T_PUESTO'];
				$cont++;
			}
			if ($codigo_grado3 == 46 || $codigo_grado3 == 59 || $codigo_grado3 == 65 || $codigo_grado3 == 73 || $codigo_grado3 == 81 || $codigo_grado3 == 88 || $codigo_grado3 == 92 || $codigo_grado3 == 93 || $codigo_grado3 == 96 || $codigo_grado3 == 97 || $codigo_grado3 == 99 || $codigo_grado3 == 40){
				$nombre1 = $grado.' '.$nombre;
			}else{
				$nombre1 = $grado.' DE '.$arma.' '.$nombre;
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
	
	
	
	function update_borrador($periodo,$cod_eva,$linea,$destino,$autoevaluado,$inmediato,$eva_final,$codigo_arma1,$codigo_grado1,
$empleo1,$tiempo1,$codigo_arma2,$codigo_grado2,$empleo2,$tiempo2,$codigo_arma3,$codigo_grado3,$empleo3,$tiempo3,$puesto_ant,$dep,$renglon,$tipo_evaluacion){
		$respuesta = new xajaxResponse();
		$ClsIng = new ClsIngreso();
		$sql = $ClsIng->update_evaluacion_toda($cod_eva,$linea,$destino,$renglon,$inmediato,$eva_final,$codigo_arma2,$codigo_arma3,$codigo_grado2,$codigo_grado3,$empleo2,$empleo3,$tiempo2,$tiempo3,$empleo1,$tiempo1,$puesto_ant);
		
		$rs = $ClsIng->exec_sql($sql);
		// $respuesta->alert($sql);
			if($rs == 1){
				$respuesta->call('xajax_Alert_Entregado', $tipo_evaluacion);
				$respuesta->script("$('#alert_modal').modal({backdrop:'static',keyboard:false, show:true});$('#alert_modal').modal('show')");
			}else{
				$respuesta->alert("ERROR DE CONEXION//Porfavor revise los catalogos si estan correctamente ingresados//");
			}
		return $respuesta;
	}

	$xajax->register(XAJAX_FUNCTION, "Grabar_evaluacion");
	$xajax->register(XAJAX_FUNCTION, "Alert_Entregado");
	$xajax->register(XAJAX_FUNCTION, "Trae_Datos_Catalogo_inmediato");
	$xajax->register(XAJAX_FUNCTION, "Trae_Datos_Catalogo_comte");
	$xajax->register(XAJAX_FUNCTION, "update_borrador");
	$xajax->processRequest();
	
?>