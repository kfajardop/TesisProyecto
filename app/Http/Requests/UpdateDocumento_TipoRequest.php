<?php

namespace App\Http\Requests;

use App\Models\Documento_Tipo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumento_TipoRequest extends FormRequest
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
        $rules = Documento_Tipo::$rules;
        
        return $rules;
    }

    public function messages()
    {
        return Documento_Tipo::$messages;
    }
}
