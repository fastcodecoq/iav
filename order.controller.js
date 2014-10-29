//order controller


(function(a,b){
	console.log(a);

	var order_listener = function(){
    
    $("#orden")
    .off("change")
    .on("change", order_controller);

	}

	var order_controller = function(){

		var json = stripslashes(decodeURI(document.URL)).replace(/%22/g,'"');
		var url = document.URL.match(/\/.*\//)[0]
		          .replace(/%20/g," ")
		          .replace("//www.inmueblealaventa.com","");		    

		    if(json = json.match(/\[.*\]/)){
              json = json[0]
		           .replace(/\[/g,"{")
		           .replace(/\]/g,"}");
		    json = JSON.parse(json);
		    json.orden = parseInt($(this).val());
		    json = JSON.stringify(json)
		    		   .replace("{","[")		
					   .replace("}","]");
             document.location = url + json;
           }else
            {
              
              if(document.URL.match("page"))
              document.location = document.URL.replace(/orden=[0-9](&)?/g,"") + "&orden=" + parseInt($(this).val());
              else
              document.location = document.URL.replace(/orden=[0-9](&)?/g,"") + "?orden=" + parseInt($(this).val());

           }


	        

	}


	var ini = function(){
	     order_listener();
	}

	$(ini);

})(window)


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