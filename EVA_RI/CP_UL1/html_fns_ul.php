<?php
require_once("../html_fns.php");

	
// <!--==============================================================================================================================================
// ============================MUESTRA LA TABLA DE LA DOTACION ULTIMA SOLICITADA AL OFICIAL==========================================================
// ==================================================================================================================================================-->
	function tabla_inmediato($dependencia,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_fin2($dependencia,$comp_eva);
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
			$salida.= '<td width = "50px" align="center"><font size="2"><b>AUT.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>INM.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>FINAL</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>ANULAR</b></font></td>';
			//$salida.= '<td width = "60px" 	align="center">Borrador</td>';
			$salida.= '<td width = "60px" 	align="center">Reporte final</td>';
			$salida.= '<td width = "60px" 	align="center">Impugnar</td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>ANULAR</b></font></td>';
			//$salida.= '<td width = "60px" 	align="center">Eliminar</td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1']); //." ".trim($row['PER_NOM2'])
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
					$salida.="<td><font size=2>".$catalogo."</font><input type='hidden' name ='catalogo'  id = 'catalogo' value='".$catalogo."'></td>";
					$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font><input type ='hidden' name='gradoyarma' value = '".$gra_desc.' '.$arm_desc."' id ='gradoyarma'></td>";
					$salida.="<td><font size=2>".$nombre."</font><input type='hidden' name ='nombre'  id = 'nombre' value='".$nombre."'></td>";
					if($situacion == 31){
						$salida.= 		"<td colspan='3' align = 'center' bgcolor='#F5F6CE'><center>APROBADO</td>";
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></center></td></center>";
					}else if($situacion == 16){
						$salida.= 		"<td colspan='5' align = 'center' bgcolor='#F5F6CE'><center>En Proyecto Borrador</center></td>";
					}else if($situacion == 17){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td colspan='4' align = 'center' bgcolor='#F5F6CE'><center>Evalua Subjefe de EMDN</center></td>";

					}else if($situacion == 18){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td colspan='5' align = 'center' bgcolor='#F5F6CE'><center>Evalua Jefe de EMDN</center></td>";

					}else{
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></center></td>";
					}
					//$salida.= "<td align = 'center'><a href = '../CP_REP/REP_bor.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte borrador'><i class='icon-file'></i></a></td>";
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
	

	function tabla_inmediato2($dependencia,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_fin5($dependencia,$comp_eva);
		if($result != ""){
			$salida.= "<div class='table-responsive'>";
			$salida.= "<table class='table table-condensed table-bordered table-hover'>";
			$salida.= '<thead>';
			$salida.= '<tr>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>No.</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	EVALUACION</b></font></td>';
			$salida.= '<td width = "75px" 	align="center"><font size=2><b>	CATALOGO	</b></font></td>';
			$salida.= '<td width = "150px" 	align="center"><font size=2><b>	GRADO	</b></font></td>';
			$salida.= '<td width = "350px" 	align="center"><font size=2><b>	NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>AUT.</b></font></td>';
			//$salida.= '<td width = "50px" align="center"><font size="2"><b>INM.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>FINAL</b></font></td>';
			//$salida.= '<td width = "60px" 	align="center">Borrador</td>';
			$salida.= '<td width = "60px" 	align="center">Reporte final</td>';
			$salida.= '<td width = "60px" 	align="center">Impugnar</td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>ANULAR</b></font></td>';

			//$salida.= '<td width = "60px" 	align="center">Eliminar</td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1']); //." ".trim($row['PER_NOM2'])
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
					$salida.="<td><font size=2>".$catalogo."</font><input type='hidden' name ='catalogo'  id = 'catalogo' value='".$catalogo."'></td>";
					$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font><input type ='hidden' name='gradoyarma' value = '".$gra_desc.' '.$arm_desc."' id ='gradoyarma'></td>";
					$salida.="<td><font size=2>".utf8_encode($nombre)."</font><input type='hidden' name ='nombre'  id = 'nombre' value='".$nombre."'></td>";
					if($situacion == 32){
						$salida.= 		"<td colspan='2' align = 'center' bgcolor='#F5F6CE'><center>APROBADO</td>";
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva2.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></center></td></center>";
					}else if($situacion == 20){
						$salida.= 		"<td colspan='5' align = 'center' bgcolor='#F5F6CE'><center>En Proyecto Borrador</center></td>";
					}else if($situacion == 21){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td colspan='3' align = 'center' bgcolor='#F5F6CE'><center>Evaluador Final</center></td>";
						//$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva2.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";

					}else if($situacion == 22){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva2.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></center></td>";
						//$salida.= "<td align = 'center'><a href = '../CP_REP/REP_bor.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte borrador'><i class='icon-file'></i></a></td>";
						//DESCOMENTAREADO EL 10DIC2020 PARA ELIMINAR LA EVAL. FINALIZADA DE UN VICEMINISTRO.
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'Eliminar'><i class='icon-trash'></i></a></td>";
				
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

	function tabla_inmediato3($dependencia,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_fin2($dependencia,$comp_eva);
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
			$salida.= '<td width = "50px" align="center"><font size="2"><b>AUT.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>INM.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>FINAL</b></font></td>';

			//$salida.= '<td width = "60px" 	align="center">Borrador</td>';
			$salida.= '<td width = "60px" 	align="center">Reporte final</td>';
			$salida.= '<td width = "60px" 	align="center">Impugnar</td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>ANULAR</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>SUBIR PDF</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>VER PDF</b></font></td>';
			//$salida.= '<td width = "60px" 	align="center">REP_INPUGNADA</td>';
			//$salida.= '<td width = "60px" 	align="center">Eliminar</td>';
			
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1']); //." ".trim($row['PER_NOM2'])
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
					$salida.="<td><font size=2>".$catalogo."</font><input type='hidden' name ='catalogo'  id = 'catalogo' value='".$catalogo."'></td>";
					$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font><input type ='hidden' name='gradoyarma' value = '".$gra_desc.' '.$arm_desc."' id ='gradoyarma'></td>";
					$salida.="<td><font size=2>".utf8_encode($nombre)."</font><input type='hidden' name ='nombre'  id = 'nombre' value='".$nombre."'></td>";
					if($situacion == 28){
						$salida.= 		"<td colspan='3' align = 'center' bgcolor='#F5F6CE'><center>APROBADO</td>";
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></center></td></center>";
					}elseif($situacion == 1){
						$salida.= 		"<td colspan='5' align = 'center' bgcolor='#F5F6CE'><center>En Proyecto Borrador</center></td>";
					}elseif($situacion == 2){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td colspan='4' align = 'center' bgcolor='#F5F6CE'><center>Evaluador Inmediato</center></td>";

					}elseif($situacion == 3){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td colspan='5' align = 'center' bgcolor='#F5F6CE'><center>Evaluador Final</center></td>";

					}elseif($situacion == 4){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center'><center><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
						
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></center></td>";
						//$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP1_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
					}
					//$salida.= "<td align = 'center'><a href = '../CP_REP/REP_bor.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte borrador'><i class='icon-file'></i></a></td>";
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'Eliminar'><i class='icon-trash'></i></a></td>";
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Subir_pdf(".$eva_id.")' class='btn btn-info' title = 'SUBIR PDF'><i class='icon-hdd'></i></a></td>";
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Ver_pdf(".$eva_id.")' class='btn btn-white' title = 'VER PDF'><i class='icon-eye-open'></i></a></td>";

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

	function tabla_admin3($dependencia){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_total_admin($dependencia,$comp_eva);
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
			$salida.= '<td width = "50px" align="center"><font size="2"><b>AUT.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>INM.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>FINAL</b></font></td>';

			//$salida.= '<td width = "60px" 	align="center">Borrador</td>';
			$salida.= '<td width = "60px" 	align="center">Reporte final</td>';
			$salida.= '<td width = "60px" 	align="center">Impugnar</td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>ANULAR</b></font></td>';

			//$salida.= '<td width = "60px" 	align="center">REP_INPUGNADA</td>';
			//$salida.= '<td width = "60px" 	align="center">Eliminar</td>';
			
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1']); //." ".trim($row['PER_NOM2'])
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
					$salida.="<td><font size=2>".$catalogo."</font><input type='hidden' name ='catalogo'  id = 'catalogo' value='".$catalogo."'></td>";
					$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font><input type ='hidden' name='gradoyarma' value = '".$gra_desc.' '.$arm_desc."' id ='gradoyarma'></td>";
					$salida.="<td><font size=2>".utf8_encode($nombre)."</font><input type='hidden' name ='nombre'  id = 'nombre' value='".$nombre."'></td>";
					if($situacion == 28){
						$salida.= 		"<td colspan='3' align = 'center' bgcolor='#F5F6CE'><center>APROBADO</td>";
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></center></td></center>";
					}elseif($situacion == 1){
						$salida.= 		"<td colspan='5' align = 'center' bgcolor='#F5F6CE'><center>En Proyecto Borrador</center></td>";
					}elseif($situacion == 2){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td colspan='4' align = 'center' bgcolor='#F5F6CE'><center>Evaluador Inmediato</center></td>";

					}elseif($situacion == 3){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td colspan='5' align = 'center' bgcolor='#F5F6CE'><center>Evaluador Final</center></td>";

					}elseif($situacion == 4){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
						
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></center></td>";
						//$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP1_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
					}
					//$salida.= "<td align = 'center'><a href = '../CP_REP/REP_bor.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte borrador'><i class='icon-file'></i></a></td>";
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'Eliminar'><i class='icon-trash'></i></a></td>";
			
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

	function tabla_Impugnados($dependencia,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_Impugnados($dependencia,$comp_eva);
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
			$salida.= '<td width = "60px" 	align="center">Reportes</td>';
			$salida.= '<td width = "60px" 	align="center">Rectificar</td>';
			$salida.= '<td width = "60px" 	align="center">Ratificar</td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1']); //." ".trim($row['PER_NOM2'])
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
					$salida.="<td><font size=2>".$catalogo."</font><input type='hidden' name ='catalogo'  id = 'catalogo' value='".$catalogo."'></td>";
					$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font><input type ='hidden' name='gradoyarma' value = '".$gra_desc.' '.$arm_desc."' id ='gradoyarma'></td>";
					$salida.="<td><font size=2>".utf8_encode($nombre)."</font><input type='hidden' name ='nombre'  id = 'nombre' value='".$nombre."'></td>";
					if($situacion == 34){
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP1_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-default' title = 'Generar reporte Impugnado'><i class='icon-flag'></i></a></center></td>";

					$salida.= 	"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-defoult' title = 'Corregir Evaluacion'><i class='icon-thumbs-down'></center></i></a></td>";
					
					$salida.= 	"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Anulacion_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Confirmar la Impugnacion'><i class='icon-thumbs-up'></center></i></a></td>";
					}
					//$salida.= "<td align = 'center'><a href = '../CP_REP/REP_bor.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte borrador'><i class='icon-file'></i></a></td>";
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

	function tabla_Impugnados_anulados($dependencia,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_Impugnados_anulados($dependencia,$comp_eva);
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
			$salida.= '<td width = "60px" 	align="center">Reportes</td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1']); //." ".trim($row['PER_NOM2'])
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
					$salida.="<td><font size=2>".$catalogo."</font><input type='hidden' name ='catalogo'  id = 'catalogo' value='".$catalogo."'></td>";
					$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font><input type ='hidden' name='gradoyarma' value = '".$gra_desc.' '.$arm_desc."' id ='gradoyarma'></td>";
					$salida.="<td><font size=2>".utf8_encode($nombre)."</font><input type='hidden' name ='nombre'  id = 'nombre' value='".$nombre."'></td>";
					if($situacion == 35){
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
					}
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'Eliminar'><i class='icon-trash'></i></a></td>";
					
					//$salida.= "<td align = 'center'><a href = '../CP_REP/REP_bor.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte borrador'><i class='icon-file'></i></a></td>";
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
	
	function tabla_inmediato4($dependencia,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_fin7($dependencia,$comp_eva);
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
			$salida.= '<td width = "50px" align="center"><font size="2"><b>AUT.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>INM.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>FINAL</b></font></td>';
			//$salida.= '<td width = "60px" 	align="center">Borrador</td>';
			$salida.= '<td width = "60px" 	align="center">Reporte final</td>';
			$salida.= '<td width = "60px" 	align="center">Impugnar</td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>ANULAR</b></font></td>';
			
			//$salida.= '<td width = "60px" 	align="center">Eliminar</td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1']); //." ".trim($row['PER_NOM2'])
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
					$salida.="<td><font size=2>".$catalogo."</font><input type='hidden' name ='catalogo'  id = 'catalogo' value='".$catalogo."'></td>";
					$salida.="<td><font size=2>".$gra_desc.' '.$arm_desc."</font><input type ='hidden' name='gradoyarma' value = '".$gra_desc.' '.$arm_desc."' id ='gradoyarma'></td>";
					$salida.="<td><font size=2>".utf8_encode($nombre)."</font><input type='hidden' name ='nombre'  id = 'nombre' value='".$nombre."'></td>";
					if($situacion == 33){
						$salida.= 		"<td colspan='3' align = 'center' bgcolor='#F5F6CE'><center>APROBADO</td>";
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></center></td></center>";
					}elseif($situacion == 24){
						$salida.= 		"<td colspan='5' align = 'center' bgcolor='#F5F6CE'><center>En Proyecto Borrador</center></td>";
					}elseif($situacion == 25){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td colspan='4' align = 'center' bgcolor='#F5F6CE'><center>Evaluador Inmediato</center></td>";

					}elseif($situacion == 26){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td colspan='5' align = 'center' bgcolor='#F5F6CE'><center>Evaluador Final</center></td>";

					}elseif($situacion == 27){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></center></td>";
					}
					//$salida.= "<td align = 'center'><a href = '../CP_REP/REP_bor.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'Generar reporte borrador'><i class='icon-file'></i></a></td>";
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'Eliminar'><i class='icon-trash'></i></a></td>";
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
	
	function html_alert_eliminado($valor){
		if($valor == 1){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Atencion</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<center><p>Evaluacion rectificada</p></center>";
			$salida.=			"<center><img src='../img/rectificar.JPG' alt='' height='100' width='100'></center>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='redirecciona();'>OK</button>";
			$salida.=		"</div>";
		}elseif($valor == 2){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Atencion</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<center><p>Evaluacion Impugnada</p></center>";
			$salida.=			"<center><img src='../img/impugna.JPG' alt='' height='100' width='100'></center>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='redirecciona();'>OK</button>";
			$salida.=		"</div>";
		}
		return $salida;
	}
?>