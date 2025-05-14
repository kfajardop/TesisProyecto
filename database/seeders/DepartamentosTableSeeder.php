<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        \DB::table('departamentos')->delete();

        Departamento::create(['nombre' => 'Alta Verapaz']);
        Departamento::create(['nombre' => 'Baja Verapaz']);
        Departamento::create(['nombre' => 'Chimaltenango']);
        Departamento::create(['nombre' => 'Chiquimula']);
        Departamento::create(['nombre' => 'El Progreso']);
        Departamento::create(['nombre' => 'Escuintla']);
        Departamento::create(['nombre' => 'Guatemala']);
        Departamento::create(['nombre' => 'Huehuetenango']);
        Departamento::create(['nombre' => 'Izabal']);
        Departamento::create(['nombre' => 'Jalapa']);
        Departamento::create(['nombre' => 'Jutiapa']);
        Departamento::create(['nombre' => 'Petén']);
        Departamento::create(['nombre' => 'Quetzaltenango']);
        Departamento::create(['nombre' => 'Quiché']);
        Departamento::create(['nombre' => 'Retalhuleu']);
        Departamento::create(['nombre' => 'Sacatepéquez']);
        Departamento::create(['nombre' => 'San Marcos']);
        Departamento::create(['nombre' => 'Santa Rosa']);
        Departamento::create(['nombre' => 'Sololá']);
        Departamento::create(['nombre' => 'Suchitepéquez']);
        Departamento::create(['nombre' => 'Totonicapán']);
        Departamento::create(['nombre' => 'Zacapa']);

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
