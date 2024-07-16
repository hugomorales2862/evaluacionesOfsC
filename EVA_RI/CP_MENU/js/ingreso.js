function Grabar_formulario(){
	var nombre_inm = document.getElementById('nombre_inm').value;
	var sit_legal = document.getElementById('sit_legal').value;
	var tipo_inm = document.getElementById('tipo_inm').value;
	var adquisicion = document.getElementById('adquisicion').value;
	var direccion = document.getElementById('direccion').value;
	var depto = document.getElementById('depto').value;
	var muni = document.getElementById('muni').value;
	var area = document.getElementById('area').value;
	var reg_nac = document.getElementById('reg_nac').value;
	var esc_pub = document.getElementById('esc_pub').value;
	var ac_gub = document.getElementById('ac_gub').value;
	var bi_estado = document.getElementById('bi_estado').value;
	var ref = document.getElementById('ref').value;
	var status = document.getElementById('status').value;
	var ref_asig = document.getElementById('ref_asig').value;// AQUI INICIAN DATOS QUE VAN HACIA LA TABLA BIN_ASIGNACION
	var fecha = document.getElementById('fecha').value;
	var logistico = document.getElementById('logistico').value;
	var dep = document.getElementById('dep').value;
	var comte = document.getElementById('comte').value;
	var usuario = document.getElementById('usuario').value;
	var obs = document.getElementById('obs').value;

	if(nombre_inm != "") {
            if(sit_legal != "") {
				if(tipo_inm != "") {
					if(adquisicion != "") {
						if(direccion != "") {
							if(depto != "") {
								if(muni != "") {
									if(area != "") {
										if(logistico != "") {
											if(comte != "") {
															// alert("TODO BIEN");
															xajax_Grabar_inmueble(nombre_inm,sit_legal,tipo_inm,adquisicion,direccion,depto,muni,area,reg_nac,esc_pub,ac_gub,bi_estado,ref,status,ref_asig,fecha,logistico,dep,comte,usuario,obs);
															}else{
															alert("Debe de seleccionar el campo de Vo. Bo.!!!");
															foco('comte');
															}
														}else{
														alert("Debe de seleccionar al oficial responsable!!!");
														foco('logistico');
														}
													}else{
													alert("Debe de llenar el campo de area!!!");
													foco('area');
													}
												}else{
												alert("Debe de especificar el municipio en que se encuentra ubicado el inmueble!!!");
												foco('muni');
												}
										}else{
										alert("Debe especificar el departamento en que se encuentra ubicado el inmueble!!!");
										foco('depto');
										}
								}else{
								alert("Debe ingresar la dirección del inmueble!!!");
								foco('direccion');
								}
						}else{
						alert("Debe especificar la forma de adquisicion del inmueble !!!");
						foco('adquisicion');
						}
				}else{
					alert("Debe especificar el tipo de inmueble, segun la clasificacion del MDN !!!");
					foco('tipo_inm');
				}
			}else{
				alert("Debe de especificar la situacion legal del inmueble !!!");
				foco('sit_legal');
			}
        }else{
            alert("Debe ingresar el nombre del inmueble!!!");
			foco('nombre_inm');
        }
}

function foco(elemento){
	document.getElementById(elemento).focus();
}