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
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<?php
		$xajax->printJavascript("..");
		?>
		<!--=============================LIBRERIAS DE BOOTSTRAP======================================-->
		<link href='../assets/css/bootstrap.css' rel='stylesheet'/>
		<link href='../assets/css/bootstrap-responsive.css' rel='stylesheet'/>
		<link href="../assets/css/docs.css" rel="stylesheet">
		<link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
		<script>
		function Buscar(){
			var catalogo = document.getElementById('catalogo').value;
			var dep = document.getElementById('dep').value;
			var periodo = document.getElementById('periodo').value;
			// alert(dep);
				if(periodo != ""){
					xajax_Buscar_aprobar(catalogo, dep, periodo);
				}else{
					alert("Es obligatorio seleccionar el periodo a evaluar");
				}
		}
		
		function enviar_solicitud(tipo){
		form = document.getElementById("f1")
		// alert(tipo);
			if (tipo == 1){
				form.action = "../CP_REP/REP_fin_cjd.php";
			}else{
				form.action = "FrmBusca_rep.php";
			}
				form.submit();
		}
		
		function justNumbers(e){
			var keynum = window.event ? window.event.keyCode : e.which;
			if ((keynum == 8) || (keynum == 46))
			return true;
			return /\d/.test(String.fromCharCode(keynum));
		}
		
		
		function CloseWindow(){
			window.location.assign("../CP_REPORTEADOR/Frm_ap.php");
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
			<form name='f1' id='f1'  method='post'>
			<!--===============================INICIA EL FIELDSET======================================-->
				<fieldset style='background:#FAFAFA'>
					<legend align='left'> <h3>Aprobar evaluaciones</h3></legend>
	<!--====================================================================================================================================================-->
	<!--======================================TABLA DE CALENDARIOS Y BUSQUEDA POR DEPENDENCIA===============================================================-->
	<!--====================================================================================================================================================-->
					<div class="row-fluid">
						<div class='span3'>
						</div>
						<div class='span2' align='left'>
						<b>CATALOGO:</b>
						</div>
						<div class='span2'>
							<input type='text' name='catalogo' maxlength='6' id='catalogo' value='' class="span12" placeholder='No. catologo' onkeypress='return justNumbers(event);'></input>
						</div>
					</div>
					<div class='row-fluid'>
						<div class='span3'>
						</div>
						<div class='span2' align='left'>
						<b>DEPENDENCIA:</b>
						</div>
	<!--==================================================================================================================================================-->
	<!--====================================COMBO QUE CARGA LAS DEPENDENCIA===============================================================================-->
						<div class='span4'>
							<?php echo Carga_dependencias_form(); ?>
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
	<!--====================================================================================================================================================-->
	<!--===================================BOTONES PARA LIMPIAR Y BUSCAR SEGUN LAS FECHAS Y LA DEPENDENCIA-=================================================-->
	<!--====================================================================================================================================================-->
					<div class='row-fluid'>
						<div class='span5'>
						</div>
						<div class='span1'>
						<input type = "reset" class="btn btn-danger" value = "Limpiar" id = "slimpiar" onclick = "Soc_Limpiar()" class='span12'/>
						</div>
						<div class='span1'>
							<input class="btn btn-primary" type="button" title="Buscar" value="Buscar" onclick="Buscar();" />
						</div>
						<div class='span3'>
						</div>
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