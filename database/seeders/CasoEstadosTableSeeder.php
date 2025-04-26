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

        CasoEstado::create([
            'nombre' => 'Activo',
        ]);

    }
}
