<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\CasoTipo;

class CasoTipoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crea_tipo_de_caso_familiar(): void
    {
        $tipo = new CasoTipo();
        $tipo->nombre = 'familiar';
        $tipo->save();

        $this->assertDatabaseHas('caso_tipos', [
            'id'     => $tipo->id,
            'nombre' => 'familiar',
        ]);
    }

    /** @test */
    public function crea_tipo_de_caso_penal(): void
    {
        $tipo = new CasoTipo();
        $tipo->nombre = 'penal';
        $tipo->save();

        $this->assertDatabaseHas('caso_tipos', [
            'id'     => $tipo->id,
            'nombre' => 'penal',
        ]);
    }

    /** @test */
    public function actualiza_de_familiar_a_penal(): void
    {
        $tipo = new CasoTipo();
        $tipo->nombre = 'familiar';
        $tipo->save();

        $tipo->nombre = 'penal';
        $tipo->save();

        $this->assertDatabaseHas('caso_tipos', [
            'id'     => $tipo->id,
            'nombre' => 'penal',
        ]);
    }

    /** @test */
    public function elimina_suavemente_un_tipo_de_caso(): void
    {
        $tipo = new CasoTipo();
        $tipo->nombre = 'familiar';
        $tipo->save();

        $tipo->delete();

        $this->assertSoftDeleted('caso_tipos', [
            'id' => $tipo->id,
        ]);
    }
}
