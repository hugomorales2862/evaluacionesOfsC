<?php
include_once('../html_fns.php');
include_once("xajax_fns_my.php");
	$usuario = $_REQUEST['catalogo'];
	session_start();
	$dependencia1 = $_SESSION['dep_cod']; 
	$usuario1 = $_SESSION['auth_user'];
	$plaza1 = $_SESSION['org_plaza'];
	$dep_desc = $_SESSION['dep_desc'];
	
	$ClsPer = new ClsPersonal();
	$result = $ClsPer->get_personal_usuario($usuario);
	if(is_array($result)){
		foreach ($result as $row){
			$nom1 = $row['PER_NOM1'];
			$nom2 = $row['PER_NOM2'];
			$ape1 = $row['PER_APE1'];
			$ape2 = $row['PER_APE2'];
			$grado = $row['GRA_DESC_LG'];
			$codigo_grado1 = $row['GRA_CODIGO'];
			$arma = $row['ARM_DESC_LG'];
			$codigo_arma1 = $row['ARM_CODIGO'];
			$empleo = $row['PER_DESC_EMPLEO'];
			$t_puesto = $row['T_PUESTO'];
		}
	}else{
		echo'<script>
			alert("ESTE CATALOGO NO EXISTE EN SU DEPENDENCIA");
			history.back()
			</script>';
		exit();
	}
	// $t_puesto = 88;
	$nombre = $nom1." ".$nom2." ".$ape1." ".$ape2;
	$nombre = utf8_encode($nombre);
	$t_pue = tiempo($t_puesto);

	
	$puesto_ant = $ClsPer->get_puestos($usuario);
	date_default_timezone_set('America/Guatemala');
		$dias= date("d");
		$mes= date("m");
		$annio = date("Y");
		$siguiente = $annio + 1;
		if ($mes == 6 or $mes == 7 or $mes == 8 or $mes == 9 or $mes == 10){
			$evaluacion = 1;
			$comp_eva = '1 - '.$annio;
		}else if($mes == 12){
			$evaluacion = 2;
			$comp_eva = '2 - '.$annio;
		}

		$total_sol = $ClsPer->comprueba_auto($usuario,$comp_eva,1);
		if($total_sol > 0){
			echo'<script>
				alert("ESTE CATALOGO YA TIENE BORRADOR REGISTRADO PARA EL PERIODO '.$comp_eva.'" );
				history.back()
				</script>';
			exit();
		}
		
?>
<!DOCTYPE html>
<html>
	<head>
		<?php		
			$xajax->printJavascript("..");
		?>
		<meta charset="utf-8" content="text/html;" http-equiv="content-type">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Evaluacion del des. 2</title>
		<link rel="shortcut icon" href="img/medallon.png" >
		<!--=============================LIBRERIAS DE BOOTSTRAP======================================-->
		<link href='../assets/css/bootstrap.css' rel='stylesheet'/>
		<link href='../assets/css/bootstrap-responsive.css' rel='stylesheet'/>
		<link href="../assets/css/docs.css" rel="stylesheet">
		<link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
		<style>
		#bg{
			position: center;
			z-index: -1;
			middle: 70;
			center: 40;
			width: 20%;
		
		}
		</style>
		<script>
		function trae_usuario(num){
			// var dep = document.getElementById('dep').value;
				if(num == 1){
					var cat_inmediato=document.getElementById('inmediato');
					xajax_Trae_Datos_Catalogo_inmediato(cat_inmediato.value);
				}else{
					var eva_final=document.getElementById('eva_final');
					xajax_Trae_Datos_Catalogo_comte(eva_final.value);
				}
		}
		
		
		function Grabar_formulario(){
			var evaluacion = document.getElementById('evaluacion').value;
			var linea = document.getElementById('linea').value;
			var destino = document.getElementById('destino').value;
			var autoevaluado = document.getElementById('autoevaluado').value;
			var inmediato = document.getElementById('inmediato').value;
			var eva_final = document.getElementById('eva_final').value;
			var codigo_arma1 = document.getElementById('codigo_arma1').value;
			var codigo_grado1 = document.getElementById('codigo_grado1').value;
			var empleo1 = document.getElementById('empleo1').value;
			var tiempo1 = document.getElementById('tiempo1').value;
			var codigo_arma2 = document.getElementById('codigo_arma2').value;
			var codigo_grado2 = document.getElementById('codigo_grado2').value;
			var empleo2 = document.getElementById('empleo2').value;
			var tiempo2 = document.getElementById('tiempo2').value;
			var codigo_arma3 = document.getElementById('codigo_arma3').value;
			var codigo_grado3 = document.getElementById('codigo_grado3').value;
			var empleo3 = document.getElementById('empleo3').value;
			var tiempo3 = document.getElementById('tiempo3').value;
			var puesto_ant = document.getElementById('puesto_ant').value;
			var dep = document.getElementById('dep').value;
			var renglon = document.getElementById('renglon').value;
			var tipo_evaluacion = document.getElementById('tipo_evaluacion').value;
			
			if(linea != "") {
					if(destino != "") {
						if(inmediato != "") {
							if(eva_final != "") {
								if(empleo1 != "") {
									if(tiempo1 != "") {
										if(puesto_ant != "") {
xajax_Grabar_borrador(evaluacion,linea,destino,autoevaluado,inmediato,eva_final,codigo_arma1,codigo_grado1,empleo1,tiempo1,codigo_arma2,codigo_grado2,empleo2,tiempo2,codigo_arma3,codigo_grado3,empleo3,tiempo3,puesto_ant,dep,renglon,tipo_evaluacion);
										}else{
										alert("Debe ingresar el puesto anterior!!!");
										foco('puesto_ant');
										}
									}else{
									alert("Debe ingresar el tiempo en el puesto!!!");
									foco('tiempo1');
									}
								}else{
								alert("Debe ingresar el empleo!!!");
								foco('empleo1');
								}
							}else{
							alert("Debe ingresar al evaluador final!!!");
							foco('eva_final');
							}
						}else{
							alert("Debe ingresar al evaluador inmediato !!!");
							foco('inmediato');
						}
					}else{
						alert("Debe de ingresar el destino actual !!!");
						foco('destino');
					}
			}else{
				alert("Debe ingresar la linea de carrera actual!!!");
				foco('linea');
			}
		}

		function foco(elemento){
			document.getElementById(elemento).focus();
		}
		
		function justNumbers(e){
			var keynum = window.event ? window.event.keyCode : e.which;
			if ((keynum == 8) || (keynum == 46))
			return true;
			 
			return /\d/.test(String.fromCharCode(keynum));
		}
		
		
		function CloseWindow(){
			window.location.assign("FrmBusca_catalogo.php");
		}
		
		
		function mayusculas(n){
				cadena = n.value;
				cadena = cadena.toUpperCase();
				band = false;
				for (i=0;i<cadena.length;i++){
					letra = cadena.substring(i,i + 1);
					if((letra == "'") || (letra == '"') || (letra == 'á') || (letra == 'é') || (letra == 'í') || (letra == 'ó') || (letra == 'ú') || (letra == '´') || (letra == '`') || (letra == 'Á') || (letra == 'É')|| (letra == 'Í')|| (letra == 'Ó')|| (letra == 'Ú') || (letra == 'à')|| (letra == 'è')|| (letra == 'ì')|| (letra == 'ò')|| (letra == 'ù')|| (letra == 'À')|| (letra == 'È')|| (letra == 'Ì')|| (letra == 'Ò')|| (letra == 'Ù')){
						cadena2 = cadena;
						cadena = cadena2.replace(letra,"");
						band = true;
					}
				}
				if(band == true){
					alert("No se permiten ingresar comillas simples o dobles, ni letras contildes u otro caracter desconocido...");
				}
				n.value = cadena;
				n.focus();	
		}
		</script>
	</head>
	<body>
		<div class='modal hide fade' id='alert_modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'></div>
		<!-- ============================================PERMISOS PARA EL ADMINISTRADOR ====================================================-->
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
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Vices/Jefes.Per<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_VJ/FrmBusca_catalogo.php">Generar borrador</a></li>
									<li><a href="../CP_VJ/Frm_auto.php">Calificar</a></li>
									<li><a href="../CP_VICES/Frm_inmediato.php">Evaluador Final</a></li>
									<li><a href="../CP_UL2/Frm_ul.php">Evaluaciones finalizadas</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Vices/Jefes.Per<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_VJ/FrmBusca_catalogo.php">Generar borrador</a></li>
									<li><a href="../CP_VJ/Frm_auto.php">Calificar</a></li>
									<li><a href="../CP_VICES/Frm_inmediato.php">Evaluador Final</a></li>
									<li><a href="../CP_UL2/Frm_ul.php">Evaluaciones finalizadas</a></li>
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
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Vi/Je.Per<b class="caret"></b></a>
								<ul class="dropdown-menu">
								<?php if($_SESSION['EVADESCOM'] == 1) {?>
									<li><a href="CP_VJ/FrmBusca_catalogo.php">Generar borrador</a></li>
									<li><a href="CP_VJ/Frm_auto.php">Calificar</a></li>
										<li><a href="CP_VICES/Frm_inmediato.php">Evaluador Final</a></li>
									<?php }?>
									<li><a href="CP_UL2/Frm_ul.php">Evaluaciones finalizadas</a></li>
								</ul>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dir. Min. <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="../CP_DIR/FrmBusca_catalogo.php">Generar borrador</a></li>
									<li><a href="../CP_DIR/Frm_auto.php">Calificar</a></li>
									<li><a href="../CP_DIR/Frm_ul.php">Evaluaciones finalizadas</a></li>
								</ul>
							</li>
							<li class="divider-vertical"></li>
							<li><a href="../CP_REPORTEADOR/Frm_ap.php">Aprobar</a></li>
							<li class="divider-vertical"></li>
						</ul>
						<ul class="nav pull-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<b class="caret"></b><i class='icon-user'></i></a>
								<ul class="dropdown-menu">
								<li><a href="../CP_EVALUACION/Frm_faltan.php" target='_blank'>Pendientes de efectuar evaluacion</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep.php">Reporte individual por periodo</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep1.php">Reporte individual por periodo Comtes. Jefes y Dir.</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_rep2.php">Por catalogo</a></li>
									<li><a href="../CP_REPORTEADOR/FrmBusca_dep.php">Por dependencias</a></li>
								</ul>
							</li>
						<?php }?>
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
	<div class='modal hide fade' id='alert_modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'></div>
	<br>
	<div class='container'>
	<div class="row-fluid">
		<div class="alert alert-info span12" align="center">
			<b>EVALUACION DEL DESEMPE&Ntilde;O LABORAL</b>
		</div>
	</div>	<br>
	<form accept-charset="UTF-8">
		<table  width='100%' border='1' >

		<div class='row-fluid'>
		<div class='span2'>
		<P class='pull-left'><smallint>EVALUACION</smallint></P>
		</div>
		<?php if($mes == 6 or $mes == 7 or $mes == 8 or $mes == 9 or $mes == 10){?>
			<div class='span2'>
				<input type = 'text' class='span12' name = 'evaluacion' id = 'evaluacion' value ='1 - <?php echo $annio; ?>' readonly></input> 
			</div>
		<?php }else if($mes == 12){?>
			<div class='span2'>
				<input type = 'text' class='span12' name = 'evaluacion' id = 'evaluacion' value ='2 - <?php echo $annio; ?>' readonly></input> 
			</div>
		<?php }?>
		
		<div class='span4'>
		</div>
		<div class='span2'>
		Seleccione renglon:
		</div>
		
		<?php //if($t_puesto >= 90){?>
		<select name="renglon" id="renglon" class = "span2">
			<option value="1" selected>NORMAL</option>
			<option value="2">RENGLON A-9</option>
			<option value="3">RENGLON A-10</option>
		</select>
		<?php// }else{?>
		<!--<select name="renglon" id="renglon" class = "span2" readonly>
			<option value="3" selected>RENGLON A-10</option>
		</select>-->
		<?php //}?>
		
		</div>
		
		<tr><th><h3><center>EJERCITO DE GUATEMALA</center></h3></th>
		<th><h3><center>DEPENDENCIA</br><?php echo $dep_desc; ?></center></h3></th></tr>
		</table>
		
		<input type='hidden' name='tipo_evaluacion' id='tipo_evaluacion' value='14'></input> <!--el TIPO 14 borrador y 15 final-->
		<input type='hidden' name='usuario' id='usuario' value='<?php echo $usuario1; ?>'></input>
		<input type='hidden' name='autoevaluado' id='autoevaluado' value='<?php echo $usuario; ?>'></input>
		<input type='hidden' name='codigo_arma1' id='codigo_arma1' value='<?php echo $codigo_arma1; ?>'></input>
		<!--<input type='hidden' name='empleo1' id='empleo1' value='<?php //echo $empleo; ?>'></input>
		<input type='hidden' name='tiempo1' id='tiempo1' value='<?php //echo $t_pue; ?>'></input>-->
		<?php //if($puesto_ant != "") {?>
		<!--<input type='hidden' name='puesto_ant' id='puesto_ant' value='<?php //echo $puesto_ant; ?>'></input>-->
		<?php //}else{?>
		<!--<input type='hidden' name='puesto_ant' id='puesto_ant' value='DESCONOCIDO'></input>-->
		<?php //}?>
		<input type='hidden' name='dep' id='dep' value='<?php echo $dependencia1; ?>'></input>
		<table width='100%' border='1' >
			<tr>
			<td>
			<table border='1' width='100%'>
			<tr>
			<td colspan='5'><strong><small>PARTE I. DATOS ADMINISTRATIVOS</small></strong></td>
			</tr>
			<tr>
			<td><center><strong><small>CATALOGO:<br><br></small></strong><?php echo $usuario; ?></center></td>
			<td><center><strong><small>NOMBRES Y APELLIDOS:<br><br></small></strong><?php echo  utf8_encode($nombre); ?></center></td>
			<td><center><strong><small>GRADO:<br><br></small></strong><?php echo combo_grados1(); ?></center></td>
			<td><center><strong><small>ARMA O SERVICIO:<br><br></small></strong><?php echo $arma; ?></center></td>
			<td><center><strong><small>LINEA DE CARRERA ACTUAL:<br></small></strong><?php echo combo_linea(); ?></center></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small>EMPLEO ACTUAL Y UNIDAD<br><br></small></strong><input type='text' class='span4' id='empleo1' placeholder='Empleo' value='<?php echo $empleo; ?>' onkeyup='mayusculas(this);'></input></center></td>
			<td><center><strong><small>TIEMPO EN EL EMPLEO ACTUAL<br><br></small></strong><input type='text' class='span2' id='tiempo1' placeholder='Empleo' value='<?php echo $t_pue; ?>' onkeyup='mayusculas(this);'></input></small></strong></center></td>
			<td><center><strong><small>EMPLEO ANTERIOR<br><br></small></strong><input type='text' class='span3' id='puesto_ant' placeholder='puesto ant' value='<?php if ($puesto_ant != ""){ echo $puesto_ant; }else{ $puesto_ant = "DESCONOCIDO"; echo $puesto_ant;}?>' onkeyup='mayusculas(this);'></input></center></td>
			<td><center><strong><small>DESTINO ACTUAL<br><br></small></strong><input type="text" id='destino' name='destino' class='span3' value='<?php echo $dep_desc; ?>' onkeyup='mayusculas(this);'></input></center></td>
			</tr>
			<tr>
			<td colspan='5'><strong><small>PARTE II. EVALUADORES</small></strong></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small>GRADO Y NOMBRE DEL EVALUADOR INMEDIATO</small></strong><br><input type='text' class='span3' id='nombre_inmediato' placeholder='Evaluador inmediato' readonly></input><?php echo combo_grados2(); ?><input type='hidden' name='codigo_arma2' id='codigo_arma2' value=''></input></center></td>
			<td><center><strong><small>CATALOGO</small></strong><br><input type="text" id='inmediato' onblur='trae_usuario(1);' name='inmediato' class='span2' placeholder='Catalogo...' maxlength='6' onkeypress="return justNumbers(event);"></input></center></td>
			<td><center><strong><small>EMPLEO</small></strong><br><input type='text' class='span3' id='empleo2' placeholder='Empleo' value='' onkeyup='mayusculas(this);'></input></center></td>
			<td><center><strong><small>TIEMPO EN EL EMPLEO</small></strong><br><input type='text' class='span3' id='tiempo2' placeholder='Tiempo/Puesto' value='' onkeyup='mayusculas(this);'></input></center></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small>GRADO Y NOMBRE DEL EVALUADOR FINAL</small></strong><br><input type='text' class='span3' id='nombre_comte' placeholder='Evaluador final' readonly></input><?php echo combo_grados3(); ?><input type='hidden' name='codigo_arma3' id='codigo_arma3' value=''></input></center></td>
			<td><center><strong><small>CATALOGO</small></strong><br><input type="text" id='eva_final' onblur='trae_usuario(2);' name='eva_final' class='span2' placeholder='Catalogo...' maxlength='6' onkeypress="return justNumbers(event);"></input></center></td>
			<td><center><strong><small>EMPLEO</small></strong><br><input type='text' class='span3' id='empleo3' placeholder='Empleo' value='' onkeyup='mayusculas(this);'></input></center></td>
			<td><center><strong><small>TIEMPO EN EL EMPLEO</small></strong><br><input type='text' class='span3' id='tiempo3' placeholder='Tiempo/Puesto' value='' onkeyup='mayusculas(this);'></input></center></td>
			</tr>
		</table>
		</table><br><br>
		<div align="center">
			&#32;<input class="btn btn-warning span3" type="reset" title="Limpiar" value="LIMPIAR BORRADOR" />
			&#32;<input class="btn btn-primary span3" type="button" title="Grabar" value="GRABAR BORRADOR" onclick="Grabar_formulario();"/> <!--onclick="Grabar_formulario();"-->
			</div>
		</form>
	</form>
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
		<script type="text/javascript" src="../../assets/js/widgets.js"></script>
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
