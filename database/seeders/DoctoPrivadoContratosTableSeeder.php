<?php

namespace Database\Seeders;

use App\Models\DoctoPrivadoContrato;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctoPrivadoContratosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('docto_privado_contratos')->delete();

        DoctoPrivadoContrato::create([
            'nombre' => 'Contrato de arrendamiento',
        ]);
        DoctoPrivadoContrato::create([
            'nombre' => 'Contrato de compra-venta',
        ]);
        DoctoPrivadoContrato::create([
            'nombre' => 'Contrato de prestación de servicios',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
