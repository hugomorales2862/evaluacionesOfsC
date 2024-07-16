<?php
require_once("../html_fns.php");

	
// <!--==============================================================================================================================================
// ============================MUESTRA LA TABLA DE LA DOTACION ULTIMA SOLICITADA AL OFICIAL==========================================================
// ==================================================================================================================================================-->
// 

	function tabla_inmediato($dependencia,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales3($dependencia,$comp_eva);
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
			$salida.= '<td width = "350px" 	align="center"><font size=2><b>	EMPLEO</b></font></td>';
			$salida.= '<td width = "1px" 	align="center"><b>Calificar</b></td>';
			$salida.= '<td width = "1px" 	align="center"><b>Evaluadores Inmediatos</b></td>';
			// $salida.= '<td width = "1px" 	align="center">Eliminar</td>';
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
				$catalogo2 = $row['EVA_CAT2'];
				$eva_id = $row['EVA_ID'];
				$situacion = $row['EVA_SITUACION'];
				$empleo = $row['EVA_EMPLEO1'];
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
					$salida.="<td><font size=2>".$empleo."</font></td>";
					$salida.= "<td align = 'center'><a href = '../CP_INM3/Frm_my.php?eva=".$eva_id."&sit=31' onclick = '' type = 'button' class='btn btn-warning' title = 'Evalua SubJefe EMDN'><i class='icon-user'></i></a></td>";
					$salida.="<td bgcolor='#FFFF00'><center><font size=3><strong>".$catalogo2."</strong></font><input type='hidden' name ='catalogo2'  id = 'catalogo2' value='".$catalogo2."'></center></td>";
					// $salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'Eliminar'><i class='icon-trash'></i></a></td>";
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.="<font size=2 color='red'>NO EXISTEN DATOS PARA EVALUADORES INMEDIATOS</font>";
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
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow();'>OK</button>";
			$salida.=		"</div>";
		}
		return $salida;
	}
?>