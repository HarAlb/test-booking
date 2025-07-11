<?php

namespace Interfaces\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OAT;

#[
    OAT\RequestBody(
        required: true,
        content: new OAT\JsonContent(
            required: ['resource_id', 'start_time', 'end_time'],
            properties: [
                new OAT\Property(
                    property: 'resource_id',
                    type: 'integer',
                    example: 1
                ),
                new OAT\Property(
                    property: 'start_time',
                    type: 'string',
                    format: 'date-time',
                    example: '2025-07-11 12:22:34',
                ),
                new OAT\Property(
                    property: 'end_time',
                    type: 'string',
                    format: 'date-time',
                    example: '2025-07-11 12:11:22',
                ),
            ],
            type: 'object'
        )
    )
]
class StoreBookingRequest extends FormRequest
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
            'resource_id' => 'required|int|exists:resources,id',
            'start_time' => 'required|string|date_format:Y-m-d H:i:s',
            'end_time' => 'required|string|date_format:Y-m-d H:i:s',
        ];
    }
}
