<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\TareaPrioridad;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TareaPrioridadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crea_prioridad_de_tarea(): void
    {
        $p = new TareaPrioridad();
        $p->nombre = 'Alta';
        $p->save();

        $this->assertDatabaseHas('tarea_prioridades', [
            'id'     => $p->id,
            'nombre' => 'Alta',
        ]);
    }

    /** @test */
    public function actualiza_nombre_de_prioridad(): void
    {
        $p = new TareaPrioridad();
        $p->nombre = 'Media';
        $p->save();

        $p->nombre = 'Urgente';
        $p->save();

        $this->assertDatabaseHas('tarea_prioridades', [
            'id'     => $p->id,
            'nombre' => 'Urgente',
        ]);
    }

    /** @test */
    public function eliminar_prioridad_tarea_soft_deletes(): void
    {
        $p = new TareaPrioridad();
        $p->nombre = 'Baja';
        $p->save();

        $p->delete();

        $this->assertSoftDeleted('tarea_prioridades', [
            'id' => $p->id,
        ]);
    }
}
