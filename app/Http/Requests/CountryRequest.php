<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:2|unique:countries,code',
        ];

        // Para el caso de actualización, ignorar el código del país actual
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $country = $this->route('country');
            $rules['code'] .= ',' . $country->id;
        }

        return $rules;
    }
}