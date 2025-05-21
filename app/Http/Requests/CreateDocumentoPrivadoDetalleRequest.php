<?php

namespace App\Http\Requests;

use App\Models\DocumentoPrivadoDetalle;
use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentoPrivadoDetalleRequest extends FormRequest
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
        return DocumentoPrivadoDetalle::$rules;
    }

    public function messages()
    {
        return DocumentoPrivadoDetalle::$messages;
    }
}
