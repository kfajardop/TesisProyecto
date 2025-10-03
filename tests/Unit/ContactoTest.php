<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Contacto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crea_contacto(): void
    {
        $c = new Contacto();
        $c->nombre     = 'Keisy Fajardo';
        $c->telefono   = '76543210';
        $c->comentario = 'Cliente nuevo';
        $c->save();

        $this->assertDatabaseHas('contactos', [
            'id'       => $c->id,
            'nombre'   => 'Keisy Fajardo',
            'telefono' => '76543210',
        ]);
    }

    /** @test */
    public function actualiza_telefono_de_contacto(): void
    {
        $c = new Contacto();
        $c->nombre   = 'Ana';
        $c->telefono = '11112222';
        $c->save();

        $c->telefono = '99998888';
        $c->save();

        $this->assertDatabaseHas('contactos', [
            'id'       => $c->id,
            'telefono' => '99998888',
        ]);
    }

    /** @test */
    public function eliminar_contacto_soft_deletes(): void
    {
        $c = new Contacto();
        $c->nombre   = 'Carlos';
        $c->telefono = '12345678';
        $c->save();

        $c->delete();

        $this->assertSoftDeleted('contactos', ['id' => $c->id]);
    }

    /** @test */
    public function puede_guardar_con_comentario_null(): void
    {
        // Teléfono obligatorio, comentario opcional
        $c = new Contacto();
        $c->nombre     = 'Solo Nombre';
        $c->telefono   = '87654321';
        $c->comentario = null;
        $c->save();

        $this->assertDatabaseHas('contactos', [
            'id'       => $c->id,
            'nombre'   => 'Solo Nombre',
            'telefono' => '87654321',
        ]);
    }
}
