<div class="container">
		<div class="navbar">
			<h3><p class="lead text-success"><?php echo $desc_dependencia; ?></p></h3>
			<!--<h3><p class="lead text-success"><?php //$dependencia=2010; ?></p></h3>-->
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="nav-collapse collapse navbar-responsive-collapse">
						<ul class="nav">
							<li><li><a class="brand"  href="../index.php"><img id='b' alt="Brand" src="../img/escudo.png"  style="max-width:30px; margin-top: -4px;"> Menu</a></li></li>
<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////USO EXCLUSIVO PARA REALIZAR EVALUACIONES QUE NO SE INGRESARON ANTERIOR MENTE ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////COMENTARIALO DESPUES DE UTILIZARLO EL MENU (menu_include.php) tambien se comentarea////////////////////////////// //////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////-->


<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////USO EXCLUSIVO PARA REALIZAR EVALUACIONES QUE NO SE INGRESARON ANTERIOR MENTE ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////COMENTARIALO DESPUES DE UTILIZARLO EL MENU (menu_include.php) tambien se comentarea////////////////////////////// //////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////-->
							<li class="divider-vertical"></li>
							<?php if($_SESSION['EVADESD1'] == 1) {?>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="../img/alert2.gif"  style="max-width:30px; margin-top: -4px;">Casos Especiales<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogo_admin.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_auto_admin.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_INMEDIATO2/Frm_inmediato_Evaluar_admin.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="../CP_EVAFINAL/Frm_final_admin.php"><i class='icon-user'></i>Evaluador Final</a></li>
									<li><a href="../CP_UL1/Frm_ul_admin.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									
								</ul>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluar<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_INMEDIATO2/Frm_inmediato_Evaluar.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="../CP_EVAFINAL/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_Evaluar.php"><i class='icon-folder-open'></i>Reportes/A Pendientes a Evaluar</a></li>-->
									<li><a href="../CP_UL1/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
								</ul>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">2dos. y Comtes.  <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_EVALUACION2/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
										<li><a href="../CP_EVALUACION2/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
									
										<li><a href="../CP_INMEDIATO2/Frm_inmediato.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
									
										<li><a href="../CP_FINAL2/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_2dos.php">Reportes/A Pendientes a Evaluar</a></li>-->
									
									<li><a href="../CP_ULS/Frm_finales2do.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									</ul>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Comtes. Jefes y Dir. <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_AUTOEVA/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
										<li><a href="../CP_AUTOEVA/Frm_auto.php"><i class='icon-user'></i>Mi evaluacion</a></li>
										<?php if($_SESSION['EVASUB'] == 1) {?>
										<li><a href="../CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua SubJefe EMDN</a></li>
										<?php }if($_SESSION['EVAJEFE'] == 1) {?>
										<li><a href="../CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe EMDN</a></li>
										<!--<li><a href="../CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>-->
										<?php }?>
										<li><a href="../CP_ULFIN/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									</ul>
								</li>
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Vic/Jef.Per<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogoVJ.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_autoVJ.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_EVAFINAL/Frm_finalVJ.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_Evaluar.php">Reportes/A Pendientes a Evaluar</a></li>-->
									<li><a href="../CP_UL1/Frm_ulVJ.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									<li><a href="../CP_EVAFINAL/Frm_vice_especial.php"><img id='b' alt="Brand" src="../img/finanzas.png"  style="max-width:20px; margin-top: -4px;">Evalua Vice.MDN/Especial</a></li>
								</ul>
								</li>
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dir. Min. <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogoDIR.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_autoDIR.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_INMEDIATO2/Frm_inmediato_DIR.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="../CP_EVAFINAL/Frm_finalDIR.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_Evaluar.php">Reportes/A Pendientes a Evaluar</a></li>-->
									<li><a href="../CP_UL1/Frm_ulDIR.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
								</ul>
							</li>
								</li>
							</li>
							<li class="divider-vertical"></li>
							<li><a href="../CP_REPORTEADOR/Frm_ap.php">Aprobar</a></li>
							<li class="divider-vertical"></li>

						</ul>
						<ul class="nav pull-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="../img/reporte.png"  style="max-width:20px; margin-top: -4px;">Reportes/A<b class="caret"></b><i class='icon-user'></i></a>
								<ul class="dropdown-menu">
								<li><a href="../CP_EVALUACION/Frm_faltan.php" target='_blank'><i class='icon-list-alt'></i>Rep. Pendientes</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep.php"><i class='icon-list-alt'></i>Rep. individual por periodo</a></li>
									<!--<li><a href="../CP_REPORTEADOR/FrmBusca_rep1.php"><i class='icon-list-alt'></i>Rep. individual por periodo Comtes. Jefes y Dir.</a></li>-->
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep2.php"><i class='icon-list-alt'></i>Rep. Por catalogo</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_dep.php"><i class='icon-list-alt'></i>Rep. Por dependencias</a></li>
									<li><a href="../CP_UL1/Frm_Impugnados.php"><i class='icon-list-alt'></i>Rep. Evaluaciones Impugnadas</a></li>
									<li><a href="../CP_UL1/Frm_ratificados.php"><i class='icon-list-alt'></i>Rep. Evaluaciones Ratificadas</a></li>

									<li><a href="../CP_REPORTEADOR/Frm_rep10419.php"><i class='icon-list-alt'></i>Rep. Categoria</a></li>

									<li><a href="../PDF/DIRECTIVA.pdf" target="_blank"><i class='icon-book'></i>Direc/ acuerdo min. número 21-2009</a></li>
									<li><a href="../PDF/manual.pdf" target="_blank"><i class='icon-book'></i>Manual de usuario General</a></li>
									<li><a href="../PDF/resumido.pdf"target="_blank"><i class='icon-book'></i>Manual de usuario Resumido</a></li>
									<li><a href="../tutoriales/Caso_especial.mp4"target="_blank"><i class='icon-play'></i>Tutorial Caso Especial</a></li>
							
								</ul>
							</li>
							<?php }elseif($_SESSION['EVADESCOM'] == 1 and $dependencia <> 2010 and $dependencia <> 2160 and $dependencia <> 2240 and $dependencia <> 2140 and $dependencia <> 2070 and $dependencia <> 2090 and $dependencia<>2120 and $dependencia<>2100) {?>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="../img/alert2.gif"  style="max-width:30px; margin-top: -4px;">Casos Especiales<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogo_admin.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_auto_admin.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_INMEDIATO2/Frm_inmediato_Evaluar_admin.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="../CP_EVAFINAL/Frm_final_admin.php"><i class='icon-user'></i>Evaluador Final</a></li>
									<li><a href="../CP_UL1/Frm_ul_admin.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									<li><a href="../CP_EVAFINAL/Frm_vice_especial.php"><img id='b' alt="Brand" src="../img/finanzas.png"  style="max-width:20px; margin-top: -4px;">Evalua Vice.MDN/Especial</a></li>
								</ul>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluar<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_INMEDIATO2/Frm_inmediato_Evaluar.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="../CP_EVAFINAL/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_Evaluar.php"><i class='icon-folder-open'></i>Reportes/A Pendientes a Evaluar</a></li>-->
									<li><a href="../CP_UL1/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
								</ul>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">2dos. y Comtes.  <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_EVALUACION2/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
										<li><a href="../CP_EVALUACION2/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
									
										<li><a href="../CP_INMEDIATO2/Frm_inmediato.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
									
										<li><a href="../CP_FINAL2/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_2dos.php">Reportes/A Pendientes a Evaluar</a></li>-->
									
									<li><a href="../CP_ULS/Frm_finales2do.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									</ul>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Comtes. Jefes y Dir. <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_AUTOEVA/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
										<li><a href="../CP_AUTOEVA/Frm_auto.php"><i class='icon-user'></i>Mi evaluacion</a></li>
										<?php if($_SESSION['EVASUB'] == 1) {?>
										<li><a href="../CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua SubJefe EMDN</a></li>
										<?php }if($_SESSION['EVAJEFE'] == 1) {?>
										<li><a href="../CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe EMDN</a></li>
										<!--<li><a href="../CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>-->
										<?php }?>
										<li><a href="../CP_ULFIN/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									</ul>
								</li>
							<ul class="nav pull-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="../img/reporte.png"  style="max-width:20px; margin-top: -4px;">Reportes/A<b class="caret"></b><i class='icon-user'></i></a>
								<ul class="dropdown-menu">
								<li><a href="../CP_EVALUACION/Frm_faltan.php" target='_blank'><i class='icon-list-alt'></i>Rep. Pendientes</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep.php"><i class='icon-list-alt'></i>Rep. individual por periodo</a></li>
									<!--<li><a href="../CP_REPORTEADOR/FrmBusca_rep1.php"><i class='icon-list-alt'></i>Rep. individual por periodo Comtes. Jefes y Dir.</a></li>-->
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep2.php"><i class='icon-list-alt'></i>Rep. Por catalogo</a></li>
									<li><a href="../CP_UL1/Frm_Impugnados.php"><i class='icon-list-alt'></i>Rep. Evaluaciones Impugnadas</a></li>
									<li><a href="../CP_UL1/Frm_ratificados.php"><i class='icon-list-alt'></i>Rep. Evaluaciones Ratificadas</a></li>
									<li><a href="../PDF/DIRECTIVA.pdf" target="_blank"><i class='icon-book'></i>Direc/ acuerdo min. número 21-2009</a></li>
									<li><a href="../PDF/manual.pdf" target="_blank"><i class='icon-book'></i>Manual de usuario General</a></li>
									<li><a href="../PDF/resumido.pdf"target="_blank"><i class='icon-book'></i>Manual de usuario Resumido</a></li>
									<li><a href="../tutoriales/Caso_especial.mp4"target="_blank"><i class='icon-play'></i>Tutorial Caso Especial</a></li>
							
								</ul>
							</li>
							<?php }elseif($_SESSION['EVADESCOM'] == 1 and $dependencia == 2010 or $dependencia == 2240 or $dependencia == 2140 or $dependencia == 2070 or $dependencia == 2090 or $dependencia==2120 or $dependencia==2100 ) {?>
							<?php if($_SESSION['EVASUB'] == 1) {?>
										<li><a href="../CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua SubJefe EMDN</a></li>
										<?php }if($_SESSION['EVAJEFE'] == 1) {?>
										<li><a href="../CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe EMDN</a></li>
										<!--<li><a href="../CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>-->
										<?php }?>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="../img/alert2.gif"  style="max-width:30px; margin-top: -4px;">Casos Especiales<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogo_admin.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_auto_admin.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_INMEDIATO2/Frm_inmediato_Evaluar_admin.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="../CP_EVAFINAL/Frm_final_admin.php"><i class='icon-user'></i>Evaluador Final</a></li>
									<li><a href="../CP_UL1/Frm_ul_admin.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									<li><a href="../CP_EVAFINAL/Frm_vice_especial.php"><img id='b' alt="Brand" src="../img/finanzas.png"  style="max-width:20px; margin-top: -4px;">Evalua Vice.MDN/Especial</a></li>
								</ul>
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluar<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_INMEDIATO2/Frm_inmediato_Evaluar.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="../CP_EVAFINAL/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_Evaluar.php"><i class='icon-folder-open'></i>Reportes/A Pendientes a Evaluar</a></li>-->
									<li><a href="../CP_UL1/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
								</ul>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">2dos. y Comtes.  <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_EVALUACION2/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
										<li><a href="../CP_EVALUACION2/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
									
										<li><a href="../CP_INMEDIATO2/Frm_inmediato.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
									
										<li><a href="../CP_FINAL2/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_2dos.php">Reportes/A Pendientes a Evaluar</a></li>-->
									
									<li><a href="../CP_ULS/Frm_finales2do.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									</ul>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Comtes. Jefes y Dir. <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_AUTOEVA/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
										<li><a href="../CP_AUTOEVA/Frm_auto.php"><i class='icon-user'></i>Mi evaluacion</a></li>
										<?php if($_SESSION['EVASUB'] == 1) {?>
										<li><a href="../CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua SubJefe EMDN</a></li>
										<?php }if($_SESSION['EVAJEFE'] == 1) {?>
										<li><a href="../CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe EMDN</a></li>
										<!--<li><a href="../CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>-->
										<?php }?>
										<li><a href="../CP_ULFIN/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									</ul>
								</li>
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Vic/Jef.Per<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogoVJ.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_autoVJ.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_EVAFINAL/Frm_finalVJ.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_Evaluar.php">Reportes/A Pendientes a Evaluar</a></li>-->
									<li><a href="../CP_UL1/Frm_ulVJ.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									<li><a href="../CP_EVAFINAL/Frm_vice_especial.php"><img id='b' alt="Brand" src="../img/finanzas.png"  style="max-width:20px; margin-top: -4px;">Evalua Vice.MDN/Especial</a></li>
								</ul>
								</li>
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dir. Min. <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogoDIR.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_autoDIR.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_INMEDIATO2/Frm_inmediato_DIR.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="../CP_EVAFINAL/Frm_finalDIR.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_Evaluar.php">Reportes/A Pendientes a Evaluar</a></li>-->
									<li><a href="../CP_UL1/Frm_ulDIR.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
								</ul>
							</li>
								</li>
							</li>

						</ul>
						<ul class="nav pull-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="../img/reporte.png"  style="max-width:20px; margin-top: -4px;">Reportes/A<b class="caret"></b><i class='icon-user'></i></a>
								<ul class="dropdown-menu">
								<li><a href="../CP_EVALUACION/Frm_faltan.php" target='_blank'><i class='icon-list-alt'></i>Rep. Pendientes</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep.php"><i class='icon-list-alt'></i>Rep. individual por periodo</a></li>
									<!--<li><a href="../CP_REPORTEADOR/FrmBusca_rep1.php"><i class='icon-list-alt'></i>Rep. individual por periodo Comtes. Jefes y Dir.</a></li>-->
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep2.php"><i class='icon-list-alt'></i>Rep. Por catalogo</a></li>
									<li><a href="../CP_UL1/Frm_Impugnados.php"><i class='icon-list-alt'></i>Rep. Evaluaciones Impugnadas</a></li>
									<li><a href="../CP_UL1/Frm_ratificados.php"><i class='icon-list-alt'></i>Rep. Evaluaciones Ratificadas</a></li>
									<li><a href="../PDF/DIRECTIVA.pdf" target="_blank"><i class='icon-book'></i>Direc/ acuerdo min. número 21-2009</a></li>
									<li><a href="../PDF/manual.pdf" target="_blank"><i class='icon-book'></i>Manual de usuario General</a></li>
									<li><a href="../PDF/resumido.pdf"target="_blank"><i class='icon-book'></i>Manual de usuario Resumido</a></li>
									<li><a href="../tutoriales/Caso_especial.mp4"target="_blank"><i class='icon-play'></i>Tutorial Caso Especial</a></li>
							
								</ul>
							</li>
							<?php }elseif($_SESSION['EVADESCOM'] == 1 and $dependencia==2160 or $dependencia == 2240 or $dependencia == 2140 or $dependencia == 2070 or $dependencia == 2090 or $dependencia==2120 or $dependencia==2100){?>
							<?php if($_SESSION['EVASUB'] == 1) {?>
										<li><a href="../CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua SubJefe EMDN</a></li>
										<?php }if($_SESSION['EVAJEFE'] == 1) {?>
										<li><a href="../CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe EMDN</a></li>
										<!--<li><a href="../CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>-->
										<?php }?>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="../img/alert2.gif"  style="max-width:30px; margin-top: -4px;">Casos Especiales<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogo_admin.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_auto_admin.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_INMEDIATO2/Frm_inmediato_Evaluar_admin.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="../CP_EVAFINAL/Frm_final_admin.php"><i class='icon-user'></i>Evaluador Final</a></li>
									<li><a href="../CP_UL1/Frm_ul_admin.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									<li><a href="../CP_EVAFINAL/Frm_vice_especial.php"><img id='b' alt="Brand" src="../img/finanzas.png"  style="max-width:20px; margin-top: -4px;">Evalua Vice.MDN/Especial</a></li>
								</ul>
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Evaluar<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_INMEDIATO2/Frm_inmediato_Evaluar.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="../CP_EVAFINAL/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_Evaluar.php"><i class='icon-folder-open'></i>Reportes/A Pendientes a Evaluar</a></li>-->
									<li><a href="../CP_UL1/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
								</ul>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">2dos. y Comtes.  <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_EVALUACION2/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
										<li><a href="../CP_EVALUACION2/Frm_auto.php"><i class='icon-user'></i>Autoevaluacion</a></li>
									
										<li><a href="../CP_INMEDIATO2/Frm_inmediato.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
									
										<li><a href="../CP_FINAL2/Frm_final.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_2dos.php">Reportes/A Pendientes a Evaluar</a></li>-->
									
									<li><a href="../CP_ULS/Frm_finales2do.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									</ul>
								<li class="divider-vertical"></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Comtes. Jefes y Dir. <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="../CP_AUTOEVA/FrmBusca_catalogo.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
										<li><a href="../CP_AUTOEVA/Frm_auto.php"><i class='icon-user'></i>Mi evaluacion</a></li>
										<?php if($_SESSION['EVASUB'] == 1) {?>
										<li><a href="../CP_INMEDIATO1/Frm_inmediato.php"><i class='icon-user'></i>Evalua SubJefe EMDN</a></li>
										<?php }if($_SESSION['EVAJEFE'] == 1) {?>
										<li><a href="../CP_FINAL1/Frm_final.php"><i class='icon-user'></i>Evalua Jefe EMDN</a></li>
										<!--<li><a href="../CP_REPORTEADOR/FrmBusca_comtes.php"><i class='icon-folder-open'></i>Reporte Comtes. Jefes y Dir</a></li>-->
										<?php }?>
										<li><a href="../CP_ULFIN/Frm_ul.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
									</ul>
								</li>
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Vic/Jef.Per<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogoVJ.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_autoVJ.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_EVAFINAL/Frm_finalVJ.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_Evaluar.php">Reportes/A Pendientes a Evaluar</a></li>-->
									<li><a href="../CP_UL1/Frm_ulVJ.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
								</ul>
								</li>
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dir. Min. <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_EVALUACION1/FrmBusca_catalogoDIR.php"><i class='icon-bookmark'></i>Generar borrador</a></li>
									<li><a href="../CP_EVALUACION1/Frm_autoDIR.php"><i class='icon-user'></i>Autoevaluacion</a></li>
										<li><a href="../CP_INMEDIATO2/Frm_inmediato_DIR.php"><i class='icon-user'></i>Evaluador Inmediato</a></li>
										<li><a href="../CP_EVAFINAL/Frm_finalDIR.php"><i class='icon-user'></i>Evaluador Final</a></li>
										<!--<li><a href="../CP_REPORTEADOR/Frm_Evaluar.php">Reportes/A Pendientes a Evaluar</a></li>-->
									<li><a href="../CP_UL1/Frm_ulDIR.php"><i class='icon-list-alt'></i>Evaluaciones finalizadas</a></li>
								</ul>
							</li>
								</li>
							</li>

						</ul>
						<ul class="nav pull-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id='b' alt="Brand" src="../img/reporte.png"  style="max-width:20px; margin-top: -4px;">Reportes/A<b class="caret"></b><i class='icon-user'></i></a>
								<ul class="dropdown-menu">
								<li><a href="../CP_EVALUACION/Frm_faltan.php" target='_blank'><i class='icon-list-alt'></i>Rep. Pendientes</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep.php"><i class='icon-list-alt'></i>Rep. individual por periodo</a></li>
									<!--<li><a href="../CP_REPORTEADOR/FrmBusca_rep1.php"><i class='icon-list-alt'></i>Rep. individual por periodo Comtes. Jefes y Dir.</a></li>-->
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep2.php"><i class='icon-list-alt'></i>Rep. Por catalogo</a></li>
									<li><a href="../CP_UL1/Frm_Impugnados.php"><i class='icon-list-alt'></i>Rep. Evaluaciones Impugnadas</a></li>
									<li><a href="../CP_UL1/Frm_ratificados.php"><i class='icon-list-alt'></i>Rep. Evaluaciones Ratificadas</a></li>
									<li><a href="../PDF/DIRECTIVA.pdf" target="_blank"><i class='icon-book'></i>Direc/ acuerdo min. número 21-2009</a></li>
									<li><a href="../PDF/manual.pdf" target="_blank"><i class='icon-book'></i>Manual de usuario General</a></li>
									<li><a href="../PDF/resumido.pdf"target="_blank"><i class='icon-book'></i>Manual de usuario Resumido</a></li>
									<li><a href="../tutoriales/Caso_especial.mp4"target="_blank"><i class='icon-play'></i>Tutorial Caso Especial</a></li>
							
								</ul>
							</li>
							<!--<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">A<b class="caret"></b><i class='icon-file'></i></a>
								<ul class="dropdown-menu">
									
								</ul>
							</li>-->
							<?php }?>
							<li class="divider-vertical"></li>
							<li><a href="../index.php"><i class='icon-off'></i>Salir</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
