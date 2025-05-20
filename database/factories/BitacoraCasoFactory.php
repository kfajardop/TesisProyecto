<?php

namespace Database\Factories;

use App\Models\BitacoraCaso;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Caso;
use App\Models\User;

class BitacoraCasoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BitacoraCaso::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create();
        }

        return [
            'descripcion' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'usuario_id' => $this->faker->word,
            'caso_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
