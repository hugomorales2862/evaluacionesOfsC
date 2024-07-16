<?php
include_once("html_fns.php");

	function en_tramite(){
		$ClsInm= new ClsInmuebles();
		$result = $ClsInm->get_tramite();
		// echo $result;
		if(is_array($result)){  //aqui miramos si nos trae datos el resultsdo
			foreach($result as $row){
				$total=$row['TOTAL'];
				// $pendientes=25;
				if($total>0){
					$salida.="<a href='CP_RECOMENDAR/Frm_recomendar.php'><span class='badge badge-info pull-right'>".$total."</span>Incidencias &nbsp </a>";
					}else{
					$salida.="<a href='CP_RECOMENDAR/Frm_recomendar.php'><span class='badge badge-info pull-right'>".$total."</span>Incidencias &nbsp </a>";
				}
			}
		}
		return $salida;
	}
	
?>