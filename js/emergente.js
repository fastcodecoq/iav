
function fn_mostrar_frm_menuss(tipo,cod){
	var web="";
	if (tipo==1)
	{
		web="/masdetallesapto.php?cod="+cod;
	}
	
	else if (tipo==2)
	{
		web="/masdatoscasa.php?cod="+cod;
	}
		
	else if (tipo==3)
	{
		web="/masdatoslocal.php?cod="+cod;
	}
	
	else if (tipo==4)
	{
		web="/masdatosofici.php?cod="+cod;
	}
	
	else if (tipo==5)
	{
		web="/masdetallesbodega.php?cod="+cod;
	}
	
	else if (tipo==6)
	{
		web="/masdatoslote.php?cod="+cod;
	}
	
	else if (tipo==7)
	{
		web="/masdatosfinca.php?cod="+cod;
	}
	
	else if (tipo==8)
	{
		web="/masdatosconsul.php?cod="+cod;
	}
	
	$("#div_oculto").load(web,function(){
		$.blockUI({
			message: $('#div_oculto'),
			css:{
				top: '20%'
			}
		}); 
	});
};


function fn_cerrar(){
	$.unblockUI({ 
		onUnblock: function(){
			$("#div_oculto").html("");
		}
	}); 
};
