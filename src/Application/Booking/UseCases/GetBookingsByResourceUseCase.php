<?php

namespace Application\Booking\UseCases;

use Domain\Booking\Repositories\BookingRepositoryInterface;
use Domain\Resource\Exceptions\ResourceNotFoundException;
use Domain\Resource\Repositories\ResourceRepositoryInterface;

class GetBookingsByResourceUseCase
{
    public function __construct(
        private BookingRepositoryInterface $repository,
        private ResourceRepositoryInterface $resourceRepository
    )
    {
    }

    public function execute(int $resourceId): array
    {
        if (!$this->resourceRepository->exists($resourceId)) {
            throw new ResourceNotFoundException();
        }

        return $this->repository->getByResource($resourceId);
    }
}
