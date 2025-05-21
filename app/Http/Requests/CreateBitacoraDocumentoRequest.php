<?php

namespace App\Http\Requests;

use App\Models\BitacoraDocumento;
use Illuminate\Foundation\Http\FormRequest;

class CreateBitacoraDocumentoRequest extends FormRequest
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
        return BitacoraDocumento::$rules;
    }

    public function messages()
    {
        return BitacoraDocumento::$messages;
    }
}
