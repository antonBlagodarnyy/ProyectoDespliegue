<?php

function ordenarPalabras(array $palabras)
{
    //Podria utilizar sort()

    $claves = array_keys($palabras);
    $n = count($claves);

   
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            $claveActual = $claves[$j];
            $claveSiguiente = $claves[$j + 1];

            if ($palabras[$claveActual] < $palabras[$claveSiguiente]) {

                $temp = $claves[$j];
                $claves[$j] = $claves[$j + 1];
                $claves[$j + 1] = $temp;
            }
        }
    }

    $ordenado = [];
    foreach ($claves as $clave) {
        $ordenado[$clave] = $palabras[$clave];
    }

    return $ordenado;
}
