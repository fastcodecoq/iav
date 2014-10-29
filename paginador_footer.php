<?php


if($num_rows != 0)
  	{
	?>
	<table>
	<?php
        $nextpage= $page +1;
       $prevpage= $page -1;
     
	 
       ?><tr><?php
           //SI ES LA PRIMERA PÁGINA DESHABILITO EL BOTON DE PREVIOUS, MUESTRO EL 1 COMO ACTIVO Y MUESTRO EL RESTO DE PÁGINAS
           if ($page == 1)
           {
			   
            ?>
              <td>&laquo;</td>
              <td>1</td> 
         <?php
              for($i= $page+1; $i<= $lastpage ; $i++)
              {?>
                <td><a href="&page=<?php echo $i;?>"><?php echo $i;?></a></td>
        <?php }
           
           //Y SI LA ULTIMA PÁGINA ES MAYOR QUE LA ACTUAL MUESTRO EL BOTON NEXT O LO DESHABILITO
            if($lastpage >$page )
            {?>     
                <td><a href="&page=<?php echo $nextpage;?>" >&raquo;</a></td><?php
            }
            else
            {?>
                <td>&raquo;</td>
        <?php
            }
        }
        else
        {
		
            //EN CAMBIO SI NO ESTAMOS EN LA PÁGINA UNO HABILITO EL BOTON DE PREVIUS Y MUESTRO LAS DEMÁS
        ?>
            <td><a href="&page=<?php echo $prevpage;?>"><strong>&laquo;</strong></a></td><?php
             for($i= 1; $i<= $lastpage ; $i++)
             {
                           //COMPRUEBO SI ES LA PÁGINA ACTIVA O NO
                if($page == $i)
                {
            ?>       <td><?php echo $i;?></td><?php
                }
                else
                {
            ?>       <td><a href="&page=<?php echo $i;?>" ><strong><?php echo $i;?></strong></a></td><?php
                }
            }
             //Y SI NO ES LA ÚLTIMA PÁGINA ACTIVO EL BOTON NEXT    
            if($lastpage >$page )
            {   ?>  
                <td><a href="&page=<?php echo $nextpage;?>"><strong>&raquo;</strong></a></td><?php
            }
            else
            {
        ?>       <td>&raquo;</td><?php
            }
        } 
		   
    ?></tr></table><?php
    }

 
?>