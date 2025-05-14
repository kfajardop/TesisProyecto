<?php

namespace Database\Seeders;

use App\Models\CasoEstado;
use Illuminate\Database\Seeder;

class CasoEstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('caso_estados')->truncate();

        CasoEstado::create(['nombre' => 'Creado']);
        CasoEstado::create(['nombre' => 'Finalizado']);
        CasoEstado::create(['nombre' => 'Cancelado']);

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
