<?php

namespace App\Http\Requests;

use App\Models\Caso_Penal_Delito;
use Illuminate\Foundation\Http\FormRequest;

class CreateCaso_Penal_DelitoRequest extends FormRequest
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
        return Caso_Penal_Delito::$rules;
    }

    public function messages()
    {
        return Caso_Penal_Delito::$messages;
    }
}
