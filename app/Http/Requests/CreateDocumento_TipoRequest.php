<?php

namespace App\Http\Requests;

use App\Models\Documento_Tipo;
use Illuminate\Foundation\Http\FormRequest;

class CreateDocumento_TipoRequest extends FormRequest
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
        return Documento_Tipo::$rules;
    }

    public function messages()
    {
        return Documento_Tipo::$messages;
    }
}
