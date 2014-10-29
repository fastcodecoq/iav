<?php


	if ($page == 0) $page = 1;					
	$prev = $page - 1;							
	$next = $page + 1;							
	$total_paginas = ceil($num_registros/$TAMANO_PAGINA);
	$lpm1 = $total_paginas - 1;	
	
	/* 
		Now we apply our rules and draw the paginacion object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$paginacion = "";
	$anexo="";
	$adjacents="";
	if($total_paginas > 1)
	{	
		$paginacion .= "<div class=\"paginacion\">";
		//previous button
		if ($page > 1) 
			$paginacion.= "<a href=\"$pagina?page=$prev$anexo\">&laquo; Anterior</a>";
		else
			$paginacion.= "<span class=\"></span>";	
		
		//pages	
		if ($total_paginas < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($contador = 1; $contador <= $total_paginas; $contador++)
			{
				if ($contador == $page)
					$paginacion.= "<span class=\"current\">$contador</span>";
				else
					$paginacion.= "<a href=\"$pagina?page=$contador$anexo\">$contador</a>";					
			}
		}
		elseif($total_paginas > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($contador = 1; $contador < 4 + ($adjacents * 2); $contador++)
				{
					if ($contador == $page)
						$paginacion.= "<span class=\"current\">$contador</span>";
					else
						$paginacion.= "<a href=\"$pagina?page=$contador$anexo\">$contador</a>";					
				}
				$paginacion.= "...";
				$paginacion.= "<a href=\"$pagina?page=$lpm1\">$lpm1</a>";
				$paginacion.= "<a href=\"$pagina?page=$total_paginas$anexo\">$total_paginas</a>";		
			}
			//in middle; hide some front and some back
			elseif($total_paginas - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$paginacion.= "<a href=\"$pagina?page=1$anexo\">1</a>";
				$paginacion.= "<a href=\"$pagina?page=2$anexo\">2</a>";
				$paginacion.= "...";
				for ($contador = $page - $adjacents; $contador <= $page + $adjacents; $contador++)
				{
					if ($contador == $page)
						$paginacion.= "<span class=\"current\">$contador</span>";
					else
						$paginacion.= "<a href=\"$pagina?page=$contador$anexo\">$contador</a>";					
				}
				$paginacion.= "...";
				$paginacion.= "<a href=\"$pagina?page=$lpm1$anexo\">$lpm1</a>";
				$paginacion.= "<a href=\"$pagina?page=$total_paginas$anexo\">$total_paginas</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$paginacion.= "<a href=\"$pagina?page=1$anexo\">1</a>";
				$paginacion.= "<a href=\"$pagina?page=2$anexo\">2</a>";
				$paginacion.= "...";
				for ($contador = $total_paginas - (2 + ($adjacents * 2)); $contador <= $total_paginas; $contador++)
				{
					if ($contador == $page)
						$paginacion.= "<span class=\"current\">$contador</span>";
					else
						$paginacion.= "<a href=\"$pagina?page=$contador$anexo\">$contador</a>";					
				}
			}
		}
		
		//next button
		if ($page < $total_paginas) 
			$paginacion.= "<a href=\"$pagina?page=$next$anexo\">Siguiente &raquo;</a>";
		else
			$paginacion.= "<span class=\"disabled\">Siguiente &raquo;</span>";
		$paginacion.= "</div>\n";		
	}
?>


