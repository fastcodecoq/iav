

function nuevoAjax(){
	var xmlhttp=false;
 	try {
 		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 	} catch (e) {
 		try {
 			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 		} catch (E) {
 			xmlhttp = false;
 		}
  	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
 		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


function enviarpagina(para,tipo,ciudad)
	{	

/*	ajax4=nuevoAjax();
	ajax4.open("POST",'propiedades.php',true);
	ajax4.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	ajax4.onreadystatechange=function() {
		if (ajax4.readyState==4) 
		{
			contenedor1.innerHTML = ajax4.responseText
		}
	}*/
	//"
//	 ajax4.send("para="+para+"&tipoInmueble="+tipo+"&ciudad="+ciudad);
	 
		location.href="propiedades.php?para="+para+"&tipoInmueble="+tipo+"&ciudad="+ciudad;			

	}
	
	
function menunuevo(para)
	{	
	

 
	location.href="propiedades.php?para="+para;			

	}
	
	
	
	