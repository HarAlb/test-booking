<?php

namespace Domain\Resource\Entities;

use DateTimeImmutable;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'ResourceResponse',
    title: 'Resource response',
    required: ['name', 'type']
)]
class Resource implements \JsonSerializable
{
    #[OAT\Property(property: 'id', type: 'integer', nullable: true, example: 1)]
    private ?int $id = null;

    #[OAT\Property(property: 'name', type: 'string', example: 'Room 101')]
    private string $name;

    #[OAT\Property(property: 'type', type: 'string', example: 'room')]
    private string $type;

    #[OAT\Property(property: 'description', type: 'string', nullable: true, example: 'Конференц-зал')]
    private ?string $description = null;

    #[OAT\Property(property: 'createdAt', type: 'string', format: 'date-time', nullable: true, example: '2025-07-11T14:00:00+00:00')]
    private ?DateTimeImmutable $createdAt = null;

    #[OAT\Property(property: 'updatedAt', type: 'string', format: 'date-time', nullable: true, example: '2025-07-12T10:30:00+00:00')]
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct(
        string $name,
        string $type,
        ?string $description = null,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null,
    )
    {
        $this->name = $name;
        $this->type = $type;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'type' => $this->getType(),
            'description' => $this->getDescription(),
            'createdAt' => $this->getCreatedAt()?->format(DATE_ATOM), // ISO8601
            'updatedAt' => $this->getUpdatedAt()?->format(DATE_ATOM),
        ];
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeImmutable $dateTimeImmutable): void
    {
        $this->createdAt = $dateTimeImmutable;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }


    public function setUpdatedAt(DateTimeImmutable $dateTimeImmutable): void
    {
        $this->updatedAt = $dateTimeImmutable;
    }

}
