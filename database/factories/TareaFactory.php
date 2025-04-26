<?php

namespace Database\Factories;

use App\Models\Tarea;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\TareaEstado;
use App\Models\TareaPrioridade;

class TareaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tarea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $tareaPrioridade = TareaPrioridade::first();
        if (!$tareaPrioridade) {
            $tareaPrioridade = TareaPrioridade::factory()->create();
        }

        return [
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'fecha' => $this->faker->date('Y-m-d'),
            'hora' => $this->faker->date('H:i:s'),
            'descripcion' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'prioridad_id' => $this->faker->word,
            'estado_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
