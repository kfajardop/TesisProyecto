<?php

namespace Database\Seeders;

use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Database\Seeder;

class MunicipiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Municipio::create(["nombre" => "Ciudad de Guatemala", "departamento_id" => Departamento::GUATEMALA]);
        Municipio::create(["nombre" => "Mixco", "departamento_id" => Departamento::GUATEMALA]);
        Municipio::create(["nombre" => "Villa Nueva", "departamento_id" => Departamento::GUATEMALA]);
        Municipio::create(["nombre" => "Villa Canales", "departamento_id" => Departamento::GUATEMALA]);
        Municipio::create(["nombre" => "San Miguel Petapa", "departamento_id" => Departamento::GUATEMALA]);
        Municipio::create(["nombre" => "Cobán", "departamento_id" => Departamento::ALTA_VERAPAZ]);
        Municipio::create(["nombre" => "San Pedro Carchá", "departamento_id" => Departamento::ALTA_VERAPAZ]);
        Municipio::create(["nombre" => "Tactic", "departamento_id" => Departamento::ALTA_VERAPAZ]);
        Municipio::create(["nombre" => "San Juan Chamelco", "departamento_id" => Departamento::ALTA_VERAPAZ]);
        Municipio::create(["nombre" => "Chisec", "departamento_id" => Departamento::ALTA_VERAPAZ]);
        Municipio::create(["nombre" => "Salamá", "departamento_id" => Departamento::BAJA_VERAPAZ]);
        Municipio::create(["nombre" => "San Jerónimo", "departamento_id" => Departamento::BAJA_VERAPAZ]);
        Municipio::create(["nombre" => "Cubulco", "departamento_id" => Departamento::BAJA_VERAPAZ]);
        Municipio::create(["nombre" => "Rabinal", "departamento_id" => Departamento::BAJA_VERAPAZ]);
        Municipio::create(["nombre" => "Purulhá", "departamento_id" => Departamento::BAJA_VERAPAZ]);
        Municipio::create(["nombre" => "Chimaltenango", "departamento_id" => Departamento::CHIMALTENANGO]);
        Municipio::create(["nombre" => "San Juan Comalapa", "departamento_id" => Departamento::CHIMALTENANGO]);
        Municipio::create(["nombre" => "Tecpán Guatemala", "departamento_id" => Departamento::CHIMALTENANGO]);
        Municipio::create(["nombre" => "Patzicía", "departamento_id" => Departamento::CHIMALTENANGO]);
        Municipio::create(["nombre" => "Acatenango", "departamento_id" => Departamento::CHIMALTENANGO]);
        Municipio::create(["nombre" => "Chiquimula", "departamento_id" => Departamento::CHIQUIMULA]);
        Municipio::create(["nombre" => "Jocotán", "departamento_id" => Departamento::CHIQUIMULA]);
        Municipio::create(["nombre" => "Camotán", "departamento_id" => Departamento::CHIQUIMULA]);
        Municipio::create(["nombre" => "Olopa", "departamento_id" => Departamento::CHIQUIMULA]);
        Municipio::create(["nombre" => "Esquipulas", "departamento_id" => Departamento::CHIQUIMULA]);
        Municipio::create(["nombre" => "Guastatoya", "departamento_id" => Departamento::EL_PROGRESO]);
        Municipio::create(["nombre" => "Sanarate", "departamento_id" => Departamento::EL_PROGRESO]);
        Municipio::create(["nombre" => "El Jícaro", "departamento_id" => Departamento::EL_PROGRESO]);
        Municipio::create(["nombre" => "Morazán", "departamento_id" => Departamento::EL_PROGRESO]);
        Municipio::create(["nombre" => "Sansare", "departamento_id" => Departamento::EL_PROGRESO]);
        Municipio::create(["nombre" => "Escuintla", "departamento_id" => Departamento::ESCUINTLA]);
        Municipio::create(["nombre" => "Palín", "departamento_id" => Departamento::ESCUINTLA]);
        Municipio::create(["nombre" => "Santa Lucía Cotzumalguapa", "departamento_id" => Departamento::ESCUINTLA]);
        Municipio::create(["nombre" => "Tiquisate", "departamento_id" => Departamento::ESCUINTLA]);
        Municipio::create(["nombre" => "La Democracia", "departamento_id" => Departamento::ESCUINTLA]);
        Municipio::create(["nombre" => "Huehuetenango", "departamento_id" => Departamento::HUEHUETENANGO]);
        Municipio::create(["nombre" => "Malacatancito", "departamento_id" => Departamento::HUEHUETENANGO]);
        Municipio::create(["nombre" => "San Pedro Soloma", "departamento_id" => Departamento::HUEHUETENANGO]);
        Municipio::create(["nombre" => "La Democracia", "departamento_id" => Departamento::HUEHUETENANGO]);
        Municipio::create(["nombre" => "Aguacatán", "departamento_id" => Departamento::HUEHUETENANGO]);
        Municipio::create(["nombre" => "Puerto Barrios", "departamento_id" => Departamento::IZABAL]);
        Municipio::create(["nombre" => "Morales", "departamento_id" => Departamento::IZABAL]);
        Municipio::create(["nombre" => "Livingston", "departamento_id" => Departamento::IZABAL]);
        Municipio::create(["nombre" => "El Estor", "departamento_id" => Departamento::IZABAL]);
        Municipio::create(["nombre" => "Los Amates", "departamento_id" => Departamento::IZABAL]);
        Municipio::create(["nombre" => "Jalapa", "departamento_id" => Departamento::JALAPA]);
        Municipio::create(["nombre" => "San Pedro Pinula", "departamento_id" => Departamento::JALAPA]);
        Municipio::create(["nombre" => "San Luis Jilotepeque", "departamento_id" => Departamento::JALAPA]);
        Municipio::create(["nombre" => "Mataquescuintla", "departamento_id" => Departamento::JALAPA]);
        Municipio::create(["nombre" => "Monjas", "departamento_id" => Departamento::JALAPA]);
        Municipio::create(["nombre" => "Jutiapa", "departamento_id" => Departamento::JUTIAPA]);
        Municipio::create(["nombre" => "El Progreso", "departamento_id" => Departamento::JUTIAPA]);
        Municipio::create(["nombre" => "Santa Catarina Mita", "departamento_id" => Departamento::JUTIAPA]);
        Municipio::create(["nombre" => "Asunción Mita", "departamento_id" => Departamento::JUTIAPA]);
        Municipio::create(["nombre" => "Zapotitlán", "departamento_id" => Departamento::JUTIAPA]);
        Municipio::create(["nombre" => "Flores", "departamento_id" => Departamento::PETEN]);
        Municipio::create(["nombre" => "San Benito", "departamento_id" => Departamento::PETEN]);
        Municipio::create(["nombre" => "San Andrés", "departamento_id" => Departamento::PETEN]);
        Municipio::create(["nombre" => "La Libertad", "departamento_id" => Departamento::PETEN]);
        Municipio::create(["nombre" => "Melchor de Mencos", "departamento_id" => Departamento::PETEN]);
        Municipio::create(["nombre" => "Quetzaltenango", "departamento_id" => Departamento::QUETZALTENANGO]);
        Municipio::create(["nombre" => "Olintepeque", "departamento_id" => Departamento::QUETZALTENANGO]);
        Municipio::create(["nombre" => "La Esperanza", "departamento_id" => Departamento::QUETZALTENANGO]);
        Municipio::create(["nombre" => "Salcajá", "departamento_id" => Departamento::QUETZALTENANGO]);
        Municipio::create(["nombre" => "Almolonga", "departamento_id" => Departamento::QUETZALTENANGO]);
        Municipio::create(["nombre" => "Santa Cruz del Quiché", "departamento_id" => Departamento::QUICHE]);
        Municipio::create(["nombre" => "Chajul", "departamento_id" => Departamento::QUICHE]);
        Municipio::create(["nombre" => "Chiché", "departamento_id" => Departamento::QUICHE]);
        Municipio::create(["nombre" => "Uspantán", "departamento_id" => Departamento::QUICHE]);
        Municipio::create(["nombre" => "Joyabaj", "departamento_id" => Departamento::QUICHE]);
        Municipio::create(["nombre" => "Retalhuleu", "departamento_id" => Departamento::RETALHULEU]);
        Municipio::create(["nombre" => "San Sebastián", "departamento_id" => Departamento::RETALHULEU]);
        Municipio::create(["nombre" => "Santa Cruz Muluá", "departamento_id" => Departamento::RETALHULEU]);
        Municipio::create(["nombre" => "San Martín Zapotitlán", "departamento_id" => Departamento::RETALHULEU]);
        Municipio::create(["nombre" => "Champerico", "departamento_id" => Departamento::RETALHULEU]);
        Municipio::create(["nombre" => "Antigua Guatemala", "departamento_id" => Departamento::SACATEPEQUEZ]);
        Municipio::create(["nombre" => "Ciudad Vieja", "departamento_id" => Departamento::SACATEPEQUEZ]);
        Municipio::create(["nombre" => "San Lucas Sacatepéquez", "departamento_id" => Departamento::SACATEPEQUEZ]);
        Municipio::create(["nombre" => "Jocotenango", "departamento_id" => Departamento::SACATEPEQUEZ]);
        Municipio::create(["nombre" => "Pastores", "departamento_id" => Departamento::SACATEPEQUEZ]);
        Municipio::create(["nombre" => "San Marcos", "departamento_id" => Departamento::SAN_MARCOS]);
        Municipio::create(["nombre" => "Malacatán", "departamento_id" => Departamento::SAN_MARCOS]);
        Municipio::create(["nombre" => "San Pedro Sacatepéquez", "departamento_id" => Departamento::SAN_MARCOS]);
        Municipio::create(["nombre" => "Ayutla", "departamento_id" => Departamento::SAN_MARCOS]);
        Municipio::create(["nombre" => "El Tumbador", "departamento_id" => Departamento::SAN_MARCOS]);
        Municipio::create(["nombre" => "Cuilapa", "departamento_id" => Departamento::SANTA_ROSA]);
        Municipio::create(["nombre" => "Barberena", "departamento_id" => Departamento::SANTA_ROSA]);
        Municipio::create(["nombre" => "Nueva Santa Rosa", "departamento_id" => Departamento::SANTA_ROSA]);
        Municipio::create(["nombre" => "Chiquimulilla", "departamento_id" => Departamento::SANTA_ROSA]);
        Municipio::create(["nombre" => "Casillas", "departamento_id" => Departamento::SANTA_ROSA]);
        Municipio::create(["nombre" => "Sololá", "departamento_id" => Departamento::SOLOLA]);
        Municipio::create(["nombre" => "Panajachel", "departamento_id" => Departamento::SOLOLA]);
        Municipio::create(["nombre" => "Santa Catarina Palopó", "departamento_id" => Departamento::SOLOLA]);
        Municipio::create(["nombre" => "San Lucas Tolimán", "departamento_id" => Departamento::SOLOLA]);
        Municipio::create(["nombre" => "Santiago Atitlán", "departamento_id" => Departamento::SOLOLA]);
        Municipio::create(["nombre" => "Mazatenango", "departamento_id" => Departamento::SUCHITEPEQUEZ]);
        Municipio::create(["nombre" => "San Antonio Suchitepéquez", "departamento_id" => Departamento::SUCHITEPEQUEZ]);
        Municipio::create(["nombre" => "Samayac", "departamento_id" => Departamento::SUCHITEPEQUEZ]);
        Municipio::create(["nombre" => "Santo Domingo Suchitepéquez", "departamento_id" => Departamento::SUCHITEPEQUEZ]);
        Municipio::create(["nombre" => "Chicacao", "departamento_id" => Departamento::SUCHITEPEQUEZ]);
        Municipio::create(["nombre" => "Totonicapán", "departamento_id" => Departamento::TOTONICAPAN]);
        Municipio::create(["nombre" => "San Cristóbal Totonicapán", "departamento_id" => Departamento::TOTONICAPAN]);
        Municipio::create(["nombre" => "San Andrés Xecul", "departamento_id" => Departamento::TOTONICAPAN]);
        Municipio::create(["nombre" => "Momostenango", "departamento_id" => Departamento::TOTONICAPAN]);
        Municipio::create(["nombre" => "Santa María Chiquimula", "departamento_id" => Departamento::TOTONICAPAN]);
        Municipio::create(["nombre" => "Zacapa", "departamento_id" => Departamento::ZACAPA]);
        Municipio::create(["nombre" => "Chiquimula", "departamento_id" => Departamento::ZACAPA]);
        Municipio::create(["nombre" => "Estanzuela", "departamento_id" => Departamento::ZACAPA]);
        Municipio::create(["nombre" => "Gualán", "departamento_id" => Departamento::ZACAPA]);
        Municipio::create(["nombre" => "La Unión", "departamento_id" => Departamento::ZACAPA]);

    }
}
