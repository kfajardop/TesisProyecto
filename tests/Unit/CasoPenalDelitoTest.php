<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\CasoPenalDelito;

class CasoPenalDelitoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crea_delito_hurto(): void
    {
        $d = new CasoPenalDelito();
        $d->nombre = 'hurto';
        $d->save();

        $this->assertDatabaseHas('caso_penal_delitos', [
            'id'     => $d->id,
            'nombre' => 'hurto',
        ]);
    }

    /** @test */
    public function crea_delito_homicidio(): void
    {
        $d = new CasoPenalDelito();
        $d->nombre = 'homicidio';
        $d->save();

        $this->assertDatabaseHas('caso_penal_delitos', [
            'id'     => $d->id,
            'nombre' => 'homicidio',
        ]);
    }

    /** @test */
    public function actualiza_nombre_de_delito(): void
    {
        $d = new CasoPenalDelito();
        $d->nombre = 'robo';
        $d->save();

        $d->nombre = 'robo agravado';
        $d->save();

        $this->assertDatabaseHas('caso_penal_delitos', [
            'id'     => $d->id,
            'nombre' => 'robo agravado',
        ]);
    }

    /** @test */
    public function soft_delete_delito(): void
    {
        $d = new CasoPenalDelito();
        $d->nombre = 'extorsión';
        $d->save();

        $d->delete();

        $this->assertSoftDeleted('caso_penal_delitos', [
            'id' => $d->id,
        ]);
    }
}
