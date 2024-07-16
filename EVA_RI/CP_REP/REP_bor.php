<?php
	include_once('html_fns_eva.php');
	include_once('../html_fns.php');
	$eva=$_REQUEST["eva"];
	
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
		$obs_final = $row['EVA_OBS_FINAL'];
		$periodo = $row['EVA_PERIODO'];
		$obs_mia = $row['EVA_OBS'];
	}
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
		
		$nombre = $nom1." ".$nom2." ".$ape1." ".$ape2;
		$t_pue = tiempo($t_puesto);

?>
		<link href='../assets/css/bootstrap.css' rel='stylesheet'/>
		<link href='../assets/css/bootstrap-responsive.css' rel='stylesheet'/>
		<link href="../assets/css/docs.css" rel="stylesheet">
		<link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type='text/JavaScript'>
	function pageprint(){
		boton = document.getElementById("print");
		boton.style.display="none";
		window.print();
		boton.style.display="block";
	}
</script>	
		<div align = "center" id = "print">
			<div class="btn-group">
				<center>
					<a class="btn btn-info" onclick ='pageprint();' class="btn btn-info btn-lg">
					  <span class="glyphicon glyphicon-home"></span> IMPRIMIR 
					</a>
				</center>
			</div>
		</div> 
		<!--el divlandscape es para poner la pagina horizontalmente -->
<div class='container'>
		<table width='100%' border='1' height='1400px' >
			<tr>
			<td>
			<table border='1' width='100%'>
			<tr>
			<td colspan='2'><strong><small><font face="courier" size='1'>EVALUACION DEL DESEMPE&Ntilde;O LABORAL<br> <?php echo $periodo; ?></font></small></strong></td>
			<td><strong><small><font face="courier" size='1'>Evaluado</font></small></strong></td>
			<td><strong><small><font face="courier" size='1'>Inmediato</font></small></strong></td>
			<td><strong><small><font face="courier" size='1'>Final</font></small></strong></td>
			</tr>
			<tr>
			<td colspan='5'><strong><small><font face="courier" size='2'>PARTE I. DATOS ADMINISTRATIVOS</font></small></strong></td>
			</tr>
			<tr>
			<td><center><strong><small><font face="courier" size='2'>CATALOGO:</font><br></strong><font face="courier" size='1'><?php echo $usuario; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>NOMBRES Y APELLIDOS:</font><br></strong><font face="courier" size='1'><?php echo $nombre; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>GRADO:</font><br></strong><font face="courier" size='1'><?php echo $gra1; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>ARMA O SERVICIO:</font><br></strong><font face="courier" size='1'><?php echo $ar1; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>LINEA DE CARRERA ACTUAL:</font><br></strong><font face="courier" size='1'><?php $linea1 = $ClsPer->trae_linea($linea); echo $linea1;?></font></small></center></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>EMPLEO ACTUAL Y UNIDAD</font><br></strong><font face="courier" size='1'><?php echo $emp1; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>TIEMPO EN EL EMPLEO ACTUAL</font><br></strong><font face="courier" size='1'><?php echo $tie1; ?></font></small></strong></center></td>
			<td><center><strong><small><font face="courier" size='2'>EMPLEO ANTERIOR</font><br></strong><font face="courier" size='1'><?php echo $e_ant; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>DESTINO ACTUAL</font><br></strong><font face="courier" size='1'><?php echo $dest;?></font></small></center></td>
			</tr>
			<tr>
			<td colspan='5'><strong><small><font face="courier" size='2'>PARTE II. EVALUADORES</font></small></strong></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>GRADO Y NOMBRE DEL EVALUADOR INMEDIATO</font></strong><br><font face="courier" size='1'><?php echo $nombre_inmediato; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>CATALOGO</font></strong><br><font face="courier" size='1'><?php echo $cat2; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>EMPLEO</font></strong><br><font face="courier" size='1'><?php echo $emp2; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>TIEMPO EN EL EMPLEO</font></strong><br><font face="courier" size='1'><?php echo $tie2; ?></font></small></center></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>GRADO Y NOMBRE DEL EVALUADOR FINAL</font></strong><br><font face="courier" size='1'><?php echo $nombre_fin; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>CATALOGO</font></strong><br><font face="courier" size='1'><?php echo $cat3; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>EMPLEO</font></strong><br><font face="courier" size='1'><?php echo $emp3; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>TIEMPO EN EL EMPLEO</font></strong><br><font face="courier" size='1'><?php echo $tie3; ?></font></small></center></td>
			</tr>
			<tr>
			<td colspan='5'><strong><small><font face="courier" size='2'>PARTE III. AREAS DE DESEMPE&Ntilde;O</font></small></strong></td>
			</tr>
			</table>
			
			
			<table border='1' width='100%' height='1200px'>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>No.</font></small></strong></center></td>
				<td><strong><small><center><font face="courier" size='2'>FACTORES DE EVALUACION</center><br></small></strong>Marque con una "X" en el calificativo que considere.</font></td>
				<td><center><strong><small><font face="courier" size='1'>Excede</font></small></strong></center></td>
				<td><center><strong><small><font face="courier" size='1'>Cumple</font></small></strong></center></td>
				<td><center><strong><small><font face="courier" size='1'>Necesita<br> mejorar</font></small></strong></center></td>
				</tr>
				<tr>
				<td colspan='5'><center><strong><small><font face="courier" size='2'>DESEMPE&Ntilde;O LABORAL<br>Habilidades y cualidades  de la persona que se califican a traves de las funciones y tareas.</font></small></strong></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>1.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>PRODUCCION Y CALIDAD DE TRABAJO:</b>Cantidad y calidad de trabajo ejecutado a nivel de excelencia buscando dar lo mejor de si mismo.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>2.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>CONOCIMIENTO DEL EMPLEO:</b>Nivel de conocimiento del empleo por medio de la experiencia, educacion, capacitacion y entrenamiento.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>3.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>TRABAJO EN EQUIPO:</b>Capacidad de integrarse a un grupo y aportar sus capacidades y habilidades para lograr cumplir objetivos y metas.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>4.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>TRABAJO BAJO PRESION:</b>Capacidad para responder en situaciones de presion o tension en el trabajo, para cumplir las tareas y responsabilidades encomendadas eficaz y eficientemente.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>5.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>PUNTUALIDAD:</b>Es la antelacion y preparacion en el cumplimiento de sus labores.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td colspan='5'><center><strong><small><font face="courier" size='2'>CAPACIDADES ADMINISTRATIVAS<br>Habilidad que facilita la administracion de los recursos en el ejercicio de sus funciones.</font></small></strong></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>1.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>ADMINISTRACION DE RECURSOS:</b>Capacidad de desarrollar el proceso de planear, organizar, dirigir y controlar el uso de los recursos con eficiencia y eficacia para cumplir con las tareas establecidas.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>2.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>COOPERACION:</b>Actitud hacia la institucion, la autoridad, los compa&ntilde;eros de trabajo y subalternos buscando realizar un trabajo en equipo enfocado en la vision y mision.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>3.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>SUPERVISION:</b>Accion positiva que se ejerce para controlar el fiel cumplimiento de las ordenes misiones y tareas asignadas.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>4.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>DESTREZA:</b>Capacidad en el manejo y conocimiento de los instrumentos de trabajo.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>5.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>EJECUCION:</b>Capacidad de llevar a cabo las ordenes y cumplir los objetivos que se le dan sin equivocarse al seguir instrucciones, basado en la mistica militar y vocacion.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				
				</table>
				
				<br><br><br><br><br><br><br><br><br><br>
				<table border='1' width='100%' height='1200px'>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>No.</font></small></strong></center></td>
				<td><strong><small><center><font face="courier" size='2'>APTITUDES MILITARES<br></small>Capacidad para realizar las funciones y tareas especificas en el servicio militar.</font></strong></center></td>
				<td><center><strong><small><font face="courier" size='1'>Excede</font></small></strong></center></td>
				<td><center><strong><small><font face="courier" size='1'>Cumple</font></small></strong></center></td>
				<td><center><strong><small><font face="courier" size='1'>Necesita<br> mejorar</font></small></strong></center></td>
				</tr>
				
				
				<tr>
				<td><center><strong><small><font face="courier" size='2'>1.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>INICIATIVA:</b>Aporte y desarrollo de ideas creativas y constructivas para solucion de situaciones imprevistas.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>2.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>ABNEGACION:</b>Aptitud consistente en el sacrificio espontaneo de la voluntad, interes, deseos y aun de la propia vida, en cumplimiento de la mision.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>3.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>PORTE:</b>Capacidad de presentacion personal, en comportamiento y apariencia, coincidentes con las normas militares y sociales.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>4.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>LIDERAZGO:</b>Habilidad de persuadir y dirigir al personal subalterno, de tal manera que se obtenga su obediencia, confianza, el respeto, lealtad, cooperacion voluntaria con el fin de cumplir la mision.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>5.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>ESPIRITU DE CUERPO:</b>Es lealtad, orgullo y entusiasmo que sienten los individuos de pertenecer a su unidad.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td colspan='5'><center><strong><small><font face="courier" size='2'>CUALIDADES PERSONALES<br>Caracteristicas individuales necesarias para el buen desempe&ntilde;o del puesto.</font></small></strong></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>1.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>TOMA DE DECISIONES:</b>Capacidad de resolucion definitiva y oportuna a problemas asociados al ejercicio de sus funciones con juicio y criterio, sin rehuir responsabilidades asociadas a la decision.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>2.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>RELACIONES INTERPERSONALES:</b>Considera el trato, respeto y comunicacion hacia superiores, subalternos y compa&ntilde;eros.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>3.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>RESPONSABILIDAD:</b>Capacidad para cumplir las tareas y responsabilidades inherentes al grado y funcion, con dedicacion, puntualidad y observando los plazos establecidos.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>4.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>COMPROMISO:</b>Poner al maximo su capacidad para sacar toda tarea que le sea confiada con dedicacion y esmero.</font></td>
				<td><center></center></td>
				<td><center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td><center><strong><small><font face="courier" size='2'>5.</font></small></strong></center></td>
				<td><b><font face="courier" size='2'>CRITERIO:</b>Facultad que se tiene para comprender algo o formar una opinion.</font></td>
				<td><center></center></td>
				<td><center></center></td>
				<td><center></center></td>
				</tr>
				<tr>
				<td colspan='5'><center><strong><small><font face="courier" size='2'>CONCEPTO DE LOS EVALUADORES<br>En este espacio cada evaluador describira un concepto sobre el desempe&ntilde;o del evaluado.</font></small></strong></center></td>
				</tr>
				<tr>
				<td colspan='5'><strong><small><font face="courier" size='2'>EVALUADOR INMEDIATO<br><br><br><br></font></small></strong></td>
				</tr>
				<tr>
				<td colspan='5'><strong><small><font face="courier" size='2'>EVALUADOR FINAL<br><br><br><br></font></small></strong></td>
				</tr>
			</table>
		</table>
	</div>