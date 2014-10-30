// JavaScript Document
function cargar_menu_lateral(tipo_pagina){
		$("#dv_ajax").show();
		/*Peticion AJAX*/
		var request = $.ajax({
							  url: "ajax/ajax_menu_lateral.php",
							  type: "POST",
							  data: {var_tipo_pagina:tipo_pagina},
							  dataType: "html",
							  success: function(data){
								  		$("#dv_ajax").hide();
										if(data!=""){
												$("#contenido_menu_lateral").html(data);
												validar_items_menu_lateral();
												$( "input:submit, .boton, input:button").button();
												$("#dv_menu_lateral").fadeIn("slow","");
												$(".handle").click();
											 	
										}
										else
											alert("Ocurrio un error");
									  }
							});
}

function validar_tipo_pagina(){
	var lista_tipo_paginas=$("#hdn_tipo_pagina").val().split('-');
	var a=0;
	for (a;a<=lista_tipo_paginas.length-1;a++){
			valor=lista_tipo_paginas[a];
			$('li[tipo_pagina="'+valor+'"]').show();
			if(a==lista_tipo_paginas.length-1)
				$('a[link_tipo_pagina="'+valor+'"]').attr("id","sin");
	}
	
		
}

function validar_items_menu_lateral(){
	var lista_tipo_paginas=$("#hdn_item_menu").val().split('|');
	var a=0;
	for (a;a<=lista_tipo_paginas.length-1;a++){
			valor=lista_tipo_paginas[a].split('~');
			$('a[id_menu="'+valor[0]+'"]').html(valor[1]);
			$('li[id_menu="'+valor[0]+'"]').show();
	}
		
}

function cargar_pagina(pagina_destino,iddestino){
	location.href=pagina_destino+"?ip="+iddestino;
}

function cargar_pagina_libro(pagina_destino,iddestino){
	location.href=pagina_destino+"?id_libro="+iddestino;
}

function menu_lateral()
{
	$('#dv_menu_lateral').tabSlideOut({
            tabHandle: '.handle',                     //class of the element that will become your tab
            pathToTabImage: '../images/iconos/32/newspaper_32x32.png', //path to the image for the tab //Optionally can be set using css
            imageHeight: '32px',                     //height of tab image           //Optionally can be set using css
            imageWidth: '32px',                       //width of tab image            //Optionally can be set using css
            tabLocation: 'left',                      //side of screen where tab lives, top, right, bottom, or left
            speed: 300,                               //speed of animation
            action: 'click',                          //options: 'click' or 'hover', action to trigger animation
            topPos: '300px',                          //position from the top/ use if tabLocation is left or right
            leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
            fixedPosition: false                      //options: true makes it stick(fixed position) on scroll
        });	
}