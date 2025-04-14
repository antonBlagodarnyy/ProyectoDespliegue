<?php

function ordenarPalabras(array $palabras)
{
    //Podria utilizar sort()
    $palabrasOrdenadas = [];

    foreach ($palabras as $key => $palabra) {
        $palabrasOrdenadas[$key] = max($palabras);
    }
    return $palabrasOrdenadas;
}
