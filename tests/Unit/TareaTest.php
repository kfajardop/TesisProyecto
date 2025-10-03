<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tarea;
use App\Models\TareaPrioridad;
use App\Models\TareaEstado;

class TareaTest extends TestCase
{
    use RefreshDatabase;

    private function seedDeps(): array
    {
        $prioridad = new TareaPrioridad();
        $prioridad->nombre = 'Alta';
        $prioridad->save();

        $estado = new TareaEstado();
        $estado->nombre = 'Pendiente';
        $estado->save();

        return [$prioridad, $estado];
    }

    /** @test */
    public function crea_tarea_con_fks_validas(): void
    {
        [$prioridad, $estado] = $this->seedDeps();

        $t = new Tarea();
        $t->nombre       = 'Redactar el contrato de compra-venta';
        $t->prioridad_id = $prioridad->id;
        $t->estado_id    = $estado->id;
        $t->fecha        = null;
        $t->hora         = null;
        $t->descripcion  = null;
        $t->save();

        $this->assertDatabaseHas('tareas', [
            'id'           => $t->id,
            'nombre'       => 'Redactar el contrato de compra-venta',
            'prioridad_id' => $prioridad->id,
            'estado_id'    => $estado->id,
        ]);
    }

    /** @test */
    public function actualiza_nombre_y_estado_de_tarea(): void
    {
        [$prioridad, $estado] = $this->seedDeps();

        $t = new Tarea();
        $t->nombre       = 'Redactar demanda';
        $t->prioridad_id = $prioridad->id;
        $t->estado_id    = $estado->id;
        $t->save();

        // cambiamos estado
        $nuevoEstado = new TareaEstado();
        $nuevoEstado->nombre = 'En Proceso';
        $nuevoEstado->save();

        $t->nombre    = 'Redactar demanda (v2)';
        $t->estado_id = $nuevoEstado->id;
        $t->save();

        $this->assertDatabaseHas('tareas', [
            'id'        => $t->id,
            'nombre'    => 'Redactar demanda (v2)',
            'estado_id' => $nuevoEstado->id,
        ]);
    }

    /** @test */
    public function crear_tarea_con_campos_no_requeridos(): void
    {
        [$prioridad, $estado] = $this->seedDeps();

        $t = new Tarea();
        $t->nombre       = 'Revisar expediente';
        $t->prioridad_id = $prioridad->id;
        $t->estado_id    = $estado->id;
        $t->fecha        = null;
        $t->hora         = null;
        $t->descripcion  = null;
        $t->save();

        $this->assertDatabaseHas('tareas', [
            'id'     => $t->id,
            'nombre' => 'Revisar expediente',
        ]);
    }

    /** @test */
    public function eliminar_tarea_soft_deletes(): void
    {
        [$prioridad, $estado] = $this->seedDeps();

        $t = new Tarea();
        $t->nombre       = 'Cerrar caso';
        $t->prioridad_id = $prioridad->id;
        $t->estado_id    = $estado->id;
        $t->save();

        $t->delete();

        $this->assertSoftDeleted('tareas', ['id' => $t->id]);
    }
}
