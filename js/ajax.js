// JavaScript Document

/********************************************************************************************
*********LIBRERIA DE AJAX
********************************************************************************************/
var request = null;
var dest;
var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
var functions = ""

//manejador de procesos
function processStateChange(){
	if (request.readyState == 4){
		contentDiv = document.getElementById(dest);
		
		if (request.status == 200){
			response = request.responseText;
			contentDiv.innerHTML = response;
			
			functionsSplit = functions.split(";");
			for (i=0; i<functionsSplit.length; i++){ 
				//alert(functionsSplit[i]);
				eval(functionsSplit[i]);
			}
		} else {
			contentDiv.innerHTML = "Error: Status "+request.status;
		}
	}
}


function loadHTML(URL, destination, method, query, functionsJs){
	dest = destination;
	functions = functionsJs;
	if (window.XMLHttpRequest){
		request = new XMLHttpRequest();

		request.onreadystatechange = processStateChange;
		request.open(method, URL, true);
		
		if (method.toUpperCase() == "POST") {
			request.setRequestHeader("Content-Type", contentType);
			request.send(query);
		} else {
			request.send(null);
		}
	} else if (window.ActiveXObject) {
		request = new ActiveXObject("Microsoft.XMLHTTP");

		if (request) {
			request.onreadystatechange = processStateChange;
			request.open(method, URL, true);

			if (method.toUpperCase() == "POST") {
				request.setRequestHeader("Content-Type", contentType);
				request.send(query);
			} else {
				request.send();
			}
		}
	} 
}

function makeRequestURL(formulario) {
	url = "";
	for (i=0; i<formulario.childNodes.length; i++) {
		if (formulario.childNodes[i].tagName == "INPUT") {
			if (formulario.childNodes[i].type == "text" || 
				formulario.childNodes[i].type == "hidden") {
				url += formulario.childNodes[i].name + "=" + formulario.childNodes[i].value + "&";
			}
		}
		
		if (formulario.childNodes[i].tagName == "TEXTAREA") {
			url += formulario.childNodes[i].name + "=" + formulario.childNodes[i].value + "&";
		}
	}
	
	return url;
}
/********************************************************************************************
FUNCION QUE BUSCA SI EL NOMBRE DE USUARIO ESTA DISPONIBLE
********************************************************************************************/
function createRequestObject(){
      var peticion;
      var browser = navigator.appName;
            if(browser == "Microsoft Internet Explorer"){
                  peticion = new ActiveXObject("Microsoft.XMLHTTP");
            }else{
                  peticion = new XMLHttpRequest();
}
return peticion;
}
var http = new Array();
function ObtDatos(url){
      var act = new Date();
      http[act] = createRequestObject();
      http[act].open('get', url);
      http[act].onreadystatechange = function() {
      if (http[act].readyState == 4) {
            if (http[act].status == 200 || http[act].status == 304) {
  		var texto
		texto = http[act].responseText
                    var DivDestino = document.getElementById("DivDestino");
                    DivDestino.innerHTML = "<div id='error'>"+texto+"</div>";                
}
}
}
http[act].send(null);
}
function compUsuario(Tecla) {
     Tecla = (Tecla) ? Tecla: window.event;
     input = (Tecla.target) ? Tecla.target : 
     Tecla.srcElement;
     if (Tecla.type == "keyup") {
          var DivDestino = document.getElementById("DivDestino");
          DivDestino.innerHTML = "<div></div>";
          if (input.value) {
               ObtDatos("consulta_usuario.php?nombre=" + input.value);
          } 
     }
}
/********************************************************************************************
FUNCION QUE BUSCA SI EL NOMBRE DE USUARIO ESTA DISPONIBLE
********************************************************************************************/

/********************************************************************************************
ACTIVA EL ENTER PARA INICIAR FORMULARIO
********************************************************************************************/
function pulsar(e,obj) {
	tecla=(document.all) ? e.keyCode : e.which;
	if(tecla==13) obj.onclick();
}
/********************************************************************************************
FUNCION QUE BUSCA SI EL NOMBRE DE USUARIO ESTA DISPONIBLE
********************************************************************************************/
