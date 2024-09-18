<?php
include_once('../html_fns.php');
include_once("xajax_fns_my.php");
date_default_timezone_set('America/Guatemala');

$usuario = $_REQUEST['catalogo'];
session_start();
$dependencia1 = $_SESSION['dep_cod'];
$usuario1 = $_SESSION['auth_user'];
$plaza1 = $_SESSION['org_plaza'];
$dep_desc = $_SESSION['dep_desc'];
// var_dump($dep_desc);
$ClsPer = new ClsPersonal();
$result = $ClsPer->get_personal_usuario($usuario);
if (is_array($result)) {
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
		$tipo_oficial = $row['GRA_CLASE'];
	}
} else {
	echo '<script>
			alert("ESTE CATALOGO NO EXISTE EN SU DEPENDENCIA");
			history.back()
			</script>';
	exit();
}

// $t_puesto = 88;
$nombre = $nom1 . " " . $nom2 . " " . $ape1 . " " . $ape2;
$nombre = utf8_encode($nombre);
// SE AGREGO ESTA VALIDACIÓN POR LA REESTRUCTURACIÓN DE BRIGADAS, POR EL TIEMPO EN LA TABLA TIEMPOS
// ESTAS PERSONAS NO PODIAN EVALUAR, POR LO QUE SE CÁLCULO EL TIEMPO CON BASE AL PUESTO ANTERIOR
// if($dependencia1 == '2665' || $dependencia1 == '2660' || $dependencia1 == '2810' || $dependencia1 == '2815' || $dependencia1 == '2680'|| $dependencia1 == '2685'|| $dependencia1 == '2640' || $dependencia1 == '2960' ){
// 	// echo "hola";
// 	$tiempoQuery = $ClsPer->calculoTiempoDpue($usuario)[0]['PUE_FEC_NOMB']; 
// 	$fecha1 = new DateTime($tiempoQuery);
// 	// var_dump($fecha1);
// 	$fechaActual = new DateTime();
// 	$diferencia = $fecha1->diff($fechaActual);
// 	// echo json_encode($diferencia);
// 	$years = str_pad($diferencia->y, 2, "0", STR_PAD_LEFT);
// 	$months = str_pad($diferencia->m, 2, "0", STR_PAD_LEFT);
// 	$days = str_pad($diferencia->d, 2, "0", STR_PAD_LEFT);

// 	// echo json_encode($t_pue);
// 	// echo json_encode($months);
// 	// echo json_encode($days);

// 	$t_puesto = ($years != '00' ? $years : '') .  $months . ($days != '00' ? $days : '');
// 	// echo json_encode($t_pue);
// 	// echo json_encode($months);
// 	// echo json_encode($days);


// }
$t_pue = tiempo($t_puesto);

$puesto_ant = $ClsPer->get_puestos($usuario);
$result2 = $ClsPer->get_datos_subjefe();
if (is_array($result2)) {
	foreach ($result2 as $row) {
		$nom1sub = $row['PER_NOM1'];
		$nom2sub = $row['PER_NOM2'];
		$ape1sub = $row['PER_APE1'];
		$ape2sub = $row['PER_APE2'];
		$gradosub = $row['GRA_DESC_LG'];
		$codigo_grado1sub = $row['GRA_CODIGO'];
		$armasub = $row['ARM_DESC_LG'];
		$codigo_arma1sub = $row['ARM_CODIGO'];
		$empleosub = $row['PER_DESC_EMPLEO'];
		$t_puestosub = $row['T_PUESTO'];
		$catalogo_sub = $row['PER_CATALOGO'];
	}
}
$nombresub = $nom1sub . " " . $nom2sub . " " . $ape1sub . " " . $ape2sub;
$nombresub = utf8_encode($nombresub);
$t_puesub = tiempo($t_puestosub);

if ($codigo_grado1sub == 46 || $codigo_grado1sub == 59 || $codigo_grado1sub == 65 || $codigo_grado1sub == 73 || $codigo_grado1sub == 81 || $codigo_grado1sub == 88 || $codigo_grado1sub == 92 || $codigo_grado1sub == 93 || $codigo_grado1sub == 96 || $codigo_grado1sub == 97 || $codigo_grado1sub == 99 || $codigo_grado1sub == 40) {
	$nombresub1 = $gradosub . ' ' . $nombresub;
} else {
	$nombresub1 = $gradosub . ' DE ' . $armasub . ' ' . $nombresub;
}


$result3 = $ClsPer->get_datos_jefe();
if (is_array($result3)) {
	foreach ($result3 as $row) {
		$nom1_jefe = $row['PER_NOM1'];
		$nom2_jefe = $row['PER_NOM2'];
		$ape1_jefe = $row['PER_APE1'];
		$ape2_jefe = $row['PER_APE2'];
		$grado_jefe = $row['GRA_DESC_LG'];
		$codigo_grado_jefe = $row['GRA_CODIGO'];
		$arma_jefe = $row['ARM_DESC_LG'];
		$codigo_arma_jefe = $row['ARM_CODIGO'];
		$empleo_jefe = $row['PER_DESC_EMPLEO'];
		$t_puesto_jefe = $row['T_PUESTO'];
		$catalogo_jefe = $row['PER_CATALOGO'];
	}
}
$nombre_jefe = $nom1_jefe . " " . $nom2_jefe . " " . $ape1_jefe . " " . $ape2_jefe;
$nombre_jefe = utf8_encode($nombre_jefe);
$t_puesto_jefe = tiempo($t_puesto_jefe);

if ($codigo_grado_jefe == 46 || $codigo_grado_jefe == 59 || $codigo_grado_jefe == 65 || $codigo_grado_jefe == 73 || $codigo_grado_jefe == 81 || $codigo_grado_jefe == 88 || $codigo_grado_jefe == 92 || $codigo_grado_jefe == 93 || $codigo_grado_jefe == 96 || $codigo_grado_jefe == 97 || $codigo_grado_jefe == 99 || $codigo_grado_jefe == 40) {
	$nombre_jefe1 = $grado_jefe . ' ' . $nombre_jefe;
} else {
	$nombre_jefe1 = $grado_jefe . ' DE ' . $arma_jefe . ' ' . $nombre_jefe;
}

$total_sol = $ClsPer->comprueba_auto($usuario, $comp_eva, 1);
if ($total_sol > 0) {
	echo '<script>
				alert("ESTE CATALOGO YA TIENE BORRADOR REGISTRADO PARA EL PERIODO ' . $comp_eva . '" );
				history.back()
				</script>';
	exit();
}

?>
<?php include_once('../fecha.php');
$total_sol = $ClsPer->comprueba_auto($usuario, $comp_eva, 1);
if ($total_sol > 0) {
	echo '<script>
				alert("ESTE CATALOGO YA TIENE BORRADOR REGISTRADO PAsdfsfdsfRA EL PERIODO ' . $comp_eva . '" );
				history.back()
				</script>';
	exit();
} ?>
<!DOCTYPE html>
<html>

<head>
	<?php
	$xajax->printJavascript("..");
	?>
	<meta charset="utf-8" content="text/html;" http-equiv="content-type">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Evaluacion del des. 2</title>
	<link rel="shortcut icon" href="img/medallon.png">
	<!--=============================LIBRERIAS DE BOOTSTRAP======================================-->
	<link href='../assets/css/bootstrap.css' rel='stylesheet' />
	<link href='../assets/css/bootstrap-responsive.css' rel='stylesheet' />
	<link href="../assets/css/docs.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<style>
		#bg {
			position: center;
			z-index: -1;
			middle: 70;
			center: 40;
			width: 20%;

		}
	</style>
	<script>
		function trae_usuario(num) {
			var dep = document.getElementById('dep').value;
			if (num == 1) {
				var cat_inmediato = document.getElementById('inmediato');
				xajax_Trae_Datos_Catalogo_inmediato(cat_inmediato.value, dep);
			} else {
				var eva_final = document.getElementById('eva_final');
				xajax_Trae_Datos_Catalogo_comte(eva_final.value, dep);
			}
		}


		function Grabar_formulario(parametro) {
			console.log("Parámetro recibido:", parametro);
			function obtenerValor(id) {
        var elemento = document.getElementById(id);
        if (!elemento) {
            console.error("El elemento con id '" + id + "' no se encontró en el DOM.");
            return null;
        }
        return elemento.value;
    }
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
			var tipo_oficial = document.getElementById('tipo_oficial').value;

			if (tipo_oficial != '3') {

				if (codigo_grado1 != "") {
					if (linea != "") {
						if (destino != "") {
							if (eva_final != "") {
								if (empleo1 != "") {
									if (tiempo1 != "") {
										if (puesto_ant != "") {

											xajax_Grabar_borrador(evaluacion, linea, destino, autoevaluado, inmediato, eva_final, codigo_arma1, codigo_grado1, empleo1, tiempo1, codigo_arma2, codigo_grado2, empleo2, tiempo2, codigo_arma3, codigo_grado3, empleo3, tiempo3, puesto_ant, dep, renglon, tipo_evaluacion,tipo_oficial);

										} else {
											alert("Debe ingresar el puesto anterior!!!");
											foco('puesto_ant');
										}
									} else {
										alert("Debe ingresar el tiempo en el empleo!!!");
										foco('tiempo1');
									}
								} else {
									alert("Debe ingresar el empleo actual!!!");
									foco('empleo1');
								}
							} else {
								alert("Debe ingresar al evaluador final!!!");
								foco('eva_final');
							}

						} else {
							alert("Debe de ingresar el destino actual !!!");
							foco('destino');
						}
					} else {
						alert("Debe ingresar la linea de carrera actual!!!");
						foco('linea');
					}
				} else {
					alert("Debe ingresar Grado Actual!!!");
					foco('codigo_grado1');
				}

			} else {
				

				//tipo_evaluacion = '3';
				if (codigo_grado1 != "") {
					if (linea != "") {
						if (destino != "") {
							if (eva_final != "") {
								if (empleo1 != "") {
									if (tiempo1 != "") {
										if (puesto_ant != "") {
											xajax_Grabar_borrador(evaluacion, linea, destino, autoevaluado, inmediato, eva_final, codigo_arma1, codigo_grado1, empleo1, tiempo1, codigo_arma2, codigo_grado2, empleo2, tiempo2, codigo_arma3, codigo_grado3, empleo3, tiempo3, puesto_ant, dep, renglon, tipo_evaluacion,tipo_oficial);

										} else {
											alert("Debe ingresar el puesto anterior!!!");
											foco('puesto_ant');
										}
									} else {
										alert("Debe ingresar el tiempo en el empleo!!!");
										foco('tiempo1');
									}
								} else {
									alert("Debe ingresar el empleo actual!!!");
									foco('empleo1');
								}
							} else {
								alert("Debe ingresar al evaluador final!!!");
								foco('eva_final');
							}

						} else {
							alert("Debe de ingresar el destino actual !!!");
							foco('destino');
						}
					} else {
						alert("Debe ingresar la linea de carrera actual!!!");
						foco('linea');
					}
				} else {
					alert("Debe ingresar Grado Actual!!!");
					foco('codigo_grado1');
				}
			}
		}

	
		function foco(elemento) {
			document.getElementById(elemento).focus();
		}

		function justNumbers(e) {
			var keynum = window.event ? window.event.keyCode : e.which;
			if ((keynum == 8) || (keynum == 46))
				return true;

			return /\d/.test(String.fromCharCode(keynum));
		}


		function CloseWindow() {
			window.location.assign("../CP_UL1/Frm_ul.php");
		}


		function mayusculas(n) {
			cadena = n.value;
			cadena = cadena.toUpperCase();
			band = false;
			for (i = 0; i < cadena.length; i++) {
				letra = cadena.substring(i, i + 1);
				if ((letra == "'") || (letra == '"') || (letra == 'á') || (letra == 'é') || (letra == 'í') || (letra == 'ó') || (letra == 'ú') || (letra == '´') || (letra == '`') || (letra == 'Á') || (letra == 'É') || (letra == 'Í') || (letra == 'Ó') || (letra == 'Ú') || (letra == 'à') || (letra == 'è') || (letra == 'ì') || (letra == 'ò') || (letra == 'ù') || (letra == 'À') || (letra == 'È') || (letra == 'Ì') || (letra == 'Ò') || (letra == 'Ù')) {
					cadena2 = cadena;
					cadena = cadena2.replace(letra, "");
					band = true;
				}
			}
			if (band == true) {
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

	<?php include_once('../menu_iclude.php'); ?>

	<div class='modal hide fade' id='alert_modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'></div>

	<br>
	<div class='container'>
		<div class="row-fluid">
			<div class="alert alert-info span12" align="center">
				<b>EVALUACION DEL DESEMPE&Ntilde;O LABORAL</b>
			</div>
		</div> <br>
		<form accept-charset="UTF-8">
			<table width='100%' border='1'>

				<div class='row-fluid'>
					<div class='span2'>
						<P class='pull-left'>
							<smallint>AUTOEVALUACION</smallint>
						</P>
					</div>
					<?php 				
					
				
					if ($mes == 5 or $mes == 6 or $mes == 7 or $mes == 8 ) { ?>
						<div class='span2'>
							<!-- <input type = 'text' class='span12' name = 'evaluacion' id = 'evaluacion' value ='1 - <?php echo $annio; ?>' readonly></input>  -->
							<input type='text' class='span12' name='evaluacion' id='evaluacion' value='<?php echo $comp_eva; ?>' readonly></input>
						</div>
					<?php } elseif ($mes == 9 or $mes == 11 or $mes == 12 or $mes == 1 or $mes == 2) { ?>
						<div class='span2'>
							<input type='text' class='span12' name='evaluacion' id='evaluacion' value='<?php echo $comp_eva; ?>' readonly></input>
							<!-- <input type = 'text' class='span12' name = 'evaluacion' id = 'evaluacion' value ='2 - <?php echo $annio; ?>' readonly></input>  -->
						</div>
					<?php } ?>

					<div class='span4'>
					</div>
					<div class='span2'>
						Seleccione renglon:
					</div>

					<?php //if($t_puesto >= 90){
					?>
					<select name="renglon" id="renglon" class="span2">
						<option value="1" selected>NORMAL</option>
						<option value="2">RENGLON A-9</option>
						<option value="3">RENGLON A-10</option>
					</select>
					<?php //}else{
					?>
					<!--<select name="renglon" id="renglon" class = "span2" readonly>
			<option value="3" selected>RENGLON A-10</option>
		</select>-->
					<?php //}
					?>

				</div>

				<tr>
					<th>
						<h3>
							<center>EJERCITO DE GUATEMALA</center>
						</h3>
					</th>
					<th>
						<h3>
							<center>DEPENDENCIA</br>
								<?php echo $dep_desc; ?>
							</center>
						</h3>
					</th>
				</tr>
			</table>

			<input type='hidden' name='tipo_evaluacion' id='tipo_evaluacion' value='1'></input>
			<!--el TIPO 7 == borrador, 4 es autoevaluacion, 5 = inmediato, 6 = final-->
			<input type='hidden' name='usuario' id='usuario' value='<?php echo $usuario1; ?>'></input>
			<input type='hidden' name='autoevaluado' id='autoevaluado' value='<?php echo $usuario; ?>'></input>
			<input type='hidden' name='codigo_arma1' id='codigo_arma1' value='<?php echo $codigo_arma1; ?>'></input>

			<!--<input type='hidden' name='empleo1' id='empleo1' value='<?php //echo $empleo; 
																		?>'></input>
		<input type='hidden' name='tiempo1' id='tiempo1' value='<?php //echo $t_pue; 
																?>'></input>
		<?php //if($puesto_ant != "") {
		?>
		<input type='hidden' name='puesto_ant' id='puesto_ant' value='<?php //echo $puesto_ant; 
																		?>'></input>
		<?php //}else{
		?>
		<input type='hidden' name='puesto_ant' id='puesto_ant' value='DESCONOCIDO'></input>-->
			<?php //}
			?>
			<input type='hidden' name='dep' id='dep' value='<?php echo $dependencia1; ?>'></input>
			<table width='100%' border='1'>
				<tr>
					<td>
						<table border='1' width='100%'>
							<tr>
								<td colspan='5'><strong><small>PARTE I. DATOS ADMINISTRATIVOS</small></strong></td>
							</tr>
							<tr>
								<td>
									<center><strong><small>CATALOGO:<br><br></small></strong>
										<?php echo $usuario; ?>
									</center>
								</td>
								<td>
									<center><strong><small>NOMBRES Y APELLIDOS:<br><br></small></strong>
										<?php echo utf8_encode($nombre); ?>
									</center>
								</td>
								<td>
									<center><strong><small>GRADO:<br><br></small></strong>
										<?php echo combo_grados1(); ?>
									</center>
								</td>
								<td>
									<center><strong><small>ARMA O SERVICIO:<br><br></small></strong>
										<?php echo $arma; ?>
									</center>
								</td>
								<td>
									<center><strong><small>LINEA DE CARRERA ACTUAL:<br></small></strong>
										<?php echo combo_linea(); ?>
									</center>
								</td>
							</tr>
							<tr>
								<td colspan='2'>
									<center><strong><small>EMPLEO ACTUAL Y UNIDAD<br><br></small></strong><input type="text" id='empleo1' name='empleo1' class='span4' value='<?php echo $empleo; ?>' onkeyup='mayusculas(this);'></input></center>
								</td>
								<td>
									<center><strong><small>TIEMPO EN EL EMPLEO ACTUAL<br><br></small></strong><input type="text" id='tiempo1' name='tiempo1' class='span2' value='<?php echo $t_pue; ?>' onkeyup='mayusculas(this);'></input></small></strong></center>
								</td>
								<td>
									<center><strong><small>EMPLEO ANTERIOR<br><br></small></strong><input type="text" id='puesto_ant' name='puesto_ant' class='span3' value='<?php if ($puesto_ant != "") {
																																													echo $puesto_ant;
																																												} else {
																																													$puesto_ant = "DESCONOCIDO";
																																													echo $puesto_ant;
																																												} ?>' onkeyup='mayusculas(this);'></input></center>
								</td>
								<td>
									<center><strong><small>DESTINO ACTUAL<br><br></small></strong><input type="text" id='destino' name='destino' class='span2' value='<?php echo $dep_desc; ?>' onkeyup='mayusculas(this);'></input></center>
								</td>
							</tr>
							<tr>
								<td colspan='5'><strong><small>PARTE II. EVALUADORES</small></strong> </input><input type='hidden' name='tipo_oficial' id='tipo_oficial' value='<?php echo ($tipo_oficial); ?>'></input></td> 
							</tr>
							<?php if ($tipo_oficial != '3') : ?>
								<tr>
									<td colspan='2'>
										<center><strong><small>GRADO Y NOMBRE DEL EVALUADOR
													INMEDIATO</small></strong><br><input type='text' class='span3' id='nombre_inmediato' placeholder='Evaluador inmediato'></input>
											<?php echo combo_grados2(); ?><input type='hidden' name='codigo_arma2' id='codigo_arma2' value=''></input>
										</center>
									</td>
									<td>
										<center><strong><small>CATALOGO</small></strong><br><input type="text" id='inmediato' onblur='trae_usuario(1);' name='inmediato' class='span2' placeholder='Catalogo...' maxlength='6' onkeypress="return justNumbers(event);"></input></center>
									</td>
									<td>
										<center><strong><small>EMPLEO</small></strong><br><input type='text' class='span3' id='empleo2' placeholder='Empleo' value='' onkeyup='mayusculas(this);'></input></center>
									</td>
									<td>
										<center><strong><small>TIEMPO EN EL EMPLEO</small></strong><br><input type='text' class='span2' id='tiempo2' placeholder='Tiempo/Puesto' value='' onkeyup='mayusculas(this);'></input></center>
									</td>
								</tr>
								<tr>
									<td colspan='2'>
										<center><strong><small>GRADO Y NOMBRE DEL EVALUADOR FINAL</small></strong><br><input type='text' class='span3' id='nombre_comte' placeholder='Evaluador final'></input>
											<?php echo combo_grados3(); ?><input type='hidden' name='codigo_arma3' id='codigo_arma3' value=''></input>
										</center>
									</td>
									<td>
										<center><strong><small>CATALOGO</small></strong><br><input type="text" id='eva_final' onblur='trae_usuario(2);' name='eva_final' class='span2' placeholder='Catalogo...' maxlength='6' onkeypress="return justNumbers(event);"></input></center>
									</td>
									<td>
										<center><strong><small>EMPLEO</small></strong><br><input type='text' class='span3' id='empleo3' placeholder='Empleo' value='' onkeyup='mayusculas(this);'></input></center>
									</td>
									<td>
										<center><strong><small>TIEMPO EN EL EMPLEO</small></strong><br><input type='text' class='span2' id='tiempo3' placeholder='Tiempo/Puesto' value='' onkeyup='mayusculas(this);'></input></center>
									</td>
								</tr>

							<?php else : ?>
								<input type="hidden" id='inmediato'  name='inmediato' class='span2' value="635433" disabled></input>
								<input type='hidden' class='span3' id='empleo2' placeholder='Empleo' value='0' disabled></input>
								<input type='hidden' class='span2' id='tiempo2' value="0" disabled></input>
								<input type='hidden' name='codigo_arma2' id='codigo_arma2' value='0' disabled></input>
								<input type='hidden' name='codigo_grado2' id='codigo_grado2' value='0' disabled></input>
								<!-- <input type='hidden' name='codigo_grado2' id='codigo_grado2' value='3'></input> -->



								<tr>
									<td colspan='2'>
										<center><strong><small>GRADO Y NOMBRE DEL EVALUADOR FINAL</small></strong><br><input type='text' class='span3' id='nombre_comte' placeholder='Evaluador final'></input>
											<?php echo combo_grados3(); ?><input type='hidden' name='codigo_arma3' id='codigo_arma3' value=''></input>
										</center>
									</td>
									<td>
										<center><strong><small>CATALOGO</small></strong><br><input type="text" id='eva_final' onblur='trae_usuario(2);' name='eva_final' class='span2' placeholder='Catalogo...' maxlength='6' onkeypress="return justNumbers(event);"></input></center>
									</td>
									<td>
										<center><strong><small>EMPLEO</small></strong><br><input type='text' class='span3' id='empleo3' placeholder='Empleo' value='' onkeyup='mayusculas(this);'></input></center>
									</td>
									<td>
										<center><strong><small>TIEMPO EN EL EMPLEO</small></strong><br><input type='text' class='span2' id='tiempo3' placeholder='Tiempo/Puesto' value='' onkeyup='mayusculas(this);'></input></center>
									</td>
								</tr>

							<?php endif; ?>

						</table>
			</table><br><br>
			<div align="center">
				&#32;<input class="btn btn-warning span3" type="reset" title="Limpiar" value="LIMPIAR BORRADOR" />
				&#32;<input class="btn btn-primary span3" type="button" title="Grabar" value="GRABAR BORRADOR" onclick="Grabar_formulario(1);" /> <!--onclick="Grabar_formulario();"-->
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