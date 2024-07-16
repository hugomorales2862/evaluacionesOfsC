<?php
include_once("../html_fns.php");

	function tiempo($tiempo){
	
		switch(strlen($tiempo)) { 
		  case 1:   
			$tiempo_s = substr($tiempo, 0, 1).' DIAS';
			 break;
		  case 2:   
			$tiempo_s = substr($tiempo, 0, 2).' DIAS';
			 break;		
		  case 3:
			$tiempo_s = substr($tiempo, 0, 1).' MESES '.substr($tiempo, 1, 2).' DIAS';
			break;
		  case 4:
			$tiempo_s = substr($tiempo, 0, 2).' MESES '.substr($tiempo, 2, 2).' DIAS';
			break;
		  case 5:
			$tiempo_s = substr($tiempo, 0, 1).' AÑOS '.substr($tiempo, 1, 2).' MESES '.substr($tiempo, 3, 2).' DIAS';
			break;
		  case 6:
			$tiempo_s = substr($tiempo, 0, 2).' AÑOS '.substr($tiempo, 2, 2).' MESES '.substr($tiempo, 4, 2).' DIAS';
			break;	
		  default:
			$tiempo_s = 'TIEMPO INDEFINIDO';
			break;
	   } 
		return $tiempo_s;
	}
	
	
	function combo_linea(){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->get_linea();
		if($result != ""){
			$salida.= '<select name="linea" id="linea" class = "span2">';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$dm_codigo = $row['LIN_ID'];
				$dm_desc_md = $row['LIN_DESC_LG'];
				$salida.= "<option value=".$dm_codigo.">".$dm_desc_md."</option>";
			}
			$salida.='</select>';
		}else{
			$salida.= '<select style="font-size: 1.2em;width:200px" name="tipos" id="tipos">';
			$salida.= "<option value='' selected>Seleccione</option>";
			$salida.= "<option value=''>no existen datos</option>";
			$salida.='</select>';
		}
			return $salida;
	}
	
	function combo_destino(){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->get_destino();
		if($result != ""){
			$salida.= '<select name="destino" id="destino" class = "span2">';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$dm_codigo = $row['DES_ID'];
				$dm_desc_md = $row['DES_DESC_LG'];
				$salida.= "<option value=".$dm_codigo.">".$dm_desc_md."</option>";
			}
			$salida.='</select>';
		}else{
			$salida.= '<select style="font-size: 1.2em;width:200px" name="tipos" id="tipos">';
			$salida.= "<option value='' selected>Seleccione</option>";
			$salida.= "<option value=''>no existen datos</option>";
			$salida.='</select>';
		}
			return $salida;
	}
	
	
	function html_alert_entregado($valor){
		if($valor == 2){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Mensaje</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<center><p>BORRADOR INGRESADO SATISFACTORIAMENTE</p></center>";
			$salida.=			"<center><img src='../img/borrador.png' alt='' height='100' width='100'></center>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(1);'>Aceptar</button>";
			$salida.=		"</div>";
		}elseif($valor == 2 or $valor == 17 or $valor == 21 or $valor == 25){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Mensaje</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<center><img src='../img/auto.png' alt='' height='400' width='400</center>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(1);'>Aceptar</button>";
			$salida.=		"</div>";
		}
		return $salida;
	}
	
	function tabla_admin1($situacion,$dependencia){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_oficiales_admin($situacion,$dependencia);
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
			$salida.= '<td width = "1px" 	align="center">Modificar</td>';
			$salida.= '<td width = "1px" 	align="center">Calificar</td>';
			//$salida.= '<td width = "1px" 	align="center">Borrador</td>';
			$salida.= '<td width = "1px" 	align="center">Eliminar</td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre= trim($row['PER_NOM1'])." ".trim($row['PER_NOM2'])." ".trim($row['PER_APE1'])." ".trim($row['PER_APE2']); 
				$nombre = utf8_encode($nombre);
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
					$salida.="<td ><font size=2>".$nombre."</font></td>";
					$salida.= "<td align = 'center'><a href = '../CP_INM1/Frm_mod.php?eva=".$eva_id."&sit=7' onclick = '' type = 'button' class='btn btn-default' title = 'Modificar borrador'><i class='icon-pencil'></i></a></td>";
					if($situacion == 1){
						$salida.= "<td align = 'center'><a href = '../CP_EVALUACION1/Frm_admin_1.php?eva=".$eva_id."&sit=2'  onclick = '' type = 'button' class='btn btn-info' title = 'Autoevaluar'><i class='icon-user'></i></a></td>";
					}
					if($situacion == 20){
						$salida.= "<td align = 'center'><a href = '../CP_EVALUACION1/Frm_miaVJ.php?eva=".$eva_id."&sit=21'  onclick = '' type = 'button' class='btn btn-info' title = 'Autoevaluar'><i class='icon-user'></i></a></td>";
					}if($situacion == 24){
						$salida.= "<td align = 'center'><a href = '../CP_EVALUACION1/Frm_miaDIR.php?eva=".$eva_id."&sit=25'  onclick = '' type = 'button' class='btn btn-info' title = 'Autoevaluar'><i class='icon-user'></i></a></td>";
					}
					//$salida.= "<td align = 'center'><a href = '../CP_REP/REP_bor.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'EVALUA JEFE INMEDIATO'><i class='icon-file'></i></a></td>";
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'Eliminar'><i class='icon-trash'></i></a></td>";
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.=			"<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";

		}
		return $salida;
	}
	
	function tabla_inmediato($situacion,$dependencia,$comp_eva){
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
			$salida.= '<td width = "1px" 	align="center">Modificar</td>';
			$salida.= '<td width = "1px" 	align="center">Calificar</td>';
			//$salida.= '<td width = "1px" 	align="center">Borrador</td>';
			$salida.= '<td width = "1px" 	align="center">Eliminar</td>';
			$salida.= '</tr>';
			$salida.= '</thead>';
			$salida.= '<tbody class= "Sub-heading">';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$nombre= trim($row['PER_NOM1'])." ".trim($row['PER_NOM2'])." ".trim($row['PER_APE1'])." ".trim($row['PER_APE2']); 
				$nombre = utf8_encode($nombre);
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
					$salida.="<td ><font size=2>".$nombre."</font></td>";
					$salida.= "<td align = 'center'><a href = '../CP_INM1/Frm_mod.php?eva=".$eva_id."&sit=7' onclick = '' type = 'button' class='btn btn-default' title = 'Modificar borrador'><i class='icon-pencil'></i></a></td>";
					if($situacion == 1){
						$salida.= "<td align = 'center'><a href = '../CP_EVALUACION1/Frm_mia_evaluar.php?eva=".$eva_id."&sit=2'  onclick = '' type = 'button' class='btn btn-info' title = 'Autoevaluar'><i class='icon-user'></i></a></td>";
					}
					if($situacion == 20){
						$salida.= "<td align = 'center'><a href = '../CP_EVALUACION1/Frm_miaVJ.php?eva=".$eva_id."&sit=21'  onclick = '' type = 'button' class='btn btn-info' title = 'Autoevaluar'><i class='icon-user'></i></a></td>";
					}if($situacion == 24){
						$salida.= "<td align = 'center'><a href = '../CP_EVALUACION1/Frm_miaDIR.php?eva=".$eva_id."&sit=25'  onclick = '' type = 'button' class='btn btn-info' title = 'Autoevaluar'><i class='icon-user'></i></a></td>";
					}
					//$salida.= "<td align = 'center'><a href = '../CP_REP/REP_bor.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-warning' title = 'EVALUA JEFE INMEDIATO'><i class='icon-file'></i></a></td>";
					$salida.= 		"<td align = 'center' bgcolor='#F5F6CE'><a onclick = 'xajax_Eliminar_evaluacion(".$eva_id.")' class='btn btn-danger' title = 'Eliminar'><i class='icon-trash'></i></a></td>";
				$salida.='</tr>';
			}
			$salida.= '</tbody>';
			$salida.= '</table>';
			$salida.= '</div>';
			$salida.= "<input type='hidden' name='contador' id='contador' value = $cont >";
		}else{
			$salida.=			"<center><img src='../img/nodata.png' alt='' height='400' width='400'></center>";

		}
		return $salida;
	}
	
	
	function combo_linea1($linea){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->get_linea();
		if($result != ""){
			$salida.= '<select name="linea" id="linea" class = "span2" disabled>';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$dm_codigo = $row['LIN_ID'];
				$dm_desc_md = $row['LIN_DESC_LG'];
				
				if($linea == $dm_codigo){
				$salida.= '<option value="'.$linea.'" selected>'.$dm_desc_md.'</option>';					
				}else{
					$salida.= '<option value="'.$dm_codigo.'">'.$dm_desc_md.'</option>';    			
				}
			}
			$salida.='</select>';
		}else{
			$salida.= '<select style="font-size: 1.2em;width:200px" name="tipos" id="tipos">';
			$salida.= "<option value='' selected>Seleccione</option>";
			$salida.= "<option value=''>no existen datos</option>";
			$salida.='</select>';
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

	function combo_grados1(){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->grados2();
		if($result != ""){
			$salida.= '<select name="codigo_grado1" id="codigo_grado1" class = "span2">';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$dm_codigo = $row['GRA_CODIGO'];
				$dm_desc_md = $row['GRA_DESC_MD'];
				$salida.= "<option value=".$dm_codigo.">".$dm_desc_md."</option>";
			}
			$salida.='</select>';
		}else{
			$salida.= '<select style="font-size: 1.2em;width:200px" name="tipos" id="tipos">';
			$salida.= "<option value='' selected>Seleccione</option>";
			$salida.= "<option value=''>no existen datos</option>";
			$salida.='</select>';
		}
			return $salida;
	}

	function combo_grados2(){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->grados2();
		if($result != ""){
			$salida.= '<select name="codigo_grado2" id="codigo_grado2" class = "span2">';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$dm_codigo = $row['GRA_CODIGO'];
				$dm_desc_md = $row['GRA_DESC_MD'];
				$salida.= "<option value=".$dm_codigo.">".$dm_desc_md."</option>";
			}
			$salida.='</select>';
		}else{
			$salida.= '<select style="font-size: 1.2em;width:200px" name="tipos" id="tipos">';
			$salida.= "<option value='' selected>Seleccione</option>";
			$salida.= "<option value=''>no existen datos</option>";
			$salida.='</select>';
		}
			return $salida;
	}
	
	function combo_grados3(){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->grados2();
		if($result != ""){
			$salida.= '<select name="codigo_grado3" id="codigo_grado3" class = "span2">';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$dm_codigo = $row['GRA_CODIGO'];
				$dm_desc_md = $row['GRA_DESC_MD'];
				$salida.= "<option value=".$dm_codigo.">".$dm_desc_md."</option>";
			}
			$salida.='</select>';
		}else{
			$salida.= '<select style="font-size: 1.2em;width:200px" name="tipos" id="tipos">';
			$salida.= "<option value='' selected>Seleccione</option>";
			$salida.= "<option value=''>no existen datos</option>";
			$salida.='</select>';
		}
			return $salida;
	}
?>