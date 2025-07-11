<?php

namespace Application\Booking\UseCases;

use Domain\Booking\Repositories\BookingRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;

class DestroyBookingUseCase
{
    public function __construct(
        private BookingRepositoryInterface $repository
    ) {
    }

    public function execute(int $id, int $userId): void
    {
        if (!$this->repository->findByIdAndUserId($id, $userId)) {
            throw new AuthorizationException("Permission denied Or not exists");
        }

        $this->repository->destroy($id);
    }
}
