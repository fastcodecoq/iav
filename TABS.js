

// searcher_tabs controller by gomosoft
// dependences jQuery 1.7 >

window.SEARCHER_TABS = function(){
	
	var _this = $(this);
	var filters = {};
	var keys = {
		"ventas" : 1,
		"arriendos" : 2
	};
	var code_ = false;
	window.map = {
		tipo_inmueble : [
			    null,
			  "apartamento",
			  "casa",
			  "local",
			  "oficina",
			  "bodega",
			  "lote",
			  "finca",
			  "Consultorio"
			   ]	 	
	};

	var _data = {
		 form : "#buscarventa"
	};

	var prices = [
		       null,
		       '<option value="0">- Precio -</option>'
                 +'<option value="1"> 0 a 40 millones </option>'
				+'<option value="2"> 41 a 70 millones </option>'
                 +'<option value="3"> 71 a 100 millones </option>'
                 +'<option value="4"> 101 a 200 millones </option>'
                 +'<option value="5"> Mas de 200 millones </option>',	
               '<option value="0">- Precio -</option>'               
		      +"<option value='1'>Hasta 300.000</option>"
			  +"<option value='2'>300.000-1.000.000</option>"
			  +"<option value='3'>1.000.000-1.300.000</option>"
              +"<option value='4'>1.300.000-6.000.000</option>"
              +"<option value='5'>6.000.000-9.000.000</option>"
	          +"<option value='6'>Más de 9.000.000</option>"
	           ];

	 this.init = function(data){


	  	if(!$)
	  	{
	  		console.log("jQuery 1.7 > is required");
	  		return false;
	  	}


	    if(data instanceof Object)
	       $.extend(_data, data);
	    
	    	filters.type = 1;

	    $("#precio").html(prices[filters.type]);
	    ini_snipets();
	    tab_controller();	    
	    submit_controller();

	    $("#codigo").live("blur paste", code_controller);	        

	    console.log("Whoooohooo TABS controller started. Code by Gomosoft");

	} 

	function code_controller(){
				
		var code  = $(this).val();	

	     code_ = true;
	     if(code.split("").length >= 2)
			   $.ajax({
			   	 url : "/short/direct/" + code,
			   	 type : "GET",
			   	 success : function(rs){ if(!rs.toLowerCase().match("no se pudo")) document.location = rs.replace("nio", "ño"); },
			   	 error : function(err){console.log(err)}
			   }); 
			else
				code_ = false;
		
			
	}


	function ini_snipets(){
		$.fn.get_type = function(){ 
			return $(this).attr("data-type");
		 }
		$.fn.activate = function(){
			$(this).addClass("activesup");
		}

		$.fn.getAllFields = function(){

			var fields = new Array();

			$("input, select").each(function(e){
				fields.push($(this));
			});

			return fields;

		}		

	}



	function prevents(e)
	{
		e.preventDefault();
		e.stopPropagation();
	}


	function tab_controller(){

		 $("[data-tab]").off("click").on("click", function(e){

		 		prevents(e);
		 		var _this = $(this);
		 		 desactivate();
		 		_this.activate();
		 		filters.type = keys[_this.get_type()];
		 		$("#precio").html(prices[filters.type]);

		 		console.log(filters.type)
		 		
				

		 });

	}

	function submit_controller(){

		$(_data.form).off("submit").on("submit", submit_action);

	}

	function submit_action(e){
		
		prevents(e);

		if(code_)
			return false;

		var _this = $(this);
		
		var filters = {};
		var type = $(".activesup").get_type();

		if(parseInt($("#tipoInmoeble").val()))
		filters.tipo_inm = $("#tipoInmoeble").val();

		filters.tipo_neg = keys[type] + '';
		if(parseInt($("#area").val()))		
		filters.campo_6 =  parseInt($("#area").val());
		if($("#idciudad").val().split("").length > 0)		
		filters.ciudad = $("#idciudad").val();				
		if($("#codigo").val().split("").length > 0)
		filters.codigo = $("#codigo").val();
	    if(parseInt($("#precio").val()) && keys[type] === 1)
		filters.campo_5 = parseInt($("#precio").val());
	    else if(parseInt($("#precio").val()) && keys[type] === 2)
		filters.campo_53 = parseInt($("#precio").val());

		filters = stripslashes(JSON.stringify(filters)
						 .replace("{","[")		
					     .replace("}","]"));

	 var prefix_url = "/" + type;

	// if(parseInt($("#tipoInmoeble").val()))
	  //   prefix_url += "/" + map.tipo_inmueble[parseInt($("#tipoInmoeble").val())];


	 if(parseInt($("#idciudad").val()))
		$.ajax({
			url : "/app_shorts/main.php?city=" + parseInt($("#idciudad").val()) + "&json",
			type : "GET",
			dataType : "JSON",
			success : function(rs){
				rs = rs.rs;
				//prefix_url +="/" + rs.name;
					var url = prefix_url + "#!" + filters;
      	
	
		document.location = url;
		
			},	
			error : function(err){
				 console.log(err);
			}
		});
      else{

      	var url = prefix_url + "#!" + filters;

      	
			
		document.location = url;
		


      }
	
		

		return false;

	}

	function desactivate(){
	  
	 if(exists(".activesup"))
	  $(".activesup").removeClass("activesup");

	}


	function exists(query_selector){
		return ($(query_selector).length > 0) ? true : false;
	}

		

};



function ini_(){ new SEARCHER_TABS().init(); }

$(ini_);

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