<?php

namespace Database\Seeders;

use App\Models\CasoFamiliarJuicioEtapa;
use App\Models\CasoFamiliarJuicioTipo;
use Illuminate\Database\Seeder;

class CasoFamiliarJuicioEtapasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('caso_familiar_juicio_etapas')->truncate();

        CasoFamiliarJuicioEtapa::create([
            'nombre' => 'Solicitud',
            'tipo_juicio_id' => CasoFamiliarJuicioTipo::JUICIO_POR_DIVORCIO_VOLUNTARIO,
            'orden' => 1,
        ]);
        CasoFamiliarJuicioEtapa::create([
            'nombre' => 'Audiencia de Conciliación',
            'tipo_juicio_id' => CasoFamiliarJuicioTipo::JUICIO_POR_DIVORCIO_VOLUNTARIO,
            'orden' => 2,
        ]);

        CasoFamiliarJuicioEtapa::create([
            'nombre' => 'Sentencia de Divorcio',
            'tipo_juicio_id' => CasoFamiliarJuicioTipo::JUICIO_POR_DIVORCIO_VOLUNTARIO,
            'orden' => 3,
        ]);

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
