<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\DocumentoEstado;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentoEstadoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crea_estado_entregado(): void
    {
        $estado = new DocumentoEstado();
        $estado->nombre = 'entregado';
        $estado->save();

        $this->assertDatabaseHas('documento_estados', [
            'id'     => $estado->id,
            'nombre' => 'entregado',
        ]);
    }

    /** @test */
    public function crea_estado_en_archivo(): void
    {
        $estado = new DocumentoEstado();
        $estado->nombre = 'en archivo';
        $estado->save();

        $this->assertDatabaseHas('documento_estados', [
            'id'     => $estado->id,
            'nombre' => 'en archivo',
        ]);
    }

    /** @test */
    public function actualiza_nombre_estado(): void
    {
        $estado = new DocumentoEstado();
        $estado->nombre = 'provisional';
        $estado->save();

        $estado->nombre = 'definitivo';
        $estado->save();

        $this->assertDatabaseHas('documento_estados', [
            'id'     => $estado->id,
            'nombre' => 'definitivo',
        ]);
    }

    /** @test */
    public function soft_delete_estado(): void
    {
        $estado = new DocumentoEstado();
        $estado->nombre = 'temporal';
        $estado->save();

        $estado->delete();

        $this->assertSoftDeleted('documento_estados', [
            'id' => $estado->id,
        ]);
    }
}
