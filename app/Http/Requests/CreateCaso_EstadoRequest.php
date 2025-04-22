<?php

namespace App\Http\Requests;

use App\Models\Caso_Estado;
use Illuminate\Foundation\Http\FormRequest;

class CreateCaso_EstadoRequest extends FormRequest
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
        return Caso_Estado::$rules;
    }

    public function messages()
    {
        return Caso_Estado::$messages;
    }
}
