<?php
//Secciones del supermercado
function secciones($valor)
{
	switch ($valor)
	{
		case 1: return "Mercado";
		case 2: return "Cuidado Personal";
		case 3: return "Productos Novedosos";
		case 4: return "Ofertas";
		default: return "[Sin definir]";
	}
}

//funcion para devolver el valor correcto para el tipo de observacion
function tipos_cupon($valor)
{
	switch ($valor)
	{
		case 1: return "Porcentaje";
		case 2: return "Cantidad Fija";
		default: return "[Sin definir]";
	}
}

//funcion para devolver los estados basicos
function estados($valor)
{
	switch ($valor)
	{
		case 1: return "Activado";
		case 2: return "Desactivado";
		default: return "[Sin definir]";
	}
}

//funcion para devolver los estados de los pedidos
function estados_pedidos($valor)
{
	switch ($valor)
	{
		/*case 1: return "Aprobado";
		case 2: return "Pendiente";
		case 3: return "Cancelado";
		case 4: return "Rechazado";
		case 5: return "Enviado";*/
		case 1: return "Realizado";
		case 2: return "Enviado";
		case 3: return "Pago";
		case 4: return "Cancelado";
		default: return "[Sin definir]";
	}
}

//Mustra los tipos de clientes que existen
function tipo_cliente($valor)
{
	switch ($valor)
	{
		case 1: return "Pionero";
		case 2: return "Cliente";
		default: return "[Sin definir]";
	}
}

//funcion para devolver el valor correcto para el tipo de observacion
function estados_civiles($valor)
{
	switch ($valor)
	{
		case 1: return "Soltero(a)";
		case 2: return "Casado(a)";
		case 3: return "Viudo(a)";
		case 4: return "Divorsiado(a)";
		case 5: return "Union Libre";
		default: return "- Seleccione -";
	}
}
?>