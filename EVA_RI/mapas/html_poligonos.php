<?php
date_default_timezone_set('America/Guatemala');
include_once("../html_fns.php");

//===============================================REPORTE_MISION.PHP========================================================================
//==============================================FORM_REPORTE_MISION.PHP======================================================================
//============================================================================================================================================

function form_reporte_mision($dep){
		$salida.="	<form name='Form1' id='Form1' method='POST'>";
		$salida.="	<div class='row-fluid'>";
		$salida.="		<div class='row-fluid span6'>";
		$salida.="	<div class='row-fluid'>";
		$salida.="		<div>Busqueda por numero de poligono</div>";
		$salida.="	</div>";
		$salida.="	<div class='row-fluid gris_1'>";
		$salida.="		<div>No. de Poligono</div>";
		$salida.="	</div>";
		$salida.="	<div class='row-fluid gris_2 text-center'>";
		//==============================NUMERO DE POLIGONO==================================-->
		$salida.="		<div class='span5'><input type='text' id='poligono' name='poligono' value=''></div>";
		$salida.="		<div class='span1'></div>";
		$salida.="	</div>";
		//==============================BOTON DE BUSQUEDA==================================-->
		$salida.="	<div class='row-fluid'>";
		$salida.="		<div align='center'><input type='button' class='btn btn-primary' value='Buscar' onclick='buscar_poligonos();'/></div>";
		$salida.="	</div>";
		$salida.="	<div class='row-fluid' id='div_mision_tf'></div>";
		$salida.="	</div>";
		$salida.="	<div class='row-fluid span6'>";
		$salida.="		<div class='row-fluid'>";
		$salida.="			<div>Mapa</div>";
		$salida.="		</div>";
		$salida.="		<div class='row-fluid'>";
		$salida.="			<div class='span12' id='map'></div>";
		$salida.="		</div>";
		$salida.="	</div>";
		$salida.="	</div>";
		$salida.="		<div id='div_mapa'></div>";
		$salida.="		<div id='div_mapa1'></div>";
		$salida.="	</form>";
		$salida.="	<div id='alert1' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
		$salida.="	</div>";
		$salida.="	<div id='alert2' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
		$salida.="	</div>";
		$salida.="	<div id='alert3' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
		$salida.="	</div>";
return $salida;
}

function html_trae_poligono($poligono){
	// $salida = "$poligono";
	
	
	$clase	= new cls_poligono();
	$result = $clase->obtener_poligono($poligono);	
	

		$salida = "<div>";	
			$salida.= "<form id = 'f1' name = 'f1'>";	
			$salida.= "<table align = 'center'>";		
				$cont = 1;
				foreach ($result as $row) {
					$salida.="<tr>";
						$codigo_inmueble 	= $row['COD_INMUEBLE'];
						$latitud			= $row['LATITUD'];
						$longitud			= $row['LONGITUD'];
						$situacion 			= $row['SITUACION'];
						
						// $salida.="<td>$cont</input></td>";
						$salida.="<td><input type = 'text' name = 'inmueble$cont' id = 'inmueble$cont' value = '$codigo_inmueble'></input></td>";
						$salida.="<td><input type = 'text' name = 'latitud$cont' id = 'latitud$cont' value = '$latitud'></input></td>";
						$salida.="<td><input type = 'text' name = 'longitud$cont' id = 'longitud$cont' value = '$longitud'></input></td>";
						$salida.="<td><input type = 'text' name = 'situacion$cont' id = 'situacion$cont' value = '$situacion'></input></td>";
					$salida.="</tr>";  
					$cont++;
				}
					$salida.="<tr>";
					$salida.="<td align = 'center'><input type = 'text' name = 'total' id = 'total' value = '$cont'></input></td>";
					$salida.="</tr>";
			$salida.= '</table>';
		$salida.= '</form>';	
		$salida.= '</div>';		
	return $salida;
}

function Pinta_coo($puntos){
	// $salida = "$puntos";
		$salida.="<td><input type = 'hidden' name = 'coo' id = 'coo' value = '$puntos'></input></td>";	
	return $salida;
}


//===========================================REPORTE_MISION.PHP========================================================================
//==============================================ALERTAS========================================================================
//============================================================================================================================================

function tabla_reporte_mision_alert($valor){
	if($valor==1){
		//modal header//
		$salida.=	"<div class='modal-header'>";
		$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
		$salida.=	"</div>";
		//modal body//
		$salida.=	"<div class='modal-body'>";
		$salida.=		"<p class='text-left'>Seleccione criterios de Busqueda, click en OK para Buscar...</p>";
		$salida.=	"</div>";
		//modal footer//
		$salida.=	"<div class='modal-footer'>";
		$salida.=	"<button class='btn btn-primary' data-dismiss='modal' aria-hidden='true'>OK</button>";
		//$salida.=	"<button class='btn btn-primary' onclick='iniciar();'>OK</button>";
		$salida.=	"</div>";
	}elseif($valor==2){
		//modal header//
		$salida.=	"<div class='modal-header'>";
		$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
		$salida.=	"</div>";
		//modal body//
		$salida.=	"<div class='modal-body'>";
		$salida.=		"<p class='text-left'>No se encontraron criterios de busqueda, click en OK para intentar de nuevo...</p>";
		$salida.=	"</div>";
		//modal footer//
		$salida.=	"<div class='modal-footer'>";
		$salida.=	"<button class='btn btn-primary' data-dismiss='modal' aria-hidden='true'>OK</button>";
		//$salida.=	"<button class='btn btn-primary' onclick='iniciar();'>OK</button>";
		$salida.=	"</div>";
	}elseif($valor==3){
		//modal header//
		$salida.=	"<div class='modal-header'>";
		$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
		$salida.=	"</div>";
		//modal body//
		$salida.=	"<div class='modal-body'>";
		$salida.=		"<p class='text-left'>Coordenadas encontradas Satisfactoriamente, click en OK para continuar...</p>";
		$salida.=	"</div>";
		//modal footer//
		$salida.=	"<div class='modal-footer'>";
		$salida.=	"<button class='btn btn-primary' data-dismiss='modal' aria-hidden='true'>OK</button>";
		//$salida.=	"<button class='btn btn-primary' onclick='iniciar();'>OK</button>";
		$salida.=	"</div>";
	}

return $salida;
}
?>