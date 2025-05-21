<?php

namespace Database\Seeders;

use App\Models\DoctoPublicoEscritura;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctoPublicoEscriturasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('docto_publico_escrituras')->delete();

        DoctoPublicoEscritura::create([
            'nombre' => 'Escritura pública',
        ]);
        DoctoPublicoEscritura::create([
            'nombre' => 'Resolución judicial',
        ]);
        DoctoPublicoEscritura::create([
            'nombre' => 'Escritura de constitución de sociedad',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
