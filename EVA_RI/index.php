<?php
include_once('html_fns.php');
include_once("CP_MENU/xajax_fns_menu.php");

//$dependencia1 = $_SESSION['dep_cod']; 
$dependencia1 = 2010;
$dependencia1 = $_SESSION['dep_cod'];
$usuario = $_SESSION['auth_user'];
$plaza1 = $_SESSION['org_plaza'];
$dep_desc = $_SESSION['dep_desc_md'];
$_SESSION['EVADESD1'];




$ClsPer = new ClsPersonal();
$result = $ClsPer->get_personal_usuario($usuario);
foreach ($result as $row) {
	$nom1 = $row['PER_NOM1'];
	$nom2 = $row['PER_NOM2'];
	$ape1 = $row['PER_APE1'];
	$ape2 = $row['PER_APE2'];
	$grado = $row['GRA_DESC_LG'];
	$arma = $row['ARM_DESC_LG'];
}

$_SESSION['arma'] = $arma;
$_SESSION['grado'] = $grado;
$_SESSION['nombre'] = $nom1 . ' ' . $nom2 . ' ' . $ape1 . ' ' . $ape2;


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Evaluacion del desempeño</title>
	<link rel="shortcut icon" href="img/Divisa.png">
	<!--=============================LIBRERIAS DE BOOTSTRAP======================================-->
	<link href='assets/css/bootstrap.css' rel='stylesheet' />
	<link href='assets/css/bootstrap-responsive.css' rel='stylesheet' />
	<link href="assets/css/docs.css" rel="stylesheet">
	<link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<style>
		#bg {
			position: absolute;
			/* Posición absoluta para ajustar según el viewport */
			z-index: -1;
			/* Coloca detrás de otros elementos */
			top: 2;
			/* Ajusta según tu diseño */
			left: 0;
			/* Ajusta según tu diseño */
			width: 100%;
			/* Ocupa el 90% del ancho del viewport */
			height: 100%;
			/* Ocupa toda la altura disponible */


		}
	</style>
</head>

<body>

	<div class="container" id="bg">
		<div class="container">
			<div class="navbar">
				<h3>
					<p class="lead text-success">
						<?php echo $dep_desc; ?>
					</p>
				</h3>
				<!--PERMISOS PARA LA D1-->
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<div class="nav-collapse collapse navbar-responsive-collapse">
							<ul class="nav">
								<li><a class="brand" href="index.php"><img id='b' alt="Brand" src="img/escudo.png" style="max-width:30px; margin-top: -4px;"> Menu</a></li>
								<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////USO EXCLUSIVO PARA REALIZAR EVALUACIONES QUE NO SE INGRESARON ANTERIOR MENTE ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////COMENTARIALO DESPUES DE UTILIZARLO EL MENU (menu_include.php) tambien se comentarea////////////////////////////// //////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////-->


								<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////USO EXCLUSIVO PARA REALIZAR EVALUACIONES QUE NO SE INGRESARON ANTERIOR MENTE ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////COMENTARIALO DESPUES DE UTILIZARLO EL MENU (menu_include.php) tambien se comentarea////////////////////////////// //////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////-->
								<li class="divider-vertical"></li>
								<?php if ($_SESSION['EVADESD1'] == 1) { ?>
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="img/alert2.gif" style="max-width:30px; margin-top: -4px;"> Casos
											Especiales<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_EVALUACION1/FrmBusca_catalogo_admin.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
											<li><a href="CP_EVALUACION1/Frm_auto_admin.php"><i class='icon-user'></i>Autoevaluacion</a></li>
											<li><a href="CP_INMEDIATO2/Frm_inmediato_Evaluar_admin.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
											<li><a href="CP_EVAFINAL/Frm_final_admin.php"><i class='icon-user'></i>Evaluador
													Final</a></li>

											<li><a href="CP_UL1/Frm_ul_admin.php"><i class='icon-list-alt'></i>Evaluaciones
													finalizadas</a></li>

										</ul>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluar<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_EVALUACION1/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
											<li><a href="CP_EVALUACION1/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
											<li><a href="CP_INMEDIATO2/Frm_inmediato_Evaluar.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
											<li><a href="CP_EVAFINAL/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a>
											</li>
											<!--<li><a href="CP_REPORTEADOR/Frm_Evaluar.php"><i class='icon-folder-open'></i>Reportes Pendientes a Evaluar</a></li>-->
											<li><a href="CP_UL1/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones
													finalizadas</a></li>
										</ul>
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">2dos. y Comtes. <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_EVALUACION2/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
											<li><a href="CP_EVALUACION2/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
											<li><a href="CP_INMEDIATO2/Frm_inmediato.php"><i class='icon-user'></i>Evaluador
													Inmediato</a></li>
											<li><a href="CP_FINAL2/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a>
											</li>
											<!--<li><a href="CP_REPORTEADOR/Frm_2dos.php">Reportes Pendientes a Evaluar</a></li>-->
											<li><a href="CP_ULS/Frm_finales2do.php"><i class='icon-list-alt'></i>Evaluaciones
													finalizadas</a></li>
										</ul>
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Comtes. Jefes y Dir. <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_AUTOEVA/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar
													borrador</a></li>
											<li><a href="CP_AUTOEVA/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a>
											</li>
											<?php if ($_SESSION['EVASUB'] == 1) { ?>
												<li><a href="CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua
														SubJefe EMDN</a></li>
											<?php }
											if ($_SESSION['EVAJEFE'] == 1) { ?>
												<li><a href="CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe EMDN</a>
												</li>
												<!--<li><a href="CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>-->
											<?php } ?>
											<li><a href="CP_ULFIN/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones
													finalizadas</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Vic/Jef.Per<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_EVALUACION1/FrmBusca_catalogoVJ.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
											<li><a href="CP_EVALUACION1/Frm_autoVJ.php"><i class='icon-user'></i>Autoevaluacion</a></li>
											<li><a href="CP_EVAFINAL/Frm_finalVJ.php"><i class='icon-user'></i>Evaluador
													Final</a></li>
											<!--<li><a href="CP_REPORTEADOR/Frm_Evaluar.php">Reportes Pendientes a Evaluar</a></li>-->
											<li><a href="CP_UL1/Frm_ulVJ.php"><i class='icon-list-alt'></i>Evaluaciones
													finalizadas</a></li>
											<li><a href="CP_EVAFINAL/Frm_vice_especial.php"><img id='b' alt="Brand" src="img/finanzas.png" style="max-width:20px; margin-top: -4px;">Evalua
													Vice.MDN/Especial</a></li>

										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dir. Min. <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_EVALUACION1/FrmBusca_catalogoDIR.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
											<li><a href="CP_EVALUACION1/Frm_autoDIR.php"><i class='icon-user'></i>Autoevaluacion</a></li>

											<li><a href="CP_INMEDIATO2/Frm_inmediato_DIR.php"><i class='icon-user'></i>Evaluador
													Inmediato</a></li>

											<li><a href="CP_EVAFINAL/Frm_finalDIR.php"><i class='icon-user'></i>Evaluador
													Final</a></li>
											<!--<li><a href="CP_REPORTEADOR/Frm_Evaluar.php">Reportes Pendientes a Evaluar</a></li>-->

											<li><a href="CP_UL1/Frm_ulDIR.php"><i class='icon-list-alt'></i>Evaluaciones
													finalizadas</a></li>
										</ul>
									</li>
									</li>
									</li>
									<li class="divider-vertical"></li>
									<li><a href="CP_REPORTEADOR/Frm_ap.php">Aprobar</a></li>

									<li class="divider-vertical"></li>

							</ul>
							<ul class="nav pull-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="img/reporte.png" style="max-width:20px; margin-top: -4px;">Reportes/A<b class="caret"></b><i class='icon-user'></i></a>
									<ul class="dropdown-menu">
										<li><a href="CP_EVALUACION/Frm_faltan.php" target='_blank'><i class='icon-list-alt'></i>Rep. Pendientes</a></li>
										<li><a href="CP_REPORTEADOR/FrmBusca_rep.php"><i class='icon-list-alt'></i>Rep.
												individual por periodo</a></li>
										<!--<li><a href="CP_REPORTEADOR/FrmBusca_rep1.php"><i class='icon-list-alt'></i>Rep. individual por periodo Comtes. Jefes y Dir.</a></li>-->
										<li><a href="CP_REPORTEADOR/FrmBusca_rep2.php"><i class='icon-list-alt'></i>Rep. Por
												catalogo</a></li>
										<li><a href="CP_REPORTEADOR/FrmBusca_dep.php"><i class='icon-list-alt'></i>Rep. Por
												dependencias</a></li>
										<li><a href="CP_UL1/Frm_Impugnados.php"><i class='icon-list-alt'></i>Rep.
												Evaluaciones Impugnadas</a></li>
										<li><a href="CP_UL1/Frm_ratificados.php"><i class='icon-list-alt'></i>Rep.
												Evaluaciones Ratificadas</a></li>
										<!--<li><a href="CP_REPORTEADOR/Frm_12016.php"><i class='icon-list-alt'></i>Rep. Aprobados</a></li>-->
										<li><a href="CP_REPORTEADOR/Frm_rep10419.php"><i class='icon-list-alt'></i>Rep.
												Categoria</a></li>
										<li><a href="PDF/DIRECTIVA.pdf" target="_blank"><i class='icon-book'></i>Direc/
												acuerdo min. número 21-2009</a></li>
										<li><a href="PDF/manual.pdf" target="_blank"><i class='icon-book'></i>Manual de
												usuario General</a></li>
										<li><a href="PDF/resumido.pdf" target="_blank"><i class='icon-book'></i>Manual de
												usuario Resumido</a></li>
										<li><a href="tutoriales/Caso_especial.mp4" target="_blank"><i class='icon-play'></i>Tutorial Caso Especial</a></li>
									</ul>
								</li>

								<!--////////////////////////////////////-->
								<!--////////////////////////////////////-->
								<!--////////////////////////////////////-->
								<!--////////////////////////////////////-->
								<!--////////////////////////////////////-->
							<?php } elseif ($_SESSION['EVADESCOM'] == 1 and $dependencia1 <> 2010 and $dependencia1 <> 2160 and $dependencia1 <> 2240 and $dependencia1 <> 2140 and $dependencia1 <> 2070 and $dependencia1 <> 2090 and $dependencia1 <> 2120 and $dependencia1 <> 2100) { ?>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="img/alert2.gif" style="max-width:30px; margin-top: -4px;"> Casos
										Especiales<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="CP_EVALUACION1/FrmBusca_catalogo_admin.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
										<li><a href="CP_EVALUACION1/Frm_auto_admin.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="CP_INMEDIATO2/Frm_inmediato_Evaluar_admin.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="CP_EVAFINAL/Frm_final_admin.php"><i class='icon-user'></i>Evaluador
												Final</a></li>

										<li><a href="CP_UL1/Frm_ul_admin.php"><i class='icon-list-alt'></i>Evaluaciones
												finalizadas</a></li>

									</ul>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluar<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="CP_EVALUACION1/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
										<li><a href="CP_EVALUACION1/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="CP_INMEDIATO2/Frm_inmediato_Evaluar.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="CP_EVAFINAL/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a>
										</li>
										<!--<li><a href="CP_REPORTEADOR/Frm_Evaluar.php"><i class='icon-folder-open'></i>Reportes Pendientes a Evaluar</a></li>-->
										<li><a href="CP_UL1/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones
												finalizadas</a></li>
									</ul>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">2dos. y Comtes. <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="CP_EVALUACION2/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
										<li><a href="CP_EVALUACION2/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="CP_INMEDIATO2/Frm_inmediato.php"><i class='icon-user'></i>Evaluador
												Inmediato</a></li>
										<li><a href="CP_FINAL2/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a>
										</li>
										<!--<li><a href="CP_REPORTEADOR/Frm_2dos.php">Reportes Pendientes a Evaluar</a></li>-->
										<li><a href="CP_ULS/Frm_finales2do.php"><i class='icon-list-alt'></i>Evaluaciones
												finalizadas</a></li>
									</ul>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Comtes. Jefes y Dir. <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="CP_AUTOEVA/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar
												borrador</a></li>
										<li><a href="CP_AUTOEVA/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a>
										</li>
										<?php if ($_SESSION['EVASUB'] == 1) { ?>
											<li><a href="CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua
													SubJefe EMDN</a></li>
										<?php }
										if ($_SESSION['EVAJEFE'] == 1) { ?>
											<li><a href="CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe EMDN</a>
											</li>
											<li><a href="CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>
										<?php } ?>
										<li><a href="CP_ULFIN/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones
												finalizadas</a></li>
									</ul>
								</li>
								<ul class="nav pull-right">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="img/reporte.png" style="max-width:20px; margin-top: -4px;">Reportes/A<b class="caret"></b><i class='icon-user'></i></a>
										<ul class="dropdown-menu">
											<li><a href="CP_EVALUACION/Frm_faltan.php" target='_blank'><i class='icon-list-alt'></i>Rep. Pendientes</a></li>
											<li><a href="CP_REPORTEADOR/FrmBusca_rep.php"><i class='icon-list-alt'></i>Rep.
													individual por periodo</a></li>
											<!--<li><a href="CP_REPORTEADOR/FrmBusca_rep1.php"><i class='icon-list-alt'></i>Rep. individual por periodo Comtes. Jefes y Dir.</a></li>-->
											<li><a href="CP_REPORTEADOR/FrmBusca_rep2.php"><i class='icon-list-alt'></i>Rep.
													Por catalogo</a></li>
											<li><a href="CP_UL1/Frm_Impugnados.php"><i class='icon-list-alt'></i>Rep.
													Evaluaciones Impugnadas</a></li>
											<li><a href="CP_UL1/Frm_ratificados.php"><i class='icon-list-alt'></i>Rep.
													Evaluaciones Ratificadas</a></li>
											<li><a href="PDF/DIRECTIVA.pdf" target="_blank"><i class='icon-book'></i>Direc/
													acuerdo min. número 21-2009</a></li>
											<li><a href="PDF/manual.pdf" target="_blank"><i class='icon-book'></i>Manual de
													usuario General</a></li>
											<li><a href="PDF/resumido.pdf" target="_blank"><i class='icon-book'></i>Manual
													de usuario Resumido</a></li>
											<li><a href="tutoriales/Caso_especial.mp4" target="_blank"><i class='icon-play'></i>Tutorial Caso Especial</a></li>
										</ul>
									</li>
								<?php } elseif ($_SESSION['EVADESCOM'] == 1 and $dependencia1 == 2010 or $dependencia1 == 2240 or $dependencia1 == 2140 or $dependencia1 == 2070 or $dependencia1 == 2090 or $dependencia1 == 2120 or $dependencia1 == 2100) { ?>
									<?php if ($_SESSION['EVASUB'] == 1) { ?>
										<li><a href="CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua SubJefe
												EMDN</a></li>
									<?php }
									if ($_SESSION['EVAJEFE'] == 1) { ?>
										<li><a href="CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe EMDN</a></li>
										<!--<li><a href="CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>-->
									<?php } ?>
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="img/alert2.gif" style="max-width:30px; margin-top: -4px;"> Casos
											Especiales<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_EVALUACION1/FrmBusca_catalogo_admin.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
											<li><a href="CP_EVALUACION1/Frm_auto_admin.php"><i class='icon-user'></i>Autoevaluacion</a></li>
											<li><a href="CP_INMEDIATO2/Frm_inmediato_Evaluar_admin.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
											<li><a href="CP_EVAFINAL/Frm_final_admin.php"><i class='icon-user'></i>Evaluador
													Final</a></li>

											<li><a href="CP_UL1/Frm_ul_admin.php"><i class='icon-list-alt'></i>Evaluaciones
													finalizadas</a></li>
											<li><a href="CP_EVAFINAL/Frm_vice_especial.php"><img id='b' alt="Brand" src="img/finanzas.png" style="max-width:20px; margin-top: -4px;">Evalua
													Vice.MDN/Especial</a></li>
										</ul>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluar<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_EVALUACION1/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
											<li><a href="CP_EVALUACION1/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
											<li><a href="CP_INMEDIATO2/Frm_inmediato_Evaluar.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
											<li><a href="CP_EVAFINAL/Frm_final.php"><i class='icon-user'></i>Evaluador
													Final</a></li>
											<!--<li><a href="CP_REPORTEADOR/Frm_Evaluar.php"><i class='icon-folder-open'></i>Reportes Pendientes a Evaluar</a></li>-->
											<li><a href="CP_UL1/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones
													finalizadas</a></li>
										</ul>

									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">2dos. y Comtes. <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_EVALUACION2/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
											<li><a href="CP_EVALUACION2/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
											<li><a href="CP_INMEDIATO2/Frm_inmediato.php"><i class='icon-user'></i>Evaluador
													Inmediato</a></li>
											<li><a href="CP_FINAL2/Frm_final.php"><i class='icon-user'></i>Evaluador
													Final</a></li>
											<!--<li><a href="CP_REPORTEADOR/Frm_2dos.php">Reportes Pendientes a Evaluar</a></li>-->
											<li><a href="CP_ULS/Frm_finales2do.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
										</ul>
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Comtes. Jefes y Dir. <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_AUTOEVA/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
											<li><a href="CP_AUTOEVA/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
											<?php if ($_SESSION['EVASUB'] == 1) { ?>
												<li><a href="CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua
														SubJefe EMDN</a></li>
											<?php }
											if ($_SESSION['EVAJEFE'] == 1) { ?>
												<li><a href="CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe
														EMDN</a></li>
												<!--<li><a href="CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>-->
											<?php } ?>
											<li><a href="CP_ULFIN/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones
													finalizadas</a></li>
										</ul>
									</li>

									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Vic/Jef.Per<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_EVALUACION1/FrmBusca_catalogoVJ.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
											<li><a href="CP_EVALUACION1/Frm_autoVJ.php"><i class='icon-user'></i>Autoevaluacion</a></li>
											<li><a href="CP_EVAFINAL/Frm_finalVJ.php"><i class='icon-user'></i>Evaluador
													Final</a></li>
											<!--<li><a href="CP_REPORTEADOR/Frm_Evaluar.php">Reportes Pendientes a Evaluar</a></li>-->
											<li><a href="CP_UL1/Frm_ulVJ.php"><i class='icon-list-alt'></i>Evaluaciones
													finalizadas</a></li>
											<li><a href="CP_EVAFINAL/Frm_vice_especial.php"><img id='b' alt="Brand" src="img/finanzas.png" style="max-width:20px; margin-top: -4px;">Evalua
													Vice.MDN/Especial</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dir. Min. <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="CP_EVALUACION1/FrmBusca_catalogoDIR.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
											<li><a href="CP_EVALUACION1/Frm_autoDIR.php"><i class='icon-user'></i>Autoevaluacion</a></li>

											<li><a href="CP_INMEDIATO2/Frm_inmediato_DIR.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>

											<li><a href="CP_EVAFINAL/Frm_finalDIR.php"><i class='icon-user'></i>Evaluador
													Final</a></li>
											<!--<li><a href="CP_REPORTEADOR/Frm_Evaluar.php">Reportes Pendientes a Evaluar</a></li>-->

											<li><a href="CP_UL1/Frm_ulDIR.php"><i class='icon-list-alt'></i>Evaluaciones
													finalizadas</a></li>
										</ul>
									</li>
									</li>
									</li>
									<ul class="nav pull-right">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="img/reporte.png" style="max-width:20px; margin-top: -4px;">Reportes/A<b class="caret"></b><i class='icon-user'></i></a>
											<ul class="dropdown-menu">
												<li><a href="CP_EVALUACION/Frm_faltan.php" target='_blank'><i class='icon-list-alt'></i>Rep. Pendientes</a></li>
												<li><a href="CP_REPORTEADOR/FrmBusca_rep.php"><i class='icon-list-alt'></i>Rep. individual por periodo</a></li>
												<!--<li><a href="CP_REPORTEADOR/FrmBusca_rep1.php"><i class='icon-list-alt'></i>Rep. individual por periodo Comtes. Jefes y Dir.</a></li>-->
												<li><a href="CP_REPORTEADOR/FrmBusca_rep2.php"><i class='icon-list-alt'></i>Rep. Por catalogo</a></li>
												<li><a href="CP_UL1/Frm_Impugnados.php"><i class='icon-list-alt'></i>Rep.
														Evaluaciones Impugnadas</a></li>
												<li><a href="CP_UL1/Frm_ratificados.php"><i class='icon-list-alt'></i>Rep.
														Evaluaciones Ratificadas</a></li>
												<li><a href="PDF/DIRECTIVA.pdf" target="_blank"><i class='icon-book'></i>Direc/ acuerdo min. número 21-2009</a>
												</li>
												<li><a href="PDF/manual.pdf" target="_blank"><i class='icon-book'></i>Manual
														de usuario General</a></li>
												<li><a href="PDF/resumido.pdf" target="_blank"><i class='icon-book'></i>Manual de usuario Resumido</a></li>
												<li><a href="tutoriales/Caso_especial.mp4" target="_blank"><i class='icon-play'></i>Tutorial Caso Especial</a></li>
											</ul>
										</li>
									<?php } elseif ($_SESSION['EVADESCOM'] == 1 and $dependencia1 == 2160 or $dependencia1 == 2240 or $dependencia1 == 2140 or $dependencia1 == 2070 or $dependencia1 == 2090 or $dependencia1 == 2120 or $dependencia1 == 2100) { ?>
										<?php if ($_SESSION['EVASUB'] == 1) { ?>
											<li><a href="CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua
													SubJefe EMDN</a></li>
										<?php }
										if ($_SESSION['EVAJEFE'] == 1) { ?>
											<li><a href="CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe EMDN</a>
											</li>
											<!--<li><a href="CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>-->
										<?php } ?>
										<li class="divider-vertical"></li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="img/alert2.gif" style="max-width:30px; margin-top: -4px;"> Casos Especiales<b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a href="CP_EVALUACION1/FrmBusca_catalogo_admin.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
												<li><a href="CP_EVALUACION1/Frm_auto_admin.php"><i class='icon-user'></i>Autoevaluacion</a></li>
												<li><a href="CP_INMEDIATO2/Frm_inmediato_Evaluar_admin.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
												<li><a href="CP_EVAFINAL/Frm_final_admin.php"><i class='icon-user'></i>Evaluador Final</a></li>

												<li><a href="CP_UL1/Frm_ul_admin.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
												<li><a href="CP_EVAFINAL/Frm_vice_especial.php"><img id='b' alt="Brand" src="img/finanzas.png" style="max-width:20px; margin-top: -4px;">Evalua
														Vice.MDN/Especial</a></li>
											</ul>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluar<b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a href="CP_EVALUACION1/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
												<li><a href="CP_EVALUACION1/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
												<li><a href="CP_INMEDIATO2/Frm_inmediato_Evaluar.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
												<li><a href="CP_EVAFINAL/Frm_final.php"><i class='icon-user'></i>Evaluador
														Final</a></li>
												<!--<li><a href="CP_REPORTEADOR/Frm_Evaluar.php"><i class='icon-folder-open'></i>Reportes Pendientes a Evaluar</a></li>-->
												<li><a href="CP_UL1/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones
														finalizadas</a></li>
											</ul>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">2dos. y Comtes. <b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a href="CP_EVALUACION2/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
												<li><a href="CP_EVALUACION2/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
												<li><a href="CP_INMEDIATO2/Frm_inmediato.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
												<li><a href="CP_FINAL2/Frm_final.php"><i class='icon-user'></i>Evaluador
														Final</a></li>
												<!--<li><a href="CP_REPORTEADOR/Frm_2dos.php">Reportes Pendientes a Evaluar</a></li>-->
												<li><a href="CP_ULS/Frm_finales2do.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
											</ul>
										<li class="divider-vertical"></li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">Comtes. Jefes y Dir.
												<b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a href="CP_AUTOEVA/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
												<li><a href="CP_AUTOEVA/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
												<?php if ($_SESSION['EVASUB'] == 1) { ?>
													<li><a href="CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua SubJefe EMDN</a></li>
												<?php }
												if ($_SESSION['EVAJEFE'] == 1) { ?>
													<li><a href="CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe
															EMDN</a></li>
													<!--<li><a href="CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>-->
												<?php } ?>
												<li><a href="CP_ULFIN/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones
														finalizadas</a></li>
											</ul>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">Vic/Jef.Per<b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a href="CP_EVALUACION1/FrmBusca_catalogoVJ.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
												<li><a href="CP_EVALUACION1/Frm_autoVJ.php"><i class='icon-user'></i>Autoevaluacion</a></li>
												<li><a href="CP_EVAFINAL/Frm_finalVJ.php"><i class='icon-user'></i>Evaluador
														Final</a></li>
												<!--<li><a href="CP_REPORTEADOR/Frm_Evaluar.php">Reportes Pendientes a Evaluar</a></li>-->
												<li><a href="CP_UL1/Frm_ulVJ.php"><i class='icon-list-alt'></i>Evaluaciones
														finalizadas</a></li>
											</ul>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dir. Min. <b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a href="CP_EVALUACION1/FrmBusca_catalogoDIR.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
												<li><a href="CP_EVALUACION1/Frm_autoDIR.php"><i class='icon-user'></i>Autoevaluacion</a></li>

												<li><a href="CP_INMEDIATO2/Frm_inmediato_DIR.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>

												<li><a href="CP_EVAFINAL/Frm_finalDIR.php"><i class='icon-user'></i>Evaluador Final</a></li>
												<!--<li><a href="CP_REPORTEADOR/Frm_Evaluar.php">Reportes Pendientes a Evaluar</a></li>-->

												<li><a href="CP_UL1/Frm_ulDIR.php"><i class='icon-list-alt'></i>Evaluaciones
														finalizadas</a></li>
											</ul>
										</li>
										</li>
										</li>
										<ul class="nav pull-right">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="img/reporte.png" style="max-width:20px; margin-top: -4px;">Reportes/A<b class="caret"></b></a>
												<ul class="dropdown-menu">
													<li><a href="CP_EVALUACION/Frm_faltan.php" target='_blank'><i class='icon-list-alt'></i>Rep. Pendientes</a></li>
													<li><a href="CP_REPORTEADOR/FrmBusca_rep.php"><i class='icon-list-alt'></i>Rep. individual por periodo</a>
													</li>
													<!--<li><a href="CP_REPORTEADOR/FrmBusca_rep1.php"><i class='icon-list-alt'></i>Rep. individual por periodo Comtes. Jefes y Dir.</a></li>-->
													<li><a href="CP_REPORTEADOR/FrmBusca_rep2.php"><i class='icon-list-alt'></i>Rep. Por catalogo</a></li>
													<li><a href="CP_UL1/Frm_Impugnados.php"><i class='icon-list-alt'></i>Rep. Evaluaciones Impugnadas</a>
													</li>
													<li><a href="CP_UL1/Frm_ratificados.php"><i class='icon-list-alt'></i>Rep. Evaluaciones Ratificadas</a>
													</li>
													<li><a href="PDF/DIRECTIVA.pdf" target="_blank"><i class='icon-book'></i>Direc/ acuerdo min. número 21-2009</a>
													</li>
													<li><a href="PDF/manual.pdf" target="_blank"><i class='icon-book'></i>Manual de usuario General</a></li>
													<li><a href="PDF/resumido.pdf" target="_blank"><i class='icon-book'></i>Manual de usuario Resumido</a></li>
													<li><a href="tutoriales/Caso_especial.mp4" target="_blank"><i class='icon-play'></i>Tutorial Caso Especial</a></li>
												</ul>
											</li>
										<?php } ?>
										<!--<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">A<b class="caret"></b><i class='icon-file'></i></a>
								<ul class="dropdown-menu">
						
								</ul>
							</li>-->
										<li class="dropdown">
										<li class="divider-vertical"></li>
										<li><a href="../MENU/menu.php"><i class='icon-off'></i>Salir</a></li>
										</li>
										</ul>

						</div>
					</div>
				</div>
				<br>
			</div>

			<div class='container' align='center'>

				<font size=5 color='black'><strong>BIENVENIDO</strong></font>
				<br>
				<font size=2 color='text'><strong>EVALUACION DEL DESEMPE&Ntilde;O PARA OFICIALES 2.5</strong></font>
				<br>
				<br>
				<img src='img/Divisa.png' alt='' height='350' width='350' />
			</div>
			<div class='container'>

				<div class="text-center">
					<br>
					<h4>
						<?php
						if ($_SESSION['arma'] != "SIN ARMA") {
							echo $_SESSION['grado'] . ' DE ' . $_SESSION['arma'] . ' ' . $_SESSION['nombre'];
						} else {
							echo $_SESSION['grado'] . ' ' . $_SESSION['nombre'];
						}
						?>
					</h4>
					<div class='row-fluid'>
						<div class='span10' align='right'>
							<a title="Descargar Google Chrome" target="_blank" href="https://www.google.es/chrome/browser/desktop/"><img src="img/goo.jpg" width="50" height="100" alt="Descargar Google Chrome" /></a>
						</div>
						<div class="footer">
							<p>CIT &copy; CAU 2021</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--====================LIBRERIAS DE BOOTSTRAP PARA QUE NOS DESPLIEGUE CALENDARIO===================-->
	<script type="text/javascript">
		$('.form_datetime').datetimepicker({
			//language:  'fr',
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