<?php
require_once("../html_fns.php");

	
// <!--==============================================================================================================================================
// ============================MUESTRA LA TABLA DE LA DOTACION ULTIMA SOLICITADA AL OFICIAL==========================================================
// ==================================================================================================================================================-->
	function tabla_inmediato($dependencia,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_fin6($dependencia,$comp_eva);
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
					$salida.="<td><font size=2>".utf8_encode($nombre)."</font><input type='hidden' name ='nombre'  id = 'nombre' value='".utf8_decode($nombre)."'></td>";
					if($situacion == 31){
						$salida.= 		"<td colspan='3' align = 'center' bgcolor='#F5F6CE'><center>APROBADO</td>";
						$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center><a onclick = 'xajax_Impugnar_evaluacion(".$eva_id.")' class='btn btn-warning' title = 'Impugnar'><i class=' icon-hand-up'></i></a></center></td></center>";
					}elseif($situacion == 16){
						$salida.= 		"<td colspan='5' align = 'center' bgcolor='#F5F6CE'><center>EN PROYECTO BORRADOR</center></td>";
					}elseif($situacion == 17){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td colspan='4' align = 'center' bgcolor='#F5F6CE'><center>Evalua Subjefe de EMDN <img id='b' alt='Brand' src='../img/eva_subje.png'  style='max-width:30px; margin-top: -4px;'></center></td>";

					}elseif($situacion == 18){
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><center>X</center></td>";
						$salida.= 		"<td colspan='3' align = 'center' bgcolor='#F5F6CE'><center>Evalua Jefe de EMDN<img id='b' alt='Brand' src='../img/eva_subje.png'  style='max-width:30px; margin-top: -4px;'><img id='b' alt='Brand' src='../img/eva_subje.png'  style='max-width:30px; margin-top: -4px;'></center></td>";

					}else{
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