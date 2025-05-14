<?php

namespace App\Http\Requests;

use App\Models\ParteInvolucradaCasos;
use Illuminate\Foundation\Http\FormRequest;

class CreateParteInvolucradaCasosRequest extends FormRequest
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
        return ParteInvolucradaCasos::$rules;
    }

    public function messages()
    {
        return ParteInvolucradaCasos::$messages;
    }
}
