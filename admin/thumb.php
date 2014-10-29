<?php
function thumb($imagefile, $w) {

    /* Obtener extensi�n del archivo */
    $dot = (strlen($imagefile) - strrpos($imagefile, ".")-1)*(-1);

    $ext = substr($imagefile, $dot);
    $ext = strtolower($ext);    
        
    /* Chequear que las im�genes sean de alguno de los formatos soportados. Por medio de la funci�n strtolower(), pasamos la extensi�n a min�sculas */
    
    if(strtolower($ext) == "gif") {
        if (!$src_img = imagecreatefromgif($imagefile)) {
            echo "Error abriendo $imagefile!"; exit;
        }
    } else if(strtolower($ext) == "jpg" || strtolower($ext) == "jpeg") {
        if (!$src_img = imagecreatefromjpeg($imagefile)) {
            echo "Error abriendo $imagefile!"; exit;
        }
    } else if(strtolower($ext) == "png") {
        if (!$src_img = imagecreatefrompng($imagefile)) {
            echo "Error abriendo $imagefile!"; exit;
        }
    } else {
        echo "Formato de im�gen no soportada"; exit;
    }
    
    /*La funci�n getimagesize devuelve un array con la siguiente estructura:
        array {
            [0] => "ancho en pixeles"
            [1] => "alto en pixeles"
            [2] => "tipo de im�gen (1=GIF; 2=JPG; 3=PNG)"
            [3] => "width=xxx height=yyy" (para usar con el tag img de HTML)
        }
    */
    
    $hw = getimagesize($imagefile);
    /* $w es el ancho para la nueva im�gen */
    $new_w = $w;
    /* A trav�s del cociente entre el alto y el cociente entre la anchura original y la anchura nueva, mantenemos las proporciones de la im�gen.*/
    $new_h = $hw["1"]/($hw["0"]/$w); 

    /* Intentamos crear una im�gen 'true color'. Esta funci�n es soportada a partir de GD 2.0, por lo que en caso de no funcionar, se usar� la funci�n imageCreate */
    $dst_img = @imagecreatetruecolor($new_w, $new_h);
    if(!$dst_img) {
      $dst_img = imageCreate($new_w, $new_h);
    }
    
    /* Se crea la im�gen con los valores obtenidos y borramos las im�genes de la memoria. */
    imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 
    imagejpeg($dst_img); 
    ImageDestroy($src_img); 
    ImageDestroy($dst_img); 
}

/* Se indica el tipo de archivo */
header("Content-type: image/jpeg");

/* Llamamos a la funci�n para crear el thumbnail con los valores obtenidos por HTTP GET */
thumb($_GET[image], $_GET[w]);

?> 