<?php
	include_once('xajax_ul.php');
	include_once ('../html_fns.php');
	include_once ('html_fns_ul.php');
	$catalogo = $_REQUEST['catalogo'];
	session_start();
	$usuario = $_SESSION['auth_user'];
	$plaza1 = $_SESSION['org_plaza'];
	$desc_dependencia1 = $_SESSION['dep_desc'];
	$dependencia = $_SESSION['dep_cod'];
	//$dependencia = 2630;
	$desc_dependencia = utf8_encode($desc_dependencia1);
	
		include_once('../fecha.php');
?>
<!--==============================================================================================================================================
=========================================================INICIA EL HTML===========================================================================
==================================================================================================================================================-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Evaluacion del des. 2</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<?php
		$xajax->printJavascript("..");
		?>
		<?php
		date_default_timezone_set('America/Guatemala');
		$fecha = date("Y-m-d");
		?>
		<!--=============================LIBRERIAS DE BOOTSTRAP======================================-->
		<link href='../assets/css/bootstrap.css' rel='stylesheet'/>
		<link href='../assets/css/bootstrap-responsive.css' rel='stylesheet'/>
		<link href="../assets/css/docs.css" rel="stylesheet">
		<link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
		<script>
		function redirecciona(){
			window.location.assign("../CP_UL1/Frm_ul.php");
		}
		</script>
	</head>
<!--==============================================================================================================================================
=========================================================INICIA EL BODY===========================================================================
==================================================================================================================================================-->
	<body>
		<div class='modal hide fade' id='alert_modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'></div>
		<!-- ============================================PERMISOS PARA EL ADMINISTRADOR ====================================================-->
	
	<?php include_once('../menu_iclude.php'); ?>

		<div id="container" align='center'>
			<div class='row-fluid'>
				<div class = 'span12' align='center'>
					<font size=5><b>Procesos de Evaluaciones</font><br> <font size=3>Oficiales del Comando</font> <br><br> PERIODO: <?php echo $comp_eva; ?></b></font>
				</div>
			</div><br><br>
<!--==============================================================================================================================================
=======================================================MUESTRA LA FOTO DEL OFICIAL======================================================================
==================================================================================================================================================-->
			</table><br><br>
			<div class="container">
				<form id = "entrega" name = "entrega" method='POST'>
				<input type='hidden' name='fecha' id='fecha' value='<?php echo $fecha; ?>'></input>
<!--=============================================================================================================================================
===========================MUESTRA LA TABLA DE LA DOTACIONES SOLICITADAS AL OFICIAL==========================================================
=================================================================================================================================================-->
					<?php 
					echo tabla_inmediato3($dependencia,$comp_eva); 
					?>
				</form><br><br>
			</div>
		</div>
		<!--====================LIBRERIAS DE BOOTSTRAP PARA QUE NOS DESPLIEGUE CALENDARIO===================-->
		<script type="text/javascript">
			$('.form_datetime').datetimepicker({
				weekStart: 1,
				todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				forceParse: 0,
				showMeridian: 1
			});
			$('.form_date').datetimepicker({
				language:  'fr',
				weekStart: 1,
				todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				minView: 2,
				forceParse: 0
			});
			$('.form_time').datetimepicker({
				language:  'fr',
				weekStart: 1,
				todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 1,
				minView: 0,
				maxView: 1,
				forceParse: 0
			});
		</script>
		<!--===se dejan de ultimo para que el documento cargue mas rapido=====================-->
		<script type="text/javascript" src="../assets/js/widgets.js"></script>
		<script src="../assets/js/jquery.js"></script>
		<script src="../assets/js/bootstrap-transition.js"></script>
		<script src="../assets/js/bootstrap-alert.js"></script>
		<script src="../assets/js/bootstrap-modal.js"></script>
		<script src="../assets/js/bootstrap-dropdown.js"></script>
		<script src="../assets/js/bootstrap-scrollspy.js"></script>
		<script src="../assets/js/bootstrap-tab.js"></script>
		<script src="../assets/js/bootstrap-tooltip.js"></script>
		<script src="../assets/js/bootstrap-popover.js"></script>
		<script src="../assets/js/bootstrap-button.js"></script>
		<script src="../assets/js/bootstrap-collapse.js"></script>
		<script src="../assets/js/bootstrap-carousel.js"></script>
		<script src="../assets/js/bootstrap-typeahead.js"></script>
		<script src="../assets/js/bootstrap-affix.js"></script>

		<script src="../assets/js/holder/holder.js"></script>
		<script src="../assets/js/google-code-prettify/prettify.js"></script>

		<script src="../assets/js/application.js"></script>
		<script>
		$(document).ready(function() {
			$('#dataTables-example').dataTable();
		});
		</script>
	</body>
</html>