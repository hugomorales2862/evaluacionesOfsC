//==========================================================
//==== CERRAR MAPAPRUEBA.PHP y MAPAPRUEBA1.PHP MODIFICAR====
//==========================================================
function cerrar(){
	window.close();
}


//====================CHECKBOX INDIVIDUAL FUERZA DE TIERRA======================================
//==============================================================================================
function buscar_poligonos(){
	
	
	var 	numero_poligono		=	document.getElementById("poligono").value;
	// alert(numero_poligono);
	
	if(numero_poligono != ""){
		xajax_poligono(numero_poligono);	
	}else{
		alert("Debe de llenar el campo requerido");
	}
}


//=================================REPORTE_MISION.PHP=========================================
//=================================MAPA VACIO PARA LIMPIAR DIV===============================
//===============================================================================================
function vacio(){
	
	var options = {
		zoom: 7,
		center: new google.maps.LatLng(15.879565, -90.485314),
		mapTypeId: google.maps.MapTypeId.TERRAIN  ,
		mapTypeControlOptions: {
		style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		}	
	};
	
    var map = new google.maps.Map(document.getElementById('map'), options);
    var popup;
  	};

//=================================REPORTE_MISION.PHP=========================================
//================================MAPA NO HAY CUANDO NO HAY DATOS DE BUSQUEDA====================
//===============================================================================================
function nohay(){

	var options = {
		zoom: 7,
		center: new google.maps.LatLng(15.879565, -90.485314),
		mapTypeId: google.maps.MapTypeId.TERRAIN  ,
		mapTypeControlOptions: {
		style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		}	
	};
	
    var map = new google.maps.Map(document.getElementById('map'), options);
  	};
//=================================REPORTE_MISION.PHP=========================================
//================================PUNTOS ENCONTRADOS SATISFACTORIAMENTE==========================
//===============================================================================================

function blanco(){

	var options = {
		zoom: 7,
		
		center: new google.maps.LatLng(15.879565, -90.485314),
		mapTypeId: google.maps.MapTypeId.TERRAIN  ,
		mapTypeControlOptions: {
		style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		}	
	};
	
    var map = new google.maps.Map(document.getElementById('map'), options);
    var popup;
};


//===============================================================================================
//===============================================================================================
//===============================================================================================

function initialize(){
	
	total = document.getElementById('total').value;
	// alert(total);
	total2 = total-1;
	
	var coordenadas = "";
	var puntos = new Array();
	
	for(i = 1; i <	total; i++){
		var latitud = document.getElementById("latitud"+i).value;
		var longitud = document.getElementById("longitud"+i).value;
			puntos[i] =  latitud+", "+longitud;
	}

	var triangleCoords2 = [];
	for (var i = 1; i < puntos.length; i++) {
		var pos = puntos[i].split(",");
		var loc = new google.maps.LatLng(pos[0], pos[1]);
		triangleCoords2.push(loc);
	}

	var mapOptions = {
		zoom: 7,
		center: new google.maps.LatLng(15.879565, -90.485314),
		mapTypeId: google.maps.MapTypeId.TERRAIN
	};
	
	var bermudaTriangle;
	
	map = new google.maps.Map(document.getElementById('map'), mapOptions);
	
	bermudaTriangle = new google.maps.Polygon({
		paths: triangleCoords2,
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 3,
		fillColor: '#FF0000',
		fillOpacity: 0.35
	});
	
	bermudaTriangle.setMap(map);
	google.maps.event.addListener(bermudaTriangle, 'click', showArrays);
	infoWindow = new google.maps.InfoWindow();
}
	
//===============================================================================================
//===============================================================================================
//===============================================================================================
function showArrays(event) {

  // Since this polygon has only one path, we can call getPath()
  // to return the MVCArray of LatLngs.
  var vertices = this.getPath();

  var contentString = '<b>Centro Medico Militar</b><br>' +
      'Clicked location: <br>' + event.latLng.lat() + ',' + event.latLng.lng() +
      '<br>';

  // Iterate over the vertices.
  for (var i =0; i < vertices.getLength(); i++) {
    var xy = vertices.getAt(i);
    contentString += '<br>' + 'Coordinate ' + i + ':<br>' + xy.lat() + ',' +
        xy.lng();
  }

  // Replace the info window's content and position.
  infoWindow.setContent(contentString);
  infoWindow.setPosition(event.latLng);

  infoWindow.open(map);
}