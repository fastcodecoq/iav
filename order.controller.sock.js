//order controller


(function(a,b){
	console.log(a);

	var order_listener = function(){
    
    $("#orden")
    .off("change")
    .on("change", order_controller);

	}

	var order_controller = function(){

	   
   var value = $(this).val();
   var data = {filters : {} , page : 1, sort : value};
  
 var hash = document.location.hash;
            data.filters = (hash) ? JSON.parse(hash
                                       .replace("#!" , "")
                                       .replace("[" , "{")
                                       .replace("]" , "}")
                                        ) : data.filters;
    if(window.inmobiliaria)
      data.filters.usuario = window.inmobiliaria +'';

   if(document.location.pathname.match("sales") || document.location.pathname.match("rents"))
           data.filters.tipo_neg = document.location.pathname.match("sales") ? "1" : "2";

   socket.emit("search", data);

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