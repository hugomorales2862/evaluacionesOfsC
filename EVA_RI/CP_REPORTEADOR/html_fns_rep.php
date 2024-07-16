<?php
include_once("../html_fns.php");

	
	function Carga_dependencias_form(){
	$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_dependencia();
		$salida = '<select name="dep" id="dep"  class="span10">';
		$salida.= '<option  value="">--Todos--</option>';
		foreach ($result as $row){
			$salida.= '<option value="'.$row['DEP_LLAVE'].'">'.$row['DEP_DESC_MD'].'</option>';			
		}
		$salida.= '</select>';
		return $salida;  
	}
	
	
	function combo_periodo(){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_periodo();
		if($result != ""){
			$salida = '<select name="periodo" id="periodo" class = "span12">';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$periodo = $row['EVA_PERIODO'];
				$salida.= "<option value='$periodo'>".$periodo."</option>";
			}
			$salida.='</select>';
		}else{
			$salida.= '<select style="font-size: 1.2em;width:200px" name="periodo" id="periodo">';
			$salida.= "<option value='' selected>Seleccione</option>";
			$salida.= "<option value=''>no existen datos</option>";
			$salida.='</select>';
		}
			return $salida;
	}

	function combo_periodo12016(){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_periodo12016();
		if($result != ""){
			$salida = '<select name="periodo" id="periodo" class = "span12">';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$periodo = $row['EVA_PERIODO'];
				$salida.= "<option value='$periodo'>".$periodo."</option>";
			}
			$salida.='</select>';
		}else{
			$salida.= '<select style="font-size: 1.2em;width:200px" name="periodo" id="periodo">';
			$salida.= "<option value='' selected>Seleccione</option>";
			$salida.= "<option value=''>no existen datos</option>";
			$salida.='</select>';
		}
			return $salida;
	}
	
	
	function tabla_finalizados($situacion,$dependencia,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_inmediato($situacion,$dependencia,$comp_eva);
		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>No.</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	EVALUACION	</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	CATALOGO	</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	GRADO	</b></font></td>';
			$salida.= '<td width = "350px" 	align="center"><font size=2><b>	NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "1px" 	align="center"></td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre= trim($row['PER_NOM1'])." ".trim($row['PER_NOM2'])." ".trim($row['PER_APE1'])." ".trim($row['PER_APE2']); 
				$gra_desc = trim($row['GRA_DESC_CT']); 
				$grado = $row['GRA_CODIGO'];
				$arm_desc = trim($row['ARM_DESC_CT']);
				$arma = $row['ARM_CODIGO'];
				$periodo = $row['EVA_PERIODO'];
				$catalogo = $row['EVA_CAT1'];
				$eva_id = $row['EVA_ID'];
				$salida.= '	<tr ';
				if ($cont % 2 == 0) {
					$salida.='class="odd gradeX">';
				}else{
					$salida.='class="success">';
				}
					$salida.="<td><font size=2>".$cont."</font></td>";
					$salida.="<td><font size=2>".$periodo."</font></td>";
					$salida.="<td><font size=2>".$catalogo."</font></td>";
					if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
						$salida.="<td><font size=2>".$gra_desc."</font></td>";
					}else{
						$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font></td>";
					}
					$salida.="<td><font size=2>".$nombre."</font></td>";

					$salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva1.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte final'><i class='icon-file'></i></a></td>";
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";
		}
		return $salida;
	}
	
	
	function tabla_fi_aprobados($dependencia,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_fin1($dependencia,$comp_eva);
		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>No.</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	EVALUACION	</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	CATALOGO	</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	GRADO	</b></font></td>';
			$salida.= '<td width = "350px" 	align="center"><font size=2><b>	NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	SITUACION</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	Reporte</b></font></td>';
			$salida.= '<td width = "1px" 	align="center"></td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre= trim($row['PER_NOM1'])." ".trim($row['PER_NOM2'])." ".trim($row['PER_APE1'])." ".trim($row['PER_APE2']); 
				$gra_desc = trim($row['GRA_DESC_CT']); 
				$grado = $row['GRA_CODIGO'];
				$arm_desc = trim($row['ARM_DESC_CT']);
				$arma = $row['ARM_CODIGO'];
				$periodo = $row['EVA_PERIODO'];
				$catalogo = $row['EVA_CAT1'];
				$eva_id = $row['EVA_ID'];
				$situacion = $row['EVA_SITUACION'];
				$salida.= '	<tr ';
				if ($cont % 2 == 0) {
					$salida.='class="odd gradeX">';
				}else{
					$salida.='class="success">';
				}
					$salida.="<td><font size=2>".$cont."</font></td>";
					$salida.="<td><font size=2>".$periodo."</font></td>";
					$salida.="<td><font size=2>".$catalogo."</font></td>";
					if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
						$salida.="<td><font size=2>".$gra_desc."</font></td>";
					}else{
						$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font></td>";
					}
					$salida.="<td><font size=2>".$nombre."</font></td>";
					if($situacion == 4 or $situacion == 8 or $situacion == 13 or $situacion == 19  or $situacion == 22 or $situacion == 27 or $situacion == 35){
						$salida.="<td><font size=2>PENDIENTE</font></td>";
						$salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte final'><i class='icon-file'></i></a></td>";
					}elseif($situacion == 28 or $situacion == 29 or $situacion == 30 or $situacion == 31 or $situacion == 32 or $situacion == 33){
						$salida.="<td><font size=2>APROBADA</font></td>";
						$salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte final'><i class='icon-file'></i></a></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
					}elseif($situacion == 34){
					//$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva2.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
					$salida.='<td align="center"><font size="2">IMPUGNADO</font></td>';
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
					}
					
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";
		}
		return $salida;
	}
	
	
	function tabla_finalizados1($situacion,$periodo){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_fin($situacion,$periodo);
		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "25px" 	align="center"><font size=2><b>No.</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	EVALUACION	</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	CATALOGO	</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	GRADO	</b></font></td>';
			$salida.= '<td width = "350px" 	align="center"><font size=2><b>	NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	DEPENDENCIA</b></font></td>';
			$salida.= '<td width = "300px" 	align="center"><font size=2><b>	EMPLEO</b></font></td>';
			$salida.= '<td width = "1px" 	align="center"></td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre= trim($row['PER_NOM1'])." ".trim($row['PER_NOM2'])." ".trim($row['PER_APE1'])." ".trim($row['PER_APE2']); 
				$gra_desc = trim($row['GRA_DESC_CT']); 
				$grado = $row['GRA_CODIGO'];
				$arm_desc = trim($row['ARM_DESC_CT']);
				$arma = $row['ARM_CODIGO'];
				$periodo = $row['EVA_PERIODO'];
				$catalogo = $row['EVA_CAT1'];
				$eva_id = $row['EVA_ID'];
				$des_dep = $row['DEP_DESC_CT'];
				$empleo = $row['EVA_EMPLEO1'];
				$salida.= '	<tr ';
				if ($cont % 2 == 0) {
					$salida.='class="odd gradeX">';
				}else{
					$salida.='class="success">';
				}
					$salida.="<td><font size=2>".$cont."</font></td>";
					$salida.="<td><font size=2>".$periodo."</font></td>";
					$salida.="<td><font size=2>".$catalogo."</font></td>";
					if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
						$salida.="<td><font size=2>".$gra_desc."</font></td>";
					}else{
						$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font></td>";
					}
					$salida.="<td><font size=2>".$nombre."</font></td>";
					$salida.="<td><font size=2>".$des_dep."</font></td>";
					$salida.="<td><font size=2>".$empleo."</font></td>";

					$salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva1.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'EVALUA JEFE INMEDIATO'><i class='icon-file'></i></a></td>";
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";
		}
		return $salida;
	}
	
	
	function tabla_fin_comte($periodo){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_fin_comte($periodo);
		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "25px" 	align="center"><font size=2><b>No.</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	EVALUACION	</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	CATALOGO	</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	GRADO	</b></font></td>';
			$salida.= '<td width = "350px" 	align="center"><font size=2><b>	NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	DEPENDENCIA</b></font></td>';
			$salida.= '<td width = "300px" 	align="center"><font size=2><b>	EMPLEO</b></font></td>';
			$salida.= '<td width = "100px" 	align="center"><font size=2><b>	SITUACION</b></font></td>';
			$salida.= '<td width = "1px" 	align="center"></td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre= trim($row['PER_NOM1'])." ".trim($row['PER_NOM2'])." ".trim($row['PER_APE1'])." ".trim($row['PER_APE2']); 
				$gra_desc = trim($row['GRA_DESC_CT']); 
				$grado = $row['GRA_CODIGO'];
				$arm_desc = trim($row['ARM_DESC_CT']);
				$arma = $row['ARM_CODIGO'];
				$periodo = $row['EVA_PERIODO'];
				$catalogo = $row['EVA_CAT1'];
				$eva_id = $row['EVA_ID'];
				$des_dep = $row['DEP_DESC_CT'];
				$empleo = $row['EVA_EMPLEO1'];
				$situacion = $row['EVA_SITUACION'];
				$salida.= '	<tr ';
				if ($cont % 2 == 0) {
					$salida.='class="odd gradeX">';
				}else{
					$salida.='class="success">';
				}
					$salida.="<td><font size=2>".$cont."</font></td>";
					$salida.="<td><font size=2>".$periodo."</font></td>";
					$salida.="<td><font size=2>".$catalogo."</font></td>";
					if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
						$salida.="<td><font size=2>".$gra_desc."</font></td>";
					}else{
						$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font></td>";
					}
					$salida.="<td><font size=2>".utf8_encode($nombre)."</font></td>";
					$salida.="<td><font size=2>".$des_dep."</font></td>";
					$salida.="<td><font size=2>".$empleo."</font></td>";
					if($situacion == 6){
						$salida.="<td><font size=2>PENDIENTE</font></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
					}else if($situacion ==7){
						$salida.="<td><font size=2>APROBADA</font></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
					}
					$salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'EVALUA JEFE INMEDIATO'><i class='icon-file'></i></a></td>";
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";
		}
		return $salida;
	}
	
	
	function tabla_catalogo($catalogo,$periodo){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->trae_rep_catalogo($catalogo,$periodo); 
		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "25px" 	align="center"><font size=2><b>No.</b></font></td>';
			// $salida.= '<td width = "25px" 	align="center"><font size=2><b>ANDDY</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	EVALUACION	</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	CATALOGO	</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	GRADO	</b></font></td>';
			$salida.= '<td width = "350px" 	align="center"><font size=2><b>	NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	DEPENDENCIA</b></font></td>';
			$salida.= '<td width = "300px" 	align="center"><font size=2><b>	EMPLEO</b></font></td>';
			$salida.= '<td width = "100px" 	align="center"><font size=2><b>	SITUACION</b></font></td>';
			//$salida.= '<td width = "100px" 	align="center"><font size=2><b>	ELIMINAR</b></font></td>';
			$salida.= '<td width = "100px" 	align="center"><font size=2><b>	R. FINAL</b></font></td>';
			$salida.= '<td width = "100px" 	align="center"><font size=2><b>	VER</b></font></td>';
			$salida.= '<td width = "1px" 	align="center"></td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre= trim($row['PER_NOM1'])." ".trim($row['PER_NOM2'])." ".trim($row['PER_APE1'])." ".trim($row['PER_APE2']); 
				$gra_desc = trim($row['GRA_DESC_CT']); 
				$grado = $row['GRA_CODIGO'];
				$arm_desc = trim($row['ARM_DESC_CT']);
				$arma = $row['ARM_CODIGO'];
				$periodo = $row['EVA_PERIODO'];
				$catalogo = $row['EVA_CAT1'];
				$eva_id = $row['EVA_ID'];
				$des_dep = $row['DEP_DESC_CT'];
				$empleo = $row['EVA_EMPLEO1'];
				$situacion = $row['EVA_SITUACION'];

				$tipo = 5;  
				$cantidad_vice = $ClsPer->trae_tipo($eva_id,$tipo); 
				

				$salida.= '	<tr ';
				if ($cont % 2 == 0) {
					$salida.='class="odd gradeX">';
				}else{
					$salida.='class="success">';
				}
					$salida.="<td><font size=2>".$cont."</font></td>";
					// $salida.="<td><font size=2>".$result2."</font></td>";
					$salida.="<td><font size=2>".$periodo."</font></td>";
					$salida.="<td><font size=2>".$catalogo."</font></td>";
					if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
						$salida.="<td><font size=2>".$gra_desc."</font></td>";
					}else{
						$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font></td>";
					}
					$salida.="<td><font size=2>".$nombre."</font></td>";
					$salida.="<td><font size=2>".$des_dep."</font></td>";
					$salida.="<td><font size=2>".$empleo."</font></td>";
					if($situacion == 4 or $situacion == 8 or $situacion == 13 or $situacion == 19 or $situacion == 22 or $situacion == 27 or $situacion == 35){
						$salida.="<td><font size=2>PENDIENTE</font></td>";
					//	$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
					}elseif($situacion ==28 or $situacion ==29 or $situacion ==30 or $situacion ==31 or $situacion ==32 or $situacion ==33 ){
						$salida.="<td><font size=2>APROBADA</font></td>";
					/*	$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";*/
					$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva2.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";

					}elseif($situacion == 34){
					//$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva2.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
					/*$salida.='<td align="center"><font size="2">IMPUGNADO</font></td>';
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";*/
					}if($cantidad_vice>0){
						$salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva2.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'EVALUA JEFE INMEDIATO'><i class='icon-file'></i></a></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
					}else{
						$salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'EVALUA JEFE INMEDIATO'><i class='icon-file'></i></a></td>";
						/*$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";*/
					}
					// $salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'EVALUA JEFE INMEDIATO'><i class='icon-file'></i></a></td>";
					//$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'Eliminar'><i class='icon-trash'></i></a></td>";
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";
		}
		return $salida;
	}
	
	
	function tabla_aprobar($catalogo, $dep, $periodo){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->trae_para_certificar($catalogo, $dep, $periodo);
		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "25px" 	align="center"><font size=2><b>No.</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	EVALUACION	</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	CATALOGO	</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	GRADO	</b></font></td>';
			$salida.= '<td width = "350px" 	align="center"><font size=2><b>	NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	DEPENDENCIA</b></font></td>';
			$salida.= '<td width = "300px" 	align="center"><font size=2><b>	EMPLEO</b></font></td>';
			$salida.= '<td width = "300px" 	align="center"><font size=2><b>	CATEGORIA</b></font></td>';
			$salida.= '<td width = "300px" 	align="center"><font size=2><b>	SITUACION</b></font></td>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>	NOTA</b></font></td>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>	VERIFICAR</b></font></td>';
			//$salida.= '<td width = "1px" 	align="center"></td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre= trim($row['PER_NOM1'])." ".trim($row['PER_NOM2'])." ".trim($row['PER_APE1'])." ".trim($row['PER_APE2']); 
				$gra_desc = trim($row['GRA_DESC_CT']); 
				$grado = $row['GRA_CODIGO'];
				$arm_desc = trim($row['ARM_DESC_CT']);
				$arma = $row['ARM_CODIGO'];
				$periodo = $row['EVA_PERIODO'];
				$catalogo = $row['EVA_CAT1'];
				$eva_id = $row['EVA_ID'];
				$des_dep = $row['DEP_DESC_CT'];
				$empleo = $row['EVA_EMPLEO1'];
				$situacion = $row['EVA_SITUACION'];
				$renglon = $row['EVA_RENGLON'];
				$tipo = 5;  
				$cantidad_vice = $ClsPer->trae_tipo($eva_id,$tipo); 
				$salida.= '	<tr ';
				if ($cont % 2 == 0) {
					$salida.='class="odd gradeX">';
				}else{
					$salida.='class="success">';
				}
					$salida.="<td><font size=2>".$cont."</font></td>";
					$salida.="<td><font size=2>".$periodo."</font></td>";
					$salida.="<td><font size=2>".$catalogo."</font></td>";
					if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
						$salida.="<td><font size=2>".$gra_desc."</font></td>";
					}else{
						$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font></td>";
					}
					$salida.="<td><font size=2>".$nombre."</font></td>";
					$salida.="<td><font size=2>".$des_dep."</font></td>";
					$salida.="<td><font size=2>".$empleo."</font></td>";
					$ClsPer = new ClsPersonal();
					$nota_total1= $ClsPer->trae_nota_total1($eva_id);
					$nota_total1p = $nota_total1 * 0.10;
					//echo ($nota_total1p);
					//echo '<br>';
					$nota_total2= $ClsPer->trae_nota_total2($eva_id);
					$nota_total2p=$nota_total2*0.45;
					//echo ($nota_total2p);
					//echo '<br>';
					$nota_total3= $ClsPer->trae_nota_total3($eva_id);
					$nota_total3p=$nota_total3*0.45;
					//echo ($nota_total3p);
					//echo '<br>';
					$nota_total4= $ClsPer->trae_nota_total5($eva_id);
					$nota_total4p=$nota_total4*0.30;

					$nota_total5= $ClsPer->trae_nota_total6($eva_id);
					$nota_total5p=$nota_total5*0.70;

					if($nota_total1p <> '' or $nota_total2p <> '' or $nota_total3p <> ''){
					$suma_total=$nota_total1p+$nota_total2p+$nota_total3p;
					}elseif($nota_total4p <> '' or $nota_total5p <> ''){
					$suma_total=$nota_total4p+$nota_total5p;
					} //$total_nota = $ClsPer->trae_no
				if($reporte==4 and $renglon==1){
					if($situacion == 28 or $situacion == 29 or $situacion == 30 or $situacion == 31 or $situacion == 32 or $situacion == 33){
					$salida.='<td align="center"><font size="2">APROBADO</font></td>';
					$salida.='<td align="center"><font size="2">'.round($suma_total).'</font></td>';
				}
			}
				elseif($renglon == 1){
					if($suma_total <= 59){
						$salida.='<td align="center"><font size="1">INSATISFACTORIO</font></td>';
					}else if($suma_total > 59 and $suma_total <= 69){
						$salida.='<td align="center"><font size="1">REGULAR</font></td>';
					}else if($suma_total > 69 and $suma_total <= 79){
						$salida.='<td align="center"><font size="1">SATISFACTORIO</font></td>';
					}else if($suma_total > 79 and $suma_total <= 89){
						$salida.='<td align="center"><font size="1">SUPERIOR</font></td>';
					}else if($suma_total > 89 and $suma_total <= 100){
						$salida.='<td align="center"><font size="1">EXCELENTE</font></td>';
					}if($situacion == 4 or $situacion == 8 or $situacion == 13 or $situacion == 19 or $situacion == 22 or $situacion == 27 or $situacion == 35){
					$salida.='<td align="center"><font size="2">PENDIENTE</font></td>';
					$salida.='<td align="center"><font size="2">'.round($suma_total).'</font></td>';
				}elseif($situacion == 28 or $situacion == 29 or $situacion == 30 or $situacion == 31 or $situacion == 32 or $situacion == 33){
					$salida.='<td align="center"><font size="2">APROBADO</font></td>';
					$salida.='<td align="center"><font size="2">'.round($suma_total).'</font></td>';
				}elseif($situacion == 34){
					//$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva2.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
					$salida.='<td align="center"><font size="2"><center>IMPUGNADO</center></font></td>';
				}
					//$salida.='<td align="center"><font size="1">'.round($suma_total).'</font></td>';
				}elseif($renglon == 2){
					$salida.='<td colspan="3" align="center"><font size="4"><center>A-9</center></font></td>';
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
				}if($situacion == 28 or $situacion == 29 or $situacion == 30 or $situacion == 31 or $situacion == 32 or $situacion == 33){
					$salida.='<td colspan="3" align="center"><font size="3"><center>APROBADO</center></font></td>';
					//$salida.='<td  align="center"><font size="2">'.round($suma_total).'</font></td>';
				}elseif($renglon == 3){
					$salida.='<td colspan="3" align="center"><font size="4"><center>A-10</center></font></td>';
				}
				
					if($cantidad_vice>0){
						$salida.= "<td align = 'center'><div class='btn-group'> <a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>Opciones <span class='caret'></span></a><ul class='dropdown-menu'><li><a href='../CP_REP/REP_eva2.php?eva=".$eva_id."' target='_blank'>Reporte</a></li><li><a onclick = 'xajax_Certificar(".$eva_id.",".$situacion.")'>Aprobar</a></li></ul></div></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
					}else{
						$salida.= "<td align = 'center'><div class='btn-group'> <a class='btn dropdown-toggle' data-toggle='dropdown' href='#'>Opciones <span class='caret'></span></a><ul class='dropdown-menu'><li><a href='../CP_REP/REP_eva.php?eva=".$eva_id."' target='_blank'>Reporte</a></li><li><a onclick = 'xajax_Certificar(".$eva_id.",".$situacion.")'>Aprobar</a></li></ul></div></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
					}

					// $salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."&sit=".$situacion."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'EVALUA JEFE INMEDIATO'><i class='icon-file'></i></a></td>";
					
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";
		}
		return $salida;
	}


	function tabla_aprobados($catalogo, $dep, $periodo){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->trae_aprobados($catalogo, $dep, $periodo);
		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "25px" 	align="center"><font size=2><b>No.</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	EVALUACION	</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	CATALOGO	</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	GRADO	</b></font></td>';
			$salida.= '<td width = "350px" 	align="center"><font size=2><b>	NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	DEPENDENCIA</b></font></td>';
			$salida.= '<td width = "300px" 	align="center"><font size=2><b>	EMPLEO</b></font></td>';
			$salida.= '<td width = "300px" 	align="center"><font size=2><b>	CATEGORIA</b></font></td>';
			$salida.= '<td width = "300px" 	align="center"><font size=2><b>	SITUACION</b></font></td>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>	NOTA</b></font></td>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>	VERIFICAR</b></font></td>';
			//$salida.= '<td width = "1px" 	align="center"></td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre= trim($row['PER_NOM1'])." ".trim($row['PER_NOM2'])." ".trim($row['PER_APE1'])." ".trim($row['PER_APE2']); 
				$gra_desc = trim($row['GRA_DESC_CT']); 
				$grado = $row['GRA_CODIGO'];
				$arm_desc = trim($row['ARM_DESC_CT']);
				$arma = $row['ARM_CODIGO'];
				$periodo = $row['EVA_PERIODO'];
				$catalogo = $row['EVA_CAT1'];
				$eva_id = $row['EVA_ID'];
				$des_dep = $row['DEP_DESC_CT'];
				$empleo = $row['EVA_EMPLEO1'];
				$situacion = $row['EVA_SITUACION'];
				$renglon = $row['EVA_RENGLON'];
				$tipo = 5;  
				$cantidad_vice = $ClsPer->trae_tipo($eva_id,$tipo); 
				$salida.= '	<tr ';
				if ($cont % 2 == 0) {
					$salida.='class="odd gradeX">';
				}else{
					$salida.='class="success">';
				}
					$salida.="<td><font size=2>".$cont."</font></td>";
					$salida.="<td><font size=2>".$periodo."</font></td>";
					$salida.="<td><font size=2>".$catalogo."</font></td>";
					if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
						$salida.="<td><font size=2>".$gra_desc."</font></td>";
					}else{
						$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font></td>";
					}
					$salida.="<td><font size=2>".$nombre."</font></td>";
					$salida.="<td><font size=2>".$des_dep."</font></td>";
					$salida.="<td><font size=2>".$empleo."</font></td>";
					$ClsPer = new ClsPersonal();
					$nota_total1= $ClsPer->trae_nota_total1($eva_id);
					$nota_total1p = $nota_total1 * 0.10;
					//echo ($nota_total1p);
					//echo '<br>';
					$nota_total2= $ClsPer->trae_nota_total2($eva_id);
					$nota_total2p=$nota_total2*0.45;
					//echo ($nota_total2p);
					//echo '<br>';
					$nota_total3= $ClsPer->trae_nota_total3($eva_id);
					$nota_total3p=$nota_total3*0.45;
					//echo ($nota_total3p);
					//echo '<br>';
					$nota_total4= $ClsPer->trae_nota_total5($eva_id);
					$nota_total4p=$nota_total4*0.30;

					$nota_total5= $ClsPer->trae_nota_total6($eva_id);
					$nota_total5p=$nota_total5*0.70;

					if($nota_total1p <> '' or $nota_total2p <> '' or $nota_total3p <> ''){
					$suma_total=$nota_total1p+$nota_total2p+$nota_total3p;
					}elseif($nota_total4p <> '' or $nota_total5p <> ''){
					$suma_total=$nota_total4p+$nota_total5p;
					} //$total_nota = $ClsPer->trae_no
				if($renglon == 1){
					if($suma_total <= 59){
						$salida.='<td align="center"><font size="1">INSATISFACTORIO</font></td>';
					}else if($suma_total > 59 and $suma_total <= 69){
						$salida.='<td align="center"><font size="1">REGULAR</font></td>';
					}else if($suma_total > 69 and $suma_total <= 79){
						$salida.='<td align="center"><font size="1">SATISFACTORIO</font></td>';
					}else if($suma_total > 79 and $suma_total <= 89){
						$salida.='<td align="center"><font size="1">SUPERIOR</font></td>';
					}else if($suma_total > 89 and $suma_total <= 100){
						$salida.='<td align="center"><font size="1">EXCELENTE</font></td>';
					}if($situacion == 4 or $situacion == 8 or $situacion == 13 or $situacion == 19 or $situacion == 22 or $situacion == 27 or $situacion == 35){
					$salida.='<td align="center"><font size="2">'.round($suma_total).'</font></td>';
				}
					//$salida.='<td align="center"><font size="1">'.round($suma_total).'</font></td>';
				}elseif($renglon == 2){
					$salida.='<td colspan="3" align="center"><font size="4"><center>A-9</center></font></td>';
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
				}if($situacion == 28 or $situacion == 29 or $situacion == 30 or $situacion == 31 or $situacion == 32 or $situacion == 33){
					$salida.='<td colspan="3" align="center"><font size="3"><center>APROBADO</center></font></td>';
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
					//$salida.='<td  align="center"><font size="2">'.round($suma_total).'</font></td>';
				}elseif($renglon == 3){
					$salida.='<td colspan="3" align="center"><font size="4"><center>A-10</center></font></td>';
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'ANULAR'><i class='icon-trash'></i></a></td>";
				}
					// $salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."&sit=".$situacion."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'EVALUA JEFE INMEDIATO'><i class='icon-file'></i></a></td>";
					
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";
		}
		return $salida;
	}

	function html_alert_certificado($valor){
		if($valor == 1){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Atencion</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>Evaluacion aprobada satisfactoriamente</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow();'>OK</button>";
			$salida.=		"</div>";
		}
		return $salida;
	}


	function tabla_cate($periodo,$cate){
		$ClsPer = new ClsPersonal();
		if ($periodo == '2 - 2017') {
			$periodo = 'eva_v2_7';
			switch($cate) {
			    case 1:
			        $cate= 90;
					$result = $ClsPer->get_cate_217($periodo,$cate);
			        break;
			    case 2:
			        $cate= 89;
			        $cate1= 80;
					$result = $ClsPer->get_cate_2172($periodo,$cate,$cate1);
			        break;
			    case 3:
			        $cate= 79;
			        $cate1= 70;
					$result = $ClsPer->get_cate_2172($periodo,$cate,$cate1);
			        break;
			    case 4:
			        $cate= 69;
			        $cate1= 60;
					$result = $ClsPer->get_cate_2172($periodo,$cate,$cate1);
			        break;
			    case 5:
			        $cate= 59;
			        $cate1= 1;
					$result = $ClsPer->get_cate_2172($periodo,$cate,$cate1);
			        break;
			    case 6:
			        $cate= 0;
					$result = $ClsPer->get_cate_2751($periodo,$cate);
			        break;
			}
		}elseif ($periodo == '2 - 2016') {
			$periodo = 'eva_v2_6';
			switch($cate) {
			    case 1:
			        $cate= 90;
					$result = $ClsPer->get_cate_11($periodo,$cate);
			        break;
			    case 2:
			        $cate= 89;
			        $cate1= 80;
					$result = $ClsPer->get_cate_12($periodo,$cate,$cate1);
			        break;
			    case 3:
			        $cate= 79;
			        $cate1= 70;
					$result = $ClsPer->get_cate_12($periodo,$cate,$cate1);
			        break;
			    case 4:
			        $cate= 69;
			        $cate1= 60;
					$result = $ClsPer->get_cate_12($periodo,$cate,$cate1);
			        break;
			    case 5:
			        $cate= 59;
			        $cate1= 1;
					$result = $ClsPer->get_cate_12($periodo,$cate,$cate1);
			        break;
			    case 6:
			        $cate= 0;
					$result = $ClsPer->get_cate_13($periodo,$cate);
			        break;
			}
		}elseif ($periodo == '1 - 2017') {
			$periodo = 'eva_v1_7';
			switch($cate) {
			    case 1:
			        $cate= 90;
					$result = $ClsPer->get_cate_14($periodo,$cate);
			        break;
			    case 2:
			        $cate= 89;
			        $cate1= 80;
					$result = $ClsPer->get_cate_15($periodo,$cate,$cate1);
			        break;
			    case 3:
			        $cate= 79;
			        $cate1= 70;
					$result = $ClsPer->get_cate_15($periodo,$cate,$cate1);
			        break;
			    case 4:
			        $cate= 69;
			        $cate1= 60;
					$result = $ClsPer->get_cate_15($periodo,$cate,$cate1);
			        break;
			    case 5:
			        $cate= 59;
			        $cate1= 1;
					$result = $ClsPer->get_cate_15($periodo,$cate,$cate1);
			        break;
			    case 6:
			        $cate= 0;
					$result = $ClsPer->get_cate_16($periodo,$cate);
			        break;
			}
		}elseif ($periodo == '1 - 2018') {
			$periodo = 'eva_v1_8';
			switch($cate) {
			    case 1:
			        $cate= 90;
					$result = $ClsPer->get_cate_1417($periodo,$cate);
			        break;
			    case 2:
			        $cate= 89;
			        $cate1= 80;
					$result = $ClsPer->get_cate_1517($periodo,$cate,$cate1);
			        break;
			    case 3:
			        $cate= 79;
			        $cate1= 70;
					$result = $ClsPer->get_cate_1517($periodo,$cate,$cate1);
			        break;
			    case 4:
			        $cate= 69;
			        $cate1= 60;
					$result = $ClsPer->get_cate_1517($periodo,$cate,$cate1);
			        break;
			    case 5:
			        $cate= 59;
			        $cate1= 1;
					$result = $ClsPer->get_cate_1517($periodo,$cate,$cate1);
			        break;
			    case 6:
			        $cate= 0;
					$result = $ClsPer->get_cate_1617($periodo,$cate);
			        break;
			}
		}elseif ($periodo == '1 - 2016') {
			$salida.= '<td width = "350px" 	align="center"><font size=2><b>	EN ESTA EVALUACION TODO EL PERSONAL QUEDA COMPRENDIDO EN art.10</b></font></td>';
		}

		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>No.</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	CATALGO	</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	GRADO	</b></font></td>';
			$salida.= '<td width = "100px" 	align="center"><font size=2><b>	ARMA	</b></font></td>';
			$salida.= '<td width = "350px" 	align="center"><font size=2><b>	NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	NOTA</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	ALTA</b></font></td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$catalogo = trim($row['PER_CATALOGO']); 
				$grado = $row['PER_GRADO'];
				$arma = $row['ARM_DESC_MD'];
				$nombre= trim($row['PER_NOM1'])." ".trim($row['PER_NOM2'])." ".trim($row['PER_APE1'])." ".trim($row['PER_APE2']); 
				$nota = $row['NOTA'];
				if($nota == 0){
					$nota ='ART.10';
				}
				$alta = $row['DEP_DESC_MD'];
				$grad = $row['GRA_DESC_MD'];
				$salida.= '	<tr ';
				if ($cont % 2 == 0) {
					$salida.='class="odd gradeX">';
				}else{
					$salida.='class="success">';
				}
					$salida.="<td><font size=2>".$cont."</font></td>";
					$salida.="<td><font size=2>".$catalogo."</font></td>";
					$salida.="<td><font size=2>".$grad."</font></td>";
					$salida.="<td><font size=2>".$arma."</font></td>";
					$salida.="<td><font size=2>".$nombre."</font></td>";
					$salida.="<td><font size=2>".$nota."</font></td>";
					$salida.="<td><font size=2>".$alta."</font></td>";
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";
		}
		return $salida;
	}
///////////////////////---------reporte URGENTE--------------////////////////////////////////////
	function carga_grados(){
	$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_grados11();
		$salida = '<select name="grad" id="grad"  class="span12">';
		$salida.= '<option  value="0">--Todos--</option>';
		foreach ($result as $row){
			$salida.= '<option value="'.$row['GRA_CODIGO'].'">'.$row['GRA_DESC_LG'].'</option>';			
		}
		$salida.= '</select>';
		return $salida;  
	}

	function carga_dep(){
	$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_dependencia();
		$salida = '<select name="depi" id="depi"  class="span12">';
		$salida.= '<option  value="0">--Todos--</option>';
		foreach ($result as $row){
			$salida.= '<option value="'.$row['DEP_LLAVE'].'">'.$row['DEP_DESC_MD'].'</option>';			
		}
		$salida.= '</select>';
		return $salida;  
	}
	

	function tabla_est_fuerza($grad,$depi,$sexo,$clase){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_est_fuerza($grad,$depi,$sexo,$clase);
		 
		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "10px" 	align="center"><font size=2><b>No.</b></font></td>';
			$salida.= '<td width = "80px" 	align="center"><font size=2><b>GRADO</b></font></td>';
			$salida.= '<td width = "40px" 	align="center"><font size=2><b>TOTAL</b></font></td>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>GENERO</b></font></td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			
			foreach($result as $row){
				$cont++;
				$grado = $row['GRA_DESC_LG']; 
				$total = $row['TOTAL'];
				$grado_cod = $row['GRA_CODIGO'];
				$sexo = $row['PER_SEXO'];
				if($sexo == 'F'){
					$sexo = 'FEMENINO';
				}
				if($sexo == 'M'){
					$sexo = 'MASCULINO';
				}
				$salida.= '	<tr ';
				if ($cont % 2 == 0) {
					$salida.='class="odd gradeX">';
				}else{
					$salida.='class="success">';
				}
					$salida.="<td><font size=2>".$cont."</font></td>";
					$salida.="<td><font size=2>".$grado."</font></td>";
					$salida.="<td><font size=2>".$total."</font></td>";
					$salida.="<td><font size=2>".$sexo."</font></td>";
				$salida.='</tr>';
			}
		 
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";
		}
		return $salida;
	}

	function tabla_tot_est(){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_tot1();
		$result1 = $ClsPer->get_total1();
		$result2 = $ClsPer->get_total2();
		$result3 = $ClsPer->get_total3();
		$result4 = $ClsPer->get_total4();
		$result5 = $ClsPer->get_total5();
		$result6 = $ClsPer->get_total6();
		$result8 = $ClsPer->get_toellena();
		$result9 = $ClsPer->get_toellena1();
		$result10 = $ClsPer->get_toellena2();
		$result11 = $ClsPer->get_toellena3();
		$result12 = $ClsPer->get_toellena4();
		$result13 = $ClsPer->get_toellena5();

		$result123 = $ClsPer->get_toevac();
		$result124 = $ClsPer->get_toevac1();
		$result125 = $ClsPer->get_toevac2();
		$result126 = $ClsPer->get_toevac3();
		$result127 = $ClsPer->get_toevac4();
		$result128 = $ClsPer->get_toevac5();

		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "10px" 	align="center"><font size=2><b>No.</b></font></td>';
			$salida.= '<td width = "80px" 	align="center"><font size=2><b>GRADO</b></font></td>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>MASCULINO</b></font></td>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>FEMENINO</b></font></td>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>LLENAS</b></font></td>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>VACANTES</b></font></td>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>SEGUN TOE</b></font></td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			
			foreach($result as $row){
				$cont++;
				$clase = $row['GRA_CLASE'];
				
				
				$salida.= '	<tr ';
				if ($cont % 2 == 0) {
					$salida.='class="odd gradeX">';
				}else{
					$salida.='class="success">';
				}

				$salida.="<td><font size=2>".$cont."</font></td>";
				
				switch($clase) {
			    case 1:
			        $clase= 'OFICIALES DE CARRERA';
			        	foreach($result1 as $row){
							$hm = $row['TOTAL'];
							$M = $row['PER_SEXO'];
							$MJ = $row['LIO'];		
						}		
								$salida.="<td><font size=2>".$clase."</font></td>";
								$salida.="<td><font size=2>".$hm."</font></td>";
								$salida.="<td><font size=2>".$MJ."</font></td>";
								foreach($result8 as $row8){
									$toe1 = $row8['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toe1."</font></td>";
								foreach($result123 as $row1){
									$toev = $row1['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toev."</font></td>";	

								$t12 = $toe1 + $toev;	
								$salida.="<td><font size=2>".$t12."</font></td>";
			        break;	
			    case 2:
			        $clase= 'OFICIALES DE RESERVA';
			        	$salida.="<td><font size=2>".$clase."</font></td>";
			        		foreach($result2 as $row){
							$hm1 = $row['TOTAL'];
							$M1 = $row['PER_SEXO'];
							$MJ1 = $row['LIO'];		
						}	
							$MJ1 = 0;
							$salida.="<td><font size=2>".$hm1."</font></td>";
							$salida.="<td><font size=2>".$MJ1."</font></td>";
							foreach($result9 as $row8){
									$toe2 = $row8['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toe2."</font></td>";
								foreach($result124 as $row2){
									$toev1 = $row2['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toev1."</font></td>";

								$t13 = $toe2 + $toev1;	
								$salida.="<td><font size=2>".$t13."</font></td>";
			        break;
			    case 3:
			        $clase= 'OFICIALES ASIMILADOS';
			       		$salida.="<td><font size=2>".$clase."</font></td>";
			       			foreach($result3 as $row){
							$hm2 = $row['TOTAL3'];
							$M2 = $row['PER_SEXO'];
							$MJ2 = $row['LIO3'];	
						}	
							$salida.="<td><font size=2>".$hm2."</font></td>";
							$salida.="<td><font size=2>".$MJ2."</font></td>";
							foreach($result10 as $row8){
									$toe3 = $row8['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toe3."</font></td>";
								foreach($result125 as $row3){
									$toev2 = $row3['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toev2."</font></td>";

								$t14 = $toe3 + $toev2;	
								$salida.="<td><font size=2>".$t14."</font></td>";
			        break;
			    case 4:
			        $clase= 'ESPECIALISTAS';
			        	$salida.="<td><font size=2>".$clase."</font></td>";
			        	foreach($result4 as $row){
							$hm4 = $row['TOTAL3'];
							$M4 = $row['PER_SEXO'];
							$MJ4 = $row['LIO3'];	
						}	
							$salida.="<td><font size=2>".$hm4."</font></td>";
							$salida.="<td><font size=2>".$MJ4."</font></td>";
							foreach($result11 as $row8){
									$toe4 = $row8['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toe4."</font></td>";

							foreach($result126 as $row4){
									$toev3 = $row4['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toev3."</font></td>";	

								$t15 = $toe4 + $toev3;	
								$salida.="<td><font size=2>".$t15."</font></td>";
			        break;
			    case 5:
			        	$clase= 'CADETES';
			        	$salida.="<td><font size=2>".$clase."</font></td>";
			        	foreach($result5 as $row){
							$hm5 = $row['TOTAL3'];
							$M5 = $row['PER_SEXO'];
							$MJ5 = $row['LIO3'];	
						}	
							$salida.="<td><font size=2>".$hm5."</font></td>";
							$salida.="<td><font size=2>".$MJ5."</font></td>";
			       		foreach($result12 as $row9){
									$toe5 = $row9['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toe5."</font></td>";
								foreach($result127 as $row5){
									$toev4 = $row5['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toev4."</font></td>";	
			        	
			        			$t16 = $toe5 + $toev4;	
								$salida.="<td><font size=2>".$t16."</font></td>";
			        break;
			    case 6:

			        $clase= 'TROPA';
			        	$salida.="<td><font size=2>".$clase."</font></td>";

			        		    foreach($result6 as $row){
								$hm6 = $row['TOTAL3'];
								$M6 = $row['PER_SEXO'];
								$MJ6 = $row['LIO3'];	
							}
							$salida.="<td><font size=2>".$hm6."</font></td>";
							$salida.="<td><font size=2>".$MJ6."</font></td>";
							foreach($result13 as $row10){
									$toe6 = $row10['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toe6."</font></td>";

							foreach($result128 as $row5){
									$toev5 = $row5['TOTAL'];	
								}	
								$salida.="<td><font size=2>".$toev5."</font></td>";	

							$t17 = $toe6 + $toev5;	
								$salida.="<td><font size=2>".$t17."</font></td>";		 
			       break;
				}	
				
			}


		
			$totalh = $hm6+ $hm5 + $hm4 + $hm2 + $hm1 + $hm;
			$totalm = $MJ6+ $MJ5 + $MJ4 + $MJ2 + $MJ1 + $MJ;
			$totall = $toe1+ $toe2 + $toe3 + $toe4 + $toe5 + $toe6;
			$totalv = $toev+ $toev1 + $toev2 + $toev3 + $toev4 + $toev5;

			$vent = $t12 + $t13 + $t14 + $t15 + $t16 + $t17;

			$salida.='</tr>';
			$salida.='<tr>';
			$salida.="<th><font size=2>".'7'."</font></th>";
			$salida.="<th><font size=2>".'TOTAL'."</font></th>";
			$salida.="<td><font size=2>". $totalh."</font></td>";
			$salida.="<td><font size=2>".$totalm."</font></td>";
			$salida.="<td><font size=2>".$totall."</font></td>";
			$salida.="<td><font size=2>".$totalv."</font></td>";
			$salida.="<td><font size=2>".$vent."</font></td>";
			$salida.='</tr>';
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";
		}
		return $salida;
	}


	function tabla_info(){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_info();
		 
		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "10px" 	align="center"><font size=2><b>No.</b></font></td>';
			$salida.= '<td width = "80px" 	align="center"><font size=2><b>GRADO</b></font></td>';
			$salida.= '<td width = "40px" 	align="center"><font size=2><b>TOTAL Masc.</b></font></td>';
			$salida.= '<td width = "50px" 	align="center"><font size=2><b>TOTAL Fem.</b></font></td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			
			foreach($result as $row){
				$cont++;
				$hom = $row['HOMBRES']; 
				$muj = $row['MUJERES'];
				$tip = $row['EFC_TIPO'];
				

				if($tip == 1){
					$tip = 'ALUMNOS';
				}
				if($tip == 2){
					$tip = 'RESERVISTAS';
				}
				if($tip == 3){
					$tip = 'CONTRATO';
				}
				$salida.= '	<tr ';
				if ($cont % 2 == 0) {
					$salida.='class="odd gradeX">';
				}else{
					$salida.='class="success">';
				}
					$salida.="<td><font size=2>".$cont."</font></td>";
					$salida.="<td><font size=2>".$tip."</font></td>";
					$salida.="<td><font size=2>".$hom."</font></td>";
					$salida.="<td><font size=2>".$muj."</font></td>";
				$salida.='</tr>';
			}
		 
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";

		}
		return $salida;
	}

?>