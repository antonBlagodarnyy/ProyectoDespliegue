<?php

function ordenarPalabras(array $palabras)
{
    //Podria utilizar sort()
    $palabrasOrdenadas = [];

    for ($i = 0; $i < count($palabras); $i++) {
        $palabrasOrdenadas[] = max($palabras);
    }

    return $palabrasOrdenadas;
}
