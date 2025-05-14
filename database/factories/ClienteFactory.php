<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Direccione;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $direccione = Direccione::first();
        if (!$direccione) {
            $direccione = Direccione::factory()->create();
        }

        return [
            'primer_nombre' => $this->faker->text($this->faker->numberBetween(5, 55)),
            'segundo_nombre' => $this->faker->text($this->faker->numberBetween(5, 55)),
            'primer_apellido' => $this->faker->text($this->faker->numberBetween(5, 55)),
            'segundo_apellido' => $this->faker->text($this->faker->numberBetween(5, 55)),
            'dpi' => $this->faker->text($this->faker->numberBetween(5, 13)),
            'telefono' => $this->faker->text($this->faker->numberBetween(5, 8)),
            'direccion_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
