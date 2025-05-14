<?php

namespace Database\Factories;

use App\Models\ParteInvolucradaCasos;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Caso;
use App\Models\ParteTipo;

class ParteInvolucradaCasosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ParteInvolucradaCasos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $parteTipo = ParteTipo::first();
        if (!$parteTipo) {
            $parteTipo = ParteTipo::factory()->create();
        }

        return [
            'model_type' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'model_id' => $this->faker->word,
            'caso_id' => $this->faker->word,
            'tipo_id' => $this->faker->word
        ];
    }
}
