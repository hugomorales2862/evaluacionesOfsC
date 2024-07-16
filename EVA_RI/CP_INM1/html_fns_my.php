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
	
	function combo_grados1($gra11){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->grados2();
		if($result != ""){
			$salida.= '<select name="codigo_grado1" id="codigo_grado1" class = "span2">';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$dm_codigo = $row['GRA_CODIGO'];
				$dm_desc_md = $row['GRA_DESC_MD'];
				$salida.= "<option value=".$dm_codigo.">".$dm_desc_md."</option>";
				if($gra11 == $dm_codigo){
				$salida.= '<option value="'.$gra11.'" selected>'.$dm_desc_md.'</option>';					
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

	function combo_grados2($gra21){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->grados2();
		if($result != ""){
			$salida.= '<select name="codigo_grado2" id="codigo_grado2" class = "span2">';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$dm_codigo = $row['GRA_CODIGO'];
				$dm_desc_md = $row['GRA_DESC_MD'];
				$salida.= "<option value=".$dm_codigo.">".$dm_desc_md."</option>";
				if($gra21 == $dm_codigo){
				$salida.= '<option value="'.$gra21.'" selected>'.$dm_desc_md.'</option>';					
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
	
	function combo_grados3($gra31){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->grados2();
		if($result != ""){
			$salida.= '<select name="codigo_grado3" id="codigo_grado3" class = "span2">';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$dm_codigo = $row['GRA_CODIGO'];
				$dm_desc_md = $row['GRA_DESC_MD'];
				$salida.= "<option value=".$dm_codigo.">".$dm_desc_md."</option>";
				if($gra31 == $dm_codigo){
				$salida.= '<option value="'.$gra31.'" selected>'.$dm_desc_md.'</option>';					
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
	
	function combo_linea($linea){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->get_linea();
		if($result != ""){
			$salida.= '<select name="linea" id="linea" class = "span2" disabled>';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$dm_codigo = $row['LIN_ID'];
				$dm_desc_md = $row['LIN_DESC_LG'];
				$salida.= "<option value=".$dm_codigo.">".$dm_desc_md."</option>";
				
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
	
	
	function html_alert_entregado($valor){
		if($valor == 7){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>BORRADOR MODIFICADO SATISFACTORIAMENTE</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(1);'>OK</button>";
			$salida.=		"</div>";
		}elseif ($valor == 5){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>EVALUACION CALIFICADA</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(1);'>OK</button>";
			$salida.=		"</div>";
		}elseif ($valor == 6){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>EVALUACION CALIFICADA EVALUADOR FINAL</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(2);'>OK</button>";
			$salida.=		"</div>";
		}elseif ($valor == 12 or $valor == 18){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<center><img src='../img/subjefe.png' alt='' height='400' width='400</center>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(1);'>Aceptar</button>";
			$salida.=		"</div>";
		}elseif ($valor == 13){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>EVALUACION CALIFICADA EVALUADOR FINALO</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(1);'>OK</button>";
			$salida.=		"</div>";
		}
		return $salida;
	}
	
	function combo_linea1($linea){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->get_linea();
		if($result != ""){
			$salida.= '<select name="linea" id="linea" class = "span2">';
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
?>