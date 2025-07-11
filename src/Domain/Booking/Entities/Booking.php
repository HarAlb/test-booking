<?php

namespace Domain\Booking\Entities;

use DateTimeImmutable;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'BookingResponse',
    title: 'Booking response',
    required: ['resource_id', 'user_id', 'start', 'end']
)]
class Booking implements \JsonSerializable
{
    #[OAT\Property(property: 'id', type: 'integer', nullable: true, example: 1)]
    private ?int $id = null;

    #[OAT\Property(property: 'resource_id', type: 'integer', example: 3)]
    private int $resourceId;

    #[OAT\Property(property: 'user_id', type: 'integer', example: 7)]
    private int $userId;

    #[OAT\Property(property: 'start_time', type: 'string', format: 'date-time', example: '2025-07-12T10:00:00+04:00')]
    private DateTimeImmutable $start_time;

    #[OAT\Property(property: 'end_time', type: 'string', format: 'date-time', example: '2025-07-12T12:00:00+04:00')]
    private DateTimeImmutable $end_time;

    #[OAT\Property(property: 'createdAt', type: 'string', format: 'date-time', nullable: true)]
    private ?DateTimeImmutable $createdAt;

    #[OAT\Property(property: 'updatedAt', type: 'string', format: 'date-time', nullable: true)]
    private ?DateTimeImmutable $updatedAt;

    public function __construct(
        int $resourceId,
        int $userId,
        DateTimeImmutable $start_time,
        DateTimeImmutable $end_time,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null
    )
    {
        $this->resourceId = $resourceId;
        $this->userId = $userId;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'resource_id' => $this->getResourceId(),
            'user_id' => $this->getUserId(),
            'start_time' => $this->getStartTime()?->format(DATE_ATOM),
            'end_time' => $this->getEndTime()?->format(DATE_ATOM),
            'createdAt' => $this->getCreatedAt()?->format(DATE_ATOM),
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
     * @return int
     */
    public function getResourceId(): int
    {
        return $this->resourceId;
    }

    /**
     * @param int $resourceId
     */
    public function setResourceId(int $resourceId): void
    {
        $this->resourceId = $resourceId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getStartTime(): DateTimeImmutable
    {
        return $this->start_time;
    }

    /**
     * @param DateTimeImmutable $start_time
     */
    public function setStartTime(DateTimeImmutable $start_time): void
    {
        $this->start_time = $start_time;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getEndTime(): DateTimeImmutable
    {
        return $this->end_time;
    }

    /**
     * @param DateTimeImmutable $end_time
     */
    public function setEndTime(DateTimeImmutable $end_time): void
    {
        $this->end_time = $end_time;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable|null $createdAt
     */
    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeImmutable|null $updatedAt
     */
    public function setUpdatedAt(?DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
