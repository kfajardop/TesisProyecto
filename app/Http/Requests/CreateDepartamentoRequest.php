<?php

namespace App\Http\Requests;

use App\Models\Departamento;
use Illuminate\Foundation\Http\FormRequest;

class CreateDepartamentoRequest extends FormRequest
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
        return Departamento::$rules;
    }

    public function messages()
    {
        return Departamento::$messages;
    }
}
