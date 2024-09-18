<?php
session_start();
date_default_timezone_set('America/Guatemala');


include_once('html_fns_rep.php');
include_once('xajax_fns_rep.php');

// Obtener datos de la sesión




?>

		<?php
			ini_set('memory_limit', '90000M');
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="LISTADO DE EVALUACIONES.xls"');
			header('Cache-Control: max-age=0');
		?>
	
	<?php 
	$contenido = excel_fi_aprobados($dep, $periodo, $usuario);

    // Imprimir el contenido
    echo $contenido;
	
		
	?>

