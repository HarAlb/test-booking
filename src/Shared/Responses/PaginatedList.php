<?php

namespace Shared\Responses;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'PaginatedList',
    properties: [
        new OAT\Property(property: 'data', type: 'array', items: new OAT\Items(ref: '#/components/schemas/ResourceResponse')),
        new OAT\Property(
            property: 'meta',
            properties: [
                new OAT\Property(property: 'total', type: 'integer', example: 100),
                new OAT\Property(property: 'current_page', type: 'integer', example: 1),
                new OAT\Property(property: 'per_page', type: 'integer', example: 10),
                new OAT\Property(property: 'last_page', type: 'integer', example: 10),
            ],
            type: 'object'
        ),
    ]
)]
class PaginatedList implements \JsonSerializable
{
    public function __construct(
        public array $items,
        public int $total,
        public int $currentPage,
        public int $perPage
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'data' => $this->items,
            'meta' => [
                'total' => $this->total,
                'current_page' => $this->currentPage,
                'per_page' => $this->perPage,
                'last_page' => ceil($this->total / $this->perPage),
            ],
        ];
    }
}
