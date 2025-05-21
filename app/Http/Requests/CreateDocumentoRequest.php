<?php

namespace App\Http\Requests;

use App\Models\Documento;
use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentoRequest extends FormRequest
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
        return Documento::$rules;
    }

    public function messages()
    {
        return Documento::$messages;
    }
}
