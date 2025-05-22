<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../backend/service/funciones.php';
require_once __DIR__ . '/../backend/service/stop_words.php';

class FuncionesTest extends TestCase
{
    public function test_eliminaDeterminantes()
    {
        $procesadorTexto = new ProcesadorTexto();
        //Funcion mock para testear eliminarDeterminantes
        $texto = $procesadorTexto->filtrarPalabras("El perro corre por el parque y la dueña ve un ¿Camión con una gata que la mira?.  árbol esta está recorrió la gata
        y la gata se quedo en la copa #"); //La cadena que entraria desde el formulario en el frontend

        $resultado = $procesadorTexto->eliminarDeterminantes($texto);

        //Los resultados que se espera que devuelva la funcion dentro del array palabras
        $this->assertContains('perro', $resultado);
        $this->assertContains('Camión', $resultado);
        $this->assertContains('árbol', $resultado);
        $this->assertContains('recorrió', $resultado);

        //Los resultados que se espera que la funcion excluya, ya sean porque son palabras determinantes
        // o porque son caracteres especiales

        $this->assertNotContains('el',  $resultado);
        $this->assertNotContains('?',  $resultado);
        $this->assertNotContains('¿',  $resultado);
        $this->assertNotContains('la',  $resultado);
        $this->assertNotContains('una',  $resultado);
        $this->assertNotContains('un',  $resultado);
        $this->assertNotContains('en',  $resultado);
        $this->assertNotContains('se',  $resultado);
        $this->assertNotContains('con',  $resultado);
        $this->assertNotContains('y',  $resultado);
        $this->assertNotContains('está',  $resultado);
        $this->assertNotContains('esta',  $resultado);
        $this->assertNotContains('#', $resultado);
    }

    public function test_filtrarPalabrasTextoVacio()
    {
        $procesadorTexto = new ProcesadorTexto();
        $resultado = $procesadorTexto->filtrarPalabras("");
        $this->assertIsArray($resultado);
        $this->assertEmpty($resultado);
    }

    public function test_filtrarPalabrasSoloCaracteresEspeciales()
    {
        $procesadorTexto = new ProcesadorTexto();
        $texto = "#$%&?¿!¡";
        $resultado = $procesadorTexto->filtrarPalabras($texto);

        $this->assertEmpty($resultado);
    }

    public function test_filtrarPalabrasTildes()
    {
        $procesadorTexto = new ProcesadorTexto();
        $texto = "camión árbol acción";

        $resultado = $procesadorTexto->filtrarPalabras($texto);
        $this->assertContains('camión',  $resultado);
        $this->assertContains('árbol',  $resultado);
        $this->assertContains('acción', $resultado);
    }


    public function test_contarPalabras()
    {
        $procesadorTexto = new ProcesadorTexto();
        $palabras = ['perro', 'gata', 'perro', 'mira'];
        $resultado = $procesadorTexto->contarPalabras($palabras);

        $this->assertEquals(2, $resultado['perro']);
        $this->assertEquals(1, $resultado['gata']);
        $this->assertEquals(1, $resultado['mira']);
    }

    public function test_contarPalabrasVacio()
    {
        $procesadorTexto = new ProcesadorTexto();
        $resultado = $procesadorTexto->contarPalabras([]);
        $this->assertIsArray($resultado);
        $this->assertEmpty($resultado);
    }

 public function test_contarPalabrasSimuladoConValoresNegativos()
{
    //Este test simula un caso en el que alguien manipule el array de contar palabras de alguna manera y 
    // meta datos negativos
    $conteoFalso = [
        'perro' => 2,
        'gato' => -3  // un supuesto recuento negativo manipulado a mano
    ];

    // Espero una excepción por parte del test
    $this->expectException(\RuntimeException::class);
    $this->expectExceptionMessage("La palabra 'gato' no se puede repetir con un numero por debajo de 0");

    foreach ($conteoFalso as $palabra => $veces) {
        if ($veces < 1) {//Si el numero de veces de la palabra no se repite al menos 1 vez
            throw new \RuntimeException("La palabra '$palabra' no se puede repetir con un numero por debajo de 0");
            //Lanzo una excepcion avisando al usuario
        }
    }
}

    public function test_ordenarPalabras()
    {
        $procesadorTexto = new ProcesadorTexto();

        $palabrasContadas = [
            'mira' => 1,
            'gata' => 3,
            'perro' => 5
        ];

        $ordenado = $procesadorTexto->ordenarPalabras($palabrasContadas);

        $esperado = [
            'perro' => 5,
            'gata' => 3,
            'mira' => 1
        ];

        $this->assertEquals($esperado, $ordenado);
    }

    public function test_ordenarPalabras_arrayDeNumeros()
    {
        $procesadorTexto = new ProcesadorTexto();
        $palabras = [123];

        $resultado =  $procesadorTexto->ordenarPalabras($palabras);

        $this->assertEquals([123], $resultado);
    }

    public function test_sanearTextoPalabrasMayusculas()
    {
        $procesadorTexto = new ProcesadorTexto();
        $texto = "PERRO gato GATO";
        $resultado = $procesadorTexto->sanearTexto($texto);
        $this->assertStringContainsString('perro',  $resultado);
        $this->assertStringContainsString('gato', $resultado);
    }

    public function test_sanearTextoMinusculas()
    {
        $procesadorTexto = new ProcesadorTexto();
        $input = "  HÓLa  ";
        $expected = "hóla";
        $this->assertSame($expected, $procesadorTexto->sanearTexto($input));
    }

    public function test_sanearTextoEncoding_unicode()
    {
        $procesadorTexto = new ProcesadorTexto();
        $text = mb_convert_encoding("Camión", 'unicode');

        $encoding = mb_detect_encoding($procesadorTexto->sanearTexto($text), 'UTF-8', true);
        $this->assertEquals('UTF-8', $encoding);
    }
    public function test_sanearTextoEncoding_ISO8859()
    {
        $procesadorTexto = new ProcesadorTexto();
        $text = mb_convert_encoding("Camión", "ISO-8859-1");

        $encoding = mb_detect_encoding($procesadorTexto->sanearTexto($text), 'UTF-8', true);
        $this->assertEquals('UTF-8', $encoding);
    }
    public function test_sanearTextoEncoding_ASCII()
    {
        $procesadorTexto = new ProcesadorTexto();
        $text = mb_convert_encoding("Camión", 'ASCII');

        $encoding = mb_detect_encoding($procesadorTexto->sanearTexto($text), 'UTF-8', true);
        $this->assertEquals('UTF-8', $encoding);
    }
    public function test_main()
    {
        $procesadorTexto = new ProcesadorTexto();
        $texto = "El perro corre por el parque y la dueña ve un ¿Camión con una gata que la mira?.  árbol esta está recorrió la gata
        y la gata se quedo en la copa #";

        $resultado = $procesadorTexto->main($texto);

        $this->assertEquals(["gata" => 3, "perro" => 1, "corre" => 1, "parque" => 1, "dueña" => 1, "ve" => 1, "camión" => 1, "mira" => 1, "árbol" => 1, "recorrió" => 1, "quedo" => 1, "copa" => 1], $resultado);
    }
    public function test_main_array()
    {
        $procesadorTexto = new ProcesadorTexto();
        $array = [];
        $this->expectException(TypeError::class);
        $procesadorTexto->main($array);
    }
    public function test_main_with_mocked_functions()
    {
        // Preparamos el texto de entrada
        $texto = "Texto de prueba para verificar el flujo";

        // Simulamos los valores que retornan las funciones auxiliares
        $textoSaneado = "texto de prueba para verificar el flujo";
        $palabrasFiltradas = ['texto', 'de', 'prueba', 'para', 'verificar', 'el', 'flujo'];
        $sinDeterminantes = ['texto', 'prueba', 'verificar', 'flujo'];
        $contadas = ['texto' => 1, 'prueba' => 1, 'verificar' => 1, 'flujo' => 1];
        $ordenadas = ['texto' => 1, 'prueba' => 1, 'verificar' => 1, 'flujo' => 1];

        // Creamos las funciones mock dentro del mismo espacio
        //require_once __DIR__. '/../backend/service/funciones.php'; // si están en otro archivo

        // Usamos funciones anónimas redefinidas si están en el mismo archivo
        // Pero como PHP no permite redefinir funciones globales fácilmente,
        // lo más recomendable es envolver las funciones en una clase, lo cual permite mockearlas

        // Alternativa realista: refactorizamos para usar una clase
        // y ahora hacemos el test con mock de métodos:

        $mock = $this->getMockBuilder(ProcesadorTexto::class)
            ->onlyMethods(['sanearTexto', 'filtrarPalabras', 'eliminarDeterminantes', 'contarPalabras', 'ordenarPalabras'])
            ->getMock();

        $mock->expects($this->once())
            ->method('sanearTexto')
            ->with($texto)
            ->willReturn($textoSaneado);

        $mock->expects($this->once())
            ->method('filtrarPalabras')
            ->with($textoSaneado)
            ->willReturn($palabrasFiltradas);

        $mock->expects($this->once())
            ->method('eliminarDeterminantes')
            ->with($palabrasFiltradas)
            ->willReturn($sinDeterminantes);

        $mock->expects($this->once())
            ->method('contarPalabras')
            ->with($sinDeterminantes)
            ->willReturn($contadas);

        $mock->expects($this->once())
            ->method('ordenarPalabras')
            ->with($contadas)
            ->willReturn($ordenadas);

        // Llamamos a la función main "envuelta"
        $resultado = $mock->main($texto);

        $this->assertEquals($ordenadas, $resultado);
    }
}
