<?php

namespace Database\Seeders;

use App\Models\CasoPenalDelito;
use Illuminate\Database\Seeder;

class CasoPenalDelitosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('caso_penal_delitos')->delete();

        CasoPenalDelito::create(['nombre' => 'Amenazas']);
        CasoPenalDelito::create(['nombre' => 'Violencia contra la mujer']);
        CasoPenalDelito::create(['nombre' => 'Hurto']);
        CasoPenalDelito::create(['nombre' => 'Lesiones leves']);
        CasoPenalDelito::create(['nombre' => 'Robo agravado']);
        CasoPenalDelito::create(['nombre' => 'Robo de equipo terminal móvil']);
        CasoPenalDelito::create(['nombre' => 'Hurto agravado']);
        CasoPenalDelito::create(['nombre' => 'Extorsión']);
        CasoPenalDelito::create(['nombre' => 'Robo']);
        CasoPenalDelito::create(['nombre' => 'Lesiones culposas']);

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
