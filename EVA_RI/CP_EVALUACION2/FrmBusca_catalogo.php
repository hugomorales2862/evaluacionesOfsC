<?php
	include_once('xajax_fns_my.php');
	include_once('../html_fns.php');
	session_start();
	$usuario = $_SESSION['auth_user'];
	$plaza1 = $_SESSION['org_plaza'];
	$dependencia = $_SESSION['dep_cod'];
	$desc_dependencia1 = $_SESSION['dep_desc'];
	$desc_dependencia = utf8_encode($desc_dependencia1);
	
	include_once('../fecha.php');
		//==SE COMENTARIO PARA QUE GENERARÁ EL BORRADOR==//
		// if($mes == 6 or $mes == 7 or $mes == 8 or $mes == 12){
?>
<!--==============================================================================================================================================
=========================================================INICIA EL HTML===========================================================================
==================================================================================================================================================-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Evaluacion del des. 2</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>

		<?php
		$xajax->printJavascript("..");
		?>
		<!--=============================LIBRERIAS DE BOOTSTRAP======================================-->
		<link href='../assets/css/bootstrap.css' rel='stylesheet'/>
		<link href='../assets/css/bootstrap-responsive.css' rel='stylesheet'/>
		<link href="../assets/css/docs.css" rel="stylesheet">
		<link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
		<script>
		function enviar(){
			form = document.getElementById("f1")
			opt=document.getElementById('check');
			if(opt.checked){
				form.action = "Frm_bor.php";
			}else{
				form.action = "Frm_bor2.php";
			}
				form.submit();
		}	
		
		function justNumbers(e){
			var keynum = window.event ? window.event.keyCode : e.which;
			if ((keynum == 8) || (keynum == 46))
			return true;
			 
			return /\d/.test(String.fromCharCode(keynum));
		}
		
		function input(){
			opt=document.getElementById('check');
			if(opt.checked){
				alert("USTED A SELECCIONADO COMO EVALUADOR FINAL AL SUBJEFE DEL EMDN");
				// xajax_Desbloquar(cod);
			}else{
				alert("USTED A SELECCIONADO OTRO EVALUADOR FINAL");
				// xajax_Desbloquar2(cod);
			}
		} 
	</script>
	</head>
<!--==============================================================================================================================================
=========================================================INICIA EL BODY===========================================================================
==================================================================================================================================================-->
	<body>
		<div class='modal hide fade' id='alert_modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'></div>
		<!-- ============================================PERMISOS PARA EL ADMINISTRADOR ====================================================-->
	
	<?php include_once('../menu_iclude.php'); ?>

	
		<div id="container" align='center'>
		<br><br><br><br>
<!--==============================================================================================================================================
=========================================================FORMULARIO PARA BUSQUETA POR MEDIO DEL CATALOGO==========================================
==================================================================================================================================================-->
			<div class="container" bgcolor = "#B2C3E1">
				<table class='filas' align = "center" cellpadding="15px" border = '1' >
					<tr>
					<td colspan = '6' ALIGN = 'CENTER' bgcolor='#E3F6CE'> <b>CATALOGO PARA EVALUAR</b></td>
				</tr>
					<form class="form-search" name='f1' id='f1' method='POST'>
						<tr>
						<td bgcolor='#E3F6CE'>
						<center><input type="text" class="input-medium search-query" placeholder='No. de catalogo' name='catalogo' id='catalogo' maxlength='6' onkeypress="return justNumbers(event);"/></center><br>
						<center><button type="button" class="btn btn-info" onclick ="enviar();">Buscar</button><BR>
						</td></center>
						</tr>
						<tr>
						<td bgcolor='#E3F6CE' align='center'>
							<img src='../img/flecha.png' alt='' height='250' width='250' </center><input type='checkbox' id='check' name='check' value='' onclick='input();' />
							&nbsp&nbsp&nbsp <h3>Evalua SubJefe-EMDN</h3>
						</tr>
					</form>
				</table>
			</div>
		</div>
	<!--====================LIBRERIAS DE BOOTSTRAP PARA QUE NOS DESPLIEGUE CALENDARIO===================-->
	<script type="text/javascript">
			$('.form_datetime').datetimepicker({
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
		<script>
		$(document).ready(function() {
			$('#dataTables-example').dataTable();
		});
		</script>
	</body>
</html>
<?php 
		//==SE COMENTARIO PARA QUE GENERARÁ EL BORRADOR==//
		// }else{
			// echo'<script>
				// alert("NO ESTA DENTRO DE LAS FECHAS COMPRENDIDAS PARA INGRESAR EVALUACIONES AL SISTEMA" );
				// history.back()
				// </script>';
			// exit();
		// }
?>