(function(a){
		
     var iav = function(){

     	 a.socket;
         var pageActive = 1;
         var results;         
         var types = [  
               null,            
              'Apartamento', 
              'Casa',
              'Local',
              'Oficina',
              'Bodega',
              'Lote',
              'Finca',
              'Consultorio'               
             ];

        var negocio = [
                      null,
                      "Vendo",
                      "Arriendo"                      
                      ];

        var template = '<li>'
				+'<div class="imagen">'
				+'<a href="{{short}}}" target="_blank"><img data-original="/pict.php?cod={{codigo}}" class="lazy" border="0" title="Ver informacion"></div></a>'
				+'<div class="detalles">'
				+'<a href="{{short}}}" target="_blank"><h2>{{title}}</h2></a>'
				+'<p>&nbsp;</p>'
				+'<p>{{zone}} • {{city}} • {{owner}} </p>'            
				+'<p>&nbsp;</p>'
				+'<p>&nbsp;</p>'                              
				+'<p>Area {{area}} • {{rooms}} Habitaciones • {{toilet}} Baños &nbsp; • {{garage}} Garaje</p>'
				+'</div>'
				+'<div class="contacto">'
				+'<p>${{price}}</p>'
				+'<a href="{{inmos}}" title="ver mas inmuebles de este anunciante" target="_blank"><img data-original="{{inmo}}" class="lazy" border="0"></a>'                    						
				+'<a href="{{short}}}" class="boton" target="_blank">Ver inmueble</a>'
				+'</div>'
				+'</li>';

     this.run = function(){
          
          socket = io.connect("http://inmueblealaventa.com:9090");
          listeners();
          results = $("[data-results]");

        $("html, body").animate({scrollTop: results.offset().top - 100});          
          search();
     }			


     var search_controller = function(rs, filtered){
     	 console.log(rs);
     	 var out = template;
     	 var outs = "";
         var items = rs.total;
         var pages = Math.ceil(rs.total / 15);
         var links = rs.freq;
         var city = (rs.city) ? rs.docs[0].city : "Colombia";
         rs = rs.docs;



     	  for(x in rs){

     	  	rs[x].image = rs[x].image || "sinImagen150.jpg";
            rs[x].pic_inmo = (rs[x].pic_inmo) ? '/pic.php?i=/bannerInmobiliariaConstructora/'+ rs[x].pic_inmo +'&w=160&h=94&make=show&c=56'  : "/pic.php?i=/imagenes/personat.jpg&w=160&h=94&make=show&c=56";
          
          var title =  (rs[x].tipo_neg < 3) ?  negocio[rs[x].tipo_neg] +" "+ types[rs[x].tipo_inm] : "Vendo / Arriendo" +" "+ types[rs[x].tipo_inm];

          var price = (rs[x].tipo_neg === "1") ? parseInt(rs[x].campo_5) : parseInt(rs[x].campo_53);
              price = price < 0 ? price * -1 : price;

    
    if(rs[x].city)
     	 outs += out
     	 .replace(/\{\{owner\}\}/g, rs[x].nomContacto)
     	 .replace(/\{\{title\}\}/g, title )
     	 .replace(/\{\{zone\}\}/g, rs[x].campo_1)
     	 .replace(/\{\{short\}\}/g, rs[x].short)
     	 .replace(/\{\{area\}\}/g, rs[x].campo_6 + " m2")
     	 .replace(/\{\{rooms\}\}/g, rs[x].campo_24 )
         .replace(/\{\{toilet\}\}/g, rs[x].campo_9 )
     	 .replace(/\{\{price\}\}/g, number_format(price,0,".",".") )
     	 .replace(/\{\{garage\}\}/g, rs[x].campo_17 )
     	 .replace(/\{\{city\}\}/g, rs[x].city.toUpperCase())
        .replace(/\{\{inmo\}\}/g, rs[x].pic_inmo)          
        .replace(/\{\{inmos\}\}/g, "/propiedades_.php?inm="+rs[x].usuario)          
        .replace(/\{\{codigo\}\}/g, rs[x].codigo)          
     	 .replace(/\{\{picture\}\}/g, rs[x].image);     	   
    	 	
    	 	    
     	    } 

            var pager = $("[data-pages]");                
            var template_ = "<span><a href='#' data-page='{{page}}'>{{page}}</a></span>&nbsp;";
            var out_ = "<span><a href='#' data-page='1' title='inicio'>&laquo;</a></span>&nbsp;";

                   

             $("[data-page]").removeClass("active");
             $("[data-page='"+pageActive+"']").addClass("active");
             $("[data-total]").html(items);
            

     	    if(rs.length > 0)
     	    {
                results.html(outs);

                pager.html("");
                $("[data-city]").html(city);
                
                if(pages > 0)
                {
                  for(i=1; i <= pages ; i++)                            
                    out_ += template_.replace(/\{\{page\}\}/g, i);

                out_ += "<span><a href='#' data-page='" + pages +"' title='fin'>&raquo;</a></span>";   
                pager.html(out_);

                var link_tem = "<a href='{{short}}' style='display:block; width:80%; margin:0 auto; text-align:left' target='_blank'>{{text}}</a>";
                var _links = "";
                for(x in links)
                  if(links[x])
                     _links += link_tem.replace("{{short}}", links[x].short).replace("{{text}}", negocio[parseInt(links[x].tipo_neg)] + " " + types[links[x].tipo_inm] + " - " + links[x].campo_1)  + "<br>";

                   $("[data-links]").html(_links);

              }
            }
            else
            {
                results.html("No se han encontraron resultados.");
                pager.html("");                
            }

             var location = new Array();
           
            if(!$("#ciudad option:selected").text().match("Escoja"))
              location.push($("#ciudad option:selected").text());
             if(!$("#zona option:selected").text().match("Escoja"))            
              location.push(" zona " +$("#zona option:selected").text());
            if(!$("#barrio option:selected").text().match("Escoja") && $("#barrio option:selected").text().split("").length > 1 )            
              location.push(" " +$("#barrio option:selected").text());

            console.log(location);

        if(location.length > 0){
          location.join(" , ");      
          $("[data-city]").text($(this).text() + " " + location);
         }

        $("img.lazy").lazyload();      
                        

     }


     var page_controller = function(e){
        e.preventDefault();
        var page = parseInt($(this).attr("data-page"));     
        var data = { filters : {} , page : page};
        pageActive = page;       
        search(data);
     }


     var listeners = function(){

        socket.on("search", search_controller);        
        $("[data-page]").die("click").live("click", page_controller);  

     }

     var search = function(data){
     	var data = data || {filters:{} , page : 1};
        var hash = document.location.hash;
        
            if(hash.match(/\?/))
               hash = hash.split("?")[0];

            data.filters = (hash) ? JSON.parse(hash
                                       .replace("#!" , "")
                                       .replace("#" , "")
                                       .replace("[" , "{")
                                       .replace("]" , "}")
                                        ) : data.filters;

            console.log(data.filters);

        if(window.inmobiliaria)
            data.filters.usuario = inmobiliaria + '';
        else if(data.filters.usuario)
          window.inmobiliaria = data.filters.usuario;

      if(document.location.pathname.match("venta") || document.location.pathname.match("arriendo"))
          { 
            data.filters.tipo_neg = document.location.pathname.match("venta") ? "1" : "2"; 
            negocio[3] = document.location.pathname.match("venta") ? "Vendo" : "Arriendo";
          }


      console.log(data);
     	socket.emit("search", data);
      if(window.inmobiliaria)
      $.getJSON("/apps/migrate/inmo.php?u=" + window.inmobiliaria, function(rs){
            var nombre = rs.nombreEmpresa || rs.nombres;
            $("[data-adm-name]").html(nombre);
            var tels = rs.telefono + " ° " + rs.celular || "";
            $("[data-tel]").html(tels);
            $("[data-site]").html(rs.url);
            $("[data-site]").attr("href",rs.url);
            $("[data-email]").attr("href","mailto:"+rs.email);
            $("[data-email]").html(rs.email);            
            var img = "/pic.php?i=/bannerInmobiliariaConstructora/"+rs.banner1+"&w=150&make=show&c=56" || "/pic.php?i=/bannerInmobiliariaConstructora/"+rs.banner2+"&w=150&make=show&c=56";
            if(!rs.banner1 && !rs.banner2)
              img = "/pic.php?i=/imagenes/personat.jpg&w=150&make=show&c=56";
            $("[data-imag]").attr("src",img);
            $("[data-enouncement]").html("<h1>"+rs.nombreEmpresa+" | venta y arriendo de inmuebles en Colombia</h1> ");
            $("title").html(rs.nombreEmpresa+" | venta y arriendo de inmuebles en Colombia");
            $("[data-inmobiliaria]").show();


      });
      else
       $("[data-inmobiliaria]").hide();



     }

     }

     new iav().run();

})(window);



function number_format(number, decimals, dec_point, thousands_sep) {
  //  discuss at: http://phpjs.org/functions/number_format/
  // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: davook
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Theriault
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Michael White (http://getsprink.com)
  // bugfixed by: Benjamin Lupton
  // bugfixed by: Allan Jensen (http://www.winternet.no)
  // bugfixed by: Howard Yeend
  // bugfixed by: Diogo Resende
  // bugfixed by: Rival
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  //  revised by: Luke Smith (http://lucassmith.name)
  //    input by: Kheang Hok Chin (http://www.distantia.ca/)
  //    input by: Jay Klehr
  //    input by: Amir Habibi (http://www.residence-mixte.com/)
  //    input by: Amirouche
  //   example 1: number_format(1234.56);
  //   returns 1: '1,235'
  //   example 2: number_format(1234.56, 2, ',', ' ');
  //   returns 2: '1 234,56'
  //   example 3: number_format(1234.5678, 2, '.', '');
  //   returns 3: '1234.57'
  //   example 4: number_format(67, 2, ',', '.');
  //   returns 4: '67,00'
  //   example 5: number_format(1000);
  //   returns 5: '1,000'
  //   example 6: number_format(67.311, 2);
  //   returns 6: '67.31'
  //   example 7: number_format(1000.55, 1);
  //   returns 7: '1,000.6'
  //   example 8: number_format(67000, 5, ',', '.');
  //   returns 8: '67.000,00000'
  //   example 9: number_format(0.9, 0);
  //   returns 9: '1'
  //  example 10: number_format('1.20', 2);
  //  returns 10: '1.20'
  //  example 11: number_format('1.20', 4);
  //  returns 11: '1.2000'
  //  example 12: number_format('1.2000', 3);
  //  returns 12: '1.200'
  //  example 13: number_format('1 000,50', 2, '.', ' ');
  //  returns 13: '100 050.00'
  //  example 14: number_format(1e-8, 8, '.', '');
  //  returns 14: '0.00000001'

  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}