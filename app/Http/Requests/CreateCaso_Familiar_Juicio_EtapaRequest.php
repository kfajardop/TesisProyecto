<?php

namespace App\Http\Requests;

use App\Models\Caso_Familiar_Juicio_Etapa;
use Illuminate\Foundation\Http\FormRequest;

class CreateCaso_Familiar_Juicio_EtapaRequest extends FormRequest
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
        return Caso_Familiar_Juicio_Etapa::$rules;
    }

    public function messages()
    {
        return Caso_Familiar_Juicio_Etapa::$messages;
    }
}
