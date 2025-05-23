<?php

namespace Database\Seeders;

use App\Models\ParteTipo;
use Illuminate\Database\Seeder;

class ParteTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('parte_tipos')->truncate();

        ParteTipo::create(['nombre' => 'Demandante']);
        ParteTipo::create(['nombre' => 'Demandado']);
        ParteTipo::create(['nombre' => 'Victima']);
        ParteTipo::create(['nombre' => 'Victimario']);

        ParteTipo::create(['nombre' => 'Compareciente']);
        ParteTipo::create(['nombre' => 'Intervinientes']);

        ParteTipo::create(['nombre' => 'Participante en Audiencia']);

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
