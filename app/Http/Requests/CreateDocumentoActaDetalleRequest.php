<?php

namespace App\Http\Requests;

use App\Models\DocumentoActaDetalle;
use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentoActaDetalleRequest extends FormRequest
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
        return DocumentoActaDetalle::$rules;
    }

    public function messages()
    {
        return DocumentoActaDetalle::$messages;
    }
}
