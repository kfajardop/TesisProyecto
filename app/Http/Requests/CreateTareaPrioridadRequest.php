<?php

namespace App\Http\Requests;

use App\Models\TareaPrioridad;
use Illuminate\Foundation\Http\FormRequest;

class CreateTareaPrioridadRequest extends FormRequest
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
        return TareaPrioridad::$rules;
    }

    public function messages()
    {
        return TareaPrioridad::$messages;
    }
}
