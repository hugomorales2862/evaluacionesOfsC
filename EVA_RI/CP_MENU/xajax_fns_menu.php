<?php
include_once('html_fns_menu.php');
require ('xajax_core/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('ISO-8859-1');  // debe llevar esta linea de codigo para 
$xajax->configure('decodeUTF8Input',true);  // para corregir 

	
	// $xajax->register(XAJAX_FUNCTION, "Carga_Pendientes");
	// $xajax->register(XAJAX_FUNCTION, "Carga_Tramite");
//El objeto xajax tiene que procesar cualquier petici??	
	$xajax->processRequest();
	
?>