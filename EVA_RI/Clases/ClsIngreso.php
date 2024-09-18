<?php
require_once ("ClsConex.php");

class ClsIngreso extends ClsConex{
	
	//function verifica_notas($cod_eva){
		//$sql = "select count(not_preg) as total from eva_notas,
		//eva_evaluacion where not_evaluacion = eva_id
		//and eva_id = $cod_eva;";
		//$result = $this->exec_query($sql);
		//	foreach ($result as $row){
					//$total = $row['TOTAL'];
			//}
		//return $total;
	//}

	function verifica_notas1($cod_eva,$not_tipo,$autoevaluado){
		$sql = "select sum(not_preg) as total from eva_evaluacion,eva_notas
		where not_evaluacion = eva_id
		and eva_cat1=$autoevaluado
		and eva_id=$cod_eva
		and not_tipo=$not_tipo";
		$result = $this->exec_query($sql);
			foreach ($result as $row){
					$total = $row['TOTAL'];
			}
		return $total;
	}
	
	function update_evaluacion_toda($cod_eva,$linea,$destino,$renglon,$inmediato,$eva_final,$codigo_arma2,$codigo_arma3,$codigo_grado2,$codigo_grado3,$empleo2,$empleo3,$tiempo2,$tiempo3,$empleo1,$tiempo1,$puesto_ant){
		$sql = "UPDATE eva_evaluacion set";
		$sql.= " eva_linea = $linea,";
		$sql.= " eva_dest_actual = '$destino',";
		$sql.= " eva_renglon = $renglon,";
		$sql.= " eva_cat2 = $inmediato,";
		$sql.= " eva_cat3 = $eva_final,";
		$sql.= " eva_arma2 = $codigo_arma2,";
		$sql.= " eva_arma3 = $codigo_arma3,";
		$sql.= " eva_grado2 = $codigo_grado2,";
		$sql.= " eva_grado3 = $codigo_grado3,";
		$sql.= " eva_empleo2 = '$empleo2',";
		$sql.= " eva_empleo3 = '$empleo3',";
		$sql.= " eva_tiempo2 = '$tiempo2',";
		$sql.= " eva_tiempo3 = '$tiempo3',";
		$sql.= " eva_empleo1 = '$empleo1',";
		$sql.= " eva_tiempo1 = '$tiempo1',";
		$sql.= " eva_emp_ant = '$puesto_ant'";
		$sql.= " where eva_id = $cod_eva;";
		return $sql;	
	}
	
	
	function eliminar_evaluacion($cod_eva){
		$sql = "UPDATE eva_evaluacion set";
		$sql.= " eva_situacion = 9";
		$sql.= " where eva_id = $cod_eva;";
		return $sql;	
	}

	function anulacion_evaluacion($cod_eva){
		$sql = "UPDATE eva_evaluacion set";
		$sql.= " eva_situacion = 35";
		$sql.= " where eva_id = $cod_eva;";
		return $sql;	
	}
	
	
	function certificar_evaluacion($cod_eva,$situacion){
		$sql = "UPDATE eva_evaluacion set";
		if($situacion == 1 or $situacion==4 or $situacion==35){
		$sql.= " eva_situacion = 28,";
		}
		if($situacion == 8 or $situacion==12){
		$sql.= " eva_situacion = 29,";
		}
		if($situacion == 13){
		$sql.= " eva_situacion = 30,";
		}
		if($situacion==15 or $situacion == 19 or $situacion==6){
		$sql.= " eva_situacion = 31,";
		}
		if($situacion == 22 or $situacion==17){
		$sql.= " eva_situacion = 32,";
		}
		if($situacion == 27){
		$sql.= " eva_situacion = 33,";
		}
		$sql.=" eva_usuario = user,";
		$sql .= " eva_fecha_aprov = CURRENT YEAR TO MINUTE";
		$sql.= " where eva_id = $cod_eva";
		$sql.= " and eva_situacion in (1,4,6,8,12,13,17,19,22,27,35);";
		return $sql;	
	}
	
	
	function impugnar_evaluacion($cod_eva){
		$sql = "UPDATE eva_evaluacion set";
		$sql.= " eva_situacion = 34";
		$sql.= " where eva_id = $cod_eva;";
		return $sql;	
	}
	
	function update_evaluacion($cod_eva,$tipo_evaluacion,$obs_inmediato,$obs_final,$obs){
		$sql = "UPDATE eva_evaluacion set";
		$sql.= " eva_situacion = $tipo_evaluacion,";
		$sql.= " eva_obs_inm = '$obs_inmediato',";
		$sql.= " eva_obs_final = '$obs_final',";
		$sql.= " eva_obs = '$obs'";
		$sql.= " where eva_id = $cod_eva;";
		return $sql;	
	}
	
	function insert_evaluacion($max,$evaluacion,$linea,$destino,$autoevaluado,$inmediato,$eva_final,$codigo_arma1,$codigo_grado1,$empleo1,$tiempo1,$codigo_arma2,$codigo_grado2,$empleo2,$tiempo2,$codigo_arma3,$codigo_grado3,$empleo3,
	$tiempo3,$puesto_ant,$dep,$renglon,$obs_inmediato,$obs_final,$tipo_evaluacion,$obs){
		$sql = "INSERT INTO eva_evaluacion values(";
		$sql.= " $max, '$evaluacion', $renglon, $linea, '$destino', $autoevaluado, $inmediato, $eva_final, ";
		$sql.= " $codigo_arma1, $codigo_arma2, $codigo_arma3, $codigo_grado1,";
		$sql.= " $codigo_grado2, $codigo_grado3, '$empleo1', '$empleo2', '$empleo3', '$tiempo1',";
		$sql.= " '$tiempo2', '$tiempo3',";
		$sql.= " '$puesto_ant', $tipo_evaluacion, '$obs_inmediato', '$obs_final', '$dep','$obs','','');";
		return $sql;	
	}
	
	
	function inserta_notas($factor,$max,$i,$preg,$tipo_evaluacion,$fecha,$usuario){
		$sql = "INSERT INTO eva_notas values(0,";
		$sql.= " $factor,$max,$i,'$preg',$tipo_evaluacion,'$fecha',$usuario);";
		return $sql;
	}

	function inserta_notas2($factor,$max,$i,$preg,$tipo_evaluacion,$fecha,$usuario){
		$sql = "INSERT INTO eva_notas values(61,";
		$sql.= " $factor,$max,$i,'$preg',$tipo_evaluacion,'$fecha',$usuario);";
		return $sql;
	}
	
	// ESTP ME PUEDE SERVIR PARA TRAER AL SUBJEFE Y JEFE DEL EMDN
	function trae_log_mdn($dep){
		$sql = "select * from morg,mper";
		$sql.= " where org_plaza = per_plaza";
		if($dep == 2010){
			$sql.= " and per_plaza = 7762495";
		}else if($dep == 2160){
			$sql.= " and per_plaza = 7762495";
		}
		$sql.= " and org_dependencia = $dep";
		
	}
	
	// ESTE ME PUEDE SERVIR PARA TRAER EL MAXIMO
	function trae_max_eva(){
		$sql ="SELECT MAX(eva_id) as maximo";
		$sql.=" FROM eva_evaluacion";
		$result = $this->exec_query($sql);
		foreach($result as $row){
			$maximo = $row['MAXIMO'];
		}
		return $maximo;
	}
	
	
	//COMBO PARA MANDAR A TRAER TODAS LAS LINEAS DE CARRERA ACTUALES
	function get_linea(){
		$sql = " SELECT * FROM eva_linea ";
		$sql.= " WHERE lin_situacion=1";
		$result = $this->exec_query($sql);
		return $result;		
	}

		function grados2(){
        $sql= "	 SELECT gra_desc_md, gra_codigo";
		$sql.= " FROM grados WHERE gra_codigo in (40,36,42,44,64,62,58,55,69,71,73,81,85,88,77,79,52,66.60,50,51,89,86,93,97,74,70,72,41,121,37,39,43,45,80,57,78,82,59,65,54,61,63,92,46,60,73,47,66)";
		$sql.= " ORDER BY gra_desc_md";
        $result =$this->exec_query($sql);
		return $result;
	}
	//COMBO PARA MANDAR A TRAER DESTINOS
	function get_destino(){
		$sql = " SELECT * FROM eva_dest ";
		$sql.= " WHERE des_situacion=1";
		$result = $this->exec_query($sql);
		return $result;		
	}

	function grabar_est_fuer_nuevo1($alumnos_h,$alumnos_m,$dependencia){
		$sql = "INSERT INTO ef_fuerza_rsvp values('2019-02-23', $dependencia, $alumnos_h, $alumnos_m, 1);";
		return $sql;	
	}

	function grabar_est_fuer_nuevo2($date,$reservistas_h,$reservistas_m,$dependencia){
		
		$sql = " INSERT INTO ef_fuerza_ce values('$date', $dependencia, $reservistas_h, $reservistas_m, 2 );";
		return $sql;	
	}

	function grabar_est_fuer_nuevo3($date,$contrato_h,$contrato_m,$dependencia){
		$sql = " INSERT INTO ef_fuerza_ce values('$date', $dependencia, $contrato_h, $contrato_m, 3 );";
		return $sql;	
	}

	function select_fecha(){
		$sql = " SELECT to_char (extend (current, YEAR to DAY), '%Y-%m-%d') as tiempo from systables where tabid = 1;";
		$result = $this->exec_query($sql);
			foreach ($result as $row){
					$date = $row['TIEMPO'];
			}
		return $date;		


	}

	function obtener_fecha(){ 
		$sql = " SELECT to_char (extend (current, YEAR to DAY), '%Y-%m-%d') as tiempo from systables where tabid = 1;";
	  	$result = $this->exec_query($sql);
		foreach ($result as $row){
			$date = $row['TIEMPO'];

		}
		 
		return $date;
		}

function guardar_reservistas($fecha,$dep,$reservistah,$reservistam){
			$sql="insert into ef_fuerza_ce values ('$fecha',$dep, $reservistah, $reservistam, 2);";
		
			return $sql;
		}

	function guardar_contrato($fecha,$dep,$contratoh,$contratom){
			$sql="insert into ef_fuerza_ce values ('$fecha',$dep, $contratoh, $contratom, 3);";
		
			return $sql;
		}




}
?>