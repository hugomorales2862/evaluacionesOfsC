<?php
include_once('html_fns.php');
include_once("CP_MENU/xajax_fns_menu.php");
	session_start();
	$dependencia1 = $_SESSION['dep_cod']; 
	$usuario = $_SESSION['auth_user'];
	$plaza1 = $_SESSION['org_plaza'];
	$dep_desc = $_SESSION['dep_desc'];
	
	$ClsPer = new ClsPersonal();
	$result = $ClsPer->get_personal_usuario($usuario);
	foreach ($result as $row){
		$nom1 = $row['PER_NOM1'];
		$nom2 = $row['PER_NOM2'];
		$ape1 = $row['PER_APE1'];
		$ape2 = $row['PER_APE2'];
		$grado = $row['GRA_DESC_LG'];
		$arma = $row['ARM_DESC_LG'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Evaluacion del desempeño</title>
		<link rel="shortcut icon" href="img/medallon.png" >
		<!--=============================LIBRERIAS DE BOOTSTRAP======================================-->
		<link href='assets/css/bootstrap.css' rel='stylesheet'/>
		<link href='assets/css/bootstrap-responsive.css' rel='stylesheet'/>
		<link href="assets/css/docs.css" rel="stylesheet">
		<link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
		<style>
		#bg{
			position: center;
			z-index: -1;
			middle: 70;
			center: 40;
			width: 20%;
		
		}
		</style>
	</head>
	<body>
	<div class="container">
		<div class="navbar">
			<h3><p class="lead text-success"><?php echo $dep_desc; ?></p></h3>
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="index.php">CCI</a>
					<div class="nav-collapse collapse navbar-responsive-collapse">
						<ul class="nav">
							<li><a href="index.php">Inicio</a></li>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluacion <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="CP_EVALUACION/Frm_my.php">Mi evaluacion</a></li>
									<li><a href="CP_MODIFICAR/Frm_modificar.php">Evaluacion Intermedia</a></li>
									<li><a href="CP_INCIDENCIAS/Frm_incidencia.php">Evaluacion final</a></li>
								</ul>
							</li>							
							<li class="divider-vertical"></li>
							<li><a href="../MENU/menu.php">Salir</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class='container' align='center'><br>
		<img src='assets/img/fondo.png' alt='F' id='bg'/>
	</div>
	<br>
	<div class='container'>
		<div class="text-center">
			<h3>BIENVENIDO</h3>
			<br>
			<br>
			<p class="lead text-info">
			<?php 
				if($_SESSION['arma'] != "SIN ARMA"){
					echo $_SESSION['grado'].' DE '.$_SESSION['arma'].' '.$_SESSION['nombre'];
				}else{
					echo $_SESSION['grado'].' '.$_SESSION['nombre'];
				}		
			?>
			</p>
			<p class="lead text-success">
				EVALUACION DEL DESEMPE&Ntilde;O
			</p>
		</div>
		<br>
		<br>
		<div class="footer">
			<p>CCI &copy; Development Team 2015</p>
		</div>
	</div>
	<!--====================LIBRERIAS DE BOOTSTRAP PARA QUE NOS DESPLIEGUE CALENDARIO===================-->
		<script type="text/javascript">
			$('.form_datetime').datetimepicker({
				//language:  'fr',
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
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/bootstrap-transition.js"></script>
		<script src="assets/js/bootstrap-alert.js"></script>
		<script src="assets/js/bootstrap-modal.js"></script>
		<script src="assets/js/bootstrap-dropdown.js"></script>
		<script src="assets/js/bootstrap-scrollspy.js"></script>
		<script src="assets/js/bootstrap-tab.js"></script>
		<script src="assets/js/bootstrap-tooltip.js"></script>
		<script src="assets/js/bootstrap-popover.js"></script>
		<script src="assets/js/bootstrap-button.js"></script>
		<script src="assets/js/bootstrap-collapse.js"></script>
		<script src="assets/js/bootstrap-carousel.js"></script>
		<script src="assets/js/bootstrap-typeahead.js"></script>
		<script src="assets/js/bootstrap-affix.js"></script>

		<script src="assets/js/holder/holder.js"></script>
		<script src="assets/js/google-code-prettify/prettify.js"></script>

		<script src="assets/js/application.js"></script>
		<script>
		$(document).ready(function() {
			$('#dataTables-example').dataTable();
		});
		</script>
	</body>
</html>
