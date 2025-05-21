<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../backend/service/funciones.php';
require_once __DIR__ . '/../backend/service/stop_words.php';
require_once __DIR__ . '/funcionesMock.php';

class FuncionesTest extends TestCase
{
    public function test_eliminaDeterminantes()
    {
        //Funcion mock para testear eliminarDeterminantes
        $texto = ProcesadorTexto::filtrarPalabras("El perro corre por el parque y la dueña ve un ¿Camión con una gata que la mira?.  árbol esta está recorrió la gata
        y la gata se quedo en la copa #"); //La cadena que entraria desde el formulario en el frontend

        $resultado = ProcesadorTexto::eliminarDeterminantes($texto);

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
        $resultado = ProcesadorTexto::filtrarPalabras("");
        $this->assertIsArray($resultado);
        $this->assertEmpty($resultado);
    }

    public function test_filtrarPalabrasSoloCaracteresEspeciales()
    {
        $texto = "#$%&?¿!¡";
        $resultado = ProcesadorTexto::filtrarPalabras($texto);

        $this->assertEmpty($resultado);
    }

    public function test_filtrarPalabrasTildes()
    {
        $texto = "camión árbol acción";
        $resultado = ProcesadorTexto::filtrarPalabras($texto);
        $this->assertContains('camión',  $resultado);
        $this->assertContains('árbol',  $resultado);
        $this->assertContains('acción', $resultado);
    }


    public function test_contarPalabras()
    {
        $palabras = ['perro', 'gata', 'perro', 'mira'];
        $resultado = ProcesadorTexto::contarPalabras($palabras);

        $this->assertEquals(2, $resultado['perro']);
        $this->assertEquals(1, $resultado['gata']);
        $this->assertEquals(1, $resultado['mira']);
    }

    public function test_contarPalabrasVacio()
    {
        $resultado = ProcesadorTexto::contarPalabras([]);
        $this->assertIsArray($resultado);
        $this->assertEmpty($resultado);
    }


    public function test_ordenarPalabras()
    {
        $palabrasContadas = [
            'mira' => 1,
            'gata' => 3,
            'perro' => 5
        ];

        $ordenado = ProcesadorTexto::ordenarPalabras($palabrasContadas);

        $esperado = [
            'perro' => 5,
            'gata' => 3,
            'mira' => 1
        ];

        $this->assertEquals($esperado, $ordenado);
    }

    public function test_sanearTextoPalabrasMayusculas()
    {
        $texto = "PERRO gato GATO";
        $resultado = ProcesadorTexto::sanearTexto($texto);
        $this->assertStringContainsString('perro',  $resultado);
        $this->assertStringContainsString('gato', $resultado);
    }

    public function test_sanearTextoMinusculas()
    {
        $input = "  HÓLa  ";
        $expected = "hóla";
        $this->assertSame($expected, ProcesadorTexto::sanearTexto($input));
    }

    public function test_sanearTextoEncoding()
    {
        $text = mb_convert_encoding("Camión", 'unicode');

        $encoding = mb_detect_encoding(ProcesadorTexto::sanearTexto($text), 'UTF-8', true);
        $this->assertEquals('UTF-8', $encoding);
    }
    public function test_main()
    {
        $texto = "El perro corre por el parque y la dueña ve un ¿Camión con una gata que la mira?.  árbol esta está recorrió la gata
        y la gata se quedo en la copa #";

        $resultado = ProcesadorTexto::main($texto);

        $this->assertEquals(["gata" => 3, "perro" => 1, "corre" => 1, "parque" => 1, "dueña" => 1, "ve" => 1, "camión" => 1, "mira" => 1, "árbol" => 1, "recorrió" => 1, "quedo" => 1, "copa" => 1], $resultado);
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

        $mock = $this->getMockBuilder(ProcesadorTextoMock::class)
            ->onlyMethods([ 'sanearTexto', 'filtrarPalabras', 'eliminarDeterminantes', 'contarPalabras', 'ordenarPalabras'])
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
