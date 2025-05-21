<?php

namespace Database\Seeders;

use App\Models\DocumentoTipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentoTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('documento_tipos')->delete();

        DocumentoTipo::create([
            'nombre' => 'Público',
        ]);
        DocumentoTipo::create([
            'nombre' => 'Privado',
        ]);
        DocumentoTipo::create([
            'nombre' => 'Acta Notarial',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
