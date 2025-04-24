<?php

function recogerTexto($texto):array{

$textoMinusculas=trim(strtolower($texto));

    $determinantes=['mi','mis','la','las','lo','los','el','ellos','ella','ellas','ellos'
,'ese','esa','esas','eso','esos','este','esto','estos','esta','estas','uno','unos','una',
'unas','aquel','aquellos','aquella','aquellas'];
    
   
    $listaPalabras= preg_split("/[\s,_\-;:]+/", $textoMinusculas);
    //Divido el texto introducido por el usuario usando una expresion regular para separar el texto 
    // por comas espacios, guiones y ; o :

    
   // print_r($listaPalabras);

   foreach ($listaPalabras as $indice => $palabra) {//Recorro todas las palabras del array

    foreach ($determinantes as $determinante) {//Recorro el array determinantes

        if($palabra == $determinante){//Si la palabra actual del array coincide con algun determinante...

            unset($listaPalabras[$indice]);//Borro esa palabra de la lista de palabras
        }
    }
   }

   // print_r($listaPalabras);

   return $listaPalabras;

}




?>