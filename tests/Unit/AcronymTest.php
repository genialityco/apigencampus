<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\StringHelpers;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcronymTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {

        $var = StringHelpers::acronym("Nombre del Évent Prueba que se puede alargar mucho más");
        $var2 = strlen($var);
        $var3 = ctype_alnum($var);
        $this->assertTrue($var3, "No es alfanumérico 1");
        $this->assertEquals(4, $var2, "No se recibio la cantidad de Carácteres 1");

        $var = StringHelpers::acronym("Nom");
        $var2 = strlen($var);
        $var3 = ctype_alnum($var);
        $this->assertTrue($var3, "No es alfanumérico 2");
        $this->assertEquals(4, $var2, "No se recibio la cantidad de Carácteres 2");

        $var = StringHelpers::acronym("# - @ ! } { + ' ");
        $var2 = strlen($var);
        $var3 = ctype_alnum($var);
        $this->assertTrue($var3, "No es alfanumérico 3");
        $this->assertEquals(4, $var2, "No se recibio la cantidad de Carácteres 3");
        
    }
}
