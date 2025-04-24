<?php

function contarPalabras (array $palabras){
    //Podria usar array_count_values()
    $palabrasContadas = [];
    foreach ($palabras as $palabra) {
        if(!array_key_exists($palabra,$palabrasContadas))
        {
            $palabrasContadas [$palabra] = array_reduce($palabras,function ($carry,$item) use ($palabra){
                if($palabra == $item){
                    $carry++;
                }
                return $carry;
            },0);
        };
      
    }
    return $palabrasContadas;
}

