<?php

namespace Database\Factories;

use App\Models\BitacoraDocumento;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Documento;
use App\Models\User;

class BitacoraDocumentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BitacoraDocumento::class;

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
            'titulo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'descripcion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'usuario_id' => $this->faker->word,
            'documento_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
