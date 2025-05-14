<?php

namespace Database\Factories;

use App\Models\Municipio;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Departamento;

class MunicipioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Municipio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $departamento = Departamento::first();
        if (!$departamento) {
            $departamento = Departamento::factory()->create();
        }

        return [
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 55)),
            'departamento_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
