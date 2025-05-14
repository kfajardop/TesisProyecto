<?php

namespace Database\Factories;

use App\Models\CasoPenalDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Caso;
use App\Models\CasoPenalDelito;
use App\Models\CasoPenalEtapa;

class CasoPenalDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CasoPenalDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $casoPenalEtapa = CasoPenalEtapa::first();
        if (!$casoPenalEtapa) {
            $casoPenalEtapa = CasoPenalEtapa::factory()->create();
        }

        return [
            'no_causa' => $this->faker->text($this->faker->numberBetween(5, 10)),
            'no_expediente' => $this->faker->text($this->faker->numberBetween(5, 45)),
            'caso_id' => $this->faker->word,
            'delito_id' => $this->faker->word,
            'etapa_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
