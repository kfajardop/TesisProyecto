<?php

namespace Database\Seeders;

use App\Models\DocumentoEstado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentoEstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('documento_estados')->delete();

        DocumentoEstado::firstOrCreate([
            'nombre' => 'En Archivo',
        ]);
        DocumentoEstado::firstOrCreate([
            'nombre' => 'Entregado',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
