<?php

namespace Database\Factories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;


class PersonaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Persona::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'primer_nombre' => $this->faker->text($this->faker->numberBetween(5, 55)),
            'segundo_nombre' => $this->faker->text($this->faker->numberBetween(5, 55)),
            'primer_apellido' => $this->faker->text($this->faker->numberBetween(5, 55)),
            'segundo_apellido' => $this->faker->text($this->faker->numberBetween(5, 55)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
