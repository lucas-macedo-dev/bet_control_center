<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedAuthorization()
    {
        abort(401, 'Você precisa estar autenticado para realizar essa ação.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bet_value' => 'required|numeric|min:0',
            'value_received' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'bet_value.required' => 'A bet mount is required',
            'value_received.required' => 'A returned value is required',
            'description.string' => 'The description must be of type string',
        ];
    }
}
