
// sidebar controller by gomosoft
// dependences jQuery 1.7 >


window.sideFilters = function(){
		
	  filters = {};
	  filterss = {};
	var keys = {
		  1 : "venta",
		 2 : "arriendo"
	};
	  this.init = function(){

	  	if(!$)
	  	{
	  		console.log("jQuery 1.7 > is required");
	  		return false;
	  	}

	  	submitControllers();
	  	radioController();


	  	console.log("Woooohooooo sideFilters controller started. Code by gomosoft");

	  }





	function prevents(e)
	{
		e.preventDefault();
		e.stopPropagation();
	}


	function radioController(){

		$("#filtros input[type='radio'], #barrio").live("change", function(){		
				
				filterss[$(this).attr("name")] = parseInt($(this).val());
				console.log(filterss);

		});


	}


	function submitAction(e){

		prevents(e);
		
		filters = {};
		$.extend(filters,filterss);
		filters.departamento = parseInt($("#departamento").val());
		filters.ciudad = parseInt($("#ciudad").val());
		filters.tipo_inmueble = parseInt($("#tipoInmueble").val());
		filters.type = parseInt($("#para").val());
		filters.dpto = parseInt($("#departamento").val());
		filters.orden = "";
				

		if(empty(filters.departamento))
			return false;

		if(empty(filters.ciudad))
			return false;

		if(empty(filters.tipo_inmueble))
			return false;

		if(empty(filters.type))
			return false;

		filters = JSON.stringify(filters)
						 .replace("{","[")		
					     .replace("}","]");

		filters = stripslashes(filters);
		filters = filters.match(/\[.+\]/g)[0];
      
	 var typee = keys[parseInt($("#para").val())];

	 if(!typee)
	 	return false;

	 var prefix_url = "/" + typee;

	 if(parseInt($("#tipoInmoeble").val()))
	     prefix_url += "/" + map.tipo_inmueble[parseInt($("#tipoInmoeble").val())];


	 if(parseInt($("#ciudad").val())){
					
				prefix_url +="/" + get_city();
				
				if(parseInt($("#departamento").val()))
					prefix_url += "/" + get_dpmt();


			

				var url = prefix_url + "/" + filters;

	
	        	document.location = url;
	 }
      else{

      	var url = prefix_url + "/" + filters;

      	

			
		document.location = url;

      }
	
		

		return false;

	}


	function get_dpmt(){
		
		var dptm = $("#departamento").val();
		var name = $("select#departamento option[value='"+dptm+"']").
					text()
					.toLowerCase()
					.replace(" ","");

		name = remove_accents(name);
		
		return name;				

	}


	function get_city(){
		
		var city = $("#ciudad").val();
		var name = $("select#ciudad option[value='"+city+"']").
					text()
					.toLowerCase()
					.replace(" ","");
	    name = remove_accents(name);				
		
		return name;				

	}


    function remove_accents(str){
    	var accents = {
			"á" : "a",
			"é" : "e",
			"í" : "i",
			"ó" : "o",
			"ú" : "u"
		}

		for(x in accents)
			str = str.replace(x, accents[x]);

		return str;
    }

	function submitControllers(){

       $("#filtros").off("submit").on("submit", submitAction);

	  }


	  function empty(str){
	  	  return !/\w/.test(str);
	  }

}



//función tomada de phpjs

function stripslashes (str) {
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Ates Goral (http://magnetiq.com)
  // +      fixed by: Mick@el
  // +   improved by: marrtins
  // +   bugfixed by: Onno Marsman
  // +   improved by: rezna
  // +   input by: Rick Waldron
  // +   reimplemented by: Brett Zamir (http://brett-zamir.me)
  // +   input by: Brant Messenger (http://www.brantmessenger.com/)
  // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
  // *     example 1: stripslashes('Kevin\'s code');
  // *     returns 1: "Kevin's code"
  // *     example 2: stripslashes('Kevin\\\'s code');
  // *     returns 2: "Kevin\'s code"
  return (str + '').replace(/\\(.?)/g, function (s, n1) {
    switch (n1) {
    case '\\':
      return '\\';
    case '0':
      return '\u0000';
    case '':
      return '';
    default:
      return n1;
    }
  });
}


function ini__(){ new sideFilters().init(); }

$(ini__);