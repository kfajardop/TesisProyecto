<?php

namespace App\Http\Requests;

use App\Models\DocumentoTipo;
use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentoTipoRequest extends FormRequest
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
        return DocumentoTipo::$rules;
    }

    public function messages()
    {
        return DocumentoTipo::$messages;
    }
}
