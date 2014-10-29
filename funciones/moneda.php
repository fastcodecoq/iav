<?php
function redondear($numero, $decimales)
{
	$factor = pow(10, $decimales);
	return (round($numero*$factor)/$factor);
}


function numero_moneda($numero)
{
	$negativo = false;
	
	if ($numero < 0)
	{
		$negativo = true;
		$numero *= -1;
	}
	$int_numero = explode(".", $numero);
	$strnumero = strval($int_numero[0]);
	$moneda = "";
	while (strlen($strnumero) > 2)
	{
		$moneda = ".".substr($strnumero, strlen($strnumero)-3, strlen($strnumero)) . $moneda;
		$strnumero = substr($strnumero, 0, strlen($strnumero)-3);
	}
	
	if (strlen($strnumero) > 0)
	{
		$moneda = $strnumero . $moneda;
	}
	else
	{
		$moneda = substr($moneda, 1, strlen($moneda));
	}
	
	if (isset($int_numero[1]) && $int_numero[1] > 0)
	{
		$moneda .= ",".$int_numero[1];
	}
	
	if ($negativo)
	{
		return "-".$moneda;
	}
	else
	{
		return $moneda;
	}
}

//echo numero_moneda(100000);
?>
