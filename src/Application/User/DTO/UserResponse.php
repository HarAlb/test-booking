<?php


namespace Application\User\DTO;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'UserResponse',
    title: 'User response',
    required: ['id', 'name', 'email']
)]
class UserResponse implements \JsonSerializable
{
    public function __construct(
        #[OAT\Property(property: 'id', type: 'integer', example: 1)]
        private int $id,

        #[OAT\Property(property: 'name', type: 'string', example: 'John Doe')]
        private string $name,

        #[OAT\Property(property: 'email', type: 'string', example: 'john@example.com')]
        private string $email
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
