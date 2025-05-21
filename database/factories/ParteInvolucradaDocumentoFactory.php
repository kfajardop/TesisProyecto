<?php

namespace Database\Factories;

use App\Models\ParteInvolucradaDocumento;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Documento;
use App\Models\ParteTipo;

class ParteInvolucradaDocumentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ParteInvolucradaDocumento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $parteTipo = ParteTipo::first();
        if (!$parteTipo) {
            $parteTipo = ParteTipo::factory()->create();
        }

        return [
            'model_type' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'model_id' => $this->faker->word,
            'tipo_id' => $this->faker->word,
            'documento_id' => $this->faker->word
        ];
    }
}
