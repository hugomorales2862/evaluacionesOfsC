<?php
require_once("../html_fns.php");

	
// <!--==============================================================================================================================================
// ============================MUESTRA LA TABLA DE LA DOTACION ULTIMA SOLICITADA AL OFICIAL==========================================================
// ==================================================================================================================================================-->
	function tabla_inmediato($dependencia,$comp_eva){
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
			$salida.= '<td width = "60px" 	align="center">Reporte final</td>';
			$salida.= '<td width = "60px" 	align="center">Impugnar</td>';
			$salida.= '<td width = "60px" 	align="center">Eliminar</td>';
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
					$salida.="<td><font size=2>".utf8_encode($nombre)."</font></td>";

					
					if($situacion == 1){
						$salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'Eliminar'><i class='icon-trash'></i></a></td>";
					}else if($situacion == 2){
						$salida.= "<td align = 'center'><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></td>";
						$salida.= 		"<td colspan='2' align = 'center' bgcolor='#F5F6CE'>APROBADO</td>";
					}else if($situacion == 0){
						$salida.= 		"<td colspan='3' align = 'center' bgcolor='#F5F6CE'>EN PROYECTO BORRADOR</td>";
					}
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<font size=2 color='red'>NO EXITEN EVALUACION FINALIZADAS</font>";
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
			$salida.=			"<p class='text-left'>Evaluacion eliminada satisfactoriamente</p>";
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
			$salida.=			"<p class='text-left'>Evaluacion impugnada satisfactoriamente</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='redirecciona();'>OK</button>";
			$salida.=		"</div>";
		}
		return $salida;
	}
?>