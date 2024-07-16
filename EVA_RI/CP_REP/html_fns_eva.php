<?php
include_once("../html_fns.php");
// include_once("../CPMENU/html_menu.php");


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
	
	
	function tabla_finalizados($dependencia,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_datos($dependencia,$comp_eva);
		if($result != ""){
			$salida = '<br>';
			$salida.= '<div id = "reportes">';
			$salida.= '<table>';
			$salida.= '<tr>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>No.</b></font></td>';
			$salida.= '<td width = "160px" align="center"><font size="2"><b>CATALOGO</b></font></td>';
			$salida.= '<td width = "200px" align="left"><font size="2"><b>GRADO</b></font></td>';
			$salida.= '<td width = "400px" align="left"><font size="2"><b>NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>AUT.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>INM.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>FINAL</b></font></td>';
			$salida.= '</tr>';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$catalogo=$row['PER_CATALOGO'];
				$nombre1=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1'])." ".trim($row['PER_NOM2']); 
				$nombre= utf8_encode($nombre1);
				$gra_desc = trim($row['GRA_DESC_CT']);  
				$grado = $row['GRA_CODIGO'];  
				$arm_desc = trim($row['ARM_DESC_CT']);
				$id_eva = trim($row['EVA_ID']);
				$situacion = $row['EVA_SITUACION'];
				$salida.= '<tr>';
				$salida.='<td align="center"><font size="2">'.$cont.'</font></td>';
				$salida.="<td align='center'><font size='2'>".$catalogo."</font></td>";
				
				if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
					$salida.="<td><font size='2'>".$gra_desc."</font></td>";
				}else{
					$salida.="<td><font size='2'>".$gra_desc.' '.$arm_desc."</font></td>";
				}
				$salida.='<td><font size="2">'.$nombre.'</font></td>';
				
				if($situacion == 4 or $situacion == 8 or $situacion == 13 or $situacion == 19  or $situacion == 23 or $situacion == 27){
					$total1 = $ClsPer->cuenta_preguntas($id_eva,1);
					if ($total1 == 20){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					}
					$total2 = $ClsPer->cuenta_preguntas($id_eva,2);
					if ($total2 == 20){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					}
					$total3 = $ClsPer->cuenta_preguntas($id_eva,3);
					if ($total3 == 20){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					}
				}
				
				
				$salida.='</tr>';
			}
			$salida.= "</table>";
			$salida.= '</div>';
			$salida.= '<br>';
		}else{
			$salida = "NO SE REPORTAN DATOS EN LA BASE DE DATOS";
		}
		return $salida;
	}
	
	
	function tabla_comtes_jefes($comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_datos_comtes_jefes($comp_eva);
		if($result != ""){
			$salida = '<br>';
			$salida.= '<div id = "reportes">';
			$salida.= '<table>';
			$salida.= '<tr>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>No.</b></font></td>';
			$salida.= '<td width = "160px" align="center"><font size="2"><b>CATALOGO</b></font></td>';
			$salida.= '<td width = "200px" align="left"><font size="2"><b>GRADO</b></font></td>';
			$salida.= '<td width = "400px" align="left"><font size="2"><b>NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>AUT.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>INM.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>FINAL</b></font></td>';
			$salida.= '</tr>';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$catalogo=$row['PER_CATALOGO'];
				$nombre1=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1'])." ".trim($row['PER_NOM2']); 
				$nombre= utf8_encode($nombre1);
				$gra_desc = trim($row['GRA_DESC_CT']);  
				$grado = $row['GRA_CODIGO'];  
				$arm_desc = trim($row['ARM_DESC_CT']);
				$id_eva = trim($row['EVA_ID']);
				$situacion = $row['EVA_SITUACION'];
				$salida.= '<tr>';
				$salida.='<td align="center"><font size="2">'.$cont.'</font></td>';
				$salida.="<td align='center'><font size='2'>".$catalogo."</font></td>";
				
				if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
					$salida.="<td><font size='2'>".$gra_desc."</font></td>";
				}else{
					$salida.="<td><font size='2'>".$gra_desc.' '.$arm_desc."</font></td>";
				}
				$salida.='<td><font size="2">'.$nombre.'</font></td>';
				
				if($situacion == 4 or $situacion == 8 or $situacion == 13 or $situacion == 19  or $situacion == 23 or $situacion == 27){
					$total1 = $ClsPer->cuenta_preguntas($id_eva,1);
					if ($total1 == 20){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					}
					$total2 = $ClsPer->cuenta_preguntas($id_eva,2);
					if ($total2 == 20){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					}
					$total3 = $ClsPer->cuenta_preguntas($id_eva,3);
					if ($total3 == 20){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					}
				}
				
				
				$salida.='</tr>';
			}
			$salida.= "</table>";
			$salida.= '</div>';
			$salida.= '<br>';
		}else{
			$salida = "NO SE REPORTAN DATOS EN LA BASE DE DATOS";
		}
		return $salida;
	}
	

function Tabla_Evaluar($comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_datos_evaluar($comp_eva);
		if($result != ""){
			$salida = '<br>';
			$salida.= '<div id = "reportes">';
			$salida.= '<table>';
			$salida.= '<tr>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>No.</b></font></td>';
			$salida.= '<td width = "160px" align="center"><font size="2"><b>CATALOGO</b></font></td>';
			$salida.= '<td width = "200px" align="left"><font size="2"><b>GRADO</b></font></td>';
			$salida.= '<td width = "400px" align="left"><font size="2"><b>NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>AUT.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>INM.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>FINAL</b></font></td>';
			$salida.= '</tr>';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$catalogo=$row['PER_CATALOGO'];
				$nombre1=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1'])." ".trim($row['PER_NOM2']); 
				$nombre= utf8_encode($nombre1);
				$gra_desc = trim($row['GRA_DESC_CT']);  
				$grado = $row['GRA_CODIGO'];  
				$arm_desc = trim($row['ARM_DESC_CT']);
				$id_eva = trim($row['EVA_ID']);
				$situacion = $row['EVA_SITUACION'];
				$salida.= '<tr>';
				$salida.='<td align="center"><font size="2">'.$cont.'</font></td>';
				$salida.="<td align='center'><font size='2'>".$catalogo."</font></td>";
				
				if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
					$salida.="<td><font size='2'>".$gra_desc."</font></td>";
				}else{
					$salida.="<td><font size='2'>".$gra_desc.' '.$arm_desc."</font></td>";
				}
				$salida.='<td><font size="2">'.$nombre.'</font></td>';
				
				if($situacion == 1 or $situacion == 2 or $situacion == 3 or $situacion == 4){
					$total1 = $ClsPer->cuenta_preguntas($id_eva,1);
					if ($total1 == 20){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					}
					$total2 = $ClsPer->cuenta_preguntas($id_eva,2);
					if ($total2 == 20){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					}
					$total3 = $ClsPer->cuenta_preguntas($id_eva,3);
					if ($total3 == 20){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					}
				}
				
				
				$salida.='</tr>';
			}
			$salida.= "</table>";
			$salida.= '</div>';
			$salida.= '<br>';
		}else{
			$salida = "NO SE REPORTAN DATOS EN LA BASE DE DATOS";
		}
		return $salida;
	}

	function tabla_comtes_2dos($comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_datos_comtes_2dos($comp_eva);
		if($result != ""){
			$salida = '<br>';
			$salida.= '<div id = "reportes">';
			$salida.= '<table>';
			$salida.= '<tr>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>No.</b></font></td>';
			$salida.= '<td width = "160px" align="center"><font size="2"><b>CATALOGO</b></font></td>';
			$salida.= '<td width = "200px" align="left"><font size="2"><b>GRADO</b></font></td>';
			$salida.= '<td width = "400px" align="left"><font size="2"><b>NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>AUT.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>INM.</b></font></td>';
			$salida.= '<td width = "50px" align="center"><font size="2"><b>FINAL</b></font></td>';
			$salida.= '</tr>';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$catalogo=$row['PER_CATALOGO'];
				$nombre1=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1'])." ".trim($row['PER_NOM2']); 
				$nombre= utf8_encode($nombre1);
				$gra_desc = trim($row['GRA_DESC_CT']);  
				$grado = $row['GRA_CODIGO'];  
				$arm_desc = trim($row['ARM_DESC_CT']);
				$id_eva = trim($row['EVA_ID']);
				$situacion = $row['EVA_SITUACION'];
				$salida.= '<tr>';
				$salida.='<td align="center"><font size="2">'.$cont.'</font></td>';
				$salida.="<td align='center'><font size='2'>".$catalogo."</font></td>";
				
				if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
					$salida.="<td><font size='2'>".$gra_desc."</font></td>";
				}else{
					$salida.="<td><font size='2'>".$gra_desc.' '.$arm_desc."</font></td>";
				}
				$salida.='<td><font size="2">'.$nombre.'</font></td>';
				
				if($situacion == 5 or $situacion == 6 or $situacion == 7 or $situacion == 8 or $situacion == 10 or $situacion == 11 or $situacion == 12 or $situacion == 13){
					$total1 = $ClsPer->cuenta_preguntas($id_eva,1);
					if ($total1 == 20){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					}
					$total2 = $ClsPer->cuenta_preguntas($id_eva,2);
					if ($total2 == 20){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					$total3 = $ClsPer->cuenta_preguntas($id_eva,3);
					if ($total3 == 20 or $situacion == 8){
						$salida.='<td align="center"><font size="2">X</font></td>';
					}else{
						$salida.='<td><font size="2"></font></td>';
					}
				}
			}
				
				$salida.='</tr>';
			}
			$salida.= "</table>";
			$salida.= '</div>';
			$salida.= '<br>';
		}else{
			$salida = "NO SE REPORTAN DATOS EN LA BASE DE DATOS";
		}
		return $salida;
	}
	
	function tabla_finalizados1($comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->get_datos_cjd($comp_eva);
		if($result != ""){
			$salida = '<br>';
			$salida.= '<div id = "reportes">';
			$salida.= '<table>';
			$salida.= '<tr>';
			$salida.= '<td width = "50px" align="center"><font size="1"><b>No.</b></font></td>';
			$salida.= '<td width = "160px" align="center"><font size="1"><b>CATALOGO</b></font></td>';
			$salida.= '<td width = "200px" align="left"><font size="1"><b>GRADO</b></font></td>';
			$salida.= '<td width = "400px" align="left"><font size="1"><b>NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "150px" align="left"><font size="1"><b>DEPENDENCIA</b></font></td>';
			$salida.= '<td width = "300px" align="left"><font size="1"><b>EMPLEO</b></font></td>';
			$salida.= '<td width = "100px" align="center"><font size="1"><b>CATEGORIA</b></font></td>';
			$salida.= '<td width = "100px" align="center"><font size="1"><b>NOTA</b></font></td>';
			$salida.= '<td width = "100px" align="center"><font size="1"><b>SITUACION</b></font></td>';
			$salida.= '</tr>';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$catalogo=$row['PER_CATALOGO'];
				$nombre1= trim($row['PER_NOM1'])." ".trim($row['PER_APE1'])." ".trim($row['PER_APE2']); 
				$nombre= utf8_encode($nombre1);
				$gra_desc = trim($row['GRA_DESC_CT']);  
				$grado = $row['GRA_CODIGO'];  
				$arm_desc = trim($row['ARM_DESC_CT']);
				$id_eva = trim($row['EVA_ID']);
				$des_dep = trim($row['DEP_DESC_CT']);
				$empleo = trim($row['EVA_EMPLEO1']);
				$situacion = trim($row['EVA_SITUACION']);
				$renglon = trim($row['EVA_RENGLON']);
				$salida.= '<tr>';
				$salida.='<td align="center"><font size="1">'.$cont.'</font></td>';
				$salida.="<td align='center'><font size='1'>".$catalogo."</font></td>";
				
				if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
					$salida.="<td><font size='1'>".$gra_desc."</font></td>";
				}else{
					$salida.="<td><font size='1'>".$gra_desc.' '.$arm_desc."</font></td>";
				}
				$salida.='<td><font size="1">'.$nombre.'</font></td>';
				$salida.='<td><font size="1">'.$des_dep.'</font></td>';
				$salida.='<td><font size="1">'.$empleo.'</font></td>';
				if($renglon == 1){
					$total_nota = $ClsPer->trae_nota_total($id_eva);
					
					if($total_nota <= 59){
						$salida.='<td align="center"><font size="1">INSATISFACTORIO</font></td>';
					}else if($total_nota > 59 and $total_nota <= 69){
						$salida.='<td align="center"><font size="1">REGULAR</font></td>';
					}else if($total_nota > 69 and $total_nota <= 79){
						$salida.='<td align="center"><font size="1">SATISFACTORIO</font></td>';
					}else if($total_nota > 79 and $total_nota <= 89){
						$salida.='<td align="center"><font size="1">SUPERIOR</font></td>';
					}else if($total_nota > 89 and $total_nota <= 100){
						$salida.='<td align="center"><font size="1">EXCELENTE</font></td>';
					}
					$salida.='<td align="center"><font size="1">'.$total_nota.'</font></td>';
				}else if($renglon == 2){
					$salida.='<td align="center"><font size="1">A-9</font></td>';
					$salida.='<td align="center"><font size="1"></font></td>';
				}else if($renglon == 3){
					$salida.='<td align="center"><font size="1">A-10</font></td>';
					$salida.='<td align="center"><font size="1"></font></td>';
				}
				if($situacion == 6 or $situacion == 5 or $situacion == 4){
					$salida.='<td align="center"><font size="1">EN TRAMITE</font></td>';
				}else if($situacion == 7){
					$salida.='<td align="center"><font size="1">APROBADO</font></td>';
				}
				$salida.='</tr>';
			}
			$salida.= "</table>";
			$salida.= '</div>';
			$salida.= '<br>';
		}else{
			$salida = "NO SE REPORTAN DATOS EN LA BASE DE DATOS";
		}
		return $salida;
	}
	
	
	
	
	function tabla_catalogo($catalogo,$comp_eva){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->trae_rep_cat($catalogo,$comp_eva);
		if($result != ""){
			$salida = '<br>';
			$salida.= '<div id = "reportes">';
			$salida.= '<table>';
			$salida.= '<tr>';
			$salida.= '<td width = "50px" align="center"><font size="1"><b>No.</b></font></td>';
			$salida.= '<td width = "160px" align="center"><font size="1"><b>CATALOGO</b></font></td>';
			$salida.= '<td width = "200px" align="left"><font size="1"><b>GRADO</b></font></td>';
			$salida.= '<td width = "400px" align="left"><font size="1"><b>NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "200px" align="left"><font size="1"><b>DEPENDENCIA</b></font></td>';
			$salida.= '<td width = "100px" align="center"><font size="1"><b>EVALUACION</b></font></td>';
			$salida.= '<td width = "100px" align="center"><font size="1"><b>CATEGORIA</b></font></td>';
			$salida.= '<td width = "100px" align="center"><font size="1"><b>NOTA</b></font></td>';
			$salida.= '<td width = "100px" align="center"><font size="1"><b>SITUACION</b></font></td>';
			$salida.= '</tr>';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$catalogo=$row['PER_CATALOGO'];
				$nombre1=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1']); 
				$nombre= utf8_encode($nombre1);
				$gra_desc = trim($row['GRA_DESC_CT']);  
				$grado = $row['GRA_CODIGO'];  
				$arm_desc = trim($row['ARM_DESC_CT']);
				$id_eva = trim($row['EVA_ID']);
				$des_dep = trim($row['DEP_DESC_CT']);
				$periodo = trim($row['EVA_PERIODO']);
				$situacion = trim($row['EVA_SITUACION']);
				$renglon = trim($row['EVA_RENGLON']);
				$salida.= '<tr>';
				$salida.='<td align="center"><font size="1">'.$cont.'</font></td>';
				$salida.="<td align='center'><font size='1'>".$catalogo."</font></td>";
				
				if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
					$salida.="<td><font size='1'>".$gra_desc."</font></td>";
				}else{
					$salida.="<td><font size='1'>".$gra_desc.' '.$arm_desc."</font></td>";
				}
				$salida.='<td><font size="1">'.$nombre.'</font></td>';
				$salida.='<td><font size="1">'.$des_dep.'</font></td>';
				$salida.='<td align="center"><font size="1">'.$periodo.'</font></td>';
				$total_nota = $ClsPer->trae_nota_total($id_eva);
				
				if($renglon == 1){
					if($total_nota <= 59){
						$salida.='<td align="center"><font size="1">INSATISFACTORIO</font></td>';
					}else if($total_nota > 59 and $total_nota <= 69){
						$salida.='<td align="center"><font size="1">REGULAR</font></td>';
					}else if($total_nota > 69 and $total_nota <= 79){
						$salida.='<td align="center"><font size="1">SATISFACTORIO</font></td>';
					}else if($total_nota > 79 and $total_nota <= 89){
						$salida.='<td align="center"><font size="1">SUPERIOR</font></td>';
					}else if($total_nota > 89 and $total_nota <= 100){
						$salida.='<td align="center"><font size="1">EXCELENTE</font></td>';
					}
					$salida.='<td align="center"><font size="1">'.$total_nota.'</font></td>';
				}else if($renglon == 2){
					$salida.='<td align="center"><font size="1">A-9</font></td>';
				}else if($renglon == 3){
					$salida.='<td align="center"><font size="1">A-10</font></td>';
				}
				if($situacion == 1 or $situacion == 6){
					$salida.='<td align="center"><font size="1">Pendiente</font></td>';
				}else if($situacion == 2 or $situacion == 7){
					$salida.='<td align="center"><font size="1">Aprobada</font></td>';
				}
				$salida.='</tr>';
			}
			$salida.= "</table>";
			$salida.= '</div>';
			$salida.= '<br>';
		}else{
			$salida = "NO SE REPORTAN DATOS PARA ESTE CATALOGO";
		}
		return $salida;
	}
	
	
	
	function tabla_dep($dep,$comp_eva,$reporte){
		$ClsPer = new ClsPersonal();
		$result = $ClsPer->trae_rep_dep($dep,$comp_eva,$reporte);
		if($result != ""){
			$salida = '<br>';
			$salida.= '<div id = "reportes">';
			$salida.= '<table>';
			$salida.= '<tr>';
			$salida.= '<td width = "50px" align="center"><font size="1"><b>No.</b></font></td>';
			$salida.= '<td width = "160px" align="center"><font size="1"><b>CATALOGO</b></font></td>';
			$salida.= '<td width = "200px" align="left"><font size="1"><b>GRADO</b></font></td>';
			$salida.= '<td width = "400px" align="left"><font size="1"><b>NOMBRE COMPLETO</b></font></td>';
			$salida.= '<td width = "200px" align="left"><font size="1"><b>DEPENDENCIA</b></font></td>';
			$salida.= '<td width = "100px" align="center"><font size="1"><b>EVALUACION</b></font></td>';
			$salida.= '<td width = "100px" align="center"><font size="1"><b>CATEGORIA</b></font></td>';
			$salida.= '<td width = "100px" align="center"><font size="1"><b>NOTA</b></font></td>';
			$salida.= '<td width = "100px" align="center"><font size="1"><b>SITUACION</b></font></td>';
			$salida.= '</tr>';
			$cont = 0;
			foreach($result as $row){
				$cont++;
				$catalogo=$row['PER_CATALOGO'];
				$nombre1=trim($row['PER_APE1'])." ".trim($row['PER_APE2']).", ".trim($row['PER_NOM1']); 
				$nombre= utf8_encode($nombre1);
				$gra_desc = trim($row['GRA_DESC_CT']);  
				$grado = $row['GRA_CODIGO'];  
				$arm_desc = trim($row['ARM_DESC_CT']);
				$id_eva = trim($row['EVA_ID']);
				$des_dep = trim($row['DEP_DESC_CT']);
				$periodo = trim($row['EVA_PERIODO']);
				$situacion = trim($row['EVA_SITUACION']);
				$renglon = trim($row['EVA_RENGLON']);
				$salida.= '<tr>';
				$salida.='<td align="center"><font size="1">'.$cont.'</font></td>';
				$salida.="<td align='center'><font size='1'>".$catalogo."</font></td>";
				
				if ($grado == 46 || $grado == 59 || $grado == 65 || $grado == 73 || $grado == 81 || $grado == 88 || $grado == 92 || $grado == 93 || $grado == 96 || $grado == 97 || $grado == 99 || $grado == 40){
					$salida.="<td><font size='1'>".$gra_desc."</font></td>";
				}else{
					$salida.="<td><font size='1'>".$gra_desc.' '.$arm_desc."</font></td>";
				}
				$salida.='<td><font size="1">'.$nombre.'</font></td>';
				$salida.='<td><font size="1">'.$des_dep.'</font></td>';
				$salida.='<td align="center"><font size="1">'.$periodo.'</font></td>';
				$ClsPer = new ClsPersonal();
					$nota_total1= $ClsPer->trae_nota_total1($id_eva);
					$nota_total1p = $nota_total1 * 0.10;
					//echo ($nota_total1p);
					//echo '<br>';
					$nota_total2= $ClsPer->trae_nota_total2($id_eva);
					$nota_total2p=$nota_total2*0.45;
					//echo ($nota_total2p);
					//echo '<br>';
					$nota_total3= $ClsPer->trae_nota_total3($id_eva);
					$nota_total3p=$nota_total3*0.45;
					//echo ($nota_total3p);
					//echo '<br>';
					$nota_total4= $ClsPer->trae_nota_total5($id_eva);
					$nota_total4p=$nota_total4*0.30;

					$nota_total5= $ClsPer->trae_nota_total6($id_eva);
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
					}
					$salida.='<td align="center"><font size="1">'.round($suma_total).'</font></td>';
				}else if($renglon == 2){
					$salida.='<td align="center"><font size="1">A-9</font></td>';
					$salida.='<td align="center"><font size="1"></font></td>';
				}else if($renglon == 3){
					$salida.='<td align="center"><font size="1">A-10</font></td>';
					$salida.='<td align="center"><font size="1"></font></td>';
				}
				if($situacion == 4 or $situacion == 8 or $situacion == 13 or $situacion == 19 or $situacion == 22 or $situacion == 27){
					$salida.='<td align="center"><font size="1">PENDIENTE</font></td>';
				}elseif($situacion == 28 or $situacion == 29 or $situacion == 30 or $situacion == 32 or $situacion == 33){
					$salida.='<td align="center"><font size="1">APROBADO</font></td>';
				}elseif($situacion == 34){
					//$salida.= "<td align = 'center'><center><a href = '../CP_REP/REP_eva2.php?eva=".$eva_id."' onclick = '' target='_blank' type = 'button' class='btn btn-success' title = 'Generar reporte final'><i class='icon-file'></i></a></center></td>";
					$salida.='<td align="center"><font size="1">IMPUGNADO</font></td>';
				}

				$salida.='</tr>';
			}
			$salida.= "</table>";
			$salida.= '</div>';
			$salida.= '<br>';
		}else{
			$salida = "NO SE REPORTAN DATOS PARA ESTA DEPENDENCIA";
		}
		return $salida;
	}
	
	
 ?>