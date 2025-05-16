<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../backend/service/funciones.php';


class FuncionesTest extends TestCase
{
    public function testRecogerTextoEliminaDeterminantes()
    {
        $texto = "El perro corre por el parque y la Camión gata lo mira.  árbol esta está recorrió";
        $resultado = recogerTexto($texto);

        $this->assertContains('perro', $resultado);
        $this->assertContains('corre', $resultado);
        $this->assertContains('parque', $resultado);
        $this->assertContains('gata', $resultado);
        $this->assertContains('mira', $resultado);

        $this->assertContains('Camión', $resultado);
        $this->assertContains('árbol', $resultado);
        
        $this->assertContains('recorrió', $resultado);

        $this->assertNotContains('el', $resultado);
        $this->assertNotContains('la', $resultado);
        $this->assertNotContains('lo', $resultado);
        $this->assertNotContains('y', $resultado);

        $this->assertNotContains('está', $resultado);
        $this->assertNotContains('esta', $resultado);
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
