<?php

namespace Database\Factories;

use App\Models\Documento;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\DocumentoEstado;
use App\Models\DocumentoTipo;
use App\Models\User;

class DocumentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Documento::class;

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
