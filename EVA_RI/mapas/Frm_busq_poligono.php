<?php
date_default_timezone_set('America/Guatemala');
include_once('../html_fns.php');
include_once('html_poligonos.php');
include_once('xajax_poligonos.php');
////////////////////// Variables de Sesion (descripcion de la dependencia) ////////////////////////
$dep_desc = $_SESSION['dep_desc'];
////////////////////// Variables de Sesion (Codigo de la dependencia) //////////////////////////////
$dep = $_SESSION['dep_cod'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!--==================TITLE====================================-->
		<title>Busqueda de poligonos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="C.O.C. Application">
		<meta name="author" content="CCI Development Team AOC 2013">
		<?php
		$xajax->printJavascript("..");
		?>
		<!--====================================================================================================-->
		<!--================================= DEFAULT =============================================================-->
		<!--====================================================================================================-->
		<link href="../assets/css/bootstrap_mapa.css" rel="stylesheet">
		<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="../assets/css/docs.css" rel="stylesheet">
		<link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="../assets/ico/favicon.png">
		<!--====================================================================================================-->
		<!--==============================MAPS==================================-->
		<!--script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&amp;language=es"></script-->
		<script type="text/javascript" src="ini_polig.js"></script>
		<!--==============================CSS==================================-->
		<link rel="stylesheet" media="all" type="text/css" href="../assets/css/oc/reporte_mision.css" />
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
	</head>
<!--====================================== BODY ==========================================================================-->
	<body onload="blanco();">
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
					<a class="brand" href="../index.php">CCI</a>
					<div class="nav-collapse collapse navbar-responsive-collapse">
						<ul class="nav">
							<li><a href="../index.php">Inicio</a></li>
						</ul>
						<ul class="nav pull-right">
							<li class="divider-vertical"></li>
							<li><a href="../CPAYUDA/Frm_Ayuda.php">Ayuda</a></li>
							<li class="divider-vertical"></li>
							<li><a href="../../MENU/menu.php">Salir</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
	
		<?php echo form_reporte_mision($dep); ?>
		<div class="footer">
			<p>CCI &copy; Development Team 2013</p>
		</div>
	</div> 
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
	</body>
</html>