<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\CasoEstado;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CasoEstadoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crea_estado_de_caso_creado(): void
    {
        $estado = new CasoEstado();
        $estado->nombre = 'Creado';
        $estado->save();

        $this->assertDatabaseHas('caso_estados', [
            'id'     => $estado->id,
            'nombre' => 'Creado',
        ]);
    }

    /** @test */
    public function crea_estado_de_caso_finalizado(): void
    {
        $estado = new CasoEstado();
        $estado->nombre = 'Finalizado';
        $estado->save();

        $this->assertDatabaseHas('caso_estados', [
            'id'     => $estado->id,
            'nombre' => 'Finalizado',
        ]);
    }

    /** @test */
    public function crea_estado_de_caso_cancelado(): void
    {
        $estado = new CasoEstado();
        $estado->nombre = 'Cancelado';
        $estado->save();

        $this->assertDatabaseHas('caso_estados', [
            'id'     => $estado->id,
            'nombre' => 'Cancelado',
        ]);
    }

    /** @test */
    public function eliminar_estado_de_caso(): void
    {
        $estado = new CasoEstado();
        $estado->nombre = 'Creado';
        $estado->save();

        $estado->delete();

        $this->assertSoftDeleted('caso_estados', [
            'id' => $estado->id,
        ]);
    }
}
