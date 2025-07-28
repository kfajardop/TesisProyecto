<?php
namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;

class CreateCasoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $camposJson = [
            'victimas',
            'victimarios',
            'personas_demandantes',
            'personas_demandadas',
        ];

        foreach ($camposJson as $campo) {
            if (is_string($this->$campo)) {
                $this->merge([
                    $campo => json_decode($this->$campo, true) ?? []
                ]);
            }
        }
    }

    public function rules(): array
    {
        $rules = [
            'tipo_id' => 'required|exists:caso_tipos,id',
            'observaciones' => 'nullable|string',
        ];

        $tipoCaso = $this->input('tipo_id');

        // Familiar
        if ($tipoCaso == \App\Models\CasoTipo::FAMILIAR) {
            $rules = array_merge($rules, [
                'tipo_juicio_id' => 'required|exists:caso_familiar_juicio_tipos,id',
                'personas_demandantes' => 'required|array|min:1',
                'personas_demandantes.*.id' => 'required|distinct',
                'personas_demandadas' => 'required|array|min:1',
                'personas_demandadas.*.id' => 'required|distinct',
                'etapa_id' => 'required|exists:caso_familiar_juicio_etapas,id',
            ]);
        }

        // Penal
        if ($tipoCaso == \App\Models\CasoTipo::PENAL) {
            $rules = array_merge($rules, [
                'no_causa' => 'required|string|max:50',
                'no_expediente' => 'required|string|max:50',
                'delito_id' => 'required|exists:caso_penal_delitos,id',
                'victimas' => 'required|array|min:1',
                'victimas.*.id' => 'required|distinct',
                'victimarios' => 'required|array|min:1',
                'victimarios.*.id' => 'required|distinct',
                'etapa_id' => 'required|exists:caso_penal_etapas,id',
            ]);
        }

        return $rules;
    }


    public function messages(): array
    {
        return [
            // Tipo de caso
            'tipo_id.required' => 'Por favor seleccione el tipo de caso.',

            // Familiar
            'tipo_juicio_id.required' => 'Seleccione el tipo de juicio para continuar.',
            'personas_demandantes.required' => 'Agregue al menos una persona como demandante.',
            'personas_demandantes.array' => 'Debe seleccionar al menos una persona como demandante.',
            'personas_demandantes.min' => 'Debe agregar al menos una persona como demandante.',
            'personas_demandadas.required' => 'Agregue al menos una persona como demandada.',
            'personas_demandadas.array' => 'Debe seleccionar al menos una persona como demandada.',
            'personas_demandadas.min' => 'Debe agregar al menos una persona como demandada.',
            'etapa_juicio_id.required' => 'Seleccione la etapa del juicio.',

            // Penal
            'no_causa.required' => 'Ingrese el número de causa del caso.',
            'no_expediente.required' => 'Ingrese el número de expediente.',
            'delito_id.required' => 'Seleccione el delito relacionado con el caso.',
            'victimas.required' => 'Agregue al menos una persona como víctima.',
            'victimas.array' => 'Debe seleccionar al menos una persona como víctima.',
            'victimas.min' => 'Debe agregar al menos una persona como víctima.',
            'victimarios.required' => 'Agregue al menos una persona como victimario.',
            'victimarios.array' => 'Debe seleccionar al menos una persona como victimario.',
            'victimarios.min' => 'Debe agregar al menos una persona como victimario.',
            'etapa_penal_id.required' => 'Seleccione la etapa del proceso penal.',
        ];
    }
}
