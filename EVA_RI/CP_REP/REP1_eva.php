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
<div class='container'><br>
		<table width='100%' border='1' >
			<tr>
			<td>
			<table border='1' width='100%'>
			<tr>
			<td colspan='6'><strong><small><font face="courier" size='1'>REPORTE FINAL EVALUACION DEL DESEMPE&Ntilde;O <br> Forma No. SAGE DP-RRHH-evaluacion <?php echo $periodo; ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Codigo de evaluacion: <?php echo Agrega_Ceros($eva); ?></font></small></strong></td>
			</tr>
			<tr>
			<td colspan='6'><strong><small><font face="courier" size='2'>PARTE I. DATOS ADMINISTRATIVOS</font></small></strong></td>
			</tr>
			<tr>
			<td><center><strong><small><font face="courier" size='2'>CATALOGO:</font><br></strong><font face="courier" size='1'><?php echo $usuario; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>NOMBRES Y APELLIDOS:</font><br></strong><font face="courier" size='1'><?php echo $nombre; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>GRADO:</font><br></strong><font face="courier" size='1'><?php echo $gra1; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>ARMA O SERVICIO:</font><br></strong><font face="courier" size='1'><?php echo $ar1; ?></font></small></center></td>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>LINEA DE CARRERA ACTUAL:</font><br></strong><font face="courier" size='1'><?php $linea1 = $ClsPer->trae_linea($linea); echo $linea1;?></font></small></center></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>EMPLEO ACTUAL Y UNIDAD</font><br></strong><font face="courier" size='1'><?php echo $emp1; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>TIEMPO EN EL EMPLEO ACTUAL</font><br></strong><font face="courier" size='1'><?php echo $tie1; ?></font></small></strong></center></td>
			<td><center><strong><small><font face="courier" size='2'>EMPLEO ANTERIOR</font><br></strong><font face="courier" size='1'><?php echo $e_ant; ?></font></small></center></td>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>DESTINO ACTUAL</font><br></strong><font face="courier" size='1'><?php echo $dest;?></font></small></center></td>
			</tr>
			<tr>
			<td colspan='6'><strong><small><font face="courier" size='2'>PARTE. AREAS DE DESEMPE&Ntilde;O</font></small></strong></td>
			</tr>
			<tr>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>DESEMPE&Ntilde;O LABORAL</font></center></small></strong></td>
			<td></td>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>APTITUDES MILITARES</font></center></small></strong></td>
			<td></td>
			</tr>
			
			<tr>
				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Produccion y calidad de trabajo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php
					$pregunta1 = $ClsPer->trae_notas_por_una($eva,1,1,1);
							if($pregunta1 == 0){
								$pregunta1 = "-";
							}else if($pregunta1 == 5){
								$pregunta1 = "Excede";
							}else if($pregunta1 >= 3){
								$pregunta1 = "Cumple";
							}else{
								$pregunta1 = "Necesita mejorar";
							}
					echo $pregunta1;
					?></font></small></center>
				</td>

				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Iniciativa<br></font></small></td>
				<td width='10%'><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,11);
					$pregunta11 = $ClsPer->trae_notas_por_una($eva,1,11,3);
							if($pregunta11 == 0){
								$pregunta11 = "-";
							}else if($pregunta11 == 5){
								$pregunta11 = "Excede";
							}else if($pregunta11 >= 3){
								$pregunta11 = "Cumple";
							}else{
								$pregunta11 = "Necesita mejorar";
							}
					echo $pregunta11;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Conocimiento del empleo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,2);
					$pregunta2 = $ClsPer->trae_notas_por_una($eva,1,2,1);
							if($pregunta2 == 0){
								$pregunta2 = "-";
							}else if($pregunta2 == 5){
								$pregunta2 = "Excede";
							}else if($pregunta2 >= 3){
								$pregunta2 = "Cumple";
							}else{
								$pregunta2 = "Necesita mejorar";
							}
					echo $pregunta2;
							
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Abnegacion</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,12);
					$pregunta12 = $ClsPer->trae_notas_por_una($eva,1,12,3);
					if($pregunta12 == 0){
								$pregunta12 = "-";
							}else if($pregunta12 == 5){
								$pregunta12 = "Excede";
							}else if($pregunta12 >= 3){
								$pregunta12 = "Cumple";
							}else{
								$pregunta12 = "Necesita mejorar";
							}
					echo $pregunta12;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Trabajo en equipo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,3);
					$pregunta3 = $ClsPer->trae_notas_por_una($eva,1,3,1);
					if($pregunta3 == 0){
								$pregunta3 = "-";
							}else if($pregunta3 == 5){
								$pregunta3 = "Excede";
							}else if($pregunta3 >= 3){
								$pregunta3 = "Cumple";
							}else{
								$pregunta3 = "Necesita mejorar";
							}
					echo $pregunta3;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Porte<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,13); 
					$pregunta13 = $ClsPer->trae_notas_por_una($eva,1,13,3);
					if($pregunta13 == 0){
								$pregunta13 = "-";
							}else if($pregunta13 == 5){
								$pregunta13 = "Excede";
							}else if($pregunta13 >= 3){
								$pregunta13 = "Cumple";
							}else{
								$pregunta13 = "Necesita mejorar";
							}
					echo $pregunta13;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Trabajo bajo presion</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,4); 
					$pregunta4 = $ClsPer->trae_notas_por_una($eva,1,4,1);
					if($pregunta4 == 0){
								$pregunta4 = "-";
							}else if($pregunta4 == 5){
								$pregunta4 = "Excede";
							}else if($pregunta4 >= 3){
								$pregunta4 = "Cumple";
							}else{
								$pregunta4 = "Necesita mejorar";
							}
					echo $pregunta4;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Liderazgo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,14); 
					$pregunta14 = $ClsPer->trae_notas_por_una($eva,1,14,3);
					if($pregunta14 == 0){
								$pregunta14 = "-";
							}else if($pregunta14 == 5){
								$pregunta14 = "Excede";
							}else if($pregunta14 >= 3){
								$pregunta14 = "Cumple";
							}else{
								$pregunta14 = "Necesita mejorar";
							}
					echo $pregunta14;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Puntualidad<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,5); 
					$pregunta5 = $ClsPer->trae_notas_por_una($eva,1,5,1);
					if($pregunta5 == 0){
								$pregunta5 = "-";
							}else if($pregunta5 == 5){
								$pregunta5 = "Excede";
							}else if($pregunta5 >= 3){
								$pregunta5 = "Cumple";
							}else{
								$pregunta5 = "Necesita mejorar";
							}
					echo $pregunta5;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Espiritu de cuerpo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,15); 
					$pregunta15 = $ClsPer->trae_notas_por_una($eva,1,15,3);
					if($pregunta15 == 0){
								$pregunta15 = "-";
							}else if($pregunta15 == 5){
								$pregunta15 = "Excede";
							}else if($pregunta15 >= 3){
								$pregunta15 = "Cumple";
							}else{
								$pregunta15 = "Necesita mejorar";
							}
					echo $pregunta15;
					?></font></small></center></td>
			</tr>



			<tr>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>CAPACIDADES ADMINISTRATIVAS</font></center></small></strong></td>
			<td></td>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>CUALIDADES PERSONALES</font></center></small></strong></td>
			<td></td>
			</tr>



			<tr>
				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Administracion de recursos</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
				<?php $total = $ClsPer->trae_notas($eva,6); 
				$pregunta6 = $ClsPer->trae_notas_por_una($eva,1,6,2);
				if($pregunta6 == 0){
								$pregunta6 = "-";
							}else if($pregunta6 == 5){
								$pregunta6 = "Excede";
							}else if($pregunta6 >= 3){
								$pregunta6 = "Cumple";
							}else{
								$pregunta6 = "Necesita mejorar";
							}
				echo $pregunta6;
				?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Toma de decisiones<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
				<?php $total = $ClsPer->trae_notas($eva,16); 
				$pregunta16 = $ClsPer->trae_notas_por_una($eva,1,16,4);
				if($pregunta16 == 0){
								$pregunta16 = "-";
							}else if($pregunta16 == 5){
								$pregunta16 = "Excede";
							}else if($pregunta16 >= 3){
								$pregunta16 = "Cumple";
							}else{
								$pregunta16 = "Necesita mejorar";
							}
				echo $pregunta16;
				?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Cooperacion<br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,7); 
					$pregunta7 = $ClsPer->trae_notas_por_una($eva,1,7,2);
					if($pregunta7 == 0){
								$pregunta7 = "-";
							}else if($pregunta7 == 5){
								$pregunta7 = "Excede";
							}else if($pregunta7 >= 3){
								$pregunta7 = "Cumple";
							}else{
								$pregunta7 = "Necesita mejorar";
							}
					echo $pregunta7;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Relaciones interpersonales</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
				<?php $total = $ClsPer->trae_notas($eva,17); 
				$pregunta17 = $ClsPer->trae_notas_por_una($eva,1,17,4);
				if($pregunta17 == 0){
								$pregunta17 = "-";
							}else if($pregunta17 == 5){
								$pregunta17 = "Excede";
							}else if($pregunta17 >= 3){
								$pregunta17 = "Cumple";
							}else{
								$pregunta17 = "Necesita mejorar";
							}
				echo $pregunta17;
				?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Supervision<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,8); 
					$pregunta8 = $ClsPer->trae_notas_por_una($eva,1,8,2);
					if($pregunta8 == 0){
								$pregunta8 = "-";
							}else if($pregunta8 == 5){
								$pregunta8 = "Excede";
							}else if($pregunta8 >= 3){
								$pregunta8 = "Cumple";
							}else{
								$pregunta8 = "Necesita mejorar";
							}
					echo $pregunta8;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Responsabilidad</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,18); 
					$pregunta18 = $ClsPer->trae_notas_por_una($eva,1,18,4);
					if($pregunta18 == 0){
								$pregunta18 = "-";
							}else if($pregunta18 == 5){
								$pregunta18 = "Excede";
							}else if($pregunta18 >= 3){
								$pregunta18 = "Cumple";
							}else{
								$pregunta18 = "Necesita mejorar";
							}
					echo $pregunta18;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Destreza</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,9); 
					$pregunta9 = $ClsPer->trae_notas_por_una($eva,1,9,2);
					if($pregunta9 == 0){
								$pregunta9 = "-";
							}else if($pregunta9 == 5){
								$pregunta9 = "Excede";
							}else if($pregunta9 >= 3){
								$pregunta9 = "Cumple";
							}else{
								$pregunta9 = "Necesita mejorar";
							}
					echo $pregunta9;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Compromiso<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,19); 
					$pregunta19 = $ClsPer->trae_notas_por_una($eva,1,19,4);
					if($pregunta19 == 0){
								$pregunta19 = "-";
							}else if($pregunta19 == 5){
								$pregunta19 = "Excede";
							}else if($pregunta19 >= 3){
								$pregunta19 = "Cumple";
							}else{
								$pregunta19 = "Necesita mejorar";
							}
					echo $pregunta19;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Ejecucion<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,10); 
					$pregunta10 = $ClsPer->trae_notas_por_una($eva,1,10,2);
					if($pregunta10 == 0){
								$pregunta10 = "-";
							}else if($pregunta10 == 5){
								$pregunta10 = "Excede";
							}else if($pregunta10 >= 3){
								$pregunta10 = "Cumple";
							}else{
								$pregunta10 = "Necesita mejorar";
							}
					echo $pregunta10;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Criterio</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,20); 
					$pregunta20 = $ClsPer->trae_notas_por_una($eva,1,20,4);
					if($pregunta20 == 0){
								$pregunta20 = "-";
							}else if($pregunta20 == 5){
								$pregunta20 = "Excede";
							}else if($pregunta20 >= 3){
								$pregunta20 = "Cumple";
							}else{
								$pregunta20 = "Necesita mejorar";
							}
					echo $pregunta20;
					?></font></small></center></td>
			</tr>
			<tr>
			<td colspan='6'><strong><small><font face="courier" size='2'>PARTE II. EVALUADORES</font></small></strong></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>GRADO Y NOMBRE DEL EVALUADOR INMEDIATO</font></strong><br><font face="courier" size='1'><?php echo $nombre_inmediato; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>CATALOGO</font></strong><br><font face="courier" size='1'><?php echo $cat2; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>EMPLEO</font></strong><br><font face="courier" size='1'><?php echo $emp2; ?></font></small></center></td>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>TIEMPO EN EL EMPLEO</font></strong><br><font face="courier" size='1'><?php echo $tie2; ?></font></small></center></td>
			</tr>
			<tr>
			<td colspan='6'><b><font face="courier" size='2'>EVALUADOR INMEDIATO:</font></center></b></br>
			<small><font face="courier" size='1'><?php echo $obs_inm; ?></font></small>
			</tr>
			<tr>
			<td colspan='6'><strong><small><font face="courier" size='2'>PARTE II-I. AREAS DE DESEMPE&Ntilde;O</font></small></strong></td>
			</tr>
			<tr>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>DESEMPE&Ntilde;O LABORAL</font></center></small></strong></td>
			<td></td>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>APTITUDES MILITARES</font></center></small></strong></td>
			<td></td>
			</tr>
			
			<tr>
				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Produccion y calidad de trabajo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php 
					$pregunta1 = $ClsPer->trae_notas_por_una($eva,2,1,1);
					if($pregunta1 == 0){
								$pregunta1 = "-";
							}else if($pregunta1 == 5){
								$pregunta1 = "Excede";
							}else if($pregunta1 >= 3){
								$pregunta1 = "Cumple";
							}else{
								$pregunta1 = "Necesita mejorar";
							}
					echo $pregunta1;
					?></font></small></center>
				</td>

				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Iniciativa<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,11);
					$pregunta11 = $ClsPer->trae_notas_por_una($eva,2,11,3);
					if($pregunta11 == 0){
								$pregunta11 = "-";
							}else if($pregunta11 == 5){
								$pregunta11 = "Excede";
							}else if($pregunta11 >= 3){
								$pregunta11 = "Cumple";
							}else{
								$pregunta11 = "Necesita mejorar";
							}
					echo $pregunta11;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Conocimiento del empleo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,2);
					$pregunta2 = $ClsPer->trae_notas_por_una($eva,2,2,1);
					if($pregunta2 == 0){
								$pregunta2 = "-";
							}else if($pregunta2 == 5){
								$pregunta2 = "Excede";
							}else if($pregunta2 >= 3){
								$pregunta2 = "Cumple";
							}else{
								$pregunta2 = "Necesita mejorar";
							}
					echo $pregunta2;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Abnegacion</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,12);
					$pregunta12 = $ClsPer->trae_notas_por_una($eva,2,12,3);
					if($pregunta12 == 0){
								$pregunta12 = "-";
							}else if($pregunta12 == 5){
								$pregunta12 = "Excede";
							}else if($pregunta12 >= 3){
								$pregunta12 = "Cumple";
							}else{
								$pregunta12 = "Necesita mejorar";
							}
					echo $pregunta12;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Trabajo en equipo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,3);
					$pregunta3 = $ClsPer->trae_notas_por_una($eva,2,3,1);
					if($pregunta3 == 0){
								$pregunta3 = "-";
							}else if($pregunta3 == 5){
								$pregunta3 = "Excede";
							}else if($pregunta3 >= 3){
								$pregunta3 = "Cumple";
							}else{
								$pregunta3 = "Necesita mejorar";
							}
					echo $pregunta3;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Porte<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,13); 
					$pregunta13 = $ClsPer->trae_notas_por_una($eva,2,13,3);
					if($pregunta13 == 0){
								$pregunta13 = "-";
							}else if($pregunta13 == 5){
								$pregunta13 = "Excede";
							}else if($pregunta13 >= 3){
								$pregunta13 = "Cumple";
							}else{
								$pregunta13 = "Necesita mejorar";
							}
					echo $pregunta13;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Trabajo bajo presion</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,4); 
					$pregunta4 = $ClsPer->trae_notas_por_una($eva,2,4,1);
					if($pregunta4 == 0){
								$pregunta4 = "-";
							}else if($pregunta4 == 5){
								$pregunta4 = "Excede";
							}else if($pregunta4 >= 3){
								$pregunta4 = "Cumple";
							}else{
								$pregunta4 = "Necesita mejorar";
							}
					echo $pregunta4;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Liderazgo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,14); 
					$pregunta14 = $ClsPer->trae_notas_por_una($eva,2,14,3);
					if($pregunta14 == 0){
								$pregunta14 = "-";
							}else if($pregunta14 == 5){
								$pregunta14 = "Excede";
							}else if($pregunta14 >= 3){
								$pregunta14 = "Cumple";
							}else{
								$pregunta14 = "Necesita mejorar";
							}
					echo $pregunta14;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Puntualidad<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,5); 
					$pregunta5 = $ClsPer->trae_notas_por_una($eva,2,5,1);
					if($pregunta5 == 0){
								$pregunta5 = "-";
							}else if($pregunta5 == 5){
								$pregunta5 = "Excede";
							}else if($pregunta5 >= 3){
								$pregunta5 = "Cumple";
							}else{
								$pregunta5 = "Necesita mejorar";
							}
					echo $pregunta5;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Espiritu de cuerpo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,15); 
					$pregunta15 = $ClsPer->trae_notas_por_una($eva,2,15,3);
					if($pregunta15 == 0){
								$pregunta15 = "-";
							}else if($pregunta15 == 5){
								$pregunta15 = "Excede";
							}else if($pregunta15 >= 3){
								$pregunta15 = "Cumple";
							}else{
								$pregunta15 = "Necesita mejorar";
							}
					echo $pregunta15;
					?></font></small></center></td>
			</tr>



			<tr>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>CAPACIDADES ADMINISTRATIVAS</font></center></small></strong></td>
			<td></td>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>CUALIDADES PERSONALES</font></center></small></strong></td>
			<td></td>
			</tr>



			<tr>
				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Administracion de recursos</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
				<?php $total = $ClsPer->trae_notas($eva,6); 
				$pregunta6 = $ClsPer->trae_notas_por_una($eva,2,6,2);
				if($pregunta6 == 0){
								$pregunta6 = "-";
							}else if($pregunta6 == 5){
								$pregunta6 = "Excede";
							}else if($pregunta6 >= 3){
								$pregunta6 = "Cumple";
							}else{
								$pregunta6 = "Necesita mejorar";
							}
				echo $pregunta6;
				?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Toma de decisiones<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
				<?php $total = $ClsPer->trae_notas($eva,16); 
				$pregunta16 = $ClsPer->trae_notas_por_una($eva,2,16,4);
				if($pregunta16 == 0){
								$pregunta16 = "-";
							}else if($pregunta16 == 5){
								$pregunta16 = "Excede";
							}else if($pregunta16 >= 3){
								$pregunta16 = "Cumple";
							}else{
								$pregunta16 = "Necesita mejorar";
							}
				echo $pregunta16;
				?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Cooperacion<br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,7); 
					$pregunta7 = $ClsPer->trae_notas_por_una($eva,2,7,2);
					if($pregunta7 == 0){
								$pregunta7 = "-";
							}else if($pregunta7 == 5){
								$pregunta7 = "Excede";
							}else if($pregunta7 >= 3){
								$pregunta7 = "Cumple";
							}else{
								$pregunta7 = "Necesita mejorar";
							}
					echo $pregunta7;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Relaciones interpersonales</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
				<?php $total = $ClsPer->trae_notas($eva,17); 
				$pregunta17 = $ClsPer->trae_notas_por_una($eva,2,17,4);
				if($pregunta17 == 0){
								$pregunta17 = "-";
							}else if($pregunta17 == 5){
								$pregunta17 = "Excede";
							}else if($pregunta17 >= 3){
								$pregunta17 = "Cumple";
							}else{
								$pregunta17 = "Necesita mejorar";
							}
				echo $pregunta17;
				
				?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Supervision<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,8); 
					$pregunta8 = $ClsPer->trae_notas_por_una($eva,2,8,2);
					if($pregunta8 == 0){
								$pregunta8 = "-";
							}else if($pregunta8 == 5){
								$pregunta8 = "Excede";
							}else if($pregunta8 >= 3){
								$pregunta8 = "Cumple";
							}else{
								$pregunta8 = "Necesita mejorar";
							}
					echo $pregunta8;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Responsabilidad</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,18); 
					$pregunta18 = $ClsPer->trae_notas_por_una($eva,2,18,4);
					if($pregunta18 == 0){
								$pregunta18 = "-";
							}else if($pregunta18 == 5){
								$pregunta18 = "Excede";
							}else if($pregunta18 >= 3){
								$pregunta18 = "Cumple";
							}else{
								$pregunta18 = "Necesita mejorar";
							}
					echo $pregunta18;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Destreza</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,9); 
					$pregunta9 = $ClsPer->trae_notas_por_una($eva,2,9,2);
					if($pregunta9 == 0){
								$pregunta9 = "-";
							}else if($pregunta9 == 5){
								$pregunta9 = "Excede";
							}else if($pregunta9 >= 3){
								$pregunta9 = "Cumple";
							}else{
								$pregunta9 = "Necesita mejorar";
							}
					echo $pregunta9;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Compromiso<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,19); 
					$pregunta19 = $ClsPer->trae_notas_por_una($eva,2,19,4);
					if($pregunta19 == 0){
								$pregunta19 = "-";
							}else if($pregunta19 == 5){
								$pregunta19 = "Excede";
							}else if($pregunta19 >= 3){
								$pregunta19 = "Cumple";
							}else{
								$pregunta19 = "Necesita mejorar";
							}
					echo $pregunta19;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Ejecucion<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,10); 
					$pregunta10 = $ClsPer->trae_notas_por_una($eva,2,10,2);
					if($pregunta10 == 0){
								$pregunta10 = "-";
							}else if($pregunta10 == 5){
								$pregunta10 = "Excede";
							}else if($pregunta10 >= 3){
								$pregunta10 = "Cumple";
							}else{
								$pregunta10 = "Necesita mejorar";
							}
					echo $pregunta10;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Criterio</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,20); 
					$pregunta20 = $ClsPer->trae_notas_por_una($eva,2,20,4);
					if($pregunta20 == 0){
								$pregunta20 = "-";
							}else if($pregunta20 == 5){
								$pregunta20 = "Excede";
							}else if($pregunta20 >= 3){
								$pregunta20 = "Cumple";
							}else{
								$pregunta20 = "Necesita mejorar";
							}
					echo $pregunta20;
					?></font></small></center></td>
			</tr>
			<tr>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>GRADO Y NOMBRE DEL EVALUADOR FINAL</font></strong><br><font face="courier" size='1'><?php echo $nombre_fin; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>CATALOGO</font></strong><br><font face="courier" size='1'><?php echo $cat3; ?></font></small></center></td>
			<td><center><strong><small><font face="courier" size='2'>EMPLEO</font></strong><br><font face="courier" size='1'><?php echo $emp3; ?></font></small></center></td>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>TIEMPO EN EL EMPLEO</font></strong><br><font face="courier" size='1'><?php echo $tie3; ?></font></small></center></td>
			</tr>
			<tr>	
			<td colspan='6'><font face="courier" size='2'><b>EVALUADOR FINAL:</font></center></b></br>
			<small><font face="courier" size='1'> <?php echo $obs_final; ?></font></small>
			</tr>	
			<tr>
			<td colspan='6'><strong><small><font face="courier" size='2'>PARTE II-II. AREAS DE DESEMPE&Ntilde;O</font></small></strong></td>
			</tr>
			<tr>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>DESEMPE&Ntilde;O LABORAL</font></center></small></strong></td>
			<td></td>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>APTITUDES MILITARES</font></center></small></strong></td>
			<td></td>
			</tr>
			
			<tr>
				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Produccion y calidad de trabajo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php 
					$pregunta1 = $ClsPer->trae_notas_por_una($eva,3,1,1);
					if($pregunta1 == 0){
								$pregunta1 = "-";
							}else if($pregunta1 == 5){
								$pregunta1 = "Excede";
							}else if($pregunta1 >= 3){
								$pregunta1 = "Cumple";
							}else{
								$pregunta1 = "Necesita mejorar";
							}
					echo $pregunta1;
					?></font></small></center>
				</td>

				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Iniciativa<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,11);
					$pregunta11 = $ClsPer->trae_notas_por_una($eva,3,11,3);
					if($pregunta11 == 0){
								$pregunta11 = "-";
							}else if($pregunta11 == 5){
								$pregunta11 = "Excede";
							}else if($pregunta11 >= 3){
								$pregunta11 = "Cumple";
							}else{
								$pregunta11 = "Necesita mejorar";
							}
					echo $pregunta11;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Conocimiento del empleo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,2);
					$pregunta2 = $ClsPer->trae_notas_por_una($eva,3,2,1);
					if($pregunta2 == 0){
								$pregunta2 = "-";
							}else if($pregunta2 == 5){
								$pregunta2 = "Excede";
							}else if($pregunta2 >= 3){
								$pregunta2 = "Cumple";
							}else{
								$pregunta2 = "Necesita mejorar";
							}
					echo $pregunta2;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Abnegacion</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,12);
					$pregunta12 = $ClsPer->trae_notas_por_una($eva,3,12,3);
					if($pregunta12 == 0){
								$pregunta12 = "-";
							}else if($pregunta12 == 5){
								$pregunta12 = "Excede";
							}else if($pregunta12 >= 3){
								$pregunta12 = "Cumple";
							}else{
								$pregunta12 = "Necesita mejorar";
							}
					echo $pregunta12;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Trabajo en equipo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,3);
					$pregunta3 = $ClsPer->trae_notas_por_una($eva,3,3,1);
					if($pregunta3 == 0){
								$pregunta3 = "-";
							}else if($pregunta3 == 5){
								$pregunta3 = "Excede";
							}else if($pregunta3 >= 3){
								$pregunta3 = "Cumple";
							}else{
								$pregunta3 = "Necesita mejorar";
							}
					echo $pregunta3;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Porte<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,13); 
					$pregunta13 = $ClsPer->trae_notas_por_una($eva,3,13,3);
					if($pregunta13 == 0){
								$pregunta13 = "-";
							}else if($pregunta13 == 5){
								$pregunta13 = "Excede";
							}else if($pregunta13 >= 3){
								$pregunta13 = "Cumple";
							}else{
								$pregunta13 = "Necesita mejorar";
							}
					echo $pregunta13;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Trabajo bajo presion</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,4); 
					$pregunta4 = $ClsPer->trae_notas_por_una($eva,3,4,1);
					if($pregunta4 == 0){
								$pregunta4 = "-";
							}else if($pregunta4 == 5){
								$pregunta4 = "Excede";
							}else if($pregunta4 >= 3){
								$pregunta4 = "Cumple";
							}else{
								$pregunta4 = "Necesita mejorar";
							}
					echo $pregunta4;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Liderazgo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,14); 
					$pregunta14 = $ClsPer->trae_notas_por_una($eva,3,14,3);
					if($pregunta14 == 0){
								$pregunta14 = "-";
							}else if($pregunta14 == 5){
								$pregunta14 = "Excede";
							}else if($pregunta14 >= 3){
								$pregunta14 = "Cumple";
							}else{
								$pregunta14 = "Necesita mejorar";
							}
					echo $pregunta14;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Puntualidad<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,5); 
					$pregunta5 = $ClsPer->trae_notas_por_una($eva,3,5,1);
					if($pregunta5 == 0){
								$pregunta5 = "-";
							}else if($pregunta5 == 5){
								$pregunta5 = "Excede";
							}else if($pregunta5 >= 3){
								$pregunta5 = "Cumple";
							}else{
								$pregunta5 = "Necesita mejorar";
							}
					echo $pregunta5;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Espiritu de cuerpo</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,15); 
					$pregunta15 = $ClsPer->trae_notas_por_una($eva,3,15,3);
					if($pregunta15 == 0){
								$pregunta15 = "-";
							}else if($pregunta15 == 5){
								$pregunta15 = "Excede";
							}else if($pregunta15 >= 3){
								$pregunta15 = "Cumple";
							}else{
								$pregunta15 = "Necesita mejorar";
							}
					echo $pregunta15;
					?></font></small></center></td>
			</tr>



			<tr>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>CAPACIDADES ADMINISTRATIVAS</font></center></small></strong></td>
			<td></td>
			<td></td>
			<td><strong><small><center><font face="courier" size='2'>CUALIDADES PERSONALES</font></center></small></strong></td>
			<td></td>
			</tr>



			<tr>
				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Administracion de recursos</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
				<?php $total = $ClsPer->trae_notas($eva,6); 
				$pregunta6 = $ClsPer->trae_notas_por_una($eva,3,6,2);
				if($pregunta6 == 0){
								$pregunta6 = "-";
							}else if($pregunta6 == 5){
								$pregunta6 = "Excede";
							}else if($pregunta6 >= 3){
								$pregunta6 = "Cumple";
							}else{
								$pregunta6 = "Necesita mejorar";
							}
				echo $pregunta6;
				?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>1.</font></small></center></td>
				<td><small><font face="courier" size='1'>Toma de decisiones<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
				<?php $total = $ClsPer->trae_notas($eva,16); 
				$pregunta16 = $ClsPer->trae_notas_por_una($eva,3,16,4);
				if($pregunta16 == 0){
								$pregunta16 = "-";
							}else if($pregunta16 == 5){
								$pregunta16 = "Excede";
							}else if($pregunta16 >= 3){
								$pregunta16 = "Cumple";
							}else{
								$pregunta16 = "Necesita mejorar";
							}
				echo $pregunta16;
				?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Cooperacion<br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,7); 
					$pregunta7 = $ClsPer->trae_notas_por_una($eva,3,7,2);
					if($pregunta7 == 0){
								$pregunta7 = "-";
							}else if($pregunta7 == 5){
								$pregunta7 = "Excede";
							}else if($pregunta7 >= 3){
								$pregunta7 = "Cumple";
							}else{
								$pregunta7 = "Necesita mejorar";
							}
					echo $pregunta7;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>2.</font></small></center></td>
				<td><small><font face="courier" size='1'>Relaciones interpersonales</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
				<?php $total = $ClsPer->trae_notas($eva,17); 
				$pregunta17 = $ClsPer->trae_notas_por_una($eva,3,17,4);
				if($pregunta17 == 0){
								$pregunta17 = "-";
							}else if($pregunta17 == 5){
								$pregunta17 = "Excede";
							}else if($pregunta17 >= 3){
								$pregunta17 = "Cumple";
							}else{
								$pregunta17 = "Necesita mejorar";
							}
				echo $pregunta17;
				?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Supervision<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,8); 
					$pregunta8 = $ClsPer->trae_notas_por_una($eva,3,8,2);
					if($pregunta8 == 0){
								$pregunta8 = "-";
							}else if($pregunta8 == 5){
								$pregunta8 = "Excede";
							}else if($pregunta8 >= 3){
								$pregunta8 = "Cumple";
							}else{
								$pregunta8 = "Necesita mejorar";
							}
					echo $pregunta8;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>3.</font></small></center></td>
				<td><small><font face="courier" size='1'>Responsabilidad</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,18); 
					$pregunta18 = $ClsPer->trae_notas_por_una($eva,3,18,4);
					if($pregunta18 == 0){
								$pregunta18 = "-";
							}else if($pregunta18 == 5){
								$pregunta18 = "Excede";
							}else if($pregunta18 >= 3){
								$pregunta18 = "Cumple";
							}else{
								$pregunta18 = "Necesita mejorar";
							}
					echo $pregunta18;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Destreza</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,9); 
					$pregunta9 = $ClsPer->trae_notas_por_una($eva,3,9,2);
					if($pregunta9 == 0){
								$pregunta9 = "-";
							}else if($pregunta9 == 5){
								$pregunta9 = "Excede";
							}else if($pregunta9 >= 3){
								$pregunta9 = "Cumple";
							}else{
								$pregunta9 = "Necesita mejorar";
							}
					echo $pregunta9;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>4.</font></small></center></td>
				<td><small><font face="courier" size='1'>Compromiso<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,19); 
					$pregunta19 = $ClsPer->trae_notas_por_una($eva,3,19,4);
					if($pregunta19 == 0){
								$pregunta19 = "-";
							}else if($pregunta19 == 5){
								$pregunta19 = "Excede";
							}else if($pregunta19 >= 3){
								$pregunta19 = "Cumple";
							}else{
								$pregunta19 = "Necesita mejorar";
							}
					echo $pregunta19;
					?></font></small></center></td>
			</tr>

			<tr>
				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Ejecucion<br></font></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,10); 
					$pregunta10 = $ClsPer->trae_notas_por_una($eva,3,10,2);
					if($pregunta10 == 0){
								$pregunta10 = "-";
							}else if($pregunta10 == 5){
								$pregunta10 = "Excede";
							}else if($pregunta10 >= 3){
								$pregunta10 = "Cumple";
							}else{
								$pregunta10 = "Necesita mejorar";
							}
					echo $pregunta10;
					?></font></small></center></td>

				<td><center><small><font face="courier" size='1'>5.</font></small></center></td>
				<td><small><font face="courier" size='1'>Criterio</font><br></small></td>
				<td><center><small><font face="courier" size='1'>
					<?php $total = $ClsPer->trae_notas($eva,20); 
					$pregunta20 = $ClsPer->trae_notas_por_una($eva,3,20,4);
					if($pregunta20 == 0){
								$pregunta20 = "-";
							}else if($pregunta20 == 5){
								$pregunta20 = "Excede";
							}else if($pregunta20 >= 3){
								$pregunta20 = "Cumple";
							}else{
								$pregunta20 = "Necesita mejorar";
							}
					echo $pregunta20;
					?></font></small></center></td>
			</tr>
			<tr>
			<td colspan='6'><font face="courier" size='2'><strong><small>PARTE IV. RESULTADO DE LA EVALUACION</font></small></strong></td>
			</tr>
			<tr>
			<td colspan='3'><font face="courier" size='2'><center><strong><small>NOTA FINAL:</font></center></small></strong><br>
			<?php if($renglon == 1){?>
			<small><center><font face="courier" size='2'><?php
					$nota_total1= $ClsPer->trae_nota_total1($eva);
					$nota_total1p=$nota_total1*0.10;
					//echo ($nota_total1p);
					//echo '<br>';
					$nota_total2= $ClsPer->trae_nota_total2($eva);
					$nota_total2p=$nota_total2*0.45;
					//echo ($nota_total2p);
					//echo '<br>';
					$nota_total3= $ClsPer->trae_nota_total3($eva);
					$nota_total3p=$nota_total3*0.45;
					//echo ($nota_total3p);
					//echo '<br>';
					$nota_total4= $ClsPer->trae_nota_total5($eva);
					$nota_total4p=$nota_total4*0.30;

					$nota_total5= $ClsPer->trae_nota_total6($eva);
					$nota_total5p=$nota_total5*0.70;

					if($nota_total1p <> '' or $nota_total2p <> '' or $nota_total3p <> ''){
					$suma_total=$nota_total1p+$nota_total2p+$nota_total3p;
					echo round($suma_total);
					
					}elseif($nota_total4p <> '' or $nota_total5p <> ''){
					$suma_total=$nota_total4p+$nota_total5p;
					echo round($suma_total);
					} //$total_nota = $ClsPer->trae_nota_total($eva); echo $total_nota;?></font></center></small>
			<!--<small><center><font face="courier" size='2'><?php //$total_nota = 89.99; echo $total_nota;?></font></center></small>-->
			<?php }?>
				<td colspan='3'><font face="courier" size='2'><center><strong><small>CATEGORIA:</font></center></small></strong></br>
					<small><center><font face="courier" size='2'>
					<?php
					
					if($renglon == 1){
						if($suma_total <= 59.99){ //===INSATISFACTORIO===//
							echo "<table>
									<tr>
										<td><font face='courier' size='1'>90-100</font></td>
										<td><font face='courier' size='1'>EXCELENTE</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>80-89</font></td>
										<td><font face='courier' size='1'>SUPERIOR</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>70-79</font></td>
										<td><font face='courier' size='1'>SATISFACTORIO</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>60-69</font></td>
										<td><font face='courier' size='1'>REGULAR</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'><b><u>0-59&nbsp;&nbsp;&nbsp;</u></b></font></td>
										<td><font face='courier' size='1'><b><u>INSATISFACTORIO</u></b></font></td>
									</tr>
								</table>";
						}else if($suma_total > 59.99 and $suma_total <= 69.99){ //===REGULAR===//
							echo "<table>
									<tr>
										<td><font face='courier' size='1'>90-100</font></td>
										<td><font face='courier' size='1'>EXCELENTE</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>80-89</font></td>
										<td><font face='courier' size='1'>SUPERIOR</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>70-79</font></td>
										<td><font face='courier' size='1'>SATISFACTORIO</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'><b><u>60-69&nbsp;&nbsp;&nbsp;</u></b></font></td>
										<td><font face='courier' size='1'><b><u>REGULAR</u></b></font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>0-59</font></td>
										<td><font face='courier' size='1'>INSATISFACTORIO</font></td>
									</tr>
								</table>";
						}else if($suma_total > 69.99 and $suma_total <= 79.99){ //===SATISFACTORIO===//
							echo "<table>
									<tr>
										<td><font face='courier' size='1'>90-100</font></td>
										<td><font face='courier' size='1'>EXCELENTE</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>80-89</font></td>
										<td><font face='courier' size='1'>SUPERIOR</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'><b><u>70-79&nbsp;&nbsp;&nbsp;</u></b></font></td>
										<td><font face='courier' size='1'><b><u>SATISFACTORIO</u></b></font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>60-69</font></td>
										<td><font face='courier' size='1'>REGULAR</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>0-59</font></td>
										<td><font face='courier' size='1'>INSATISFACTORIO</font></td>
									</tr>
								</table>";
						}else if($suma_total > 79.99 and $suma_total <= 89.99){ //===SUPERIOR===//
							echo "<table>
									<tr>
										<td><font face='courier' size='1'>90-100</font></td>
										<td><font face='courier' size='1'>EXCELENTE</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'><b><u>80-89&nbsp;&nbsp;&nbsp;</u></b></font></td>
										<td><font face='courier' size='1'><b><u>SUPERIOR</u></b></font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>70-79</font></td>
										<td><font face='courier' size='1'>SATISFACTORIO</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>60-69</font></td>
										<td><font face='courier' size='1'>REGULAR</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>0-59</font></td>
										<td><font face='courier' size='1'>INSATISFACTORIO</font></td>
									</tr>
								</table>";
						}else if($suma_total > 89.99 and $suma_total <= 100){ //===EXCELENTE===//
							echo "<table>
									<tr>
										<td><font face='courier' size='1'><b><u>90-100&nbsp;&nbsp;&nbsp;</u></b></font></td>
										<td><font face='courier' size='1'><b><u>EXCELENTE</u></b></font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>80-89</font></td>
										<td><font face='courier' size='1'>SUPERIOR</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>70-79</font></td>
										<td><font face='courier' size='1'>SATISFACTORIO</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>60-69</font></td>
										<td><font face='courier' size='1'>REGULAR</font></td>
									</tr>
									<tr>
										<td><font face='courier' size='1'>0-59</font></td>
										<td><font face='courier' size='1'>INSATISFACTORIO</font></td>
									</tr>
								</table>";
						}
					}else if($renglon == 2){
						echo "<small><center><font face='courier' size='2'>Renglon A-9</font></center></small>";
					}else if($renglon == 3){
						echo "<small><center><font face='courier' size='2'>Renglon A-10</font></center></small>";
					}
					?>
					</center></small></font>
				</td>
			</tr>	
			
			<tr>
			<td colspan='5'><small><font face="courier" size='1'>Acepto los resultados de la evaluacion</font></small></td>
			<td ><center><small><font face="courier" size='1'>SI  NO</font></center></small></td>
			</tr>	
			<tr>
			<td colspan='6'><strong><small><font face="courier" size='2'>PARTE V. AUTENTICACION</font></small></strong></td>
			</tr>
			
			<tr>
			<td colspan='6'><b><font face="courier" size='2'>OBSERVACIONES:</font></center></b></br>
			<small><font face="courier" size='1'><?php echo $obs_mia; ?></font></small>
			</tr>
			
			<tr>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>FIRMA DEL EVALUADO</font></center></small></strong><br><br></td>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>FIRMA DEL EVALUADOR INMEDIATO</font></center></small></strong><br><br></td>
			<td colspan='2'><center><strong><small><font face="courier" size='2'>FIRMA DEL EVALUADOR FINAL</font></center></small></strong><br><br></td>
			</tr>
			
			<tr>
			<td colspan='3'><center><strong><small><font face="courier" size='2'>AUNTENTICA:<br>OFICIAL DE PERSONAL</font></center></small></strong><br><br></td>
			<td colspan='3'><center><strong><small><font face="courier" size='2'>Vo.Bo.<br> COMANDANTE, JEFE , DIRECTOR</font></center></small></strong><br><br></td>
			</tr>
			<tr>
			<td colspan='6'><strong><small><font face="courier" size='2'>FECHA:</small></strong><br><?php $fecha = $ClsPer->trae_fecha($eva); echo cambia_fecha_mes($fecha); ?></font> </td>
			</tr>
			
			<table>
			</td>
			</tr>
			
			</table>
			</table>
		</table>
	</div>