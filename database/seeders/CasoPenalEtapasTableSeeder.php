<?php

namespace Database\Seeders;

use App\Models\CasoPenalEtapa;
use Illuminate\Database\Seeder;

class CasoPenalEtapasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('caso_penal_etapas')->delete();

        CasoPenalEtapa::create(['nombre' => 'Preparatoria', 'orden' => 1]);
        CasoPenalEtapa::create(['nombre' => 'Intermedia' , 'orden' => 2]);
        CasoPenalEtapa::create(['nombre' => 'Juicio' , 'orden' => 3]);
        CasoPenalEtapa::create(['nombre' => 'Impugnación' , 'orden' => 4]);
        CasoPenalEtapa::create(['nombre' => 'Ejecución' , 'orden' => 5]);

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
