<?php

namespace Database\Factories;

use App\Models\Caso_Tipo;
use Illuminate\Database\Eloquent\Factories\Factory;


class Caso_TipoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Caso_Tipo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
