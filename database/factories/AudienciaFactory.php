<?php

namespace Database\Factories;

use App\Models\Audiencia;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Caso;

class AudienciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Audiencia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $caso = Caso::first();
        if (!$caso) {
            $caso = Caso::factory()->create();
        }

        return [
            'fecha' => $this->faker->date('Y-m-d'),
            'hora' => $this->faker->date('H:i:s'),
            'lugar' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'caso_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
