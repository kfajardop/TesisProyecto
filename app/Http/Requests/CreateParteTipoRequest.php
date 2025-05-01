<?php

namespace App\Http\Requests;

use App\Models\ParteTipo;
use Illuminate\Foundation\Http\FormRequest;

class CreateParteTipoRequest extends FormRequest
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
        return ParteTipo::$rules;
    }

    public function messages()
    {
        return ParteTipo::$messages;
    }
}
