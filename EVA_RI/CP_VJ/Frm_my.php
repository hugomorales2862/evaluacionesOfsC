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
	$result = $ClsPer->get_personal_usuario1($usuario,$dependencia1);
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
				alert("ESTE CATALOGO YA TIENE AUTOEVALUACION REGISTRADA PARA EL PERIODO '.$comp_eva.'" );
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
			var dep = document.getElementById('dep').value;
				if(num == 1){
					var cat_inmediato=document.getElementById('inmediato');
					xajax_Trae_Datos_Catalogo_inmediato(cat_inmediato.value,dep);
				}else{
					var eva_final=document.getElementById('eva_final');
					xajax_Trae_Datos_Catalogo_comte(eva_final.value,dep);
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
			var obs_inmediato = document.getElementById('obs_inmediato').value;
			var obs_final = document.getElementById('obs_final').value;
			var tipo_evaluacion = document.getElementById('tipo_evaluacion').value;
			var usuario = document.getElementById('usuario').value;
			var obs = document.getElementById('obs').value;

			
			var preguntas = new Array();
			for(i = 1; i <= 20; i++){
				var porNombre=document.getElementsByName("pregunta"+i);
				for(var j=0;j<porNombre.length;j++)
				{
					if(porNombre[j].checked)
						resultado=porNombre[j].value;
					
				}
				preguntas[i] = resultado;
			}
			
			
			if(linea != "") {
					if(destino != "") {
						if(inmediato != "") {
							if(eva_final != "") {
xajax_Grabar_evaluacion(evaluacion,linea,destino,autoevaluado,inmediato,eva_final,codigo_arma1,codigo_grado1,empleo1,tiempo1,codigo_arma2,codigo_grado2,empleo2,tiempo2,codigo_arma3,codigo_grado3,empleo3,tiempo3,puesto_ant,dep,renglon,obs_inmediato,obs_final,tipo_evaluacion,preguntas,usuario,obs);
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
							<li class="divider-vertical"></li>
							<?php if($_SESSION['EVADESCOM'] == 1 and $dependencia1 <> 2010) {?>
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
							<?php }else if($_SESSION['EVADESCOM'] == 1 and $dependencia1 == 2010) {?>
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
		</div>
		
		<tr><th><h3><center>EJERCITO DE GUATEMALA</center></h3></th>
		<th><h3><center>DEPENDENCIA</br><?php echo $dep_desc; ?></center></h3></th></tr>
		</table>
		
		<input type='hidden' name='tipo_evaluacion' id='tipo_evaluacion' value='1'></input> <!--el TIPO 1 es autoevaluacion, 2 = inmediato, 3 = final-->
		<input type='hidden' name='usuario' id='usuario' value='<?php echo $usuario1; ?>'></input>
		<input type='hidden' name='autoevaluado' id='autoevaluado' value='<?php echo $usuario; ?>'></input>
		<input type='hidden' name='codigo_arma1' id='codigo_arma1' value='<?php echo $codigo_arma1; ?>'></input>
		<input type='hidden' name='codigo_grado1' id='codigo_grado1' value='<?php echo $codigo_grado1; ?>'></input>
		<input type='hidden' name='empleo1' id='empleo1' value='<?php echo $empleo; ?>'></input>
		<input type='hidden' name='tiempo1' id='tiempo1' value='<?php echo $t_pue; ?>'></input>
		<?php if($puesto_ant != "") {?>
		<input type='hidden' name='puesto_ant' id='puesto_ant' value='<?php echo $puesto_ant; ?>'></input>
		<?php }else{?>
		<input type='hidden' name='puesto_ant' id='puesto_ant' value='DESCONOCIDO'></input>
		<?php }?>
		<input type='hidden' name='dep' id='dep' value='<?php echo $dependencia1; ?>'></input>
		<?php if($t_puesto >= 90){ $variante = 1;?>
			<input type='hidden' name='renglon' id='renglon' value='1'></input>
		<?php }else{ $variante = 2;?>
			<input type='hidden' name='renglon' id='renglon' value='2'></input>
		<?php }?>
		<table width='100%' border='1' >
			<tr>
			<td>
			<table border='1' width='100%'>
			<tr>
			<td colspan='5'><strong><small>PARTE I. DATOS ADMINISTRATIVOS</small></strong></td>
			</tr>
			<tr>
			<td><center><strong><small>CATALOGO:<br><br></small></strong><?php echo $usuario; ?></center></td>
			<td><center><strong><small>NOMBRES Y APELLIDOS:<br><br></small></strong><?php echo $nombre; ?></center></td>
			<td><center><strong><small>GRADO:<br><br></small></strong><?php echo $grado; ?></center></td>
			<td><center><strong><small>ARMA O SERVICIO:<br><br></small></strong><?php echo $arma; ?></center></td>
			<td><center><strong><small>LINEA DE CARRERA ACTUAL:<br></small></strong><?php echo combo_linea(); ?></center></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small>EMPLEO ACTUAL Y UNIDAD<br><br></small></strong><?php echo $empleo; ?></center></td>
			<td><center><strong><small>TIEMPO EN EL EMPLEO ACTUAL<br><br></small></strong><?php echo $t_pue; ?></small></strong></center></td>
			<td><center><strong><small>EMPLEO ANTERIOR<br><br></small></strong><?php if ($puesto_ant != ""){ echo $puesto_ant; }else{ $puesto_ant = "DESCONOCIDO"; echo $puesto_ant;}?></center></td>
			<td><center><strong><small>DESTINO ACTUAL<br></small></strong><?php echo combo_destino(); ?></center></td>
			</tr>
			<tr>
			<td colspan='5'><strong><small>PARTE II. EVALUADORES</small></strong></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small>GRADO Y NOMBRE DEL EVALUADOR INMEDIATO</small></strong><br><input type='text' class='span5' id='nombre_inmediato' placeholder='Evaluador inmediato' readonly></input><input type='hidden' name='codigo_grado2' id='codigo_grado2' value=''></input><input type='hidden' name='codigo_arma2' id='codigo_arma2' value=''></input></center></td>
			<td><center><strong><small>CATALOGO</small></strong><br><input type="text" id='inmediato' onblur='trae_usuario(1);' name='inmediato' class='span2' placeholder='Catalogo...' maxlength='6' onkeypress="return justNumbers(event);"></input></center></td>
			<td><center><strong><small>EMPLEO</small></strong><br><input type='text' class='span2' id='empleo2' placeholder='Empleo' value='' readonly></input></center></td>
			<td><center><strong><small>TIEMPO EN EL EMPLEO</small></strong><br><input type='text' class='span2' id='tiempo2' placeholder='Tiempo/Puesto' value='' readonly></input></center></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small>GRADO Y NOMBRE DEL EVALUADOR FINAL</small></strong><br><input type='text' class='span5' id='nombre_comte' placeholder='Evaluador final' readonly></input><input type='hidden' name='codigo_grado3' id='codigo_grado3' value=''></input><input type='hidden' name='codigo_arma3' id='codigo_arma3' value=''></input></center></td>
			<td><center><strong><small>CATALOGO</small></strong><br><input type="text" id='eva_final' onblur='trae_usuario(2);' name='eva_final' class='span2' placeholder='Catalogo...' maxlength='6' onkeypress="return justNumbers(event);"></input></center></td>
			<td><center><strong><small>EMPLEO</small></strong><br><input type='text' class='span2' id='empleo3' placeholder='Empleo' value='' readonly></input></center></td>
			<td><center><strong><small>TIEMPO EN EL EMPLEO</small></strong><br><input type='text' class='span2' id='tiempo3' placeholder='Tiempo/Puesto' value='' readonly></input></center></td>
			</tr>
			<tr>
			<td colspan='5'><strong><small>PARTE III. AREAS DE DESEMPEÑO</small></strong></td>
			</tr>
			</table>
			<table border='1' width='100%'>
			<tr>
			<td><center><strong><small>No.<br><br><br></small></strong></center></td>
			<td><strong><small><center>FACTORES DE EVALUACION</center><br></small></strong>Seleccione la opcion en el calificativo que considere para cada uno de los numerales</td>
			<td><center><strong><small>Excelente<br><br><br></small></strong></center></td>
			<td><center><strong><small>Cumple<br><br><br></small></strong></center></td>
			<td><center><strong><small>Necesita<br> mejorar<br><br><br></small></strong></center></td>
			</tr>
			<?php if($variante == 1){?>
			<tr>
			<td colspan='5'><center><strong><small>DESEMPE&Ntilde;O LABORAL<br>Habilidades y cualidades  de la persona que se califican a traves de las funciones y tareas.</small></strong></center></td>
			</tr>
			<tr>
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>PRODUCCION Y CALIDAD DE TRABAJO:</b><br>Cantidad y calidad de trabajo ejecutado a nivel de excelencia buscando dar lo mejor de si mismo.</td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>CONOCIMIENTO DEL EMPLEO:</b><br>Nivel de conocimiento del empleo por medio de la experiencia, educacion, capacitacion y entrenamiento.</td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>TRABAJO EN EQUIPO:</b><br>Capacidad de integrarse a un grupo y aportar sus capacidades y habilidades para lograr cumplir objetivos y metas.</td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>TRABAJO BAJO PRESION:</b><br>Capacidad para responder en situaciones de presion o tension en el trabajo, para cumplir las tareas y responsabilidades encomendadas eficaz y eficientemente.</td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>PUNTUALIDAD:</b><br>Es la antelacion y preparacion en el cumplimiento de sus labores.</td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td colspan='5'><center><strong><small>CAPACIDADES ADMINISTRATIVAS<br>Habilidad que facilita la administracion de los recursos en el ejercicio de sus funciones.</small></strong></center></td>
			</tr>
			<tr>
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>ADMINISTRACION DE RECURSOS:</b><br>Capasidad de desarrollar el proceso de planear, organizar, dirigir y controlar el uso de los recursos con eficiencia y eficacia para cumplir con las tareas establecidas.</td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>COOPERACION:</b><br>Actitud hacia la institucion, la autoridad, los compa&ntilde;eros de trabajo y subalternos buscando realizar un trabajo en equipo enfocado en la vision y mision.</td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>SUPERVISION:</b><br>Accion positiva que se ejerce para controlar el fiel cumplimiento de las ordenes misiones y tareas asignadas.</td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>DESTREZA:</b><br>Capacidad en el manejo y conocimiento de los instrumentos de trabajo.</td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>EJECUCION:</b><br>Capacidad de llevbar a cabo las ordenes y cumplir los objetivos que se le dan sin equivocarse al seguir instrucciones, basado en la mistica militar y vocacion.</td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td colspan='5'><center><strong><small>APTITUDES MILITARES<br>Capacidad para realizar las funciones y tareas especificas en el servicio militar.</small></strong></center></td>
			</tr>
			<tr>
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>INICIATIVA:</b><br>Aporte y desarrollo de ideas creativas y constructivas para solucion de situaciones imprevistas.</td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>ABNEGACION:</b><br>Aptitud consistente en el sacrificio espontaneo de la voluntad, interes, deseos y aun de la propia vida, en cumplimiento de la mision.</td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>PORTE:</b><br>Capacidad de presentacion personal, en comportamiento y apariencia, coincidentes con las normas militares y sociales.</td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>LIDERAZGO:</b><br>Habilidad de persuadir y dirigir al personal subalterno, de tal manera que se obtenga su obediencia, confianza, el respeto, lealtad, cooperacion voluntaria con el fin de cumplir la mision.</td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>ESPIRITU DE CUERPO:</b><br>Es lealtad, orgullo y entusiasmo que sienten los individuos de pertenecer a su unidad.</td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td colspan='5'><center><strong><small>CUALIDADES PERSONALES<br>Caracteristicas individuales necesarias para el buen desempeño del puesto.</small></strong></center></td>
			</tr>
			<tr>
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>TOMA DE DECISIONES:</b><br>Capacidad de resolucion definitiva y oportuna a problemas asociados al ejercicio de sus funciones con juicio y criterio, sin rehuir responsabilidades asociadas a la decision.</td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>RELACIONES INTERPERSONALES:</b><br>Considera el trato, respeto y comunicacion hacia superiores, subalternos y compa&ntilde;eros.</td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>RESPONSABILIDAD:</b><br>Capacidad para cumplir las tareas y responsabilidades inherentes al grado y funcion, con dedicacion, puntualidad y observando los plazos establecidos.</td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>COMPROMISO:</b><br>Ponel al maximo su capacidad para sacar toda tarea que le sea confiada con dedicacion y esmero.</td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="0.1" checked></center></td>
			</tr>
			<tr>
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>CRITERIO:</b><br>Facultad que se tiene para comprender algo o formar una opinion.</td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="0.5"></center></td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="0.3"></center></td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="0.1" checked></center></td>
			</tr>
			<?php }else if($variante == 2){ ?>
			<tr>
			<td colspan='5'><center><strong><small>DESEMPE&Ntilde;O LABORAL<br>Habilidades y cualidades  de la persona que se califican a traves de las funciones y tareas.</small></strong></center></td>
			</tr>
			<tr>
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>PRODUCCION Y CALIDAD DE TRABAJO:</b><br>Cantidad y calidad de trabajo ejecutado a nivel de excelencia buscando dar lo mejor de si mismo.</td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="0.5"checked disabled></center></td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="0.3" disabled ></center></td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="0.1" disabled ></center></td>
			</tr>
			<tr>
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>CONOCIMIENTO DEL EMPLEO:</b><br>Nivel de conocimiento del empleo por medio de la experiencia, educacion, capacitacion y entrenamiento.</td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>TRABAJO EN EQUIPO:</b><br>Capacidad de integrarse a un grupo y aportar sus capacidades y habilidades para lograr cumplir objetivos y metas.</td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>TRABAJO BAJO PRESION:</b><br>Capacidad para responder en situaciones de presion o tension en el trabajo, para cumplir las tareas y responsabilidades encomendadas eficaz y eficientemente.</td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>PUNTUALIDAD:</b><br>Es la antelacion y preparacion en el cumplimiento de sus labores.</td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="0.5"checked disabled></center></td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td colspan='5'><center><strong><small>CAPACIDADES ADMINISTRATIVAS<br>Habilidad que facilita la administracion de los recursos en el ejercicio de sus funciones.</small></strong></center></td>
			</tr>
			<tr>
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>ADMINISTRACION DE RECURSOS:</b><br>Capasidad de desarrollar el proceso de planear, organizar, dirigir y controlar el uso de los recursos con eficiencia y eficacia para cumplir con las tareas establecidas.</td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="0.1"disabled ></center></td>
			</tr>
			<tr>
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>COOPERACION:</b><br>Actitud hacia la institucion, la autoridad, los compa&ntilde;eros de trabajo y subalternos buscando realizar un trabajo en equipo enfocado en la vision y mision.</td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>SUPERVISION:</b><br>Accion positiva que se ejerce para controlar el fiel cumplimiento de las ordenes misiones y tareas asignadas.</td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>DESTREZA:</b><br>Capacidad en el manejo y conocimiento de los instrumentos de trabajo.</td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>EJECUCION:</b><br>Capacidad de llevbar a cabo las ordenes y cumplir los objetivos que se le dan sin equivocarse al seguir instrucciones, basado en la mistica militar y vocacion.</td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td colspan='5'><center><strong><small>APTITUDES MILITARES<br>Capacidad para realizar las funciones y tareas especificas en el servicio militar.</small></strong></center></td>
			</tr>
			<tr>
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>INICIATIVA:</b><br>Aporte y desarrollo de ideas creativas y constructivas para solucion de situaciones imprevistas.</td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>ABNEGACION:</b><br>Aptitud consistente en el sacrificio espontaneo de la voluntad, interes, deseos y aun de la propia vida, en cumplimiento de la mision.</td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>PORTE:</b><br>Capacidad de presentacion personal, en comportamiento y apariencia, coincidentes con las normas militares y sociales.</td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>LIDERAZGO:</b><br>Habilidad de persuadir y dirigir al personal subalterno, de tal manera que se obtenga su obediencia, confianza, el respeto, lealtad, cooperacion voluntaria con el fin de cumplir la mision.</td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>ESPIRITU DE CUERPO:</b><br>Es lealtad, orgullo y entusiasmo que sienten los individuos de pertenecer a su unidad.</td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td colspan='5'><center><strong><small>CUALIDADES PERSONALES<br>Caracteristicas individuales necesarias para el buen desempeño del puesto.</small></strong></center></td>
			</tr>
			<tr>
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>TOMA DE DECISIONES:</b><br>Capacidad de resolucion definitiva y oportuna a problemas asociados al ejercicio de sus funciones con juicio y criterio, sin rehuir responsabilidades asociadas a la decision.</td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>RELACIONES INTERPERSONALES:</b><br>Considera el trato, respeto y comunicacion hacia superiores, subalternos y compa&ntilde;eros.</td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>RESPONSABILIDAD:</b><br>Capacidad para cumplir las tareas y responsabilidades inherentes al grado y funcion, con dedicacion, puntualidad y observando los plazos establecidos.</td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>COMPROMISO:</b><br>Ponel al maximo su capacidad para sacar toda tarea que le sea confiada con dedicacion y esmero.</td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="0.1" disabled></center></td>
			</tr>
			<tr>
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>CRITERIO:</b><br>Facultad que se tiene para comprender algo o formar una opinion.</td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="0.5" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="0.3" disabled></center></td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="0.1" disabled></center></td>
			</tr>
			<?php }?>
			</table>
			</td>
			</tr>
			<tr>
			<td><b>OBSERVACIONES:</center></b></br>
			<?php if($t_puesto >= 90){ ?>
			<textarea class='form-control span12' name='obs' id='obs' rows='2' onkeyup='mayusculas(this);'  value='' placeholder='AGREGUE OBSERVACIONES'></textarea>
			<?php }else{ ?>
				<textarea class='form-control span12' name='obs' id='obs' rows='2' onkeyup='mayusculas(this);'  value='' placeholder='AGREGUE OBSERVACIONES'>ARTICULO 10 DE LA NORMATIVA DE CLASIFICACION Y EVALUACION.</textarea>
			<?php } ?>
			<input type='hidden' name='bol_desc_empleo' id='bol_desc_empleo' value="">
			</tr>
			<tr>
			<td colspan='5'><center><strong><small>CONCEPTO DE LOS EVALUADORES</center><br>En este espacio cada evaluador describira un concepto sobre el desempeño del evaluado.</small></strong></td>
			</tr>
			<tr>
			<td><b>EVALUADOR INMEDIATO:</center></b></br>
			<textarea class='form-control span12' name='obs_inmediato' id='obs_inmediato' rows='2' onkeyup='mayusculas(this);'  value='' placeholder='AGREGUE OBSERVACIONES' readonly></textarea>
			<input type='hidden' name='bol_desc_empleo' id='bol_desc_empleo' value="">
			</tr>	
			<tr>	
			<td><b>EVALUADOR FINAL:</center></b></br>
			<textarea class='form-control span12' name='obs_final' id='obs_final' rows='2' onkeyup='mayusculas(this);'  value='' placeholder='AGREGUE OBSERVACIONES' readonly></textarea>
			<input type='hidden' name='bol_desc_empleo' id='bol_desc_empleo' value="">
			</tr>	
		</table><br>
		<div align="center">
			&#32;<input class="btn btn-warning span3" type="reset" title="Limpiar" value="LIMPIAR EVALUACION" />
			&#32;<input class="btn btn-primary span3" type="button" title="Grabar" value="GRABAR EVALUACION" onclick="Grabar_formulario();"/> <!--onclick="Grabar_formulario();"-->
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
