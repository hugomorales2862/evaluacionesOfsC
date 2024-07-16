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
	
	
	function combo_linea($linea){
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
	
	
	
	function html_alert_entregado($valor){
		if($valor == 0){
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
		}else if ($valor == 2){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>EVALUACION POR EL JEFE INMEDIATO INGRESADA SATISFACTORIAMENTE</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(1);'>OK</button>";
			$salida.=		"</div>";
		}else if ($valor == 3){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>EVALUACION FINAL INGRESADA SATISFACTORIAMENTE</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(2);'>OK</button>";
			$salida.=		"</div>";
		}else if ($valor == 10){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>BORRADOR MODIFICADO SATISFACTORIAMENTE</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(3);'>OK</button>";
			$salida.=		"</div>";
		}else if ($valor == 16){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>BORRADOR MODIFICADO SATISFACTORIAMENTE</p>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(4);'>OK</button>";
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
	
	function combo_destino1($dest){
		$ClsIng = new ClsIngreso();
		$result = $ClsIng->get_destino();
		if($result != ""){
			$salida.= '<select name="destino" id="destino" class = "span2">';
				$salida.= "<option value='' selected>Seleccione</option>";
			foreach($result as $row){
				$dm_codigo = $row['DES_ID'];
				$dm_desc_md = $row['DES_DESC_LG'];
			
				if($dest == $dm_codigo){
				$salida.= '<option value="'.$dest.'" selected>'.$dm_desc_md.'</option>';					
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