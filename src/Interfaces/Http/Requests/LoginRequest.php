<?php

namespace Interfaces\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OAT;

#[
    OAT\RequestBody(
        required: true,
        content: new OAT\JsonContent(
            required: ['email', 'password'],
            properties: [
                new OAT\Property(property: 'email', type: 'string', format: 'email', example: 'user@example.com'),
                new OAT\Property(property: 'password', type: 'string', format: 'password', example: 'secret123'),
            ]
        )
    )
]
class LoginRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ];
    }
}
