<?php

namespace Application\Booking\UseCases;

use Domain\Booking\Entities\Booking;
use Domain\Booking\Exceptions\BookingPeriodConflictException;
use Domain\Booking\Repositories\BookingRepositoryInterface;
use Domain\Resource\Exceptions\ResourceNotFoundException;
use Domain\Resource\Repositories\ResourceRepositoryInterface;

class StoreBookingUseCase
{
    public function __construct(
        private BookingRepositoryInterface $repository,
        private ResourceRepositoryInterface $resourceRepository
    )
    {
    }

    public function execute(int $resourceId, int $userId, \DateTimeImmutable $start, \DateTimeImmutable $end): Booking
    {
        if ($this->repository->checkUserBookingConflict($userId, $start, $end)) {
            throw new BookingPeriodConflictException();
        }

        if (!$this->resourceRepository->exists($resourceId)) {
            throw new ResourceNotFoundException();
        }

        $booking = new Booking($resourceId, $userId, $start, $end);

        return $this->repository->save($booking);
    }
}
