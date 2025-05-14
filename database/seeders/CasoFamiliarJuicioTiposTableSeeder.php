<?php

namespace Database\Seeders;

use App\Models\CasoFamiliarJuicioTipo;
use Illuminate\Database\Seeder;

class CasoFamiliarJuicioTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('caso_familiar_juicio_tipos')->delete();

        CasoFamiliarJuicioTipo::create(['nombre' => 'Juicio por divorcio voluntario']);
        CasoFamiliarJuicioTipo::create(['nombre' => 'Juicio oral de divorcio']);
        CasoFamiliarJuicioTipo::create(['nombre' => 'Juicio oral de aumento de pensión alimenticia']);
        CasoFamiliarJuicioTipo::create(['nombre' => 'Juicio oral de extinción de pensión alimenticia']);
        CasoFamiliarJuicioTipo::create(['nombre' => 'Juicio oral de fijación de pensión alimenticia']);
        CasoFamiliarJuicioTipo::create(['nombre' => 'Juicio oral de filiación y paternidad']);
        CasoFamiliarJuicioTipo::create(['nombre' => 'Juicio ejecutivo en la vía de apremio']);
        CasoFamiliarJuicioTipo::create(['nombre' => 'Juicio oral de relaciones familiares']);

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
