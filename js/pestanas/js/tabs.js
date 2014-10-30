/***************************/
//@Author: Adrian Mato Gondelle
//@website: http://web.ontuts.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

function cargar_pestanas_sup(){
    $(".pestamenusupe > li").click(function(e){
        var a = e.target.id;
        //desactivamos seccion y activamos elemento de menu
        $(".pestamenusupe li.activesup").removeClass("activesup");
        $(".pestamenusupe #"+a).addClass("activesup");
        //ocultamos divisiones, mostramos la seleccionada
        $(".contenidopestasup").css("display", "none");
        $("."+a).fadeIn();
    });
}


function cargar_pestanas(){
    $(".menuinf > li").click(function(e){
        var a = e.target.id;
        //desactivamos seccion y activamos elemento de menu
        $(".menuinf li.activeinf").removeClass("activeinf");
        $(".menuinf #"+a).addClass("activeinf");
        //ocultamos divisiones, mostramos la seleccionada
        $(".contentinf").css("display", "none");
        $("."+a).fadeIn();
    });
}


function cargar_pestanas_inm(){
    $(".menuinfinmu > li").click(function(e){
        var a = e.target.id;
        //desactivamos seccion y activamos elemento de menu
        $(".menuinfinmu li.activeinfinm").removeClass("activeinfinm");
        $(".menuinfinmu #"+a).addClass("activeinfinm");
        //ocultamos divisiones, mostramos la seleccionada
        $(".contentinfinm").css("display", "none");
        $("."+a).fadeIn();
    });
}


function cargar_pestanas_inmu(){
    $(".menuinfinmu > li").click(function(e){
        var a = e.target.id;
        //desactivamos seccion y activamos elemento de menu
        $(".menuinfinmu li.activeimg").removeClass("activeimg");
        $(".menuinfinmu #"+a).addClass("activeimg");
        //ocultamos divisiones, mostramos la seleccionada
        $(".contentinfinm").css("display", "none");
        $("."+a).fadeIn();
    });
}





function cargar_pestanas_tabulador(){
    $(".pestamenusupe > li").click(function(e){
        var a = e.target.id;
        //desactivamos seccion y activamos elemento de menu
        $(".pestamenusupe li.activesup").removeClass("activesup");
        $(".pestamenusupe #"+a).addClass("activesup");
        //ocultamos divisiones, mostramos la seleccionada
        $(".contenidopestasup").css("display", "none");
        $("."+a).fadeIn();
    });
}