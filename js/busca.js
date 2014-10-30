/* 
    Document   : javascript
    Created on : 01-oct-2012, 17:55:36
    Author     : israel parra
    Description:
        Purpose of the javascript follows.
*/
//FUNCION DE AUTOCOMPLETAR
            $(document).ready(function(){
                $("#autocompletar").keyup(function()
                { 
                    $("#sugerencia").show(); 
                    var buscar; 
                    buscar = $("#autocompletar").val(); 
 
                    if (buscar.length > 0) 
                    { 
                        $.ajax( 
                        { 
                            type: "POST", 
                            url: "funciones.php", 
                            data: "buscar=" + buscar, 
                            success: function(message) 
                            { 
                                $("#sugerencia").empty(); 
                                if (message.length > 0) 
                                { 
                                    message = message; 
                                    $("#sugerencia").append(message); 
                                }else{
                                    message = "sin sugerencias";
                                    $("#sugerencia").append(message);
                                }
                            } 
                        }); 
                    } 
                    else 
                    {
                        // Si la sugerencia está vacía
                        $("#sugerencia").empty(); 
                    } 
                });
            });
//FIN DE LA FUNCIÓN AUTOCOMPLETAR
//FUNCION CON LA QUE AL PULSAR EL ENLACE 
//NOS LO PONGA EN EL CAMPO DE TEXTO CON ID AUTOCOMPLETAR
            function selectItem(idContenido,value)
            {
                // Cuando pulsamos sobre el desplegable, colocamos el valor en el cuadro de texto
                document.getElementById("autocompletar").value=value;
                //volvemos a indicar que actualice el listado con el nuevo valor
                autocompletar(idContenido,value);
            }
//FUNCION DE LA WEB DE CÉSAR CANCINO, http://cesarcancino.com
//UN GENIO DE LA PROGRAMACIÓN!