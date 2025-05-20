<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../backend/service/funciones.php';


class FuncionesTest extends TestCase
{
    public function testRecogerTextoEliminaDeterminantes()
    {
        $texto = "El perro corre por el parque y la dueña ve un ¿Camión con una gata que la mira?.  árbol esta está recorrió la gata
        y la gata se quedo en la copa #";//La cadena que entraria desde el formulario en el frontend
        $resultado = recogerTexto($texto);

        //Los resultados que se espera que devuelva la funcion dentro del array palabras
        $this->assertContains('perro', $resultado);
        $this->assertContains('corre', $resultado);
        $this->assertContains('parque', $resultado);
        $this->assertContains('dueña', $resultado);
        $this->assertContains('gata', $resultado);
        $this->assertContains('mira', $resultado);
        

        $this->assertContains('camión', $resultado);//Las letras en mayuscula en el texto, se convierten
        //a minuscula cuando pasan por la funcion, por eso aqui espero que camion se pase a minuscula
        //cuando la funcion devuelva el resultado
        $this->assertContains('árbol', $resultado);
        
        $this->assertContains('recorrió', $resultado);

        //Los resultados que se espera que la funcion excluya, ya sean porque son palabras determinantes
        // o porque son caracteres especiales

        $this->assertNotContains('el', $resultado);
         $this->assertNotContains('?', $resultado);
          $this->assertNotContains('¿', $resultado);
        $this->assertNotContains('la', $resultado);
         $this->assertNotContains('una', $resultado);
         $this->assertNotContains('un', $resultado);
         $this->assertNotContains('en', $resultado);
         $this->assertNotContains('se', $resultado);
          $this->assertNotContains('con', $resultado);
       // $this->assertNotContains('lo', $resultado);
        $this->assertNotContains('y', $resultado);

        $this->assertNotContains('está', $resultado);
        $this->assertNotContains('esta', $resultado);
        $this->assertNotContains('#', $resultado);
    }

     public function testRecogerTextoConTextoVacio()
    {
        $resultado = recogerTexto("");
        $this->assertIsArray($resultado);
        $this->assertEmpty($resultado);
    }

     public function testRecogerTextoSoloCaracteresEspeciales()
    {
        $texto = "#$%&?¿!¡";
        $resultado = recogerTexto($texto);
        $this->assertEmpty($resultado);
    }

    public function testContarPalabrasCuentaCorrectamente()
    {
        $palabras = ['perro', 'gata', 'perro', 'mira'];
        $resultado = contarPalabras($palabras);

        $this->assertEquals(2, $resultado['perro']);
        $this->assertEquals(1, $resultado['gata']);
        $this->assertEquals(1, $resultado['mira']);
    }

    public function testOrdenarPalabrasOrdenaDescendente()
    {
        $palabrasContadas = [
            'mira' => 1,
            'gata' => 3,
            'perro' => 5
        ];

        $ordenado = ordenarPalabras($palabrasContadas);

        $esperado = [
            'perro' => 5,
            'gata' => 3,
            'mira' => 1
        ];

        $this->assertEquals($esperado, $ordenado);
    }
}
