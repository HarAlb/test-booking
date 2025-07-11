<?php

namespace Domain\Booking\Repositories;

use Domain\Booking\Entities\Booking;

interface BookingRepositoryInterface
{
    public function save(Booking $booking): Booking;

    public function getByResource(int $resourceId): array;

    public function findByIdAndUserId(int $id, int $userId): ?Booking;

    public function destroy(int $id): void;

    public function checkUserBookingConflict(int $userId, \DateTimeImmutable $start, \DateTimeImmutable $end): bool;
}
