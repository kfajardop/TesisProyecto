<?php

namespace Database\Factories;

use App\Models\Caso;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\CasoEstado;
use App\Models\CasoTipo;
use App\Models\User;

class CasoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Caso::class;

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
            'tipo_id' => $this->faker->word,
            'estado_id' => $this->faker->word,
            'usuario_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
