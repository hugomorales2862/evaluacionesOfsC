<?php
include_once('xajax_fns_rep.php');
include_once('../html_fns.php');
session_start();
$usuario = $_SESSION['auth_user'];
$plaza1 = $_SESSION['org_plaza'];
$dependencia = $_SESSION['dep_cod'];
$desc_dependencia1 = $_SESSION['dep_desc'];
$desc_dependencia = utf8_encode($desc_dependencia1);
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
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<?php
	$xajax->printJavascript("..");
	?>
	
	<!--=============================LIBRERIAS DE BOOTSTRAP======================================-->
	<link href='../assets/css/bootstrap.css' rel='stylesheet' />
	<link href='../assets/css/bootstrap-responsive.css' rel='stylesheet' />
	<link href="../assets/css/docs.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<script>
		function Buscar() {
			var dep = document.getElementById('dep').value;
			var periodo = document.getElementById('periodo').value;
			var usuario = document.getElementById('usuario').value;



			if (periodo != "") {
				xajax_Buscar_Vacios(dep, periodo, usuario);
			} else {
				alert("DEBE SELECCIONAR EL PERIODO");
			}
		}

		function Buscar2() {
			var dep = document.getElementById('dep').value;
			var periodo = document.getElementById('periodo').value;
			var usuario = document.getElementById('usuario').value;



			if (periodo != "") {
				xajax_Buscar_Vacios2(dep, periodo, usuario);
			} else {
				alert("DEBE SELECCIONAR EL PERIODO");
			}
		}


		function enviar_solicitud(tipo) {
			form = document.getElementById("f1")
			// alert(tipo);
			if (tipo == 1) {
				form.action = "../CP_REP/REP_finalizados.php";
			} else {
				form.action = "FrmBusca_rep.php";
			}
			form.submit();
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
	<div align='center' class='container'>
		<!--===============================INICIA EL FORM======================================-->
		<form name='f1' id='f1' method='post'>
			<input type='hidden' name='dep' id='dep' value='<?php echo $dependencia; ?>'></input>
			<!--===============================INICIA EL FIELDSET======================================-->
			<fieldset style='background:#FAFAFA'>
				<legend align='left'>
					<h3>Reporte final de Of. evaluados por periodos</h3>
				</legend>
				<!--====================================================================================================================================================-->
				<!--======================================TABLA DE CALENDARIOS Y BUSQUEDA POR DEPENDENCIA===============================================================-->
				<!--====================================================================================================================================================-->
				<div class='row-fluid'>
					<div class='span12'>
					</div>
				</div>
				<div class='row-fluid'>
					<div class='span3'>
					</div>
					<div class='span2' align='left'>
						<b>PERIODO:</b>
					</div>
					<!--==================================================================================================================================================-->
					<!--====================================COMBO QUE CARGA LAS DEPENDENCIA===============================================================================-->
					<div class='span2'>
						<?php echo combo_periodo(); ?>
					</div>


				</div><br>


				<div class='row-fluid'>
					<div class='span3'>
					</div>

					<div class='span2' align='left'>
						<b>CATALOGO DE LA PERSONA QUE APROBO:</b>
					</div>
					<div class='span2'>
						<input type="number" placeholder=" Catalogo" id="usuario" class="span12">
					</div>

				</div>
				<!--====================================================================================================================================================-->
				<!--===================================BOTONES PARA LIMPIAR Y BUSCAR SEGUN LAS FECHAS Y LA DEPENDENCIA-=================================================-->
				<!--====================================================================================================================================================-->
				<div class='row-fluid'>
					<div class='span5'>
					</div>
					<div class='span1'>
						<input type="reset" class="btn btn-danger" value="Limpiar" id="slimpiar" onclick="Soc_Limpiar()" class='span12' />
					</div>
					<div class='span1'>
						<input class="btn btn-primary" type="button" title="Buscar" value="Buscar" onclick="Buscar();" />
					</div>

					<div class='span1'>

						<a href="aprobados.php" class="btn btn-success" id="btnDescargarExcel" style="display: none;">Excel</a>

					</div>
					<div class='span3'>
					</div>
					<!--<div class='span1'>
							<input type = "button" class="btn btn-success" value = "Ver proceso" id = "sbuscar" onclick = "enviar_solicitud(1);" class='span12'/>
						</div>-->
				</div>
				<br><br>
				<div id='resultado'>
				</div>
			</fieldset>
		</form>
	</div>
	<!--====================LIBRERIAS DE BOOTSTRAP PARA QUE NOS DESPLIEGUE CALENDARIO===================-->
	<script type="text/javascript">
		$('.form_datetime').datetimepicker({
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 1
		});
		$('.form_date').datetimepicker({
			language: 'fr',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
		});
		$('.form_time').datetimepicker({
			language: 'fr',
			weekStart: 1,
			todayBtn: 1,
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
	<script src="../assets/js/bootstrap-affix.js"></script>\


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