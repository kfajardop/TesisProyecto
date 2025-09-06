<?php

namespace App\Http\Requests;

use App\Models\Documento;
use App\Models\DocumentoTipo;
use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $camposJson = [
            'comparecientes',
            'intervinientes',
        ];

        foreach ($camposJson as $campo) {
            if (is_string($this->$campo)) {
                $this->merge([
                    $campo => json_decode($this->$campo, true) ?? []
                ]);
            }
        }
    }

    public function rules()
    {
        $rules = [
            'tipo_id' => 'required|exists:caso_tipos,id',
            'observaciones' => 'nullable|string',
        ];

        $tipoDocumento = $this->input('tipo_id');

        switch ($tipoDocumento) {
            // 🔹 Documentos Públicos
            case DocumentoTipo::PUBLICO:
                $rules = array_merge($rules, [
                    'tipo_escritura_id' => 'required|exists:docto_publico_escrituras,id',
                    'no_escritura' => 'required|string|max:50',
                    'comparecientes' => 'required|array|min:1',
                    'comparecientes.*.id' => 'required|distinct',
                    'intervinientes' => 'required|array|min:1',
                    'intervinientes.*.id' => 'required|distinct',
                    'fecha_documento' => 'required|date',
                    'estado_id' => 'required|exists:documento_estados,id',
                ]);
                break;

            // 🔹 Documentos Privados
            case DocumentoTipo::PRIVADO:
                $rules = array_merge($rules, [
                    'tipo_contrato_id' => 'required|exists:tipos_contrato,id',
                    'comparecientes' => 'required|array|min:1',
                    'comparecientes.*.id' => 'required|distinct',
                    'intervinientes' => 'required|array|min:1',
                    'intervinientes.*.id' => 'required|distinct',
                    'fecha_documento' => 'required|date',
                    'estado_id' => 'required|exists:documento_estados,id',
                ]);
                break;

            // 🔹 Acta Notarial
            case DocumentoTipo::ACTA_NOTARIAL:
                $rules = array_merge($rules, [
                    'tipo_acta_notarial_id' => 'required|exists:tipos_acta_notarial,id',
                    'comparecientes' => 'required|array|min:1',
                    'comparecientes.*.id' => 'required|distinct',
                    'intervinientes' => 'required|array|min:1',
                    'intervinientes.*.id' => 'required|distinct',
                    'fecha_documento' => 'required|date',
                    'estado_id' => 'required|exists:documento_estados,id',
                ]);
                break;
        }

        return $rules;
    }

    public function messages()
    {
        return array_merge(Documento::$messages, [
            // Públicos
            'tipo_id.required' => 'Debe seleccionar un tipo de documento.',
            'tipo_escritura_id.required' => 'Debe seleccionar el tipo de escritura.',
            'no_escritura.required' => 'Debe ingresar el número de escritura.',

            // Privados
            'tipo_contrato_id.required' => 'Debe seleccionar el tipo de contrato.',

            // Acta Notarial
            'tipo_acta_notarial_id.required' => 'Debe seleccionar el tipo de acta notarial.',

            // Comunes
            'comparecientes.required' => 'Debe agregar al menos un compareciente.',
            'comparecientes.min' => 'Debe agregar al menos un compareciente.',
            'intervinientes.required' => 'Debe agregar al menos un interviniente.',
            'intervinientes.min' => 'Debe agregar al menos un interviniente.',
            'fecha_documento.required' => 'Debe ingresar la fecha del documento.',
            'estado_id.required' => 'Debe seleccionar un estado del documento.',
        ]);
    }
}
