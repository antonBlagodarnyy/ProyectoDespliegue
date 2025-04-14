<?php

function recogerTexto($texto){

    
   
    $listaPalabras= preg_split("/[\s,_\-;:]+/", $texto);
    //Divido el texto usando una expresion regular para separar el texto por comas
    //espacios, guiones y ; o :

    
   // print_r($listaPalabras);

   return $listaPalabras;

}

recogerTexto();

?>