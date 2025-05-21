<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ParteTipo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        //Seeder del proyecto de abogados

        //Seeders para los casos
        $this->call(CasoTiposTableSeeder::class);
        $this->call(CasoEstadosTableSeeder::class);

        //Seeders para los casos familiares
        $this->call(CasoFamiliarJuicioTiposTableSeeder::class);
        $this->call(CasoFamiliarJuicioEtapasTableSeeder::class);

        //Seeders para casos penales
        $this->call(CasoPenalDelitosTableSeeder::class);
        $this->call(CasoPenalEtapasTableSeeder::class);

        //Seeders para las partes involucradas
        $this->call(ParteTiposTableSeeder::class);

        //Seeders para direcciones
        $this->call(DepartamentosTableSeeder::class);
        $this->call(MunicipiosTableSeeder::class);

        //Seeders para los documentos
        $this->call(DocumentoEstadosTableSeeder::class);
        $this->call(DocumentoTiposTableSeeder::class);


        //Seeders con datos de prueba
        $this->call(PersonasTableSeeder::class);
    }
}
