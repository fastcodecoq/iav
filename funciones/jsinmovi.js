


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

	
	
	function enviarinmoiv(opc)
	{
					
					
				
					

	
	contenedor1 = document.getElementById('contenedor1');
	
	contenedor1.innerHTML='<div align="center"><br><br><br><br><br><br><img src="imagenes/ico_ajax.gif" align="absmiddle" border="0" /></div>';
	ajax4=nuevoAjax();
	ajax4.open("POST",'resultado_inmoviliaria.php',true);
	ajax4.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	ajax4.onreadystatechange=function() {
		if (ajax4.readyState==4) 
		{
			contenedor1.innerHTML = ajax4.responseText
		}
	}
	//"
	 ajax4.send("inmovi="+opc);
	 
					/*var concatenar="";
					
					var tipoInmueble=$("#tipoInmueble").val();
					var ciudad=$("#idciudad").val();
					var precio=$("#precio").val();
					var area=$("#area").val();
					var codigo=$("#codigo").val();
					
					if (tipoinmueble=0)
					{
						concatenar=concatenar;
					}
					else
					{
						concatenar=concatenar+"&tipoInmueble="+tipoInmueble
					}
					
					
					if (ciudad=0)
					{
						concatenar=concatenar;
					}
					else
					{
						concatenar=concatenar+"&ciudad="+ciudad
					}
				
					
					
					
					//location.href="propiedades.php?para=1";
					location.href="propiedades.php?para=1"+concatenar;*/

	}