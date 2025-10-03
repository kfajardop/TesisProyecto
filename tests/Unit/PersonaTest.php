<?php

namespace Tests\Unit;

use App\Models\Persona;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonaTest extends TestCase
{
    use RefreshDatabase; // usa migraciones en SQLite en memoria

    /** @test */
    public function test_crear_persona(): void
    {
        // Insertar datos
        $persona = Persona::create([
            'primer_nombre'   => 'Keisy',
            'segundo_nombre'  => 'Orfelinda',
            'primer_apellido' => 'Fajardo',
            'segundo_apellido'=> 'Palencia',
        ]);

        // Verifica que se guardó en la BD de PRUEBAS
        $this->assertDatabaseHas('personas', [
            'id'             => $persona->id,
            'primer_nombre'  => 'Keisy',
            'primer_apellido'=> 'Fajardo',
        ]);
    }

    /** @test */
    public function test_eliminar_persona_soft_delete(): void
    {
        $persona = Persona::create([
            'primer_nombre'   => 'Ana',
            'primer_apellido' => 'Martínez',
        ]);

        $persona->delete();

        $this->assertSoftDeleted('personas', [
            'id' => $persona->id,
        ]);
    }
}
