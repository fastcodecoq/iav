/*****************************************************************************************************
 EDITAR USUARIO
*****************************************************************************************************/
function editar_usuario(id)
{
	document.frm_usuarios.hdd_id.value = id;
	document.frm_usuarios.action = "usuario_edit.php";
	document.frm_usuarios.submit();
}

function guardar_usuario()
{
	if(document.frm_usuarios.txt_cedula.value != "" && document.frm_usuarios.txt_nombre.value != "" && document.frm_usuarios.txt_apellidos.value != "" && document.frm_usuarios.txt_email.value != "" && document.frm_usuarios.txt_telefono.value != "" && document.frm_usuarios.txt_direccion.value != "" && document.frm_usuarios.txt_contrasena.value != "" && document.frm_usuarios.txt_confirmacion.value != "" && document.frm_usuarios.txt_usuario.value != ""  && document.frm_usuarios.cmb_cargo.value != "0")
	{ 
		if(document.frm_usuarios.txt_contrasena.value == document.frm_usuarios.txt_confirmacion.value)
		{
			document.frm_usuarios.hdd_tipo.value = "agregar"; 
			document.frm_usuarios.submit();
		}
		else
		{
			alert("El campo de confirmación no es igual al de contraseña");		
		}
	} 
	else 
	{ 
		alert('Los Campos con * son obligatorios');
	}
}

function modificar_usuario()
{
	if(document.frm_usuarios.txt_nombre.value != "" && document.frm_usuarios.txt_apellidos.value != "" && document.frm_usuarios.cmb_cargo.value != "0")
	{ 
		if(document.frm_usuarios.txt_contrasena.value != '' && document.frm_usuarios.txt_confirmacion.value != '')
		{
			if(document.frm_usuarios.txt_contrasena.value == document.frm_usuarios.txt_confirmacion.value)
			{
				document.frm_usuarios.hdd_tipo.value = "agregar"; 
				document.frm_usuarios.submit();
			}
			else
			{
				alert("El campo de confirmación no es igual al de contraseña");		
			}
		}
		else
		{
			document.frm_usuarios.hdd_tipo.value = "agregar"; 
			document.frm_usuarios.submit();
		}
	} 
	else 
	{ 
		alert('Los Campos con * son obligatorios');
	}
}
/*****************************************************************************************************
 EDITAR USUARIO
*****************************************************************************************************/

/*****************************************************************************************************
 ELIMINAR USUARIO
*****************************************************************************************************/
function eliminar_usuarios()
{
	document.frm_usuarios.hdd_accion.value = "eliminar";
	document.frm_usuarios.submit();
}
/*****************************************************************************************************
 ELIMINAR USUARIO
*****************************************************************************************************/


/*****************************************************************************************************
 PASAR ELEMENTOS DE UNA LISTA A OTRA
*****************************************************************************************************/

function adicionar()
{
	var array_prod = new Array();
	
	obj=document.getElementById('productos'); 
    if (obj.selectedIndex==-1) return; 
    valor=obj.value; 
    txt=obj.options[obj.selectedIndex].text; 
    obj.options[obj.selectedIndex]=null; 
    obj2=document.getElementById('prod_sugeridos'); 
    opc = new Option(txt,valor); 
    eval((obj2.options[obj2.options.length]=opc).selected = true); 
}
function remover()
{
	obj=document.getElementById('prod_sugeridos'); 
    if (obj.selectedIndex==-1) return; 
    valor=obj.value; 
    txt=obj.options[obj.selectedIndex].text; 
    obj.options[obj.selectedIndex]=null; 
    obj2=document.getElementById('productos'); 
    opc = new Option(txt,valor); 
    eval(obj2.options[obj2.options.length]=opc); 
}

/*****************************************************************************************************
 PASAR ELEMENTOS DE UNA LISTA A OTRA
*****************************************************************************************************/


/*****************************************************************************************************
 EDITAR CLIENTE
*****************************************************************************************************/
function editar_cliente(id)
{
	document.frm_clientes.hdd_id.value = id;
	document.frm_clientes.action = "cliente_edit.php";
	document.frm_clientes.submit();
}


function modificar_cliente()
{
	if(document.frm_clientes.txt_nombre.value != "" && document.frm_clientes.txt_apellidos.value != "" && document.frm_clientes.txt_telefono.value != "")
	{ 
	
		if(document.frm_clientes.txt_contrasena.value != '' && document.frm_clientes.txt_confirmacion.value != '')
		{
			if(document.frm_clientes.txt_contrasena.value == document.frm_clientes.txt_confirmacion.value)
			{
				document.frm_clientes.hdd_tipo.value = "agregar"; 
				document.frm_clientes.submit();
			}
			else
			{
				alert("El campo de confirmación no es igual al de contraseña");		
			}
		}
		else
		{
			document.frm_clientes.hdd_tipo.value = "agregar"; 
			document.frm_clientes.submit();
		}
	} 
	else 
	{ 
		alert('Los Campos con * son obligatorios');
	}
}
/*****************************************************************************************************
 EDITAR CLIENTE
*****************************************************************************************************/

/*****************************************************************************************************
 EDITAR HOTEL
*****************************************************************************************************/
function editar_hotel(id)
{
	document.frm_hoteles.hdd_id.value = id;
	document.frm_hoteles.action = "hotel_edit.php";
	document.frm_hoteles.submit();
}
/*****************************************************************************************************
 EDITAR HOTEL
*****************************************************************************************************/

