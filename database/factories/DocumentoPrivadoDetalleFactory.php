<?php

namespace Database\Factories;

use App\Models\DocumentoPrivadoDetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\DoctoPrivadoContrato;
use App\Models\Documento;

class DocumentoPrivadoDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DocumentoPrivadoDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $documento = Documento::first();
        if (!$documento) {
            $documento = Documento::factory()->create();
        }

        return [
            'fecha' => $this->faker->date('Y-m-d'),
            'comentario' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'documento_id' => $this->faker->word,
            'contrato_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
