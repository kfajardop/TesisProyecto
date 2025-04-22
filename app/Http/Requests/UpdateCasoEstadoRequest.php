<?php

namespace App\Http\Requests;

use App\Models\CasoEstado;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCasoEstadoRequest extends FormRequest
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
        $rules = CasoEstado::$rules;
        
        return $rules;
    }

    public function messages()
    {
        return CasoEstado::$messages;
    }
}
