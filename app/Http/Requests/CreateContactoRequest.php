<?php

namespace App\Http\Requests;

use App\Models\Contacto;
use Illuminate\Foundation\Http\FormRequest;

class CreateContactoRequest extends FormRequest
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
        return Contacto::$rules;
    }

    public function messages()
    {
        return Contacto::$messages;
    }
}
