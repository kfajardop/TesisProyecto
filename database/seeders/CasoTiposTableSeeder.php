<?php

namespace Database\Seeders;

use App\Models\CasoTipo;
use Illuminate\Database\Seeder;

class CasoTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('caso_tipos')->delete();

        CasoTipo::create(['nombre' => 'Familiar']);
        CasoTipo::create(['nombre' => 'Penal']);

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
