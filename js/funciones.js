/****************************************************************************************************
  ABRE UNA VENTANA DEL EXPLORADOR
*****************************************************************************************************/
function abrir_ventana(url, nombre, propiedades) 
{ 
  window.open(url,nombre,propiedades);
}
/****************************************************************************************************
  ABRE UNA VENTANA DEL EXPLORADOR
*****************************************************************************************************/

/*****************************************************************************************************
 RESALTA FILA/CELDA DE UNA TABLA
*****************************************************************************************************/
function resaltarFila(fila, color) 
{
	fila.bgColor=color;
	fila.style.cursor="hand"; 
}
/*****************************************************************************************************
 RESALTA FILA/CELDA DE UNA TABLA
*****************************************************************************************************/

/*****************************************************************************************************
 DES-RESALTA FILA/CELDA DE UNA TABLA
*****************************************************************************************************/
function reestablecerFila(fila, color) 
{
	fila.bgColor=color;
	fila.style.cursor="default"; 
}
/*****************************************************************************************************
 DES-RESALTA FILA/CELDA DE UNA TABLA
*****************************************************************************************************/

/*****************************************************************************************************
 PREPARA LOS CAMPOS PARA EL LOGIN
*****************************************************************************************************/
function ingresar() 
{
	document.frm_login.submit();
}
/*****************************************************************************************************
 PREPARA LOS CAMPOS PARA EL LOGIN
*****************************************************************************************************/

/*****************************************************************************************************
 VALIDA UN EMAIL
*****************************************************************************************************/
function validar_email(valor) 
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor))
	{
		//alert("La direcci�n de email " + valor    + " es correcta.") 
		return (true)
	} 
	else 
	{
		//alert("La direcci�n de email es incorrecta.");
		return (false);
	}
}
/*****************************************************************************************************
 VALIDA UN EMAIL
*****************************************************************************************************/

/*****************************************************************************************************
 MUESTRA Y ESCONDE OBJETOS EN LA PANTALLA
*****************************************************************************************************/
function visibilidad(nombre, valor)
{
	var objeto = document.getElementById(nombre);
	objeto.style.display = valor;
}
/*****************************************************************************************************
 MUESTRA Y ESCONDE OBJETOS EN LA PANTALLA
*****************************************************************************************************/

/*****************************************************************************************************
 RESTRINGE LA ENTRADA DE DATOS A SOLO NUMEROS
*****************************************************************************************************/
function soloNumeros(e) { 
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true;
    patron =/[.\d]/; 
    te = String.fromCharCode(tecla);
    return patron.test(te);
	/*
	patron = /\d/; // Solo acepta n�meros
	patron = /\w/; // Acepta n�meros y letras
	patron = /\D/; // No acepta n�meros
	patron =/[A-Za-z��\s]/; // igual que el ejemplo, pero acepta tambi�n las letras � y �
	*/
} 
//Uso: onkeypress="validar(event,)"
/*****************************************************************************************************
 RESTRINGE LA ENTRADA DE DATOS A SOLO NUMEROS
*****************************************************************************************************/

/*****************************************************************************
C�digo para colocar los indicadores de miles  y decimales mientras se escribe
Script creado por Tunait!
Si quieres usar este script en tu sitio eres libre de hacerlo con la condici�n de que permanezcan intactas estas l�neas, osea, los cr�ditos.

http://javascript.tunait.com
tunait@yahoo.com  27/Julio/03
******************************************************************************/
function puntillos(input)
{
var num = input.value.replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}
else{ alert('Solo se permiten numeros');
input.value = input.value.replace(/[^\d\.]*/g,'');
}
}