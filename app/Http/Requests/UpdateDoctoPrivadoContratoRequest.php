<?php

namespace App\Http\Requests;

use App\Models\DoctoPrivadoContrato;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctoPrivadoContratoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = DoctoPrivadoContrato::$rules;
        
        return $rules;
    }

    public function messages()
    {
        return DoctoPrivadoContrato::$messages;
    }
}
