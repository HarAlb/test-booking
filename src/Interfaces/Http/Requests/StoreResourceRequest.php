<?php

namespace Interfaces\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OAT;

#[
    OAT\RequestBody(
        required: true,
        content: new OAT\JsonContent(
            required: ['name', 'type'],
            properties: [
                new OAT\Property(
                    property: 'name',
                    type: 'string',
                    maxLength: 255,
                    example: 'Room A'
                ),
                new OAT\Property(
                    property: 'type',
                    type: 'string',
                    maxLength: 16,
                    example: 'room'
                ),
                new OAT\Property(
                    property: 'description',
                    type: 'string',
                    maxLength: 1024,
                    example: 'Spacious room with sea view',
                    nullable: true
                ),
            ],
            type: 'object'
        )
    )
]
class StoreResourceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:16',
            'description' => 'nullable|string|max:1024'
        ];
    }
}
