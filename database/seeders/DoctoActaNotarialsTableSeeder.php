<?php

namespace Database\Seeders;

use App\Models\DoctoActaNotarial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctoActaNotarialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('docto_acta_notariales')->delete();

        DoctoActaNotarial::create([
            'nombre' => 'Acta de nacimiento',
        ]);
        DoctoActaNotarial::create([
            'nombre' => 'Acta de matrimonio',
        ]);
        DoctoActaNotarial::create([
            'nombre' => 'Acta de defunción',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
