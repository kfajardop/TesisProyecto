<?php

namespace App\Http\Requests;

use App\Models\DoctoActaNotarial;
use Illuminate\Foundation\Http\FormRequest;

class CreateDoctoActaNotarialRequest extends FormRequest
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
        return DoctoActaNotarial::$rules;
    }

    public function messages()
    {
        return DoctoActaNotarial::$messages;
    }
}
