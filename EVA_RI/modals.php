<?php function html_alert_entregado($valor){
		if($valor == 4){
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h4 id='myModalLabel'><center>MENSAJE</center></h4>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>AUTOEVALUACION INGRESADA SATISFACTORIAMENTE</p>";
			
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(1);'>OK</button>";
			$salida.=		"</div>";
		}else{
			$salida.=		"<div class='modal-header'>";
			$salida.=		"<h3 id='myModalLabel'>Alerta</h3>";
			$salida.=		"</div>";
			//modal body//
			$salida.=		"<div class='modal-body'>";
			$salida.=			"<p class='text-left'>BORRADOR INGRESADO SATISFACTORIAMENTE</p>";
			$salida.=			"<center><img src='../img/borrador.png' alt=""></center>";
			$salida.=		"</div>";
			//modal footer//
			$salida.=		"<div class='modal-footer'>";
			$salida.=		"<button class='btn btn-primary' onclick='CloseWindow(1);'>OK</button>";
			$salida.=		"</div>";
			
		}
			
		return $salida;

	} ?>
