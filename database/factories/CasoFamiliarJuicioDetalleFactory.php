<?php

namespace Database\Factories;

use App\Models\CasoFamiliarJuicioDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Caso;
use App\Models\CasoFamiliarJuicioEtapa;
use App\Models\CasoFamiliarJuicioTipo;

class CasoFamiliarJuicioDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CasoFamiliarJuicioDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $casoFamiliarJuicioTipo = CasoFamiliarJuicioTipo::first();
        if (!$casoFamiliarJuicioTipo) {
            $casoFamiliarJuicioTipo = CasoFamiliarJuicioTipo::factory()->create();
        }

        return [
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'juicio_etapa_id' => $this->faker->word,
            'caso_id' => $this->faker->word,
            'tipo_juicio_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
