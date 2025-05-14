<?php

function recogerTexto($texto):array{

$textoConvertido=mb_convert_encoding($texto,'unicode');

$textoMinusculas=trim(strtolower($texto));

    $determinantes=[
        "a", "acá", "ahí", "al", "algo", "algunas", "algunos", "allá", "allí", "ambos",
        "ante", "antes", "aquel", "aquella", "aquellas", "aquello", "aquellos", "aquí",
        "arriba", "así", "atrás", "aun", "aunque", "bajo", "bien", "cabe", "cada",
        "casi", "como", "con", "conmigo", "contigo", "contra", "cual", "cuales",
        "cualquier", "cualquiera", "cuando", "cuanta", "cuantas", "cuanto", "cuantos",
        "de", "dejar", "del", "demasiado", "demás", "dentro", "desde", "donde", "dos",
        "el", "él", "ella", "ellas", "ello", "ellos", "en", "encima", "entonces",
        "entre", "era", "erais", "eran", "eras", "eres", "es", "esa", "esas", "ese",
        "eso", "esos", "esta", "estaba", "estabais", "estaban", "estabas", "estad",
        "estada", "estadas", "estado", "estados", "estamos", "estando", "estar",
        "estaremos", "estará", "estarán", "estarás", "estaré", "estaréis", "estaría",
        "estaríais", "estaríamos", "estarían", "estarías", "estas", "este", "estemos",
        "esto", "estos", "estoy", "estuve", "estuviera", "estuvierais", "estuvieran",
        "estuvieras", "estuvieron", "estuviese", "estuvieseis", "estuviesen",
        "estuvieses", "estuvimos", "estuviste", "estuvisteis", "estuviéramos",
        "estuviésemos", "estuvo", "está", "estábamos", "estáis", "están", "estás",
        "fue", "fuera", "fuerais", "fueran", "fueras", "fueron", "fuese", "fueseis",
        "fuesen", "fueses", "fui", "fuimos", "fuiste", "fuisteis", "fuéramos",
        "fuésemos", "ha", "habida", "habidas", "habido", "habidos", "habiendo",
        "habremos", "habrá", "habrán", "habrás", "habré", "habréis", "habría",
        "habríais", "habríamos", "habrían", "habrías", "habéis", "había", "habíais",
        "habíamos", "habían", "habías", "han", "has", "hasta", "hay", "haya", "hayamos",
        "hayan", "hayas", "he", "hemos", "hicieron", "hizo", "hoy", "hubiera",
        "hubierais", "hubieran", "hubieras", "hubieron", "hubiese", "hubieseis",
        "hubiesen", "hubieses", "hubimos", "hubiste", "hubisteis", "hubiéramos",
        "hubiésemos", "hubo", "la", "las", "le", "les", "lo", "los", "más", "me",
        "mi", "mis", "mientras", "mio", "misma", "mismas", "mismo", "mismos", "modo",
        "mucho", "muchos", "muy", "nada", "ni", "ninguna", "ningunas", "ninguno",
        "ningunos", "no", "nos", "nosotras", "nosotros", "nuestra", "nuestras",
        "nuestro", "nuestros", "nunca", "os", "otra", "otras", "otro", "otros", "para",
        "pero", "poco", "por", "porque", "primero", "puede", "pueden", "puedo", "pues",
        "que", "quien", "quienes", "qué", "se", "sea", "seamos", "sean", "seas", "ser",
        "seremos", "será", "serán", "serás", "seré", "seréis", "sería", "seríais",
        "seríamos", "serían", "serías", "seáis", "sido", "siendo", "sin", "sobre",
        "sois", "solamente", "solo", "somos", "soy", "su", "sus", "suya", "suyas",
        "suyo", "suyos", "sí", "también", "tanto", "te", "tendremos", "tendrá",
        "tendrán", "tendrás", "tendré", "tendréis", "tendría", "tendríais", "tendríamos",
        "tendrían", "tendrías", "tened", "tenemos", "tenga", "tengamos", "tengan",
        "tengas", "tengo", "tenida", "tenidas", "tenido", "tenidos", "teniendo", "tenéis",
        "tenía", "teníais", "teníamos", "tenían", "tenías", "ti", "tiene", "tienen",
        "tienes", "todo", "todos", "trabaja", "trabajamos", "trabajan", "trabajar",
        "trabajas", "trabajo", "tras", "tú", "tu", "tus", "tuve", "tuviera", "tuvierais",
        "tuvieran", "tuvieras", "tuvieron", "tuviese", "tuvieseis", "tuviesen",
        "tuvieses", "tuvimos", "tuviste", "tuvisteis", "tuviéramos", "tuviésemos",
        "tuvo", "tuya", "tuyas", "tuyo", "tuyos", "un", "una", "unas", "uno", "unos",
        "usa", "usamos", "usan", "usar", "usas", "uso", "usted", "ustedes", "va", "vais",
        "valor", "vamos", "van", "varias", "varios", "vaya", "verdad", "verdadera",
        "vosotras", "vosotros", "voy", "vuestra", "vuestras", "vuestro", "vuestros",
        "y", "ya", "yo"
      ];
    
   
    $listaPalabras= preg_split("/[\s,._\-;:¿?!¡+@#%&()\d]+/", $textoMinusculas);
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

   $listaPalabras=array_filter($listaPalabras);

   // print_r($listaPalabras);

   return $listaPalabras;

}




?>