<?php
include_once('html_fns_eva.php');
include_once('../html_fns.php');

$eva = $_REQUEST["eva"];

session_start();
$dependencia1 = $_SESSION['dep_cod'];
$usuario1 = $_SESSION['auth_user'];
$plaza1 = $_SESSION['org_plaza'];
$dep_desc = $_SESSION['dep_desc'];



$ClsPer = new ClsPersonal();
$result = $ClsPer->get_eva($eva);

foreach ($result as $row) {
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
$gra1 = $ClsPer->trae_grados($gra11, 1);
$gra2 = $ClsPer->trae_grados($gra21, 2);
$gra3 = $ClsPer->trae_grados($gra31, 2);
$ar1 = $ClsPer->trae_armas($ar11, 1);
$ar2 = $ClsPer->trae_armas($ar21, 2);
$ar3 = $ClsPer->trae_armas($ar31, 2);

$result4 = $ClsPer->get_personal_usuario($cat2);
foreach ($result4 as $row) {
	$nom_inm1 = $row['PER_NOM1'];
	$nom_inm2 = $row['PER_NOM2'];
	$ape_inm1 = $row['PER_APE1'];
	$ape_inm2 = $row['PER_APE2'];

}
if ($gra21 == 46 || $gra21 == 59 || $gra21 == 65 || $gra21 == 73 || $gra21 == 81 || $gra21 == 88 || $gra21 == 92 || $gra21 == 93 || $gra21 == 96 || $gra21 == 97 || $gra21 == 99 || $gra21 == 40) {
	$nombre_inmediato = $gra2 . " " . $nom_inm1 . " " . $nom_inm2 . " " . $ape_inm1 . " " . $ape_inm2;
} else {
	$nombre_inmediato = $gra2 . " " . $ar2 . " " . $nom_inm1 . " " . $nom_inm2 . " " . $ape_inm1 . " " . $ape_inm2;
}


$result5 = $ClsPer->get_personal_usuario($cat3);
foreach ($result5 as $row) {
	$nom_fin11 = $row['PER_NOM1'];
	$nom_fin21 = $row['PER_NOM2'];
	$ape_fin11 = $row['PER_APE1'];
	$ape_fin21 = $row['PER_APE2'];
}
if ($gra31 == 46 || $gra31 == 59 || $gra31 == 65 || $gra31 == 73 || $gra31 == 81 || $gra31 == 88 || $gra31 == 92 || $gra31 == 93 || $gra31 == 96 || $gra31 == 97 || $gra31 == 99 || $gra31 == 40) {
	$nombre_fin = $gra3 . " " . $nom_fin11 . " " . $nom_fin21 . " " . $ape_fin11 . " " . $ape_fin21;
} else {
	$nombre_fin = $gra3 . " " . $ar3 . " " . $nom_fin11 . " " . $nom_fin21 . " " . $ape_fin11 . " " . $ape_fin21;
}

$result = $ClsPer->get_personal_usuario($usuario);
foreach ($result as $row) {
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
	$serie = $row['PER_SERIE'];
}

$nombre = $nom1 . " " . $nom2 . " " . $ape1 . " " . $ape2;


$t_pue = tiempo($t_puesto);

?>
<meta charset="UTF-8">
<link href='../assets/css/bootstrap.css' rel='stylesheet' />
<link href='../assets/css/bootstrap-responsive.css' rel='stylesheet' />
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
<div align="center" id="print">
	<div class="btn-group">
		<center>
			<a class="btn btn-info" onclick='pageprint();' class="btn btn-info btn-lg">
				<span class="glyphicon glyphicon-home"></span> IMPRIMIR
			</a>
		</center>
	</div>
</div>
<!--el divlandscape es para poner la pagina horizontalmente -->
<div class='container'>
	<table width='102%' border='1' height='100px'>
		<tr>
			<td>
				<table border='1' width='102%'>
					<tr>
						<td colspan='5'><strong><small>
									<font face="courier" size='1'>REPORTE FINAL EVALUACION DEL DESEMPE&Ntilde;O <br>
										Forma No. SAGE DP-RRHH-evaluacion
										<?php echo $periodo; ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Codigo de
										evaluacion:
										<?php echo Agrega_Ceros($eva); ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp No.Serie
										<?php echo $serie; ?>
									</font>
								</small></strong></td>
					</tr>
					<tr>
						<td colspan='5'><strong><small>
									<font face="courier" size='1'>PARTE I. DATOS ADMINISTRATIVOS</font>
								</small></strong></td>
					</tr>
					<tr>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>CATALOGO:</font><br></strong>
								<font face="courier" size='1'>
									<?php echo $usuario; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>NOMBRES Y APELLIDOS:</font><br></strong>
								<font face="courier" size='1'>
									<?php echo $nombre; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>GRADO:</font><br></strong>
								<font face="courier" size='1'>
									<?php echo $gra1; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>ARMA O SERVICIO:</font><br></strong>
								<font face="courier" size='1'>
									<?php echo $ar1; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>LINEA DE CARRERA ACTUAL:</font><br></strong>
								<font face="courier" size='1'>
									<?php $linea1 = $ClsPer->trae_linea($linea);
									echo $linea1; ?>
								</font></small>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<center><strong><small>
										<font face="courier" size='1'>EMPLEO ACTUAL Y UNIDAD</font><br></strong>
								<font face="courier" size='1'>
									<?php echo $emp1; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>TIEMPO EN EL EMPLEO ACTUAL</font><br></strong>
								<font face="courier" size='1'>
									<?php echo $tie1; ?>
								</font></small></strong>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>EMPLEO ANTERIOR</font><br></strong>
								<font face="courier" size='1'>
									<?php echo $e_ant; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>DESTINO ACTUAL</font><br></strong>
								<font face="courier" size='1'>
									<?php echo $dest; ?>
								</font></small>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan='5'><strong><small>
									<font face="courier" size='1'>PARTE II. EVALUADORES</font>
								</small></strong></td>
					</tr>
					<tr>
						<td colspan='2'>
							<center><strong><small>
										<font face="courier" size='1'>GRADO Y NOMBRE DEL EVALUADOR INMEDIATO</font>
										</strong><br>
								<font face="courier" size='1'>
									<?php echo $nombre_inmediato; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>CATALOGO</font></strong><br>
								<font face="courier" size='1'>
									<?php echo $cat2; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>EMPLEO</font></strong><br>
								<font face="courier" size='1'>
									<?php echo $emp2; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>TIEMPO EN EL EMPLEO</font></strong><br>
								<font face="courier" size='1'>
									<?php echo $tie2; ?>
								</font></small>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<center><strong><small>
										<font face="courier" size='1'>GRADO Y NOMBRE DEL EVALUADOR FINAL</font>
										</strong><br>
								<font face="courier" size='1'>
									<?php echo $nombre_fin; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>CATALOGO</font></strong><br>
								<font face="courier" size='1'>
									<?php echo $cat3; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>EMPLEO</font></strong><br>
								<font face="courier" size='1'>
									<?php echo $emp3; ?>
								</font></small>
							</center>
						</td>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>TIEMPO EN EL EMPLEO</font></strong><br>
								<font face="courier" size='1'>
									<?php echo $tie3; ?>
								</font></small>
							</center>
						</td>
					</tr>
					<tr>
						<td colspan='5'><strong><small>
									<font face="courier" size='1'>PARTE III. AREAS DE DESEMPE&Ntilde;O</font>
								</small></strong></td>
					</tr>
				</table>
				<table border='1' width='102%' >
					<tr>
						<td>
							<center><strong><small>
										<font face="courier" size='1'>No.</font>
									</small></strong></center>
						</td>
						<td colspan='5' style='height:10px;'><strong><small>
									<center>
										<font face="courier" size='1'>FACTORES DE EVALUACION</font>
									</center>
								</small></strong></td>
					</tr>
					<tr>
						<td></td>
						<td><strong><small>
									<center>
										<font face="courier" size='1'>DESEMPE&Ntilde;O LABORAL</font>
									</center>
								</small></strong></td>
						<td></td>
						<td></td>
						<td style='height:10px;'><strong><small>
									<center>
										<font face="courier" size='1'>APTITUDES MILITARES</font>
									</center>
								</small></strong></td>

					</tr>

					<tr>
						<td>
							<center><small>
									<font face="courier" size='1'>1.</font>
								</small></center>
						</td>
						<td><small>
								<font face="courier" size='1'>Produccion y calidad de trabajo</font>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 1);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>

						<td style='height:10px;'>
							<center><small>
									<font face="courier" size='1'>1.</font>
								</small></center>
						</td>
						<td style='height:10px;'><small>
								<font face="courier" size='1'>Iniciativa</font>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 11);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>
					</tr>

					<tr>
						<td>
							<center><small>
									<font face="courier" size='1'>2.</font>
								</small></center>
						</td>
						<td><small>
								<font face="courier" size='1'>Conocimiento del empleo</font><br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 2);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>

						<td style='height:10px;'>
							<center><small>
									<font face="courier" size='1'>2.</font>
								</small></center>
						</td>
						<td style='height:10px;'><small>
								<font face="courier" size='1'>Abnegacion</font><br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 12);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>
					</tr>

					<tr>
						<td>
							<center><small>
									<font face="courier" size='1'>3.</font>
								</small></center>
						</td>
						<td><small>
								<font face="courier" size='1'>Trabajo en equipo</font><br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 3);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>

						<td style='height:10px;'>
							<center><small>
									<font face="courier" size='1'>3.</font>
								</small></center>
						</td>
						<td style='height:10px;'><small>
								<font face="courier" size='1'>Porte<br></font>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 13);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>
					</tr>

					<tr>
						<td>
							<center><small>
									<font face="courier" size='1'>4.</font>
								</small></center>
						</td>
						<td><small>
								<font face="courier" size='1'>Trabajo bajo presion</font><br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 4);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>

						<td style='height:10px;'>
							<center><small>
									<font face="courier" size='1'>4.</font>
								</small></center>
						</td>
						<td style='height:10px;'><small>
								<font face="courier" size='1'>Liderazgo</font><br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 14);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>
					</tr>

					<tr>
						<td>
							<center><small>
									<font face="courier" size='1'>5.</font>
								</small></center>
						</td>
						<td><small>
								<font face="courier" size='1'>Puntualidad<br></font>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 5);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>

						<td style='height:10px;'>
							<center><small>
									<font face="courier" size='1'>5.</font>
								</small></center>
						</td>
						<td style='height:10px;'><small>
								<font face="courier" size='1'>Espiritu de cuerpo</font><br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 15);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>
					</tr>



					<tr>
						<td></td>
						<td><strong><small>
									<center>
										<font face="courier" size='1'>CAPACIDADES ADMINISTRATIVAS</font>
									</center>
								</small></strong></td>
						<td></td>
						<td></td>
						<td style='height:10px;'><strong><small>
									<center>
										<font face="courier" size='1'>CUALIDADES PERSONALES</font>
									</center>
								</small></strong></td>
						<td></td>
					</tr>



					<tr>
						<td>
							<center><small>
									<font face="courier" size='1'>1.</font>
								</small></center>
						</td>
						<td><small>
								<font face="courier" size='1'>Administracion de recursos</font><br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 6);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>

						<td style='height:10px;'>
							<center><small>
									<font face="courier" size='1'>1.</font>
								</small></center>
						</td>
						<td style='height:10px;'><small>
								<font face="courier" size='1'>Toma de decisiones<br></font>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 16);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>
					</tr>

					<tr>
						<td>
							<center><small>
									<font face="courier" size='1'>2.</font>
								</small></center>
						</td>
						<td><small>
								<font face="courier" size='1'>Cooperacion<br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 7);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>

						<td style='height:10px;'>
							<center><small>
									<font face="courier" size='1'>2.</font>
								</small></center>
						</td>
						<td style='height:10px;'><small>
								<font face="courier" size='1'>Relaciones interpersonales</font><br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 17);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>
					</tr>

					<tr>
						<td>
							<center><small>
									<font face="courier" size='1'>3.</font>
								</small></center>
						</td>
						<td><small>
								<font face="courier" size='1'>Supervision<br></font>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 8);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>

						<td style='height:10px;'>
							<center><small>
									<font face="courier" size='1'>3.</font>
								</small></center>
						</td>
						<td style='height:10px;'><small>
								<font face="courier" size='1'>Responsabilidad</font><br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 18);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>
					</tr>

					<tr>
						<td>
							<center><small>
									<font face="courier" size='1'>4.</font>
								</small></center>
						</td>
						<td><small>
								<font face="courier" size='1'>Destreza</font><br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 9);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>

						<td style='height:10px;'>
							<center><small>
									<font face="courier" size='1'>4.</font>
								</small></center>
						</td>
						<td style='height:10px;'><small>
								<font face="courier" size='1'>Compromiso<br></font>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 19);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>
					</tr>

					<tr>
						<td>
							<center><small>
									<font face="courier" size='1'>5.</font>
								</small></center>
						</td>
						<td><small>
								<font face="courier" size='1'>Ejecucion<br></font>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 10);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>

						<td style='height:10px;'>
							<center><small>
									<font face="courier" size='1'>5.</font>
								</small></center>
						</td>
						<td style='height:10px;'><small>
								<font face="courier" size='1'>Criterio</font><br>
							</small></td>
						<td>
							<center><small>
									<font face="courier" size='1'>
										<?php $total = $ClsPer->trae_notas($eva, 20);
										if ($total == 0) {
											$total = "-";
										} else if ($total == 15) {
											$total = "Excede";
										} else if (($total >= 9) and ($total <= 14)) {
											$total = "Cumple";
										} else {
											$total = "Necesita mejorar";
										}
										echo $total;
										?>
									</font>
								</small></center>
						</td>
					</tr>

					<tr>
						<td colspan='6' style='height:10px;'><strong><small>
									<font face="courier" size='1'>PARTE IV. CONCEPTO DE LOS EVALUADORES</font>
								</small></strong></td>
					</tr>
					<tr>
						<td colspan='6' style='height:10px; padding: 2%;'><b>
								<font face="courier" size='1'>EVALUADOR INMEDIATO:</font>
								</center>
							</b></br>
							<small>
								<font face="courier" size='1'>
									<?php echo $obs_inm; ?>
								</font>
							</small>
					</tr>
					<tr>
						<td colspan='6' style='height:10px; padding: 2%;'>
							<font face="courier" size='1'><b>EVALUADOR FINAL:</font>
							</center></b></br>
							<small>
								<font face="courier" size='1'>
									<?php echo $obs_final; ?>
								</font>
							</small>
					</tr>
					<tr>
						<td colspan='6' style='height:10px;'>
							<font face="courier" size='1'><strong><small>PARTE V. RESULTADO DE LA EVALUACION</font>
							</small></strong>
						</td>
					</tr>
					<tr>
						<td colspan='3' style='height:50px; padding: 2%;'>
							<font face="courier" size='1'>
								<center><strong><small>NOTA FINAL:
							</font>
							</center></small></strong>
							<?php if ($renglon == 1) { ?>
								<small>
									<center>
										<font face="courier" size='1'>
											<?php
											$nota_total1 = $ClsPer->trae_nota_total1($eva);
											$nota_total1p = $nota_total1 * 0.10;
											//echo ($nota_total1p);
											//echo '<br>';
											$nota_total2 = $ClsPer->trae_nota_total2($eva);
											$nota_total2p = $nota_total2 * 0.45;
											//echo ($nota_total2p);
											//echo '<br>';
											$nota_total3 = $ClsPer->trae_nota_total3($eva);
											$nota_total3p = $nota_total3 * 0.45;
											//echo ($nota_total3p);
											//echo '<br>';
											$nota_total4 = $ClsPer->trae_nota_total5($eva);
											$nota_total4p = $nota_total4 * 0.30;

											$nota_total5 = $ClsPer->trae_nota_total6($eva);
											$nota_total5p = $nota_total5 * 0.70;

											if ($nota_total1p <> '' or $nota_total2p <> '' or $nota_total3p <> '') {
												$suma_total = $nota_total1p + $nota_total2p + $nota_total3p;
												echo round($suma_total);
												$suma_total = round($suma_total);
												//echo $suma_total;
												//echo $suma_total;
										
											} elseif ($nota_total4p <> '' or $nota_total5p <> '') {
												$suma_total = $nota_total4p + $nota_total5p;
												echo round($suma_total);
												$suma_total = round($suma_total);
												echo $suma_total;
											} //$total_nota = $ClsPer->trae_nota_total($eva); echo $total_nota;?>
										</font>
									</center>
								</small>
								<!--<small><center><font face="courier" size='2'><?php //$total_nota = 89.99; echo $total_nota;?></font></center></small>-->
							<?php } ?>
						<td colspan='3' style='height:50px; padding: 2%;'>
							<font face="courier" size='1'>
								<center><strong><small>CATEGORIA:
							</font>
							</center></small></strong>
							<small>
								<center>
									<font face="courier" size='1'>
										<?php

										if ($renglon == 1) {
											if ($suma_total <= 59) { //===INSATISFACTORIO===//
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
											} else if ($suma_total >= 60 and $suma_total <= 69) { //===REGULAR===//
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
											} else if ($suma_total >= 70 and $suma_total <= 79) { //===SATISFACTORIO===//
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
											} else if ($suma_total >= 80 and $suma_total <= 89) { //===SUPERIOR===//
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
											} else if ($suma_total >= 90 and $suma_total <= 100) { //===EXCELENTE===//
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
										} else if ($renglon == 2) {
											echo "<small><center><font face='courier' size='1'>Renglon A-9</font></center></small>";
										} else if ($renglon == 3) {
											echo "<small><center><font face='courier' size='1'>Renglon A-10</font></center></small>";
										}
										?>
								</center>
							</small></font>
						</td>
					</tr>

					<tr>
						<td colspan='5'><small>
								<font face="courier" size='1'>Acepto los resultados de la evaluacion</font>
							</small></td>
						<td style='height:10px;'>
							<center><small>
									<font face="courier" size='1'>SI NO</font>
							</center></small>
						</td>
					</tr>
					<tr>
						<td colspan='6' style='height:10px;'><strong><small>
									<font face="courier" size='1'>PARTE VI. AUTENTICACION</font>
								</small></strong></td>
					</tr>

					<tr>
						<!-- ESTE STYLE ES EL QUE HACE QUE TODO SE PONGA IGUAL QUE ANTES -->
						<td colspan='6' style='height:10px; padding: 1%;'><b>
								<font face="courier" size='1'>OBSERVACIONES:</font>
								</center>
							</b></br>
							<small>
								<font face="courier" size='1'>
									<?php echo $obs_mia; ?>
								</font>
							</small>
					</tr>

					<tr>
						<td colspan='2' style='height:10px; padding: 2%;'>
							<center><strong><small>
										<font face="courier" size='1'>FIRMA DEL EVALUADO</font>
							</center></small></strong><br>
						</td>
						<td colspan='2' style='height:10px; padding: 2%;'>
							<center><strong><small>
										<font face="courier" size='1'>FIRMA DEL EVALUADOR INMEDIATO</font>
							</center></small></strong><br><br>
						</td>
						<td colspan='2' style='height:10px; padding: 2%;'>
							<center><strong><small>
										<font face="courier" size='1'>FIRMA DEL EVALUADOR FINAL</font>
							</center></small></strong><br><br>
						</td>
					</tr>
					<tr>
						<td colspan='3' style='height:10px; padding: 2%;'>
							<center><strong><small>
										<font face="courier" size='1'>AUNTENTICA:<br>OFICIAL DE PERSONAL</font>
							</center></small></strong><br><br>
						</td>
						<td colspan='3' style='height:10px; padding: 2%;'>
							<center><strong><small>
										<font face="courier" size='1'>Vo.Bo.<br> COMANDANTE, JEFE , DIRECTOR</font>
							</center></small></strong><br><br>
						</td>
					</tr>
					<table>
			</td>
		</tr>

	</table>
	</table>
	</table>
	<tr>
		<td colspan='6'><strong><small>
					<font face="courier" size='1'>FECHA:
				</small></strong>
			<?php $fecha = $ClsPer->trae_fecha($eva);
			echo cambia_fecha_mes($fecha); ?>
			</font>
		</td>
	</tr>
</div>