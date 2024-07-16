<?php
require_once ("ClsConex.php");

class ClsPersonal extends ClsConex{

	function get_periodo(){
		$sql = "select distinct eva_periodo";
		$sql.= " from eva_evaluacion";
		$sql.= " where eva_situacion in(1,4,6,8,13,12,15,17,19,22,23,27,28,29,30,31,32,33,34)";
		$sql.= " order by eva_periodo DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_periodo12016(){
		$sql = "select distinct eva_periodo";
		$sql.= " from eva_evaluacion";
		$sql.= " where eva_situacion in(28,29,30,31,32,33)";
		$sql.= " order by eva_periodo DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_of($dependencia,$comp_eva){
		$sql = "SELECT per_catalogo, per_nom1,per_nom2,per_ape1,per_ape2,per_sexo,
		gra_desc_ct,arm_desc_ct, gra_codigo, arm_codigo
		FROM mper,morg,grados,armas
		WHERE org_plaza = per_plaza
		AND per_grado=gra_codigo
		AND gra_clase in (1,2)
		AND arm_codigo=per_arma
		AND org_dependencia = $dependencia
		AND org_situacion ='A'
		and per_catalogo not in
		(SELECT eva_cat1 from eva_evaluacion 
		where eva_periodo = '$comp_eva' and eva_situacion 
		in (0,1,2,3,4,5,6,7,8,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35))
		ORDER BY gra_codigo DESC, org_plaza ASC;";

		//echo $sql;
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function trae_linea($linea){
			$sql = "select lin_desc_lg from eva_linea
			where lin_id = $linea";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$linea1 = $row['LIN_DESC_LG'];
			}
		return $linea1;
	}
	
	function trae_nota_total($eva){
			$sql = "select sum(not_nota) as total from eva_notas, eva_evaluacion
			where not_evaluacion = eva_id
			and eva_id = $eva";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$total = $row['TOTAL'];
			}
		return $total;
	}
	function trae_nota_total1($eva){
			$sql = "select sum(not_nota) as total1 from eva_notas, eva_evaluacion where not_evaluacion=eva_id and  eva_id = $eva and not_tipo=1";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$total1 = $row['TOTAL1'];
			}
		return $total1;
	}

	function trae_nota_total2($eva){
			$sql = "select sum(not_nota) as total2 from eva_notas, eva_evaluacion where not_evaluacion=eva_id and  eva_id = $eva and not_tipo=2";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$total2 = $row['TOTAL2'];
			}
		return $total2;
	}
	
	function trae_nota_total3($eva){
			$sql = "select sum(not_nota) as total3 from eva_notas, eva_evaluacion where not_evaluacion=eva_id and  eva_id = $eva and not_tipo=3";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$total3 = $row['TOTAL3'];
			}
		return $total3;
	}

	function trae_nota_total5($eva){
			$sql = "select sum(not_nota) as total5 from eva_notas, eva_evaluacion where not_evaluacion=eva_id and  eva_id = $eva and not_tipo=5";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$total5 = $row['TOTAL5'];
			}
		return $total5;
	}

	function trae_nota_total6($eva){
			$sql = "select sum(not_nota) as total6 from eva_notas, eva_evaluacion where not_evaluacion=eva_id and  eva_id = $eva and not_tipo=6";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$total6 = $row['TOTAL6'];
			}
		return $total6;
	}

	function trae_notas($eva,$cod){
	$sql = "select sum(not_nota) as total from eva_notas, eva_evaluacion
			where not_evaluacion = eva_id
			and eva_id = $eva
			and not_preg = $cod";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$total = $row['TOTAL'];
			}
		return $total;
	}
	
	function trae_notas_por_una($eva,$tipo,$num,$fac){
	$sql = "select not_nota as nota from eva_notas, eva_evaluacion
			where
			not_evaluacion =eva_id
			and eva_id = $eva
			and not_tipo= $tipo
			and not_preg=$num
			and not_factores=$fac";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$nota = $row['NOTA'];
			}
		return $nota;
	}
	function trae_tipo($eva, $tipo){
			$sql = "select count(not_preg) as total from eva_notas, eva_evaluacion
			where not_evaluacion = eva_id
			and eva_id = $eva
			and not_tipo = $tipo;";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$total = $row['TOTAL'];
			}
		return $total;

	}
	
	function trae_fecha($eva){
			$sql = "select not_fecha from eva_notas
					where not_evaluacion = $eva
					and not_preg = 1
					and not_tipo in (3,6)";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$fecha = $row['NOT_FECHA'];
			}
		return $fecha;
	}
	
	function trae_grados($grado,$cod){
		if($cod == 2){
			$sql = "SELECT gra_desc_ct from grados
			where gra_codigo = $grado";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$grado = $row['GRA_DESC_CT'];
			}
		}else{
			$sql = "SELECT gra_desc_lg from grados
			where gra_codigo = $grado";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$grado = $row['GRA_DESC_LG'];
			}
		}
		return $grado;
	}
	
	function trae_armas($armas,$cod){
		if($cod == 2){
			$sql = "SELECT arm_desc_ct from armas
			where arm_codigo = $armas";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$grado = $row['ARM_DESC_CT'];
			}
		}else{
			$sql = "SELECT arm_desc_lg from armas
			where arm_codigo = $armas";
			$result = $this->exec_query($sql);
			foreach ($result as $row){
					$grado = $row['ARM_DESC_LG'];
			}
		}
		return $grado;
	}
	
	function get_eva($eva){
		$sql = "select * from eva_evaluacion 
				where eva_id = $eva;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function get_oficiales_inmediato($situacion,$dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		and eva_periodo = '$comp_eva'
		and eva_situacion = $situacion
		and eva_dep = $dependencia
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_admin($situacion,$dependencia){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		and eva_situacion = $situacion
		
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	//OJO MODIFICADO PARA ELIMINAR
	
	function get_oficiales_inmediato_jefe($situacion,$dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		and eva_periodo = '$comp_eva' 
		and eva_situacion = $situacion
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function Evaluar_Eva_Final($situacion,$dependencia,$comp_eva){
		$sql = "SELECT * from eva_evaluacion, mper, grados, armas, morg
		where eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		and eva_periodo = '$comp_eva'
		and eva_situacion = $situacion
		and eva_dep = $dependencia
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_admin3($situacion,$dependencia){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		and eva_situacion = $situacion
		
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_evalua_viceministro_caso_especial($situacion,$dependencia){
		
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_cat1 = per_catalogo
		and eva_empleo3='VICEMINISTRO DE LA DEFENSA NACIONAL'
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		and eva_situacion = 3
		and eva_dep in ($dependencia,2810)
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
		
	}

	function Evaluar_Eva_VJ($situacion,$dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion = $situacion
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	function get_oficiales_2comtes($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in (14,5,10)
		
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_3comtes($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in (20,21,22,23)
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function get_oficiales_inmediato_sub($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(4,11)
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function get_oficiales_inmediato_sub_nuevo($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(11,12,17)
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_inmediato2($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		
		and eva_periodo = '$comp_eva'
		and eva_situacion in(6,15,11)
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_admin2($situacion,$dependencia){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		
		and eva_situacion=$situacion
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	

	function get_oficiales_inmediato_evaluar($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		and eva_periodo = '$comp_eva'
		and eva_situacion = 2
		and eva_dep = $dependencia
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_inmediato_DIR($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion = 25
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_inmediato3($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion = $situacion
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	
	
	function get_oficiales_fin1($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(4,8,13,19,22,27,28,29,30,31,32,33,34,35)
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function get_directores($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(16,17,18)
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function get_oficiales_fin2($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(1,2,3,4,28)
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_total_admin($dependencia){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_situacion in(1,2,3,4,28)
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_Impugnados($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion = 34
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_Impugnados_anulados($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion = 35
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function get_oficiales_fin3($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		and eva_periodo = '$comp_eva'
		and eva_situacion in(5,6,7,8,10,11,12,13,29)
		
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_fin4($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(10,11,20)
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function get_oficiales_fin5($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(20,21,22,32)
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_oficiales_fin6($dependencia,$comp_eva){
		////VALIDACION ESPECIFICA PARA FINCA EL PINO /
		//eva_empleo3='VICEMINISTRO DE LA DEFENSA NACIONAL'---->VALIDACION PARA QUE EL PERSONAL DEL MDN PUEDA CALIFICAR EL SEÑOR VICEMINISTRO COMO EVALUADOR FINAL
		if($dependencia==2010){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_empleo3='VICEMINISTRO DE LA DEFENSA NACIONAL'
		and eva_situacion in(1,2,3,4,16,17,18,19,31)
		and eva_dep in ($dependencia,2810)
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
		}else{
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(16,17,18,19,31)
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
		}
		
	}
	
	function get_oficiales_fin7($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(24,25,26,27,33)
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	function get_oficiales_fin($situacion,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg,mdep
		where eva_periodo = '$comp_eva'
		and eva_situacion = $situacion
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		and eva_dep = dep_llave
		ORDER BY dep_llave ASC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function get_oficiales_fin_comte($comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg,mdep
		where eva_periodo = '$comp_eva'
		and eva_situacion in (6,7)
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		and eva_dep = dep_llave
		ORDER BY dep_llave ASC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function trae_rep_catalogo($catalogo,$periodo){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg,mdep";
		$sql.= " where eva_cat1 = per_catalogo";
		$sql.= " and per_catalogo = $catalogo";
		$sql.= " and eva_situacion in (4,8,13,19,22,27)";
		if($periodo != ""){
		$sql.= " and eva_periodo = '$periodo'";
		}
		$sql.= " and per_grado = gra_codigo";
		$sql.= " and per_arma = arm_codigo";
		$sql.= " and per_plaza = org_plaza";
		$sql.= " and eva_dep = dep_llave";
		$sql.= " ORDER BY eva_periodo ASC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function get_datos($dependencia,$comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(0,1,2,3,4,5,6,7,8,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35)
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function get_datos_evaluar($comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(1,2,3,4)
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_datos_comtes_2dos($comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(5,6,7,8,10,11,12,13)
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_datos_comtes_jefes($comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in(4,8,13,19,23,27)
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		ORDER BY gra_codigo DESC, org_plaza DESC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function get_datos_subjefe(){
		$sql = "SELECT *, 
		(SELECT gra_desc_md FROM grados WHERE gra_codigo = org_grado) 
		as org_grado_rec 
		 FROM armas, grados, morg, mdep,situaciones, mper,
		 OUTER tiempos
		 WHERE per_arma = arm_codigo AND per_grado = gra_codigo 
		 AND per_plaza = org_plaza
		 and org_plaza = 6899149
		 and per_grado=gra_codigo
		 AND gra_clase in (1,2)
		 AND org_dependencia = dep_llave 
		
		 AND per_situacion = sit_codigo 
		 AND per_catalogo = t_catalogo;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function get_datos_jefe(){
		$sql = "SELECT *, 
		(SELECT gra_desc_md FROM grados WHERE gra_codigo = org_grado) 
		as org_grado_rec 
		 FROM armas, grados, morg, mdep,situaciones, mper,
		 OUTER tiempos
		 WHERE per_arma = arm_codigo AND per_grado = gra_codigo 
		 AND per_plaza = org_plaza
		 and org_plaza = 6899139
		 and per_grado=gra_codigo
		 AND gra_clase in (1,2)
		 AND org_dependencia = dep_llave 
		
		 AND per_situacion = sit_codigo 
		 AND per_catalogo = t_catalogo;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function get_datos_cjd($comp_eva){
		$sql = "select * from eva_evaluacion, mper, grados, armas, morg,mdep
		where eva_periodo = '$comp_eva'
		and eva_situacion in(4,5,6,7,8)
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza
		and eva_dep = dep_llave
		ORDER BY eva_cat1 ASC;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function trae_preguntas($eva,$sit){
		$sql = "select * from eva_notas
		where not_evaluacion = $eva
		and not_tipo = $sit;";
		$result = $this->exec_query($sql);
		return $result;
	}
	

	
	function cuenta_preguntas($id_eva,$sit){
		$sql = "select count(not_id) as total from eva_notas
		where not_evaluacion = $id_eva
		and not_tipo = $sit;";
		$result = $this->exec_query($sql);
			foreach ($result as $row){
					$total = $row['TOTAL'];
			}
		return $total;
	}
	
	
	function cuenta_finalizados($situacion,$dependencia,$comp_eva){
		$sql = "select count(eva_id) from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion = $situacion
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function cuenta_fin_todos($dependencia,$comp_eva){
		$sql = "select count(eva_id) from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion in (1,2)
		and eva_dep = $dependencia
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function cuenta_finalizados1($situacion,$comp_eva){
		$sql = "select count(eva_id) from eva_evaluacion, mper, grados, armas, morg
		where eva_periodo = '$comp_eva'
		and eva_situacion = $situacion
		and eva_cat1 = per_catalogo
		and per_grado = gra_codigo
		and per_arma = arm_codigo
		and per_plaza = org_plaza;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function trae_rep_cat($catalogo,$comp_eva){
		$sql = "select * from eva_evaluacion,grados, armas,mdep,mper";
		$sql.= " where eva_cat1 = per_catalogo";
		$sql.= " and per_catalogo = $catalogo";
		$sql.= " and eva_situacion in(3,6,10,11)";
		$sql.= " and eva_grado1 = gra_codigo";
		$sql.= " and eva_arma1 = arm_codigo";
		$sql.= " and eva_dep = dep_llave";
		if($comp_eva != ""){
		$sql.= " and eva_periodo = '$comp_eva'";
		}
		$sql.= " ORDER BY eva_id ASC";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	
	function trae_rep_dep($dep,$comp_eva,$reporte){
		$sql = "select * from eva_evaluacion,grados, armas,mdep,mper";
		$sql.= " where eva_cat1 = per_catalogo";
		$sql.= " and eva_situacion in(1,4,6,8,12,13,17,19,22,27,28,29,30,31,32,33,34)";
		$sql.= " and eva_grado1 = gra_codigo";
		$sql.= " and eva_arma1 = arm_codigo";
		$sql.= " and eva_dep = dep_llave";
		$sql.= " and dep_llave = $dep";
		$sql.= " and eva_periodo = '$comp_eva'";
		if($reporte == 1 or $reporte == 2 or $reporte == 3){
			$sql.= " and eva_renglon = $reporte";
		}else if($reporte == 34){
			$sql.= " and eva_situacion = $reporte";
		}
		$sql.= " ORDER BY eva_cat1 ASC";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	
	function trae_para_certificar($catalogo, $dep, $periodo){
		$sql = "select * from eva_evaluacion,grados, armas,mdep,mper";
		$sql.= " where eva_cat1 = per_catalogo";
		if($catalogo != ""){
		$sql.= " and per_catalogo = $catalogo";
		}
		$sql.= " and eva_situacion in(1,6,4,8,12,13,15,17,19,22,27,28,29,30,31,32,33,34,35)";
		$sql.= " and eva_grado1 = gra_codigo";
		$sql.= " and eva_arma1 = arm_codigo";
		$sql.= " and eva_dep = dep_llave";
		if($dep != ""){
		$sql.= " and dep_llave = $dep";
		}
		if($periodo != ""){
		$sql.= " and eva_periodo = '$periodo'";
		}
		$sql.= " ORDER BY eva_cat1 ASC";
		$result = $this->exec_query($sql);
		return $result;
	}

	function trae_aprobados($catalogo, $dep, $periodo){
		$sql = "select * from eva_evaluacion,grados, armas,mdep,mper";
		$sql.= " where eva_cat1 = per_catalogo";
		if($catalogo != ""){
		$sql.= " and per_catalogo = $catalogo";
		}
		$sql.= " and eva_situacion in(28,29,30,31,32,33)";
		$sql.= " and eva_grado1 = gra_codigo";
		$sql.= " and eva_arma1 = arm_codigo";
		$sql.= " and eva_dep = dep_llave";
		if($dep != ""){
		$sql.= " and dep_llave = $dep";
		}
		if($periodo != ""){
		$sql.= " and eva_periodo = '$periodo'";
		}
		$sql.= " ORDER BY eva_cat1 ASC";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function comprueba_auto($usuario,$comp_eva,$sit){
		$sql = "SELECT count(eva_id) as total from eva_evaluacion
		where eva_cat1 = $usuario
		and eva_periodo = '$comp_eva'
		and eva_situacion in (0,1,2,3,4,5,6,7,8,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35);";
		$result = $this->exec_query($sql);
		foreach ($result as $row){
				$total = $row['TOTAL'];
		}
		return $total;
	}
	
	function get_dependencia() {
		$sql = " SELECT dep_desc_md, dep_llave";
		$sql.= " FROM mdep";
		$sql.= " WHERE dep_llave between 2000 and 4000";
		$sql.= " and dep_llave not in (2290, 2150, 2100, 2670,3000,2130)";
		$sql.= " ORDER BY dep_desc_ct asc";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function get_personal_usuario($usuario){
		$sql = "SELECT *, 
		(SELECT gra_desc_md FROM grados WHERE gra_codigo = org_grado) 
		as org_grado_rec 
		 FROM armas, grados, morg, mdep,situaciones, mper,
		 OUTER tiempos
		 WHERE per_arma = arm_codigo AND per_grado = gra_codigo 
		 AND per_plaza = org_plaza
		 and per_grado=gra_codigo
		 AND gra_clase in (1,2,3)
		 AND org_dependencia = dep_llave 
		
		 AND per_situacion = sit_codigo 
		 AND per_catalogo = t_catalogo
		AND per_catalogo = $usuario;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function get_personal_usuario1($usuario,$dep){
		$sql = "SELECT *, 
		(SELECT gra_desc_md FROM grados WHERE gra_codigo = org_grado) 
		as org_grado_rec 
		 FROM armas, grados, morg, mdep,situaciones, mper,
		 OUTER tiempos
		 WHERE per_arma = arm_codigo AND per_grado = gra_codigo 
		 AND per_plaza = org_plaza
		 and per_grado=gra_codigo
		 AND gra_clase in (1,2)
		 AND org_dependencia = dep_llave 
		AND dep_llave = $dep
		 AND per_situacion = sit_codigo 
		 AND per_catalogo = t_catalogo
		AND per_catalogo = $usuario;";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	//TRAE EL HISTORIAL DE PUESTOS
	function get_puestos($usuario){
		$sql= "SELECT first 1 pue_desc as puesto";
		// $sql.= " pue_fec_cese, pue_ord_gral, pue_punto_og,dep_desc_md";
		$sql.= " FROM dpue, grados, armas, situaciones,mdep";
		$sql.= " WHERE pue_grado = gra_codigo";
		$sql.= " AND pue_arma = arm_codigo";
		$sql.= " AND pue_situacion = sit_codigo";
		$sql.= " AND pue_dependencia = dep_llave";
		$sql.= " AND pue_catalogo = $usuario";
		$sql.= " ORDER BY pue_fec_nomb DESC;";		
		$result = $this->exec_query($sql);
		foreach($result as $row){
			$puesto = $row['PUESTO'];
		}
		return $puesto;
	}
	
	function get_personal_log($cat_ultimo){
		$sql = "SELECT per_catalogo, per_nom1,per_nom2,per_ape1,per_ape2,";
		$sql.= " gra_desc_ct,arm_desc_ct, gra_codigo, arm_codigo,arm_desc_lg";
		$sql.= " FROM mper,morg,grados,armas";
		$sql.= " WHERE per_catalogo = $cat_ultimo";
		$sql.= " and per_grado = gra_codigo";
		$sql.= " and per_arma = arm_codigo";
		$sql.= " and per_plaza = org_plaza";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	
	function obtener_oficina($usuario){
		$sql = " SELECT m.org_plaza,  m.org_plaza_desc";
		$sql.= " FROM morg as m";
		$sql.= " WHERE org_dependencia = (";
		$sql.= " select org_dependencia from morg,  mper";
		$sql.= " where per_plaza=org_plaza";
		$sql.= " and per_catalogo=$usuario";
		$sql.= " )";
		$sql.= " and org_jerarquia[1] =";
		$sql.= " (select org_jerarquia[1] from morg, mper";
		$sql.= " where per_plaza=org_plaza";
		$sql.= " and per_catalogo=$usuario";
		$sql.= " )";
		$sql.= " and org_jerarquia[2,3] =";
		$sql.= " (select org_jerarquia[2,3] from morg, mper";
		$sql.= " where per_plaza=org_plaza";
		$sql.= " and per_catalogo=$usuario";
		$sql.= " )";
		$sql.= " and org_jerarquia like '%0000000'";
		$result = $this->exec_query($sql);
		return $result;
	}
	
	function trae_logistico_comando($dep_cod){
		$sql = "select per_catalogo, per_nom1,per_nom2,per_ape1,";
		$sql.= " per_ape2,gra_desc_ct,arm_desc_ct, gra_codigo from mper, mdep,";
		$sql.= " morg,grados,armas where dep_llave = org_dependencia and";
		$sql.= " org_plaza = per_plaza and dep_llave = $dep_cod";
		$sql.= " and per_grado=gra_codigo and gra_codigo>=40";
		$sql.= " and gra_clase in (1,2,3) and arm_codigo=per_arma";
		$sql.= " and org_situacion = 'A' order by gra_codigo DESC, org_plaza ASC";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}
	
	function trae_comandante_comando($dep_cod){
		$sql = "SELECT per_plaza,per_catalogo,per_grado,per_nom1,";
		$sql.= " per_nom2,per_ape1,per_ape2,gra_desc_md,arm_desc_md"; 
		$sql.= " FROM mper,morg,grados,armas";
		$sql.= " where per_plaza = org_plaza";
		$sql.= " and per_grado = gra_codigo";
		$sql.= " and per_arma = arm_codigo";   
		$sql.= " and per_plaza IN (SELECT jef_plaza FROM jefes where";
		$sql.= " jef_categoria in (0101, 0102, 0103))";
		$sql.= " and org_dependencia = $dep_cod";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}

	function get_cate_217($periodo,$cate){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total4) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total4 >= $cate and per_situacion = 11 and per_catalogo= catalogo4 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}

	function get_cate_2172($periodo,$cate,$cate1){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total4) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total4 between $cate1 and $cate and per_situacion = 11 and per_catalogo= catalogo4 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}

	function get_cate_2751($periodo,$cate){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total4) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total4 = $cate and per_situacion = 11 and per_catalogo= catalogo4 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}


	function get_cate_11($periodo,$cate){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total2) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total2 >= $cate and per_situacion = 11 and per_catalogo= catalogo2 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}

	function get_cate_12($periodo,$cate,$cate1){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total2) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total2 between $cate1 and $cate and per_situacion = 11 and per_catalogo= catalogo2 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}

	function get_cate_13($periodo,$cate){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total2) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total2 = $cate and per_situacion = 11 and per_catalogo= catalogo2 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}

	function get_cate_14($periodo,$cate){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total3) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total3 >= $cate and per_situacion = 11 and per_catalogo= catalogo3 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}

	function get_cate_15($periodo,$cate,$cate1){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total3) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total3 between $cate1 and $cate and per_situacion = 11 and per_catalogo= catalogo3 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}

	function get_cate_16($periodo,$cate){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total3) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total3 = $cate and per_situacion = 11 and per_catalogo= catalogo3 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}


	function get_cate_1417($periodo,$cate){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total5) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total5 >= $cate and per_situacion = 11 and per_catalogo= catalogo5 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}

	function get_cate_1517($periodo,$cate,$cate1){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total5) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total5 between $cate1 and $cate and per_situacion = 11 and per_catalogo= catalogo5 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}

	function get_cate_1617($periodo,$cate){
		$sql = "SELECT unique(per_catalogo),per_grado,arm_desc_md,per_nom1, per_nom2, per_ape1, per_ape2,round(total5) as nota,dep_desc_md,gra_desc_md from mper,$periodo,morg,mdep,armas,grados where total5 = $cate and per_situacion = 11 and per_catalogo= catalogo5 and per_plaza = org_plaza and org_dependencia = dep_llave and per_arma = arm_codigo and per_grado = gra_codigo order by per_grado desc ";
		$resultado1 = $this->exec_query($sql);
		return $resultado1;	
	}	

function get_grados11(){
		$sql = " SELECT UNIQUE (gra_codigo),gra_desc_lg from grados where gra_codigo in (4,5,6,8,10,11,12,16,18,19,21,23,24,80,26,28,29,30,31,32,33,34,36,37,41,42,43,44,45,46,47,54,55,57,58,59,60,61,62,63,64,65,66,69,70,71,72,73,74,77,78,79,81,82,85,86,88,89,92,93,96,97,39,40) order by gra_codigo ";
		$result = $this->exec_query($sql);
		return $result;
	}

function get_est_fuerza($grad,$depi,$sexo,$clase){
		$sql = " SELECT gra_desc_lg, count(per_catalogo) as total, gra_codigo,per_sexo FROM mper, morg, grados WHERE per_plaza = org_plaza AND per_grado = gra_codigo AND per_situacion IN ('11', 'T0', '1L', '1R', '2K', 'TH', '12', '13', '1B', '1K', '1M', '1N', 'T0', '1L', '1R', '1U', '26', '2A', '2B', '1B', '1K', '1M')";
		if ($grad <> 0){
			$sql.= " AND gra_codigo = $grad";
			}	
		if($depi <> 0){
			$sql.= " AND  org_dependencia = $depi";
			}
		if($sexo <> 'A'){
			$sql.= " AND  per_sexo = '$sexo'";
			}
		if($clase <> 0){
			$sql.= " AND  gra_clase = $clase";
			}
		$sql.= " GROUP BY gra_codigo,gra_desc_lg,per_sexo";
		$sql.= " ORDER BY gra_codigo desc ";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_tot1(){
		$sql = " SELECT UNIQUE (gra_clase)
				 FROM grados 
				WHERE  gra_clase in (1,2,3,4,5,6) ";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_total1(){
		$sql = "SELECT count(per_catalogo) as total,per_sexo,(SELECT count(per_catalogo) as total11
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 1
                and per_sexo = 'F'
				GROUP BY per_sexo) as lio
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 1 
                and per_sexo = 'M'
				GROUP BY per_sexo";
		$result = $this->exec_query($sql);
		return $result;		
	}

	function get_total2(){
		$sql = "SELECT count(per_catalogo) as total,per_sexo,(SELECT count(per_catalogo) as total11
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 2
                and per_sexo = 'F'
				GROUP BY per_sexo) as lio
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 2 
                and per_sexo = 'M'
				GROUP BY per_sexo";
		$result = $this->exec_query($sql);
		return $result;		
	}

	function get_total3(){
		$sql = "SELECT count(per_catalogo) as total3 ,per_sexo,(SELECT count(per_catalogo)
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 3
                and per_sexo = 'F'
				GROUP BY per_sexo) as lio3
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 3 
                and per_sexo = 'M'
				GROUP BY per_sexo";
		$result = $this->exec_query($sql);
		return $result;		
	}

	function get_total4(){
		$sql = "SELECT count(per_catalogo) as total3 ,per_sexo,(SELECT count(per_catalogo)
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 4
                and per_sexo = 'F'
				GROUP BY per_sexo) as lio3
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 4 
                and per_sexo = 'M'
				GROUP BY per_sexo";
		$result = $this->exec_query($sql);
		return $result;		
	}

	function get_total5(){
		$sql = "SELECT count(per_catalogo) as total3 ,per_sexo,(SELECT count(per_catalogo)
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 5
                and per_sexo = 'F'
				GROUP BY per_sexo) as lio3
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 5 
                and per_sexo = 'M'
				GROUP BY per_sexo";
		$result = $this->exec_query($sql);
		return $result;		
	}

	function get_total6(){
		$sql = "SELECT count(per_catalogo) as total3 ,per_sexo,(SELECT count(per_catalogo)
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 6
                and per_sexo = 'F'
				GROUP BY per_sexo) as lio3
				 FROM mper, morg, grados 
				WHERE per_plaza = org_plaza 
				AND per_grado = gra_codigo 
				AND per_situacion IN ('11', 'T0', 'A')  and gra_clase = 6 
                and per_sexo = 'M'
				GROUP BY per_sexo";
		$result = $this->exec_query($sql);
		return $result;		
	}

	function get_toellena(){
		$sql = " SELECT count(per_catalogo) as Total FROM morg,mper,grados where org_plaza = per_plaza and per_situacion IN ('11','A') and per_grado = gra_codigo and gra_clase = 1";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_toellena1(){
		$sql = " SELECT count(per_catalogo) as Total FROM morg,mper,grados where org_plaza = per_plaza and per_situacion IN ('11','A') and per_grado = gra_codigo and gra_clase = 2";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_toellena2(){
		$sql = " SELECT count(per_catalogo) as Total FROM morg,mper,grados where org_plaza = per_plaza and per_situacion IN ('11','A') and per_grado = gra_codigo and gra_clase = 3";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_toellena3(){
		$sql = " SELECT count(per_catalogo) as Total FROM morg,mper,grados where org_plaza = per_plaza and per_situacion IN ('11','A') and per_grado = gra_codigo and gra_clase = 4";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_toellena4(){
		$sql = " SELECT count(per_catalogo) as Total FROM morg,mper,grados where org_plaza = per_plaza and per_situacion IN ('11','A') and per_grado = gra_codigo and gra_clase = 5";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_toellena5(){
		$sql = " SELECT count(per_catalogo) as Total FROM morg,mper,grados where org_plaza = per_plaza and per_situacion IN ('11','A','T0','TH') and per_grado = gra_codigo and gra_clase = 6";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_toevac(){
		$sql = " SELECT count(org_plaza) as total from morg,mdep,grados
	where dep_llave = org_dependencia and org_cod_pago = 1 and org_situacion = 'A' and org_ceom <> 'TITULO' and org_grado = gra_codigo and gra_clase = 1 and org_plaza not in(select per_plaza from mper)";
		$result = $this->exec_query($sql);
		return $result;
	}
	function get_toevac1(){
		$sql = " SELECT count(org_plaza) as total from morg,mdep,grados
	where dep_llave = org_dependencia and org_cod_pago = 1 and org_situacion = 'A' and org_ceom <> 'TITULO' and org_grado = gra_codigo and gra_clase = 2 and org_plaza not in(select per_plaza from mper)";
		$result = $this->exec_query($sql);
		return $result;
	}
	function get_toevac2(){
		$sql = " SELECT count(org_plaza) as total from morg,mdep,grados
	where dep_llave = org_dependencia and org_cod_pago = 1 and org_situacion = 'A' and org_ceom <> 'TITULO' and org_grado = gra_codigo and gra_clase = 3 and org_plaza not in(select per_plaza from mper)";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_toevac3(){
		$sql = " SELECT count(org_plaza) as total from morg,mdep,grados
	where dep_llave = org_dependencia and org_cod_pago = 1 and org_situacion = 'A' and org_ceom <> 'TITULO' and org_grado = gra_codigo and gra_clase = 4 and org_plaza not in(select per_plaza from mper)";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_toevac4(){
		$sql = " SELECT count(org_plaza) as total from morg,mdep,grados
	where dep_llave = org_dependencia and org_cod_pago = 1 and org_situacion = 'A' and org_ceom <> 'TITULO' and org_grado = gra_codigo and gra_clase = 5 and org_plaza not in(select per_plaza from mper)";
		$result = $this->exec_query($sql);
		return $result;
	}

	function get_toevac5(){
		$sql = " SELECT count(org_plaza) as total from morg,mdep,grados
	where dep_llave = org_dependencia and org_cod_pago = 1 and org_situacion = 'A' and org_ceom <> 'TITULO' and org_grado = gra_codigo and gra_clase = 6 and org_plaza not in(select per_plaza from mper)";
		$result = $this->exec_query($sql);
		return $result;
	}


	function get_info(){
		$sql = " SELECT NVL(SUM(EFC_MASCULINO),0) AS HOMBRES ,NVL(SUM(EFC_FEMENINO),0) AS MUJERES,EFC_TIPO  FROM EF_FUERZA_CE WHERE EFC_FECHA = TODAY  GROUP BY EFC_TIPO";
		$result = $this->exec_query($sql);
		return $result;
	}


	function obtener_fecha(){ 
		$sql = " SELECT to_char (extend (current, YEAR to DAY), '%Y-%m-%d') as tiempo from systables where tabid = 1;";
	  	$result = $this->exec_query($sql);
		foreach ($result as $row){
			$date = $row['TIEMPO'];

		}
		 
		return $date;
		}

	function guardar_alumnos($fecha,$dep,$alumnos,$alumnas){
			$sql="insert into ef_fuerza_ce values ('$fecha',$dep, $alumnos, $alumnas, 1);";
		
			return $sql;
		}


	function calculoTiempoDpue($catalogo){
		$sql = "SELECT FIRST 1 PUE_FEC_NOMB FROM DPUE WHERE PUE_CATALOGO = $catalogo ORDER BY pue_fec_nomb DESC";
		$result = $this->exec_query($sql);
		return $result;
	}



}
?>
