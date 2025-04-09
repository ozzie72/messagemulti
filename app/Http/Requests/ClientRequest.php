<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        return [
			'company' => 'required|string|max:100',
			'name' => 'required|string|max:50',
			'last_name' => 'required|string|max:50',
			'ip' => 'required|string|max:15',
			'port' => 'required|string|max:6',
			'server_user' => 'string|max:50',
			'server_pass' => 'string|max:100',
            'image'  => 'required|image|mimes:jpeg,jpg',
            'divition_id' => 'required|exists:divitions,id',
            'department_id' => 'required|exists:departments,id',
        ];
    }
}
