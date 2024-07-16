<?php
include_once('html_fns_eva.php');
$periodo = $_REQUEST['periodo'];
// echo $periodo;
session_start();
$desc_dependencia = $_SESSION['dep_desc'];
$dep = $_SESSION['dep_cod']; 
$usuario = $_SESSION['auth_user'];

if($periodo != ""){
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Reporte por solicitud</title>	
		<!--Librerias Utilitarias-->
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
					<a class="btn btn-info" href="../CP_REPORTEADOR/FrmBusca_rep.php" class="btn btn-info btn-lg">
					  <span class="glyphicon glyphicon-home"></span> REGRESAR 
					</a>
					<a class="btn btn-info" onclick ='pageprint();' class="btn btn-info btn-lg">
					  <span class="glyphicon glyphicon-home"></span> IMPRIMIR 
					</a>
				</center>
			</div>
		</div> 
		<!--el divlandscape es para poner la pagina horizontalmente -->
	<div class='container'><br>
		<table style = "width:100%">
					<tr>
						<td style = "width:50%;border:none;">
							<h4 align='left'><font size="2">EJERCITO DE GUATEMALA</font></h4>
						</td>
						<td style = "width:50%;border:none;">
							<h4 align='right'><font size="2"><?php echo $desc_dependencia; ?></font></h4>
						</td>
					</tr>
				</table>
		<table style = "width:100%">
			<tr>
				<td style = "width:70%;border:none;">
					<h4 align='center'><font size="2">OFICIALES EVALUADOS <br> Periodo <?php echo $periodo; ?></font></h4>
				</td>
			</tr>
		</table>
		<?php echo tabla_finalizados($dep,$periodo); ?>
	
	</div>
</html>
<?php }else{
	echo'<script>
		alert("DEBE SELECCIONAR EL PERIODO");
		history.back()
		</script>';
	exit();
}?>