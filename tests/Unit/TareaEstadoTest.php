<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\TareaEstado;

class TareaEstadoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crea_estado_de_tarea(): void
    {
        $e = new TareaEstado();
        $e->nombre = 'Pendiente';
        $e->save();

        $this->assertDatabaseHas('tarea_estados', [
            'id'     => $e->id,
            'nombre' => 'Pendiente',
        ]);
    }

    /** @test */
    public function actualiza_nombre_de_estado(): void
    {
        $e = new TareaEstado();
        $e->nombre = 'Pendiente';
        $e->save();

        $e->nombre = 'En Proceso';
        $e->save();

        $this->assertDatabaseHas('tarea_estados', [
            'id'     => $e->id,
            'nombre' => 'En Proceso',
        ]);
    }

    /** @test */
    public function eliminar_estado_soft_deletes(): void
    {
        $e = new TareaEstado();
        $e->nombre = 'Cerrada';
        $e->save();

        $e->delete();

        $this->assertSoftDeleted('tarea_estados', ['id' => $e->id]);
    }
}
