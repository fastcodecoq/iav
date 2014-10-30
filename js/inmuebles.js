// JavaScript Document
// Desarrollo Saulo Andres Valderrama

/*****************************************************************************************************
 CONSULTA INMUEBLES POR FILTRO
*****************************************************************************************************/

function consultar_inmueble_select_arriendo (){
	var minimo = document.arriendos.val_minA.value;
	var maximo = document.arriendos.val_maxA.value;
	var tipo = document.arriendos.tipoArriendo.value;
	var municipio = document.arriendos.municipioA.value;
	var barrio = document.arriendos.barrioA.value;	
	var palabraClave = document.arriendos.palabraClaveArriendo.value;
	
	if( palabraClave == '' || palabraClave != 'Palabra clave Ej: Cañaveral')
	{
		document.arriendos.action = 'inmuebles.php?tipo_cons=1&tip_inmueble='+tipo+'&barrio='+barrio+'&min='+minimo+'&max='+maximo+'&tip_con=1&orden=0';
		document.arriendos.submit();
	}
	else
	{
		document.arriendos.action = 'inmuebles.php?palabra'+palabraClave+'&tip_con=1&orden=0';
		document.arriendos.submit();
	}
}

/*****************************************************************************************************
 CONSULTA INMUEBLES POR FILTRO
*****************************************************************************************************/

/*****************************************************************************************************
 CONSULTA INMUEBLES POR FILTRO
*****************************************************************************************************/

function consultar_inmueble_select_venta (){
	var minimo = document.frm_buscador.cmb_minimo.value;
	var maximo = document.frm_buscador.cmb_maximo.value;
	var barrio = document.frm_buscador.cmb_barrio.value;
	var tipo = document.frm_buscador.cmb_tipo.value;
	
	if( maximo != '' && minimo != '')
	{
		document.frm_buscador.action = 'inmuebles.php?tipo_cons=2&tip_inmueble='+tipo+'&barrio='+barrio+'&min='+minimo+'&max='+maximo+'&tip_con=2&orden=0';
		document.frm_buscador.submit();
	}
	else
	{
		alert('Debe seleccionar un Valor minimo y Valor maximo');
	}
}

/*****************************************************************************************************
 CONSULTA INMUEBLES POR FILTRO
*****************************************************************************************************/

/*****************************************************************************************************
 CONSULTA INMUEBLES POR CODIGO
*****************************************************************************************************/
function consultar_inmueble_codigo (){
	
	
	var codigo = document.frm_buscador.txt_codigo.value;
	
	if(codigo != "")
	{
		document.frm_buscador.action = 'inmueble.php?codigo='+codigo;
		document.frm_buscador.submit();
	}
	else
	{
		alert("Debe ingresar un codigo");
	}
	
}
/*****************************************************************************************************
 CONSULTA INMUEBLES POR CODIGO
*****************************************************************************************************/

/*****************************************************************************************************
 CONSULTA INMUEBLES POR DIRECCION
*****************************************************************************************************/
function consultar_inmueble_direccion (){
	
	
	var direccion = document.frm_buscador.txt_busq_dir.value;
	
	if(direccion !=  'Ej: (CL 036 23 14, CR 033, AV, DIAG, KM, TRANSV)')
	{
		if(direccion != "")
		{
			document.frm_buscador.action = 'inmuebles_dir.php?tipo_cons=1&dir='+direccion+'&tip_con=1&orden=0'
			document.frm_buscador.submit();
		}
		else
		{
			alert("Debe ingresar una criterio de busqueda");
		}
	}
	else
	{
		alert("El criterio de busqueda no es valido");
	}
	
}
/*****************************************************************************************************
 CONSULTA INMUEBLES POR DIRECCION
*****************************************************************************************************/

/*****************************************************************************************************
 ENVIAR CORREO
*****************************************************************************************************/
function enviar_correo()
{
	if(document.frm_correo.txt_nombre_amigo.value != "" && document.frm_correo.txt_email_amigo.value != "" && document.frm_correo.txt_su_nombre.value != "")
	{
		document.frm_correo.hdd_accion.value = 'enviar_correo';
		document.frm_correo.submit();
	}
	else
	{
		alert("Los datos con * son obligatorios");
	}
}
/*****************************************************************************************************
 ENVIAR CORREO
*****************************************************************************************************/

/*****************************************************************************************************
 PROGRAMAR CITA
*****************************************************************************************************/
function programar_cita()
{
	if(document.frm_correo.txt_nombre.value != "" && document.frm_correo.txt_telefono.value != "" && document.frm_correo.txt_email.value != "" && document.frm_correo.txt_fecha.value != "" && document.frm_correo.cmb_hora.value != "0")
	{
		document.frm_correo.hdd_accion.value = 'enviar_correo';
		document.frm_correo.submit();
	}
	else
	{
		alert("Los datos con * son obligatorios");
	}
}
/*****************************************************************************************************
 PROGRAMAR CITA
*****************************************************************************************************/

/*****************************************************************************************************
 CONSULTA PAGO DE FACTURA
*****************************************************************************************************/

function consultar_fac_pago()
{
	var factura = document.frm_pagos.txt_factura.value;
	
	if( factura != '')
	{
		document.frm_pagos.action = 'pagos_val.php';
		document.frm_pagos.submit();
	}
	else
	{
		alert('Debe ingresar el numero de la factura');
	}
}

/*****************************************************************************************************
 CONSULTA PAGO DE FACTURA
*****************************************************************************************************/

/*****************************************************************************************************
 CONSULTA OTROS PAGOS
*****************************************************************************************************/

function otros_pagos()
{
	var cedula = document.frm_pagos.Ref1.value;
	var nombre = document.frm_pagos.Ref2.value;
	var tipo = document.frm_pagos.Ref4.value;
	var valor = document.frm_pagos.valor.value;
	
	if( cedula != '' & nombre != '' & tipo != '0' & valor != '')
	{
		document.frm_pagos.action = 'https://www.edinet.com/Pse/pago.aspx';
		document.frm_pagos.submit();
	}
	else
	{
		alert('Debe ingresar los campos Cedula, Nombre, Tipo de pago y Valor');
	}
}

/*****************************************************************************************************
 CONSULTA OTROS PAGOS
*****************************************************************************************************/

/*****************************************************************************************************
 VALIDAR CONTRASEÑA Y USUARIO
*****************************************************************************************************/

function validar_clave()
{
	var usuario = document.frm_cuenta.txt_usuario.value;
	var clave = document.frm_cuenta.txt_contrasena.value;

	
	if( usuario != '' & clave != '')
	{
		document.frm_cuenta.action = 'autenticacion_cliente.php';
		document.frm_cuenta.submit();
	}
	else
	{
		alert('Todos los campos son obligatorios');
	}
}

/*****************************************************************************************************
 VALIDAR CONTRASEÑA Y USUARIO
*****************************************************************************************************/