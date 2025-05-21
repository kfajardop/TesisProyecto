<?php

namespace App\Http\Requests;

use App\Models\DocumentoPublicoDetalle;
use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentoPublicoDetalleRequest extends FormRequest
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
        return DocumentoPublicoDetalle::$rules;
    }

    public function messages()
    {
        return DocumentoPublicoDetalle::$messages;
    }
}
