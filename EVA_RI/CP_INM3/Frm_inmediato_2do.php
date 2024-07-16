<?php
include_once('../html_fns.php');
include_once("xajax_fns_my.php");
	$eva = $_REQUEST['eva'];
	$sit = $_REQUEST['sit'];
	session_start();
	$dependencia1 = $_SESSION['dep_cod']; 
	$usuario1 = $_SESSION['auth_user'];
	$plaza1 = $_SESSION['org_plaza'];
	$dep_desc = $_SESSION['dep_desc'];
	
	
	
	$ClsPer = new ClsPersonal();
	$result = $ClsPer->get_eva($eva);
	foreach ($result as $row){
		$usuario = $row['EVA_CAT1'];
		$linea = $row['EVA_LINEA'];
		$dest = $row['EVA_DEST_ACTUAL'];
		$cat2 = $row['EVA_CAT2'];
		$cat3 = $row['EVA_CAT3'];
		$emp1 = $row['EVA_EMPLEO1'];
		$emp2 = $row['EVA_EMPLEO2'];
		$emp3 = $row['EVA_EMPLEO3'];
		$tie1 = $row['EVA_TIEMPO1'];
		$tie2 = $row['EVA_TIEMPO2'];
		$tie3 = $row['EVA_TIEMPO3'];
		$e_ant = $row['EVA_EMP_ANT'];
		$gra11 = $row['EVA_GRADO1'];
		$gra21 = $row['EVA_GRADO2'];
		$gra31 = $row['EVA_GRADO3'];
		$ar11 = $row['EVA_ARMA1'];
		$ar21 = $row['EVA_ARMA2'];
		$ar31 = $row['EVA_ARMA3'];
		$renglon = $row['EVA_RENGLON'];
		$obs_inm = $row['EVA_OBS_INM'];
		$obs_mia = $row['EVA_OBS'];
	}
	// $renglon = 2;
	$tie1 = utf8_encode($tie1);
	$tie2 = utf8_encode($tie2);
	$tie3 = utf8_encode($tie3);
	$obs_inm = utf8_encode($obs_inm);
	$obs_mia = utf8_encode($obs_mia);
	
	$gra1 = $ClsPer->trae_grados($gra11,1);
	$gra2 = $ClsPer->trae_grados($gra21,2);
	$gra3 = $ClsPer->trae_grados($gra31,2);
	$ar1 = $ClsPer->trae_armas($ar11,1);
	$ar2 = $ClsPer->trae_armas($ar21,2);
	$ar3 = $ClsPer->trae_armas($ar31,2);
	
	$result4 = $ClsPer->get_personal_usuario($cat2);
		foreach ($result4 as $row){
			$nom_inm1 = $row['PER_NOM1'];
			$nom_inm2 = $row['PER_NOM2'];
			$ape_inm1 = $row['PER_APE1'];
			$ape_inm2 = $row['PER_APE2'];
		}
		if ($gra21 == 46 || $gra21 == 59 || $gra21 == 65 || $gra21 == 73 || $gra21 == 81 || $gra21 == 88 || $gra21 == 92 || $gra21 == 93 || $gra21 == 96 || $gra21 == 97 || $gra21 == 99 || $gra21 == 40){
			$nombre_inmediato = $gra2." ".$nom_inm1." ".$nom_inm2." ".$ape_inm1." ".$ape_inm2;
		}else{
			$nombre_inmediato = $gra2." ".$ar2." ".$nom_inm1." ".$nom_inm2." ".$ape_inm1." ".$ape_inm2;
		}
		
		
		$result5 = $ClsPer->get_personal_usuario($cat3);
		foreach ($result5 as $row){
			$nom_fin11 = $row['PER_NOM1'];
			$nom_fin21 = $row['PER_NOM2'];
			$ape_fin11 = $row['PER_APE1'];
			$ape_fin21 = $row['PER_APE2'];
		}
		if ($gra31 == 46 || $gra31 == 59 || $gra31 == 65 || $gra31 == 73 || $gra31 == 81 || $gra31 == 88 || $gra31 == 92 || $gra31 == 93 || $gra31 == 96 || $gra31 == 97 || $gra31 == 99 || $gra31 == 40){
			$nombre_fin = $gra3." ".$nom_fin11." ".$nom_fin21." ".$ape_fin11." ".$ape_fin21;
		}else{
			$nombre_fin = $gra3." ".$ar3." ".$nom_fin11." ".$nom_fin21." ".$ape_fin11." ".$ape_fin21;
		}
	
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
	$nombre = $nom1." ".$nom2." ".$ape1." ".$ape2;
	$t_pue = tiempo($t_puesto);
	
	$result1 = $ClsPer->trae_comandante_comando($dependencia1);
		foreach ($result1 as $row){
			$catalago_comte = $row['PER_CATALOGO'];
		}
	
	
	$puesto_ant = $ClsPer->get_puestos($usuario);
?>
<?php include_once('../fecha.php'); ?>
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
		function Grabar_formulario(){
			var cod_eva = document.getElementById('cod_eva').value;
			var tipo_evaluacion = document.getElementById('tipo_evaluacion').value;
			//alert(tipo_evaluacion);
			var usuario = document.getElementById('usuario').value;
			var autoevaluado = document.getElementById('autoevaluado').value;
			var obs_inmediato = document.getElementById('obs_inmediato').value;
			var obs = document.getElementById('obs').value;
			var obs_final = document.getElementById('obs_final').value;
			// alert(obs_inmediato);
			// alert(obs_final);
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
			
			
			if(cod_eva != "") {
					xajax_Grabar_evaluacion(cod_eva,tipo_evaluacion,preguntas,usuario,obs_inmediato,obs_final,obs,autoevaluado);
			}else{
				alert("Ocurrio un error de conexion");
				window.location.assign("../CP_ULS/Frm_finales2do.php");
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
		
		
		function CloseWindow(num){
			if(num == 1){
				window.location.assign("../CP_ULS/Frm_finales2do.php");
			}else{
				window.location.assign("../CP_ULS/Frm_finales2do.php");
			}
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
	
	<?php include_once('../menu_iclude.php'); ?>

	<div class='modal hide fade' id='alert_modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'></div>
	</div>
	
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
		<?php if($mes == 5 or $mes == 6 or $mes == 7){?>
			<div class='span2'>
				<input type = 'text' class='span12' name = 'evaluacion' id = 'evaluacion' value ='1 - <?php echo $annio; ?>' readonly></input> 
			</div>
		<?php }else if($mes == 11 or $mes == 12 or $mes == 1 ){?>
			<div class='span2'>
				<input type = 'text' class='span12' name = 'evaluacion' id = 'evaluacion' value ='2 - <?php echo $annio; ?>' readonly></input> 
			</div>
		<?php }?>
		
		<div class='span4'>
		</div>
		<div class='span2'>
		
		</div>
		
		<?php if($t_puesto >= 90){?>
			<?php if($renglon == 1){ ?>
			<select name="renglon" id="renglon" class = "span2" disabled>
				<option value="1" selected>NORMAL</option>
				<option value="2">RENGLON A-9</option>
				<option value="3">RENGLON A-10</option>
				</select>
			<?php } else if($renglon == 2){ ?>
			<select name="renglon" id="renglon" class = "span2"disabled>
				<option value="1">NORMAL</option>
				<option value="2" selected>RENGLON A-9</option>
				<option value="3">RENGLON A-10</option>
				</select>
			<?php } else if($renglon == 3){ ?>
			<select name="renglon" id="renglon" class = "span2"disabled>
				<option value="1">NORMAL</option>
				<option value="2">RENGLON A-9</option>
				<option value="3" selected>RENGLON A-10</option>
				</select>
			<?php } ?>
		<?php }else{?>
		<select name="renglon" id="renglon" class = "span2" disabled>
			<option value="3" selected>RENGLON A-10</option>
		</select>
		<?php }?>
		
		</div>
		
		<tr ><th><h3><center>EJERCITO DE GUATEMALA</center></h3></th>
		<th><h3><center>DEPENDENCIA</br><?php echo $dep_desc; ?></center></h3></th></tr>
		</table>
		
		<input type='hidden' name='cod_eva' id='cod_eva' value='<?php echo $eva; ?>'></input> <!--codigo de la evaluacion que se esta evaluando por el jefe inmediato-->
		<input type='hidden' name='tipo_evaluacion' id='tipo_evaluacion' value='<?php echo $sit; ?>'></input> <!--el TIPO 1 es autoevaluacion, 2 = inmediato, 3 = final-->
		<input type='hidden' name='autoevaluado' id='autoevaluado' value='<?php echo $usuario; ?>'></input>
		<input type='hidden' name='codigo_arma1' id='codigo_arma1' value='<?php echo $codigo_arma1; ?>'></input>
		<input type='hidden' name='codigo_grado1' id='codigo_grado1' value='<?php echo $codigo_grado1; ?>'></input>
		<input type='hidden' name='empleo1' id='empleo1' value='<?php echo $empleo; ?>'></input>
		<input type='hidden' name='tiempo1' id='tiempo1' value='<?php echo $t_pue; ?>'></input>
		<input type='hidden' name='puesto_ant' id='puesto_ant' value='<?php echo $puesto_ant; ?>'></input>
		<input type='hidden' name='dep' id='dep' value='<?php echo $dependencia1; ?>'></input>
		<input type='hidden' name='usuario' id='usuario' value='<?php echo $usuario1; ?>'></input>
		<table width='100%' border='1' >
			<tr >
			<td>
			<table border='1' width='100%'>
			<tr >
			<td colspan='5'><strong><small>PARTE I. DATOS ADMINISTRATIVOS</small></strong></td>
			</tr>
			<tr>
			<td><center><strong><small>CATALOGO:<br><br></small></strong><?php echo $usuario; ?></center></td>
			<td><center><strong><small>NOMBRES Y APELLIDOS:<br><br></small></strong><?php echo utf8_encode($nombre); ?></center></td>
			<td><center><strong><small>GRADO:<br><br></small></strong><?php echo $gra1; ?></center></td>
			<td><center><strong><small>ARMA O SERVICIO:<br><br></small></strong><?php echo $ar1; ?></center></td>
			<td><center><strong><small>LINEA DE CARRERA ACTUAL:<br></small></strong><?php echo combo_linea($linea); ?></center></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small>EMPLEO ACTUAL Y UNIDAD<br><br></small></strong><?php echo $emp1; ?></center></td>
			<td><center><strong><small>TIEMPO EN EL EMPLEO ACTUAL<br><br></small></strong><?php echo $tie1; ?></small></strong></center></td>
			<td><center><strong><small>EMPLEO ANTERIOR<br><br></small></strong><?php echo $e_ant; ?></center></td>
			<td><center><strong><small>DESTINO ACTUAL<br><br></small></strong><?php echo $dest; ?></center></td>
			</tr>
			<tr>
			<td colspan='5'><strong><small>PARTE II. EVALUADORES</small></strong></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small>GRADO Y NOMBRE DEL EVALUADOR INMEDIATO</small></strong><br><br><?php echo utf8_encode($nombre_inmediato); ?><input type='hidden' name='codigo_grado2' id='codigo_grado2' value=''></input><input type='hidden' name='codigo_arma2' id='codigo_arma2' value=''></input></center></td>
			<td><center><strong><small>CATALOGO</small></strong><br><br><?php echo $cat2; ?></center></td>
			<td><center><strong><small>EMPLEO</small></strong><br><br><?php echo $emp2; ?></center></td>
			<td><center><strong><small>TIEMPO EN EL EMPLEO</small></strong><br><br><?php echo $tie2; ?></center></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small>GRADO Y NOMBRE DEL EVALUADOR FINAL</small></strong><br><br><?php echo utf8_encode($nombre_fin); ?><input type='hidden' name='codigo_grado3' id='codigo_grado3' value=''></input><input type='hidden' name='codigo_arma3' id='codigo_arma3' value=''></input></center></td>
			<td><center><strong><small>CATALOGO</small></strong><br><br><?php echo $cat3; ?></center></td>
			<td><center><strong><small>EMPLEO</small></strong><br><br><?php echo $emp3; ?></center></td>
			<td><center><strong><small>TIEMPO EN EL EMPLEO</small></strong><br><br><?php echo $tie3; ?></center></td>
			</tr>
			<tr>
			<td colspan='5'><strong><small>PARTE III. AREAS DE DESEMPEÑO</small></strong></td>
			</tr>
			</table>
			<table border='1' width='100%'>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>No.<br><br><br></small></strong></center></td>
			<td><strong><small><center>FACTORES DE EVALUACION</center><br></small></strong>Seleccione la opcion en el calificativo que considere para cada uno de los numerales</td>
			<td><center><strong><small>Excede<br><br><br></small></strong></center></td>
			<td><center><strong><small>Cumple<br><br><br></small></strong></center></td>
			<td><center><strong><small>Necesita<br> mejorar<br><br><br></small></strong></center></td>
			</tr>
			<?php if($renglon == 1){?>
			<tr bgcolor="#F7DC6F">
			<td colspan='5'><center><strong><small>DESEMPE&Ntilde;O LABORAL<br>Habilidades y cualidades  de la persona que se califican a traves de las funciones y tareas.</small></strong></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>PRODUCCION Y CALIDAD DE TRABAJO:</b><br>Cantidad y calidad de trabajo ejecutado a nivel de excelencia buscando dar lo mejor de si mismo.</td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="5"></center></td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="3"></center></td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>CONOCIMIENTO DEL EMPLEO:</b><br>Nivel de conocimiento del empleo por medio de la experiencia, educacion, capacitacion y entrenamiento.</td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="5"></center></td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="3"></center></td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>TRABAJO EN EQUIPO:</b><br>Capacidad de integrarse a un grupo y aportar sus capacidades y habilidades para lograr cumplir objetivos y metas.</td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="5"></center></td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="3"></center></td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>TRABAJO BAJO PRESION:</b><br>Capacidad para responder en situaciones de presion o tension en el trabajo, para cumplir las tareas y responsabilidades encomendadas eficaz y eficientemente.</td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="5"></center></td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="3"></center></td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>PUNTUALIDAD:</b><br>Es la antelacion y preparacion en el cumplimiento de sus labores.</td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="5"></center></td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="3"></center></td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td colspan='5'><center><strong><small>CAPACIDADES ADMINISTRATIVAS<br>Habilidad que facilita la administracion de los recursos en el ejercicio de sus funciones.</small></strong></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>ADMINISTRACION DE RECURSOS:</b><br>Capacidad de desarrollar el proceso de planear, organizar, dirigir y controlar el uso de los recursos con eficiencia y eficacia para cumplir con las tareas establecidas.</td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="5"></center></td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="3"></center></td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>COOPERACION:</b><br>Actitud hacia la institucion, la autoridad, los compa&ntilde;eros de trabajo y subalternos buscando realizar un trabajo en equipo enfocado en la vision y mision.</td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="5"></center></td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="3"></center></td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>SUPERVISION:</b><br>Accion positiva que se ejerce para controlar el fiel cumplimiento de las ordenes misiones y tareas asignadas.</td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="5"></center></td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="3"></center></td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>DESTREZA:</b><br>Capacidad en el manejo y conocimiento de los instrumentos de trabajo.</td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="5"></center></td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="3"></center></td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>EJECUCION:</b><br>Capacidad de llevar a cabo las ordenes y cumplir los objetivos que se le dan sin equivocarse al seguir instrucciones, basado en la mistica militar y vocacion.</td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="5"></center></td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="3"></center></td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td colspan='5'><center><strong><small>APTITUDES MILITARES<br>Capacidad para realizar las funciones y tareas especificas en el servicio militar.</small></strong></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>INICIATIVA:</b><br>Aporte y desarrollo de ideas creativas y constructivas para solucion de situaciones imprevistas.</td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="5"></center></td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="3"></center></td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>ABNEGACION:</b><br>Aptitud consistente en el sacrificio espontaneo de la voluntad, interes, deseos y aun de la propia vida, en cumplimiento de la mision.</td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="5"></center></td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="3"></center></td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>PORTE:</b><br>Capacidad de presentacion personal, en comportamiento y apariencia, coincidentes con las normas militares y sociales.</td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="5"></center></td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="3"></center></td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>LIDERAZGO:</b><br>Habilidad de persuadir y dirigir al personal subalterno, de tal manera que se obtenga su obediencia, confianza, el respeto, lealtad, cooperacion voluntaria con el fin de cumplir la mision.</td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="5"></center></td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="3"></center></td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>ESPIRITU DE CUERPO:</b><br>Es lealtad, orgullo y entusiasmo que sienten los individuos de pertenecer a su unidad.</td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="5"></center></td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="3"></center></td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td colspan='5'><center><strong><small>CUALIDADES PERSONALES<br>Caracteristicas individuales necesarias para el buen desempeño del puesto.</small></strong></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>TOMA DE DECISIONES:</b><br>Capacidad de resolucion definitiva y oportuna a problemas asociados al ejercicio de sus funciones con juicio y criterio, sin rehuir responsabilidades asociadas a la decision.</td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="5"></center></td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="3"></center></td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>RELACIONES INTERPERSONALES:</b><br>Considera el trato, respeto y comunicacion hacia superiores, subalternos y compa&ntilde;eros.</td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="5"></center></td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="3"></center></td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>RESPONSABILIDAD:</b><br>Capacidad para cumplir las tareas y responsabilidades inherentes al grado y funcion, con dedicacion, puntualidad y observando los plazos establecidos.</td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="5"></center></td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="3"></center></td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>COMPROMISO:</b><br>Poner al maximo su capacidad para sacar toda tarea que le sea confiada con dedicacion y esmero.</td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="5"></center></td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="3"></center></td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="1" checked></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>CRITERIO:</b><br>Facultad que se tiene para comprender algo o formar una opinion.</td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="5"></center></td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="3"></center></td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="1" checked></center></td>
			</tr>
			<?php }else if($renglon == 2 or $renglon == 3){ ?>
			<tr bgcolor="#F7DC6F">
			<td colspan='5'><center><strong><small>DESEMPE&Ntilde;O LABORAL<br>Habilidades y cualidades  de la persona que se califican a traves de las funciones y tareas.</small></strong></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>PRODUCCION Y CALIDAD DE TRABAJO:</b><br>Cantidad y calidad de trabajo ejecutado a nivel de excelencia buscando dar lo mejor de si mismo.</td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="0"checked disabled></center></td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="0" disabled ></center></td>
			<td><center><input type="radio" name="pregunta1" id="pregunta1" value="0" disabled ></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>CONOCIMIENTO DEL EMPLEO:</b><br>Nivel de conocimiento del empleo por medio de la experiencia, educacion, capacitacion y entrenamiento.</td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta2" id="pregunta2" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>TRABAJO EN EQUIPO:</b><br>Capacidad de integrarse a un grupo y aportar sus capacidades y habilidades para lograr cumplir objetivos y metas.</td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta3" id="pregunta3" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>TRABAJO BAJO PRESION:</b><br>Capacidad para responder en situaciones de presion o tension en el trabajo, para cumplir las tareas y responsabilidades encomendadas eficaz y eficientemente.</td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta4" id="pregunta4" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>PUNTUALIDAD:</b><br>Es la antelacion y preparacion en el cumplimiento de sus labores.</td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="0"checked disabled></center></td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta5" id="pregunta5" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td colspan='5'><center><strong><small>CAPACIDADES ADMINISTRATIVAS<br>Habilidad que facilita la administracion de los recursos en el ejercicio de sus funciones.</small></strong></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>ADMINISTRACION DE RECURSOS:</b><br>Capacidad de desarrollar el proceso de planear, organizar, dirigir y controlar el uso de los recursos con eficiencia y eficacia para cumplir con las tareas establecidas.</td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta6" id="pregunta6" value="0"disabled ></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>COOPERACION:</b><br>Actitud hacia la institucion, la autoridad, los compa&ntilde;eros de trabajo y subalternos buscando realizar un trabajo en equipo enfocado en la vision y mision.</td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta7" id="pregunta7" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>SUPERVISION:</b><br>Accion positiva que se ejerce para controlar el fiel cumplimiento de las ordenes misiones y tareas asignadas.</td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta8" id="pregunta8" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>DESTREZA:</b><br>Capacidad en el manejo y conocimiento de los instrumentos de trabajo.</td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta9" id="pregunta9" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>EJECUCION:</b><br>Capacidad de llevar a cabo las ordenes y cumplir los objetivos que se le dan sin equivocarse al seguir instrucciones, basado en la mistica militar y vocacion.</td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta10" id="pregunta10" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td colspan='5'><center><strong><small>APTITUDES MILITARES<br>Capacidad para realizar las funciones y tareas especificas en el servicio militar.</small></strong></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>INICIATIVA:</b><br>Aporte y desarrollo de ideas creativas y constructivas para solucion de situaciones imprevistas.</td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta11" id="pregunta11" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>ABNEGACION:</b><br>Aptitud consistente en el sacrificio espontaneo de la voluntad, interes, deseos y aun de la propia vida, en cumplimiento de la mision.</td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta12" id="pregunta12" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>PORTE:</b><br>Capacidad de presentacion personal, en comportamiento y apariencia, coincidentes con las normas militares y sociales.</td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta13" id="pregunta13" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>LIDERAZGO:</b><br>Habilidad de persuadir y dirigir al personal subalterno, de tal manera que se obtenga su obediencia, confianza, el respeto, lealtad, cooperacion voluntaria con el fin de cumplir la mision.</td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta14" id="pregunta14" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>ESPIRITU DE CUERPO:</b><br>Es lealtad, orgullo y entusiasmo que sienten los individuos de pertenecer a su unidad.</td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta15" id="pregunta15" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td colspan='5'><center><strong><small>CUALIDADES PERSONALES<br>Caracteristicas individuales necesarias para el buen desempeño del puesto.</small></strong></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>1.</small></strong></center></td>
			<td><b>TOMA DE DECISIONES:</b><br>Capacidad de resolucion definitiva y oportuna a problemas asociados al ejercicio de sus funciones con juicio y criterio, sin rehuir responsabilidades asociadas a la decision.</td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta16" id="pregunta16" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>2.</small></strong></center></td>
			<td><b>RELACIONES INTERPERSONALES:</b><br>Considera el trato, respeto y comunicacion hacia superiores, subalternos y compa&ntilde;eros.</td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta17" id="pregunta17" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>3.</small></strong></center></td>
			<td><b>RESPONSABILIDAD:</b><br>Capacidad para cumplir las tareas y responsabilidades inherentes al grado y funcion, con dedicacion, puntualidad y observando los plazos establecidos.</td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta18" id="pregunta18" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>4.</small></strong></center></td>
			<td><b>COMPROMISO:</b><br>Poner al maximo su capacidad para sacar toda tarea que le sea confiada con dedicacion y esmero.</td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta19" id="pregunta19" value="0" disabled></center></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><center><strong><small>5.</small></strong></center></td>
			<td><b>CRITERIO:</b><br>Facultad que se tiene para comprender algo o formar una opinion.</td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="0" checked disabled></center></td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="0" disabled></center></td>
			<td><center><input type="radio" name="pregunta20" id="pregunta20" value="0" disabled></center></td>
			</tr>
			<?php }?>
			
			</table>
			</td>
			</tr>
			<tr >
			<td><b>OBSERVACIONES:</center></b></br>
			<textarea class='form-control span12' name='obs' id='obs' rows='2' onkeyup='mayusculas(this);'  value='' placeholder='AGREGUE OBSERVACIONES'readonly><?php echo $obs_mia; ?></textarea>
			</tr>
			<tr>
			<td colspan='5'><center><strong><small>CONCEPTO DE LOS EVALUADORES</center><br>En este espacio cada evaluador describira un concepto sobre el desempeño del evaluado.</small></strong></td>
			</tr>
			<tr bgcolor="#F7DC6F">
			<td><b>EVALUADOR INMEDIATO:</center></b></br>
			
			<textarea class='form-control span12' name='obs_inmediato' id='obs_inmediato' rows='2' onkeyup='mayusculas(this);'  value='' placeholder='AGREGUE OBSERVACIONES'></textarea>
			</tr>	
			<tr >
			<td><b>EVALUADOR FINAL:</center></b></br>
				<textarea class='form-control span12' name='obs_final' id='obs_final' rows='2' onkeyup='mayusculas(this);'  value='' placeholder='AGREGUE OBSERVACIONES'readonly></textarea>
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
