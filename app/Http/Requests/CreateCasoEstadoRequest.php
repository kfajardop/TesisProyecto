<?php

namespace App\Http\Requests;

use App\Models\CasoEstado;
use Illuminate\Foundation\Http\FormRequest;

class CreateCasoEstadoRequest extends FormRequest
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
        return CasoEstado::$rules;
    }

    public function messages()
    {
        return CasoEstado::$messages;
    }
}
