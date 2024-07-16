<?php
	include_once('xajax_inmediato.php');
	include_once ('../html_fns.php');
	include_once ('html_fns_inmediato.php');
	$catalogo = $_REQUEST['catalogo'];
	session_start();
	$usuario = $_SESSION['auth_user'];
	$plaza1 = $_SESSION['org_plaza'];
	$desc_dependencia1 = $_SESSION['dep_desc'];
	$dependencia = $_SESSION['dep_cod'];
	$desc_dependencia = utf8_encode($desc_dependencia1);
	
		date_default_timezone_set('America/Guatemala');
		$dias= date("d");
		$mes= date("m");
		$annio = date("Y");
		$siguiente = $annio + 1;
		if ($mes == 6 or $mes == 7 or $mes == 8){
			$evaluacion = 1;
			$comp_eva = '1 - '.$annio;
		}else if($mes == 12){
			$evaluacion = 2;
			$comp_eva = '2 - '.$annio;
		}
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
		function CloseWindow(){
			window.location.assign("Frm_inmediato.php");
		}
		</script>
	</head>
<!--==============================================================================================================================================
=========================================================INICIA EL BODY===========================================================================
==================================================================================================================================================-->
	<body>
	<div class='modal hide fade' id='alert_modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'></div>
		<!-- ============================================PERMISOS PARA EL ADMINISTRADOR ====================================================-->
	<div class="container">
		<div class="navbar">
			<h3><p class="lead text-success"><?php echo $desc_dependencia; ?></p></h3>
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="../index.php">CCI</a>
					<div class="nav-collapse collapse navbar-responsive-collapse">
						<ul class="nav">
							<li><a href="../index.php">Inicio</a></li>
							<li class="divider-vertical"></li>
							<?php if($_SESSION['EVADESCOM'] == 1 and $dependencia <> 2010) {?>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluar <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_EVALUACION/FrmBusca_catalogo.php">Generar borrador</a></li>
										<li><a href="../CP_EVALUACION/Frm_auto.php">Calificar</a></li>
										<li><a href="../CP_UL/Frm_ul.php">Evaluaciones finalizadas</a></li>
									</ul>
								</li>	
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">2dos. y Comtes.  <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_S/FrmBusca_catalogo.php">Generar borrador</a></li>
										<li><a href="../CP_S/Frm_auto.php">Calificar</a></li>
										<li><a href="../CP_ULS/Frm_ul.php">Evaluaciones finalizadas</a></li>
									</ul>
								</li>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Comtes. Jefes y Dir. <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_EVALUACION1/FrmBusca_catalogo.php">Generar borrador</a></li>
										<li><a href="../CP_EVALUACION1/Frm_auto.php">Mi evaluacion</a></li>
										<?php if($_SESSION['EVASUB'] == 1) {?>
											<li><a href="../CP_INMEDIATO1/Frm_inmediato.php">Evalua SubJefe EMDN</a></li>
										<?php } if($_SESSION['EVAJEFE'] == 1) {?>
											<li><a href="../CP_FINAL1/Frm_final.php">Evalua Jefe EMDN</a></li>
										<?php }?>
										<li><a href="../CP_UL1/Frm_ul.php">Evaluaciones finalizadas</a></li>
									</ul>
								</li>
							</ul>
							<ul class="nav pull-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_EVALUACION/Frm_faltan.php" target='_blank'>Pendientes de efectuar evaluacion</a></li>
										<li><a href="../CP_REPORTEADOR/FrmBusca_rep.php">Reporte individual por periodo</a></li>
										<li><a href="../CP_REPORTEADOR/FrmBusca_rep2.php">Por catalogo</a></li>
									</ul>
								</li>
								<li class="divider-vertical"></li>
							<?php }else if($_SESSION['EVADESCOM'] == 1 and $dependencia == 2010) {?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluar <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION/FrmBusca_catalogo.php">Generar borrador</a></li>
									<li><a href="../CP_EVALUACION/Frm_auto.php">Calificar</a></li>
									<li><a href="../CP_UL/Frm_ul.php">Evaluaciones finalizadas</a></li>
								</ul>
							</li>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dir. Min. <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_DIR/FrmBusca_catalogo.php">Generar borrador</a></li>
									<li><a href="../CP_DIR/Frm_auto.php">Calificar</a></li>
									<li><a href="../CP_DIR/Frm_ul.php">Evaluaciones finalizadas</a></li>
								</ul>
							</li>
						</ul>
						<ul class="nav pull-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION/Frm_faltan.php" target='_blank'>Pendientes de efectuar evaluacion</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep.php">Reporte individual por periodo</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep2.php">Por catalogo</a></li>
								</ul>
							</li>
							<?php }else if($_SESSION['EVADESD1'] == 1) {?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluar <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION/FrmBusca_catalogo.php">Generar borrador</a></li>
									<li><a href="../CP_EVALUACION/Frm_auto.php">Calificar</a></li>
									<li><a href="../CP_UL/Frm_ul.php">Evaluaciones finalizadas</a></li>
								</ul>
							</li>	
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">2dos. y Comtes.  <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_S/FrmBusca_catalogo.php">Generar borrador</a></li>
									<li><a href="../CP_S/Frm_auto.php">Calificar</a></li>
									<li><a href="../CP_ULS/Frm_ul.php">Evaluaciones finalizadas</a></li>
								</ul>
							</li>	
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Comtes. Jefes y Dir. <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogo.php">Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_auto.php">Mi evaluacion</a></li>
									<?php if($_SESSION['EVASUB'] == 1) {?>
										<li><a href="../CP_INMEDIATO1/Frm_inmediato.php">Evalua SubJefe EMDN</a></li>
									<?php } if($_SESSION['EVAJEFE'] == 1) {?>
										<li><a href="../CP_FINAL1/Frm_final.php">Evalua Jefe EMDN</a></li>
									<?php }?>
									<li><a href="../CP_UL1/Frm_ul.php">Evaluaciones finalizadas</a></li>
								</ul>
							</li>
							<li class="divider-vertical"></li>
							<li><a href="../CP_REPORTEADOR/Frm_ap.php">Aprobar</a></li>
							<li class="divider-vertical"></li>
						</ul>
						<ul class="nav pull-right">
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes EMDN<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION/Frm_faltan.php" target='_blank'>Pendientes de efectuar evaluacion</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep.php">Reporte individual por periodo</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep1.php">Reporte individual por periodo Comtes. Jefes y Dir.</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep2.php">Por catalogo</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_dep.php">Por dependencias</a></li>
								</ul>
							</li>
							<?php }?>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Ayuda <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#" target="_blank">Directiva</a></li>
									<li><a href="#" target="_blank">Manual de usuario</a></li>
								</ul>
							</li>
							<li class="divider-vertical"></li>
							<li><a href="../../MENU/menu.php">Salir</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
		<div id="container" align='center'>
			<div class='row-fluid'>
				<div class = 'span12' align='center'>
					<font size=5><b>Evalua jefe inmediato <br> Periodo <?php echo $comp_eva; ?></b></font>
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
					echo tabla_inmediato(1,$dependencia,$comp_eva); 
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