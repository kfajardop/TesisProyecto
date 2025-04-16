<?php

namespace App\Http\Requests;

use App\Models\Tarea_Prioridad;
use Illuminate\Foundation\Http\FormRequest;

class CreateTarea_PrioridadRequest extends FormRequest
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
        return Tarea_Prioridad::$rules;
    }

    public function messages()
    {
        return Tarea_Prioridad::$messages;
    }
}
