<?
//funcion que traduce el numero de mes a español
function traducir_nombre_mes($numero_mes)
{	
	switch($numero_mes)
	{
		case 1:
			$nombre_mes_esp = "Enero";
			break;
		case 2:
			$nombre_mes_esp = "Febrero";
			break;
		case 3:
			$nombre_mes_esp = "Marzo";
			break;
		case 4:
			$nombre_mes_esp = "Abril";
			break;
		case 5:
			$nombre_mes_esp = "Mayo";
			break;
		case 6:
			$nombre_mes_esp = "Junio";
			break;
		case 7:
			$nombre_mes_esp = "Julio";
			break;
		case 8:
			$nombre_mes_esp = "Agosto";
			break;
		case 9:
			$nombre_mes_esp = "Septiembre";
			break;
		case 10:
			$nombre_mes_esp = "Octubre";
			break;
		case 11:
			$nombre_mes_esp = "Noviembre";
			break;
		case 12:
			$nombre_mes_esp = "Diciembre";
			break;
		default:
			$nombre_mes_esp = "Error en el mes!";
	}
	
	return $nombre_mes_esp;
}

//funcion q escribe la fecha (dd de mes de YYYY)
function escribir_fecha($fecha)
{
	$fecha_final = intval(substr($fecha, 8, 2))." de ".traducir_nombre_mes(intval(substr($fecha, 5, 2)))." de ".substr($fecha, 0, 4);
	
	return $fecha_final;
}

function implota($fecha) // bd2local
{
	if (($fecha == "") || ($fecha == "0000-00-00"))
		return "";
	$vector_fecha = explode("-",$fecha);
	$aux = $vector_fecha[2];
	$vector_fecha[2] = $vector_fecha[0];
	$vector_fecha[0] = $aux;
	return implode("/",$vector_fecha);
}

function explota($fecha) // local2bd
{
	$vector_fecha = explode("/",$fecha);
	$aux = $vector_fecha[2];
	$vector_fecha[2] = $vector_fecha[0];
	$vector_fecha[0] = $aux;
	return implode("-",$vector_fecha);
};

function suma_dia_fecha($fecha,$ndias)     
{
        
      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
               list($dia,$mes,$año)=split("/", $fecha);
          
      if (preg_match("/([0-9][0-9]){1,2}-[0-9]{1,2}-[0-9]{1,2}/",$fecha))
           
              list($año,$mes,$dia)=split("-",$fecha);
        $nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
        $nuevafecha=date("Y-m-d",$nueva);
          
      return ($nuevafecha); 
        
}

//retorna la diferencia en dias entre dos fechas (YYYY-mm-dd)
function diferencia_en_dias($fecha_ini, $fecha_fin)
{
	if (strtotime($fecha_fin) > strtotime($fecha_ini))
	{
		$segundos = strtotime($fecha_fin)-strtotime($fecha_ini);
	}
	else if (strtotime($fecha_fin) < strtotime($fecha_ini))
	{
		$segundos = (strtotime($fecha_ini)-strtotime($fecha_fin)) * (-1);
	}
	else
	{
		$segundos = 0;
		return 0;
	}
	
	$dias = intval($segundos/(60*60*24));
	
	return $dias;
}
?>