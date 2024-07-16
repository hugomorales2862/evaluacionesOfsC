<?php
	include_once('xajax_fns_rep.php');
	include_once('../html_fns.php');
	session_start();
	$usuario = $_SESSION['auth_user'];
	$plaza1 = $_SESSION['org_plaza'];
	$dependencia = $_SESSION['dep_cod'];
	$desc_dependencia1 = $_SESSION['dep_desc'];
	$desc_dependencia = utf8_encode($desc_dependencia1);
?>
<!--==============================================================================================================================================
=========================================================INICIA EL HTML===========================================================================
==================================================================================================================================================-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;" charset="ISO-8859-1" />
<title>Estado de Fuerza</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.serialScroll-1.2.2-min.js"></script>
<script type="text/javascript" src="js/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/jquery-ui-1.8.custom.min.js" ></script>
<style type="text/css">

html, body {
            height:100%
            width:100%;
            margin:0px;
            padding:0px;
        }
       #mensaje {
            width:20%;
        }
#divMenu {font-family:arial,helvetica; font-size:12pt; font-weight:bold}
#divMenu a{text-decoration:none;}
#divMenu a:hover{color:red;}


letrasT{padding-right:50; padding-left:50; font-family:Arial; align:center;}
.encabezado {color:blue;font-family:calibri;font-weight:bold;font-size:18px;}

.style1 {color: #0033FF}

div-tabas {
height: 159px;
overflow - y: auto;
}
body {
margin: 0;
font-size:16px;
color: #000000;
font-family:Arial, Helvetica, sans-serif;
}
#sliderWrap {
margin: 0 auto;
width: 300px;
}
#slider {
position: absolute;
background-image:url(slider.png);
background-repeat:no-repeat;
background-position: bottom;
width: 300px;
height: 159px;
margin-top: -141px;
}
#slider img {
border: 0;
}
#sliderContent {
margin: 50px 0 0 50px;
position: absolute;
text-align:center;
background-color:#FFFFCC;
color:#333333;
font-weight:bold;
padding: 10px;
}
#header {
margin: 0 auto;
width: 600px;
background-color: #F0F0F0;
height: 200px;
padding: 10px;
}
#openCloseWrap {
position:absolute;
margin: 143px 0 0 120px;
font-size:12px;
font-weight:bold;
}

#alfabetos{border-collapse:collapse; background:buttonface;}

#alfabetos td{font:12px "arial" "helvetica" "sans-serif"; border:1px solid; text-align:center; vertical-align:top; }

#contEncCol{overflow:hidden; background:ButtonHighlight; width:16em; //ANCHO TABLA}

#contEncFil{overflow:hidden; background:ButtonHighlight; height:8em; //ALTO TABLA}

#contenedor{overflow:auto; width:16em; height:8em; //ANCHO Y ALTO TABLA}

#encCol td{text-align:center; vertical-align:middle; border:1px solid;}
#encFil {width:100%;
z-index:-1;
}
#encCol {height:100%; 
z-index:-1;
}

#contenido{background:#fff;}

#contenido td{text-align:left; white-space:nowrap;}

#rellEncFil{height:80px; width:0; }
#rellEncCol{height:0; width:80px; }

.tabla td{border:1px solid;}

.rellH{ position:relative; top:0; z-index:-1; bor¬der:1px solid red;}

.letrasT{padding-right:50; padding-left:50; font-family:Arial; align:center;}
</style>
<script type="text/javascript" src="libs/spinmenu.js"></script>  
<script type="text/javascript" src="libs/jquery[1].fixedheader"></script>  
<script language="javascript" type="text/javascript"> 

function cerrarse(){
	window.close()
}
	$(function() {
		
	    //dialogo para imprimir
		$("#div-impresion").dialog({
		     width:580,
			 height: 480,
		     modal: true,
		     autoOpen: false,
		     title: 'Seleccione los criterios de Impresion'
			
		});
	    //link para mostrar el dialogo de impresion
		$('#impresion')
			.click(function() {
				$('#div-impresion').dialog('open');
			});
			
		
		//calendario de impresion
		$("#datepicker2").datepicker({
			dateFormat: 'dd/mm/yy',
		    onSelect: function(dateText, inst) {
				document.getElementById('newFecha2').value = dateText;
			}
		});
		
     	    
		//dialogo para buscar
		$("#div-buscar").dialog({
		     width:580,
			 height: 480,
		     modal: true,
		     autoOpen: false,
		     title: 'Seleccione los criterios de Busqueda'
			
		});

	    //link para buscar
		$('#buscar')
			.click(function() {
				$('#div-buscar').dialog('open');
			});
			
		
		//calendario para busqueda
		$("#datepicker").datepicker({
			dateFormat: 'dd/mm/yy',
		    onSelect: function(dateText, inst) {
				document.getElementById('newFecha').value = dateText;				  
			}
		});

    });

function verif(n){
	permitidos=/[^0-9.]/;
		if(permitidos.test(n.value)){
			alert("solo se puede ingresar numeros");
			n.value="";
			n.focus();
	}
}
function validaciones(){
	var bandera = 0;

	
	if(document.getElementById('4-15').value > 0 ){
	
		if(document.getElementById('4-15').value > 0  && document.getElementById('comi').value == 0 ){
				alert("Ingrese el Detalle del personal de COMISION");
				//comi.focus();
				bandera = 1;
					return; 
					
		}else{
			if(document.getElementById('4-15').value !=  document.getElementById('total-comision2').value){
					alert("Verifique el Detalle del personal de COMISION");
					//comi.focus();
					bandera  = 1;
						return;  
					
				}
		}
	}	
	if(document.getElementById('2-15').value > 0 ){
				if(document.getElementById('verificacion2').value != document.getElementById('2-15').value ){
					alert("Ingrese el detalle del personal SEGREGADO");
					bandera  = 1;
					return; 
												
					}
					
				var maximo = document.getElementById('segre_total').value;
				if(document.getElementById('segre_total').value > 0 ){
						for(var i=1;i<=maximo;i++)
							if(document.getElementById('segre_' + i).value == ""){
								alert("Verifique su detalle de SEGREGADOS");
								document.getElementById('segre_' + i).focus();
								bandera  = 1;
								return; 
							
								
								
							}
						}
				
			}
			
	if(document.getElementById('3-15').value > 0 ){
	
		if(document.getElementById('3-15').value > 0  && document.getElementById('dest').value == 0 ){
				alert("Ingrese el detalle del personal DESTACADO");
				//comi.focus();
				bandera = 1;
					return; 
				
		}else{
			if(document.getElementById('3-15').value !=  document.getElementById('total-destacados2').value){
					alert("Verifique su detalle de DESTACADOS");
					//comi.focus();
					bandera  = 1;
				return;  
						
				}
		}
	}
		if(document.getElementById('12-15').value != document.getElementById('toe').value ){
		  alert("Los datos ingresados no concuerdan con los datos de su TOE, verifique sus datos");
				bandera  = 1;
				return;  
		
		
		}	
			
			
			
		
	if(bandera == 0){
		document.form1.submit();
	}
	

}

function limpiar() {
  document.getElementById('form1').reset();
  return false;
}
function suma(posicion,maximo) {
      var total=0;
      var num=0;
      for(var i=1;i<=maximo;i++) { //control de columnas
        num = document.getElementById(i).value;
        valNum = parseInt(num);
        if (isNaN(valNum)) {
          valNum = 0;
		 
        }
		total += valNum;
      } 
	   document.getElementById('total-comision2').value = total;
      //document.getElementById(row + '-' + (max+1)).value = total;
      sumaCol(maximo, 4 );
    }
function suma1(posicion,maximo) {
      var total=0;

      var num=0;
      for(var i=1;i<=maximo;i++) { //control de columnas
        num = document.getElementById('dest_'+i).value;
        valNum = parseInt(num);
        if (isNaN(valNum)) {
          valNum = 0;
		 
        }

		total += valNum;
      } 

	   document.getElementById('total-destacados2').value = total;
      //document.getElementById(row + '-' + (max+1)).value = total;

      sumaCol(maximo, 4 );



    }




function sumaFila(row,max) {
      var total=0;
      var num=0;
      for(var i=1;i<=max;i++) { //control de columnas
        num = document.getElementById(row + '-' + i).value;
        valNum = parseInt(num);
        if (isNaN(valNum)) {
          valNum = 0;
		 
        }
        total += valNum;
      } 
      document.getElementById(row + '-' + (max+1)).value = total;
      sumaCol('15', 11 );
    }
    
    function sumaCol(col,max) {
      var total=0;
      var num=0;
      for(var i=1;i<=max;i++) { //control de filas
        num = document.getElementById(i + '-' + col).value;
        valNum = parseInt(num);
        if (isNaN(valNum)) {
          valNum = 0;
        }
        total += valNum;
      } 
      document.getElementById((max+1) + '-' + col).value = total;
    }



function desplaza(){
pasoH = document.getElementById("contenedor").scrollLeft;
pasoV = document.getElementById("contenedor").scrollTop;
document.getElementById("contEncCol").scrollLeft = pasoH;
document.getElementById("contEncFil").scrollTop = pasoV;
}
	
 
</script> 
<link href="css/style-hor.css" rel="stylesheet" type="text/css">
<?php echo $xajax->getJavascript();?>
</head>
<body style = "background:URL(css/Fondo.jpg);margin:0px;">

<div align = "center" style = "margin:0px;">
<div>

<div>
  <!--<div align = "center" style = "margin:0px;">
		<IMG src= "css/EstFue.png"/>
  </div>-->
<div align = "center" style="width:800px;"> 
<!--<div class="menu" style="width:800px;">
	
	<a href="#" onclick ="validaciones();">Guardar</a>
    <a href="#" id="buscar">Buscar</a>
    <a href="javascript:void(0);" onclick="limpiar();">Limpiar</a>
	<a href="#" id="impresion">Imprimir</a>
	<?php
   		if($usuario = 607325){
   		?><a href="../EVA_RI/CP_REPORTEADOR/rep_est_fuerza.php">Reportes</a>
   		<?php	
   		}
   ?>
	<a href="../MENU/menu.php">Menu Principal</a>
	<a href="Manual/Manual_Estado_Fuerza.pdf">Ayuda</a>
    <a href="../AUTOCOM/logout.php">Salir</a>
   
 </div>-->
 </div>
 <br>
</div>
<div align = "center" style="font-weight:bold;color:blue;align:center;" >
 						</p><p class = "encabezado">Dependencia: <?php echo $_SESSION['dep_desc'] ?></p>

	  
	  <form id="form1" name="form1" method="post" action="query.php" >
<div id="screen">
	<script type="text/javascript">
		function onSlideClick() {
			var valcom = parseInt(document.getElementById('4-15').value);			
			var comisionados = parseInt(document.getElementById('verificacion').value);
			if(valcom != comisionados) {
				document.getElementById('verificacion').value = valcom;
				xajax_campos_comisiones(valcom);
			}
		}
		function onSlideClick2() {
			var valcom = parseInt(document.getElementById('2-15').value);			
			var comisionados = parseInt(document.getElementById('verificacion2').value);
			if(valcom != comisionados) {
				document.getElementById('verificacion2').value = valcom;
				xajax_campos_segregados(valcom,document.getElementById('2-15').value);
			}
		}

	
		function dibuja_campos_agregados(){

			var agregados = document.getElementById('agre').value;
			
//xajax_busca_agregados(fecha, dependencia);
				$.post("campos_agregados.php",{variable:  agregados}, function(data){
			       /// Ponemos la respuesta de nuestro script en el DIV recargado
			    $("#DIVagregados").html(data);
			   
			    });        
			}


		
		function dibuja_campos_comision() {
			var comisiones1 = document.getElementById('4-15').value;			
			var comisiones = document.getElementById('comi').value;
				$.post("campos_comision.php", { variable: comisiones, variable1: comisiones1}, function(data){
			       /// Ponemos la respuesta de nuestro script en el DIV recargado
				$("#comisiones").html(data);
				
				});  

		
			}
		



		function dibuja_campos_destacados() {
			var destacamentos1 = document.getElementById('3-15').value;			
			var destacamentos = document.getElementById('dest').value;
			
				  $.post("campos_destacados.php", { variable: destacamentos,  variable1: destacamentos1}, function(data){
			       /// Ponemos la respuesta de nuestro script en el DIV recargado
				$("#DIVdestacados").html(data);
				  });  
			}
	
		function dibuja_campos_segregados() {
			
			var segregados = parseInt(document.getElementById('2-15').value);	
					
			
				$.post("campos_segregados.php", {variable: segregados}, function(data){
			       /// Ponemos la respuesta de nuestro script en el DIV recargado
				$("#segregados2").html(data);
				 });  
			}
		

</script>

<!--==============================================================================================================================================
=========================================================INICIA EL HTML===========================================================================
==================================================================================================================================================-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
		function Buscar(){
			
			var grad = document.getElementById('grad').value;
			var depi = document.getElementById('depi').value;
			var sexo = document.getElementById('sexo').value;
			var clase = document.getElementById('clase').value;
				
			 xajax_est_fuerza(grad,depi,sexo,clase);
		}

		function Buscar1(){
			 xajax_tot_est();
		}

		function Soc_Limpiar(){
			location.reload();
		}
		function imprSelec(historial){
  var ficha=document.getElementById(historial);
  var ventimp=window.open(' ','popimpr');
  ventimp.document.write(ficha.innerHTML);
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
}


function Guardar2(){
   // 	alert('Dios es amor y paz');
   
    var	dep = document.getElementById("dep").value;
    // alert(dep);
 	 var	contratoh = document.getElementById("contratoh").value;
      // alert(alumnos);
	var	contratom = document.getElementById("contratom").value;
      // alert(alumnas);
    

     xajax_guardar_contrato(dep,contratoh,contratom);
    
	
}

			

		</script>
	</head>
<!--==============================================================================================================================================
=========================================================INICIA EL BODY===========================================================================
==================================================================================================================================================-->
	<body>
		<div class='modal hide fade' id='alert_modal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'></div>
		<!-- ============================================PERMISOS PARA EL ADMINISTRADOR ====================================================-->
	<div align='center' class='container'>
			<!--===============================INICIA EL FORM======================================-->
		<form name='f1' id='f1'  method='post'>
			<input type='hidden' name='dep' id='dep' value='<?php echo $dependencia; ?>'></input>
			<!--===============================INICIA EL FIELDSET======================================-->
				<fieldset style='background:#FAFAFA'>
					<legend align='left'> <h3>INGRESE EL ESTADO DE FUERZA DEL PERSONAL POR CONTRATO</h3></legend>
	<!--====================================================================================================================================================-->
	<!--======================================TABLA DE CALENDARIOS Y BUSQUEDA POR DEPENDENCIA===============================================================-->
	<!--====================================================================================================================================================-->
			<!--	<div class='row-fluid' >
						<div class='span4'>
							<b>DEPENDENCIA:</b><br>
						
							<?php// echo carga_dep(); ?>
						</div>
						<div class='span4' >
						<b>GRADO:</b><br>
						
							<?php// echo carga_grados(); ?>
						</div>
						<div class='span2'>
							<b>SEXO:</b><br>
						
								<select id= "sexo" name="sexo" class="span12">
								  <option value="A">AMBOS</option>
								  <option value="M">MASCULINO</option>
								  <option value="F">FEMENINO</option>
								</select>
						</div>
						<div class='span2'>
							<b>CLASE:</b><br>
						
								<select id= "clase" name="clase" class="span12">
								  <option value="0">-TODOS-</option>
								  <option value="1">CARRERA</option>
								  <option value="2">RESERVA</option>
								  <option value="3">ASIMILADOS</option>
								  <option value="4">ESPECIALISTAS</option>
								  <option value="6">TROPA</option>
								</select>
						</div>
				<div>-->


	<!--=======================================================================================================================================-->
	<!--===================================CUADRO DE ESTADO DE FUERZA=================================================-->
	<!--=======================================================================================================================================-->

			 <table id = "alfabetos" style="background-color:#BDBDBD;border:1;">
				<tr>
					<td>TIPO</td>
					<td>
						<div id="contEncCol" style="width:530px">
							<table id="encCol" >
								<tr>
									<td colspan = "3" align="center" style="width:111px;"><input  readonly value = "PERSONAL POR CONTRATO" 	size = "11" style ="height:22px;align:middle" /></td>
									<!--<td colspan = "3" align="center" style="width:111px;"><input readonly value = "TOTAL" 	size = "21" style ="height:22px;align:middle"/></td>-->

								</tr>
								<tr>
									<td align="center" style="width:40px;"><input readonly value = "HOMBRES" 	size = "4" style ="height:22px;align:middle" /></td>
									<td align="center" style="width:40px;"><input readonly value = "MUJERES" 	size = "4" style ="height:22px;align:middle" /></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div id="contEncFil" style="height:120px;">
							<table id="encFil" style="height:360px;">
								<tr><td height="22px"><input style="height:19px;" readonly id = "1"  name = "1" value = "PERSONAL POR CONTRATO" 			size = "10" style ="height:22px;align:middle" title = "Personal Disponible: Referente al Personal que no se encuentra tomado en cuenta en los demas destinos" ></td></tr>
								
								
							</table>
						</div>
					</td>
					<td >
						<div id="contenedor" onscroll="desplaza()" style="width:530px;height:175px;">
							<table id="contenido" style="width:130px;height:260px;">
								<tr>
									<td height="13px"><input id = "contratoh"  name = "contratoh"       type= "text"  maxlength="3"  value = "0" size = "4"  onchange="sumaFila('1',14);sumaCol('1',11);"  onkeyup = "verif(this)" ></td>
									<td height="13px"><input id = "contratom"  name = "contratom"      type= "text" maxlength="3"  value = "0" size = "4"  onchange="sumaFila('1',14);sumaCol('2',11);"  onkeyup = "verif(this)" ></td>
									<!--<td height="13px"><input id = "1-15" name = "disp-total"     type= "text" maxlength="3"  value = "0" size = "10" onchange="sumaFila('1',14);sumaCol('15',11);" onkeyup = "verif(this)" readonly  ></td>	-->			
								</tr>	
							</table>
						</div>
					</td>
				</tr>
			</table>
	<!--====================================================================================================================================================-->
	<!--===================================BOTONES PARA LIMPIAR Y BUSCAR SEGUN LAS FECHAS Y LA DEPENDENCIA-=================================================-->
	<!--====================================================================================================================================================-->
					<br>
					<br>
					<div class='row-fluid'>
						<div class='span4'>
						</div>

						<div class='span1'>
							
							<input class="btn btn-success" type="button" title="GUARDAR" value="GUARDAR"  onclick="Guardar2();"/></a>
						</div>
						<div class='span1'>
							<a href="../../EstadoFuerza/index3.php"><input class="btn btn-warning" type="button" title="Regresar" value="SALIR"  /></a>
						</div>
						
						<!--<div class='span1'>
							<input class="btn btn-primary" type="button" title="totales" value="TOTALES" onclick="Buscar1();"/></a>
						</div>
						<div class='span1'>
						<input type = "reset" class="btn btn-danger" value = "Limpiar" id = "slimpiar" onclick = "Soc_Limpiar()" class='span12'/>
						</div>
						<div class='span1'>
							<input class="btn btn-primary" type="button" title="Buscar" value="Buscar" onclick="Buscar();" />
						</div>
						<div class='span1'>
							<a href="../../EstadoFuerza/index3.php"><input class="btn btn-warning" type="button" title="Regresar" value="Regresar"  /></a>
						</div>
						<div class='span1'>
							<a href="javascript:imprSelec('resul')"><input class="btn btn-success" type="button" title="CURRU" value="CURRU"  /></a>
						</div>
						<div class='span3'>
						</div>
						<!--<div class='span1'>
							<input type = "button" class="btn btn-success" value = "Ver proceso" id = "sbuscar" onclick = "enviar_solicitud(1);" class='span12'/>
						</div>-->
					</div>
					<br><br>
					<div id='resul'>
					</div>
				</fieldset>
			</form>
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