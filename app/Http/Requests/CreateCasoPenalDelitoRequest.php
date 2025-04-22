<?php

namespace App\Http\Requests;

use App\Models\CasoPenalDelito;
use Illuminate\Foundation\Http\FormRequest;

class CreateCasoPenalDelitoRequest extends FormRequest
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
        return CasoPenalDelito::$rules;
    }

    public function messages()
    {
        return CasoPenalDelito::$messages;
    }
}
