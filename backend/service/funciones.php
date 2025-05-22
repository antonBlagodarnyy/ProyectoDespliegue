<?php
require_once __DIR__ . '/stop_words.php';

class ProcesadorTexto
{


    function main($texto): array
    {
        $textoSaneado = ProcesadorTexto::sanearTexto($texto);
        $listaPalabras = ProcesadorTexto::eliminarDeterminantes(ProcesadorTexto::filtrarPalabras($textoSaneado));
        $palabrasContadas = ProcesadorTexto::contarPalabras($listaPalabras);
        $palabrasOrdenadas = ProcesadorTexto::ordenarPalabras($palabrasContadas);

        return $palabrasOrdenadas;
    }

    function sanearTexto($texto): string
    {

        $textoConvertido = mb_convert_encoding($texto, 'UTF-8', 'auto');

        //var_dump($texto);

        $textoMinusculas = trim(mb_strtolower($textoConvertido, 'UTF-8'));

        return $textoMinusculas;
    }

    function filtrarPalabras($texto): array
    {
        $listaPalabras = preg_split("/[\s,._\-;:¿?!¡+@$#%&()\d]+/u", $texto, -1, PREG_SPLIT_NO_EMPTY);
        //Divido el texto introducido por el usuario usando una expresion regular para separar el texto 
        // por comas espacios, guiones y ; o : . Gracias a la u final de la regex, consigo tratar los caracteres
        //con tilde como á,é,í,ó,ú como caracteres completos y no caracteres separados, por ejemplo a ´.

        return $listaPalabras;
    }

    function eliminarDeterminantes($listaPalabras): array
    {

        foreach ($listaPalabras as $indice => $palabra) { //Recorro todas las palabras del array

            foreach (STOP_WORDS as $determinante) { //Recorro el array determinantes

                if ($palabra == $determinante) { //Si la palabra actual del array coincide con algun determinante...

                    unset($listaPalabras[$indice]); //Borro esa palabra de la lista de palabras
                }
            }
        }

        $listaPalabras = array_filter($listaPalabras);

        // print_r($listaPalabras);

        return $listaPalabras;
    }

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

    function contarPalabras(array $palabras)
    {
        //Podria usar array_count_values()
        $palabrasContadas = [];
        foreach ($palabras as $palabra) {
            if (!array_key_exists($palabra, $palabrasContadas)) {
                $palabrasContadas[$palabra] = array_reduce($palabras, function ($carry, $item) use ($palabra) {
                    if ($palabra == $item) {
                        $carry++;
                    }
                    return $carry;
                }, 0);
            };
        }
        return $palabrasContadas;
    }
}
