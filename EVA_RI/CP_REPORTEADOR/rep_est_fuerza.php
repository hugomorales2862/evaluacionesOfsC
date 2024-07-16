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
			
			var grad = document.getElementById('grad').value;
			var depi = document.getElementById('depi').value;
			var sexo = document.getElementById('sexo').value;
			var clase = document.getElementById('clase').value;
				
			 xajax_est_fuerza(grad,depi,sexo,clase);
		}

		function Buscar1(){
			 xajax_tot_est();
		}

		function buscainfo(){
			 xajax_buscar_info();
		}

		function Soc_Limpiar(){
			location.reload();
		}
		function imprSelec(historial){
  var ficha=document.getElementById(historial);
  var ventimp=window.open(' ','popimpr');
  ventimp.document.write(ficha.innerHTML);
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
}
		</script>
	</head>
<!--==============================================================================================================================================
=========================================================INICIA EL BODY===========================================================================
==================================================================================================================================================-->
	<body>
		<div class='modal hide fade' id='alert_modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'></div>
		<!-- ============================================PERMISOS PARA EL ADMINISTRADOR ====================================================-->
	<div align='center' class='container'>
			<!--===============================INICIA EL FORM======================================-->
		<form name='f1' id='f1'  method='post'>
			<input type='hidden' name='dep' id='dep' value='<?php echo $dependencia; ?>'></input>
			<!--===============================INICIA EL FIELDSET======================================-->
				<fieldset style='background:#FAFAFA'>
					<legend align='left'> <h3>Reporte Estado de Fuerza</h3></legend>
	<!--====================================================================================================================================================-->
	<!--======================================TABLA DE CALENDARIOS Y BUSQUEDA POR DEPENDENCIA===============================================================-->
	<!--====================================================================================================================================================-->
				<div class='row-fluid' >
						<div class='span4'>
							<b>DEPENDENCIA:</b><br>
						
							<?php echo carga_dep(); ?>
						</div>
						<div class='span4' >
						<b>GRADO:</b><br>
						
							<?php echo carga_grados(); ?>
						</div>
						<div class='span2'>
							<b>SEXO:</b><br>
						
								<select id= "sexo" name="sexo" class="span12">
								  <option value="A">--AMBOS----</option>
								  <option value="M">MASCULINO</option>
								  <option value="F">FEMENINO</option>
								</select>
						</div>
						<div class='span2'>
							<b>CLASE:</b><br>
						
								<select id= "clase" name="clase" class="span12">
								  <option value="0">--TODOS----</option>
								  <option value="1">CARRERA</option>
								  <option value="2">RESERVA</option>
								  <option value="3">ASIMILADOS</option>
								  <option value="4">ESPECIALISTAS</option>
								  <option value="6">TROPA</option>
								</select>
						</div>
				<div>
	<!--====================================================================================================================================================-->
	<!--===================================BOTONES PARA LIMPIAR Y BUSCAR SEGUN LAS FECHAS Y LA DEPENDENCIA-=================================================-->
	<!--====================================================================================================================================================-->
					<div class='row-fluid'>
						
						<div class='span3'>
						</div>
						<div class='span1'>
							<input class="btn btn-primary" type="button" title="Res./Al" value="Res./Al" onclick="buscainfo();" />
						</div>
						<div class='span1'>
							<input class="btn btn-primary" type="button" title="totales" value="Totales" onclick="Buscar1();" class='span12'/>
						</div>
						<div class='span1'>
						<input type = "reset" class="btn btn-danger" value = "Limpiar" id = "slimpiar" onclick = "Soc_Limpiar()" class='span12'/>
						</div>
						<div class='span1'>
							<input class="btn btn-primary" type="button" title="Buscar" value="Buscar" onclick="Buscar();" />
						</div>
						<div class='span1'>
							<a href="../../EstadoFuerza/index3.php"><input class="btn btn-warning" type="button" title="Regresar" value="Regresar"/></a>
						</div>
						<div class='span1'>
							<a href="javascript:imprSelec('resul')"><input class="btn btn-success" type="button" title="IMPRIMIR" value="Imprimir"/></a>
						</div>
						<div class='span3'>
						</div>
						<!--<div class='span1'>
							<input type = "button" class="btn btn-success" value = "Ver proceso" id = "sbuscar" onclick = "enviar_solicitud(1);" class='span12'/>
						</div>-->
					</div>
					<br><br>
					<div id='resul'>
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